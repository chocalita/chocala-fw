<?php
require_once("EmailEngine.php");

/**
 * @author ypra
 * Date: 4/4/2016
 * Time: 11:52 p.m.
 */
class EmailSender
{

    /**
     * @var SysEmail
     */
    private $email = null;

    /**
     * @var SysUser
     */
    private $user = null;

    /**
     * @var EmailEngine
     */
    private $emailEngine = null;

    /**
     * @return SysEmail
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return SysUser
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param SysUser $user
     */
    public function setUser(SysUser $user)
    {
        $this->user = $user;
    }

    private function __construct()
    {
    }

    /**
     * @param SysEmail $email
     * @param SysUser $user
     * @return EmailSender
     */
    public static function instanceFrom(SysEmail $email, SysUser $user = null)
    {
        $instance = new self();
        $instance->email = $email;
        if (is_object($user)) {
            $instance->user = $user;
        }
        $instance->emailEngine = new EmailEngine();
        return $instance;
    }

    /**
     * @return EmailEngine
     */
    public function engineInstance()
    {
        return $this->emailEngine;
    }

    /**
     * @return string
     */
    public static function trackingUrl()
    {
        return WEB_ROOT . AppParam::value(AppParam::G_EMAIL_TRACKING_URI);
    }
    /**
     * @return int
     */
    public static function maxBatchSizeToSend()
    {
        return AppParam::value(AppParam::G_EMAIL_MAX_BATCH_SIZE);
    }

    /**
     * @return int
     */
    public static function timesBetweenSend()
    {
        return AppParam::value(AppParam::G_EMAIL_TIME_BETWEEN_SEND);
    }

    /**
     * @return int
     */
    public static function maxSendTries()
    {
        return AppParam::value(AppParam::G_EMAIL_MAX_SENDING_TRIES);
    }

    /**
     * @param $emailMap
     * @return mixed|string
     */
    public function renderBody($emailMap)
    {
        $template = $this->email->getTemplate();
        $emailContent = $template != '' ? (new EmailView())->renderView($template) : $emailMap['Body'];
        $emailContent = str_replace('#SUBJECT#', $emailMap['Subject'], $emailContent);
        $emailContent = str_replace('#CONTENT#', $emailMap['Body'], $emailContent);
        $emailContent = str_replace('#TRACING_LINK#', $emailMap['TrackingLink'], $emailContent);
        return $emailContent;
    }

    /**
     * @param $emailMap
     * @param $emailVars
     * @return null|SysEmailSent
     */
    public function sendMail($emailMap, $emailVars)
    {
        if (!isset($emailMap['FromName'])) {
            $emailMap['FromName'] = $this->email->getFromName();
        }
        if (!isset($emailMap['FromEmail'])) {
            $emailMap['FromEmail'] = $this->email->getFromEmail();
        }
        if (!isset($emailMap['CC'])) {
            $CCs = explode(";", $this->email->getCc());
            if (sizeof($CCs) > 0) {
                $emailMap['CC'] = [];
                foreach ($CCs as $CC) {
                    array_push($emailMap['CC'], ['Email' => $CC]);
                }
            }
        }
        if (!isset($emailMap['BCC'])) {
            $BCCs = explode(";", $this->email->getBcc());
            if (sizeof($BCCs) > 0) {
                $emailMap['BCC'] = [];
                foreach ($BCCs as $BCC) {
                    array_push($emailMap['BCC'], ['Email' => $BCC]);
                }
            }
        }
        if (!isset($emailMap['Subject'])) {
            $emailMap['Subject'] = $this->email->getSubject();
        }
        if (!isset($emailMap['Body'])) {
            $emailMap['Body'] = $this->email->getBody();
        }
        $trackingHash = isset($emailMap['TrackingHash']) ? $emailMap['TrackingHash'] : SpecialStrings::generateHash(30);
        $emailMap['TrackingLink'] = self::trackingUrl() . $trackingHash;
        $emailMap['Body'] = $this->renderBody($emailMap);
        $this->emailEngine->prepare($emailMap, $emailVars);
        $this->emailEngine->processVars();
        $nSents = 0;
        $timeBetween = self::timesBetweenSend();
        $maxTries = self::maxSendTries();
        do {
            $success = $this->emailEngine->Send();
            sleep($timeBetween);
        } while (!$success && ++$nSents < $maxTries);
        return $this->logEmail($trackingHash, $success);
    }

    /**
     * @param string $hash
     * @param boolean $success
     * @return null|SysEmailSent
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function logEmail($hash, $success)
    {
        $emailSent = new SysEmailSent();
        $emailSent->setEmailId($this->email->getId());
        if (is_object($this->user)) {
            $emailSent->setSysUser($this->user);
        }
        if (UserControl::isLoggedIn()) {
            $emailSent->setSenderId(UserControl::user()->getId());
        }
        $emailSent->setHashString($hash);
        $emailSent->setIsSuccess($success);
        $emailSent->setFromName($this->emailEngine->getFromName());
        $emailSent->setFromEmail($this->emailEngine->getFrom());
        $emailSent->setToEmail($this->emailEngine->serializeTo());
        $emailSent->setCc($this->emailEngine->serializeCC());
        $emailSent->setBcc($this->emailEngine->serializeBCC());
        $emailSent->setSubject($this->emailEngine->Subject);
        $emailSent->setContent($this->emailEngine->Body);
        $emailSent->setShippingDate(new DateUtil());
        return $emailSent->save() ? $emailSent : null;
    }

}
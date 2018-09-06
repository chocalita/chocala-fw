<?php
require_once("EmailEngine.php");

/**
 * @author ypra
 * Date: 5/9/2018
 * Time: 10:45 p.m.
 */
class EmailDirectorioSender
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
     * @var int
     */
    private $empresaDirectorioId = null;

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
     * @param int $empresaDirectorioId
     * @param SysUser $user
     * @return EmailDirectorioSender
     */
    public static function instanceFrom(SysEmail $email, $empresaDirectorioId, SysUser $user = null)
    {
        $instance = new self();
        $instance->email = $email;
        if (is_object($user)) {
            $instance->user = $user;
        }
        $instance->empresaDirectorioId = $empresaDirectorioId;
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
     * @throws \Propel\Runtime\Exception\PropelException
     */
    public function sendMail($emailMap, $emailVars, PDO $pdo)
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
            sleep(1);
//            sleep($timeBetween);
        } while (!$success && ++$nSents < $maxTries);
        return $this->logEmail($trackingHash, $success, $pdo);
    }

    /**
     * @param string $hash
     * @param boolean $success
     * @param $empresaDirectorioId
     * @param PDO $pdo
     * @return bool
     */
    public function logEmail($hash, $success, PDO $pdo)
    {
        $dateTime = (new DateUtil())->format("Y-m-d H:i:s");
        $data = [
//            "ID" => 0 ,
            "EMAIL_ID" => $this->email->getId() ,
            "USER_ID" => 1 ,
            "SENDER_ID" => 1 ,
            "EMPRESA_DIRECTORIO_ID" => $this->empresaDirectorioId*1 ,
            "HASH_STRING" => "'".$hash ."'",
            "FROM_NAME" => "'".$this->emailEngine->getFromName()."'",
            "FROM_EMAIL" => "'".$this->emailEngine->getFrom()."'",
            "TO_EMAIL" => "'".$this->emailEngine->serializeTo()."'",
            "CC" => "'".$this->emailEngine->serializeCC()."'",
            "BCC" => "'".$this->emailEngine->serializeBCC()."'",
            "SUBJECT" => "'".$this->emailEngine->Subject."'",
            "CONTENT" => "'".$this->emailEngine->Body."'",
            "IS_SUCCESS" => $success? 1: 0,
//            "SHIPPING_DATE" => "'".$dateTime."'",
//            "OPENING_DATE" => "'".$dateTime."'"
        ];
        $fields = implode(",", array_keys($data));
        $fields2 = implode(",:", array_keys($data));

        $params = "?". str_repeat(",?", sizeof($data) - 1);
        $sql = "INSERT INTO mail_sent ($fields) VALUES ($params)" ;
        $sql = "INSERT INTO mail_sent ($fields) VALUES (:$fields2)" ;
//        return $pdo->prepare($sql)->execute($data);

        try {
            $selectQueryResult = $pdo->prepare($sql);
//            $stmt->bindParam(':email', $mail, PDO::PARAM_STR);
//            $stmt->bindParam(':estatus', $activo, PDO::PARAM_INT);
            $i = 1;
            $empresaDirectorioId = $this->empresaDirectorioId*1;
            $selectQueryResult->bindParam(":EMAIL_ID",$this->email->getId() , PDO::PARAM_INT);
            $selectQueryResult->bindParam(":USER_ID" ,$i , PDO::PARAM_INT);
            $selectQueryResult->bindParam(":SENDER_ID",$i , PDO::PARAM_INT);
            $selectQueryResult->bindParam(":EMPRESA_DIRECTORIO_ID" ,$empresaDirectorioId  , PDO::PARAM_INT);
            $selectQueryResult->bindParam(":HASH_STRING" , $hash ,PDO::PARAM_STR);
            $selectQueryResult->bindParam(":FROM_NAME" , $this->emailEngine->getFromName(),PDO::PARAM_STR);
            $selectQueryResult->bindParam(":FROM_EMAIL" , $this->emailEngine->getFrom(),PDO::PARAM_STR);
            $selectQueryResult->bindParam(":TO_EMAIL" , $this->emailEngine->serializeTo(),PDO::PARAM_STR);
            $selectQueryResult->bindParam(":CC" , $this->emailEngine->serializeCC(),PDO::PARAM_STR);
            $selectQueryResult->bindParam(":BCC" , $this->emailEngine->serializeBCC(),PDO::PARAM_STR);
            $selectQueryResult->bindParam(":SUBJECT" , $this->emailEngine->Subject,PDO::PARAM_STR);
            $selectQueryResult->bindParam(":CONTENT" , $this->emailEngine->Body,PDO::PARAM_STR);
            $selectQueryResult->bindParam(":IS_SUCCESS" , $success,PDO::PARAM_BOOL);

            return $selectQueryResult->execute($data);
        } catch (PDOException $e) {
            $this->handle_sql_errors($sql, $e->getMessage());
        }
        //INSERT INTO mail_sent (
        //EMAIL_ID,
        //USER_ID,
        //SENDER_ID,
        //EMPRESA_DIRECTORIO_ID
        //,HASH_STRING
        //,FROM_NAME
        //,FROM_EMAIL
        //,TO_EMAIL
        //,CC
        //,BCC
        //,SUBJECT
        //,CONTENT
        //,IS_SUCCESS
        //,SHIPPING_DATE
        //,OPENING_DATE
        //) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)
//        $emailSent = new SysEmailSent();
//        $emailSent->setEmailId($this->email->getId());
//        if (is_object($this->user)) {
//            $emailSent->setSysUser($this->user);
//        }
//        if (UserControl::isLoggedIn()) {
//            $emailSent->setSenderId(UserControl::user()->getId());
//        }
//        $emailSent->setHashString($hash);
//        $emailSent->setIsSuccess($success);
//        $emailSent->setFromName($this->emailEngine->getFromName());
//        $emailSent->setFromEmail($this->emailEngine->getFrom());
//        $emailSent->setToEmail($this->emailEngine->serializeTo());
//        $emailSent->setCc($this->emailEngine->serializeCC());
//        $emailSent->setBcc($this->emailEngine->serializeBCC());
//        $emailSent->setSubject($this->emailEngine->Subject);
//        $emailSent->setContent($this->emailEngine->Body);
//        $emailSent->setShippingDate(new DateUtil());
//        return $emailSent->save() ? $emailSent : null;
    }

    function handle_sql_errors($query, $error_message)
    {
        echo '<pre>';
        echo $query;
        echo '</pre>';
        echo $error_message;
        die;
    }
}
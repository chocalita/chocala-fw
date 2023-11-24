<?php

use Chocala\Util\PHPMailer;

/**
 * @author ypra
 * Date: 4/4/2016
 * Time: 8:53 p.m.
 */
class EmailEngine extends PHPMailer
{

    /**
     * A instance from EmailEngine class
     * @var EmailEngine
     */
    private static $instance = null;

    /**
     *
     * @var array
     */
    private $vars = array();

    /**
     *
     * @return EmailEngine
     */
    public static function instance()
    {
        if(!is_object(self::$instance)){
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     *
     * @param array $vars
     */
    public function setVars($vars)
    {
        $this->vars = $vars;
    }

    /**
     *
     * @param string $key
     * @param string $value
     */
    public function addVar($key, $value)
    {
        $this->vars[$key] = $value;
    }

    /**
     * @return string
     */
    public function getFromName()
    {
        return $this->FromName;
    }

    /**
     * @return string
     */
    public function getFrom()
    {
        return $this->From;
    }

    /**
     *
     * @param string $from
     */
    public function setFrom($from)
    {
        $this->From= $from;
    }

    /**
     *
     * @param string $fromName
     */
    public function setFromName($fromName)
    {
        $this->FromName = $fromName;
    }

    /**
     * @return array
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * For initializing destinators datas
     * @param array $destinators
     */
    public function setTo($destinators)
    {
        $this->ClearAddresses();
        foreach($destinators as $destinator){
            $this->AddAddress($destinator['Email'], $destinator['Name']);
        }
    }

    /**
     * @return array
     */
    public function getCC()
    {
        return $this->cc;
    }

    /**
     * @param array $destinators
     */
    public function setCC($destinators)
    {
        $this->ClearCCs();
        foreach($destinators as $destinator){
            $this->AddCC($destinator['Email'], $destinator['Name']?: "");
        }
    }

    /**
     * @return array
     */
    public function getBCC()
    {
        return $this->bcc;
    }

    /**
     * @param array $destinators
     */
    public function setBCC($destinators)
    {
        $this->ClearBCCs();
        foreach($destinators as $destinator){
            $this->AddBCC($destinator['Email'], $destinator['Name']?: "");
        }
    }

    /**
     *
     * @param string $subject
     */
    public function setSubject($subject)
    {
        $this->Subject = $subject;
    }

    /**
     *
     * @param string $body
     */
    public function setBody($body)
    {
        $this->Body = $body;
    }

    public function __construct()
    {
        $this->IsHTML(true);
        $this->CharSet = 'UTF-8';
    }


    /**
     * @param array $destinators
     * @return string
     */
    public function serializeAddresses($destinators)
    {
        $strings = [];
        foreach($destinators as $destinator){
            $strings[] = $destinator[0].($destinator[1]!=''? '<'.$destinator[1].'>': '');
        }
        return implode(';', $strings);
    }

    /**
     * @return string
     */
    public function serializeTo()
    {
        return $this->serializeAddresses($this->to);

    }

    /**
     * @return string
     */
    public function serializeCC()
    {
        return $this->serializeAddresses($this->cc);

    }

    /**
     * @return string
     */
    public function serializeBCC()
    {
        return $this->serializeAddresses($this->bcc);

    }

    /**
     * Send the email
     *
     * @return bool
     */
    public function run()
    {
        return $this->Send();
    }

    /**
     * Returns the body content from the email
     *
     * @return string
     */
    public function content()
    {
        return $this->Body;
    }

    public function resetVars()
    {
        $this->vars = array();
    }

    /**
     * @param array $emailMap
     * @param array $emailVars
     */
    public function prepare($emailMap, $emailVars = [])
    {
        if(isset($emailMap['FromName'])){
            $this->setFromName($emailMap['FromName']);
        }
        if(isset($emailMap['FromEmail'])){
            $this->setFrom($emailMap['FromEmail']);
        }
        if(isset($emailMap['To'])){
            $this->setTo($emailMap['To']);
        }
        if(isset($emailMap['CC'])){
            $this->setCC($emailMap['CC']);
        }
        if(isset($emailMap['BCC'])){
            $this->setBCC($emailMap['BCC']);
        }
        if(isset($emailMap['Subject'])){
            $this->setSubject($emailMap['Subject']);
        }
        if(isset($emailMap['Body'])){
            $this->setBody($emailMap['Body']);
        }
        $this->setVars($emailVars);
        $this->processVars();
    }

    /**
     * Process email variables replacing key with values
     *
     * @return void
     */
    public function processVars()
    {
        foreach($this->vars as $key => $value){
            $this->Subject = str_replace($key, $value, $this->Subject);
            $this->Body = str_replace($key, $value, $this->Body);
        }
    }


}
<?php

/**
 * Created by PhpStorm.
 * User: Yecid
 * Date: 2/10/2016
 * Time: 11:52 p.m.
 */
abstract class AppSecureService extends GenericService
{
    const LAST_CAPTCHA_GENERATED_TEXT = "LAST_CAPTCHA_GENERATED_TEXT";
    const LAST_CAPTCHA_GENERATED_PATH = "LAST_CAPTCHA_GENERATED_PATH";

    /**
     * @var SysUser
     */
    protected $sessionUser = null;

    /**
     * @return GenericService
     */
    public static function instance()
    {
        $instance = parent::instance();
        if($instance->sessionUser == null){
            $instance->sessionUser = UserControl::user();
        }
        return $instance;
    }

    public function createCaptcha()
    {
        $this->deleteCaptcha();
        $text = SpecialStrings::generateHash(4);
        $imageName = "IMG-" . time();
        Session::set(self::LAST_CAPTCHA_GENERATED_TEXT, $text);
        Session::set(self::LAST_CAPTCHA_GENERATED_PATH, $imageName);
        return Image::createTmpImageFromText($text, $imageName);
    }

    private function deleteCaptcha()
    {
        if(Session::has(self::LAST_CAPTCHA_GENERATED_PATH)) {
            Image::deleteTmpImage(Session::get(self::LAST_CAPTCHA_GENERATED_PATH));
        }
    }

    public function verifyCaptcha($text)
    {
        $generatedText = Session::get(self::LAST_CAPTCHA_GENERATED_TEXT);
        $this->deleteCaptcha();
        return $text == $generatedText;
    }

}
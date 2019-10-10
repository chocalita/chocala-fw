<?php

/**
 * Created by PhpStorm.
 * User: Yecid
 * Date: 2/10/2016
 * Time: 11:52 p.m.
 */
abstract class AppSecureService extends AuditService
{
    const LAST_CAPTCHA_GENERATED_TEXT = "LAST_CAPTCHA_GENERATED_TEXT";
    const LAST_CAPTCHA_GENERATED_PATH = "LAST_CAPTCHA_GENERATED_PATH";
    const CAPTCHA_DEFAULT_IMG = "CAPTCHA-0123.png";

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
        $imageFilename = "CAPTCHA-" . time() . SpecialStrings::generateHash(8) . '.png';
        Session::set(self::LAST_CAPTCHA_GENERATED_TEXT, $text);
        Session::set(self::LAST_CAPTCHA_GENERATED_PATH, $imageFilename);
        FilesHelper::webPath('tmp');
        $filePath = FilesHelper::dirPath('tmp') . $imageFilename;
        if (Image::createTmpImageFromText($text, $filePath)) {
            return FilesHelper::webPath('tmp') . $imageFilename;
        }
        return FilesHelper::webPath('tmp').self::CAPTCHA_DEFAULT_IMG;
    }

    private function deleteCaptcha()
    {
        if(Session::has(self::LAST_CAPTCHA_GENERATED_PATH)) {
            Image::deleteTmpImage(FilesHelper::dirPath('tmp') .
                Session::get(self::LAST_CAPTCHA_GENERATED_PATH));
            Session::delete(self::LAST_CAPTCHA_GENERATED_PATH);
        }
    }

    public function verifyCaptcha($text)
    {
        $generatedText = Session::get(self::LAST_CAPTCHA_GENERATED_TEXT);
        $this->deleteCaptcha();
        return $text == $generatedText;
    }

}
<?php

/**
 *
 * @author ypra
 * Date: 3/26/2016
 * Time: 8:42 p.m.
 */
abstract class FilesHelper
{

    /**
     * @return string
     */
    public static function filesDir()
    {
        return FILES_DIR;
    }

    /**
     * @return string
     */
    public static function filesWeb()
    {
        return FILES_WEB;
    }

    /**
     * @param string $filesDir
     * @return string
     */
    public static function dirPath($filesDir)
    {
        return self::filesDir().$filesDir.DIRECTORY_SEPARATOR;
    }

    /**
     * @param string $filesDir
     * @return string
     */
    public static function webPath($filesDir)
    {
        return self::filesWeb().$filesDir.'/';
    }

    /**
     * @param $fileSource
     * @param $pathDest
     * @param string|null $filename
     * @return bool
     */
    public static function copyInDir($fileSource, $pathDest, $filename = null)
    {
        $filename = $filename!=''? $filename: basename($fileSource);
        return copy($fileSource, self::dirPath($pathDest).$filename);

    }

    /**
     * @param string $file
     * @return string
     */
    public static function extension($file)
    {
        return pathinfo($file)['extension'];
    }

    public static function autoVersion($fileDir)
    {
        $fileRoot = APP_DIR."public".DIRECTORY_SEPARATOR;
        if (!file_exists($fileRoot . $fileDir)) {
            return $fileDir;
        }
        $mtime = filemtime($fileRoot . $fileDir);
        return WEB_ROOT . $fileDir . "?v=$mtime";
    }

}
<?php
require_once('IImage.php');
require_once('ImageMimeTypes.php');

/**
 *
 * @author ypra
 */
class Image implements IImage
{
    const IMG_TMP_PATH = "files" . DIRECTORY_SEPARATOR . "tmp" . DIRECTORY_SEPARATOR;
    /**
     *
     * @var string
     */
    private $fileExtension = '';

    /**
     *
     * @var resource
     */
    private $image = null;

    /**
     *
     * @var string
     */
    private $mimeExtension = '';

    /**
     *
     * @var string
     */
    private $mimeType = '';

    /**
     *
     * @var string
     */
    private $name = '';

    /**
     *
     * @var int
     */
    private $originalX = 0;

    /**
     *
     * @var int
     */
    private $originalY = 0;

    /**
     *
     * @var int
     */
    private $size = 0;

    /**
     *
     * @var string
     */
    private $tempName = '';

    private $imagenes=null;

    /**
     *
     * @return string
     */
    public function fileExtension()
    {
        return $this->fileExtension;
    }

    /**
     *
     * @param File $file
     */
    public function __construct($file)
    {
        $this->name = $file['name'];
        $this->mimeType = $file['type'];
        $this->tempName = $file['tmp_name'];
        $this->size = $file['size'];
        $this->mimeExtension = ImageMimeTypes::mimeExtensionFrom($this
            ->mimeType);
        $this->fileExtension = self::fileExtensionFrom($this->name);
        define('NAMETHUMB', $this->tempName.'oimg');
        define('NAMERESIZE', $this->tempName.'oimg');
        $sizes = getimagesize($this->tempName);
        $this->originalX = $sizes[0];
        $this->originalY = $sizes[1];
    }

    /**
     *
     * @param string $filename
     * @return string
     */
    public static function fileExtensionFrom($filename)
    {
        return pathinfo($filename)['extension'];
    }

    /**
     *
     * @return resource
     */
    public function image()
    {
        if($this->image === null){
            switch($this->mimeExtension){
                case ImageMimeTypes::BMP_EXTENSION:
                    $this->image = imagecreatefromwbmp($this->tempName);
                    break;
                case ImageMimeTypes::GIF_EXTENSION:
                    $this->image = imagecreatefromgif($this->tempName);
                    break;
                case ImageMimeTypes::JPG_EXTENSION:
                    $this->image = imagecreatefromjpeg($this->tempName);
                    break;
                case ImageMimeTypes::PNG_EXTENSION:
                    $this->image = imagecreatefrompng($this->tempName);
                    break;
                default:
                    $this->image = imagecreatefromgif($this->tempName);
                    break;
            }
        }
        return $this->image;
    }

    /**
     *
     * @param string $filename
     * @param resource $resource
     * @return bool
     */
    public function saveAs($filename, $resource = null)
    {
        if($resource === null){
            $resource = $this->image();
        }
        switch($this->mimeExtension){
            case ImageMimeTypes::BMP_EXTENSION:
                return imagewbmp($resource, $filename);
            case ImageMimeTypes::JPG_EXTENSION:
                return imagejpeg($resource, $filename);
            case ImageMimeTypes::PNG_EXTENSION:
                return imagepng($resource, $filename);
            case ImageMimeTypes::GIF_EXTENSION:
            default:
                return imagegif($resource, $filename);
        }
    }

    /**
     *
     * @param string $filename
     * @param int $maxSize
     * @return bool
     */
    public function saveResizeMax($filename, $maxSize = 0)
    {
        $img = $this->image();
        $imgResource = $img;
        if(($this->originalX > $maxSize || $this->originalY > $maxSize)
            && $maxSize > 0){
            $maxLOf = $maxSize;
            $frOf = $maxLOf / (($this->originalX > $this->originalY)?
                    $this->originalX: $this->originalY);
            $xImgOf = $this->originalX * $frOf;
            $yImgOf = $this->originalY * $frOf;
            $newImg = imagecreatetruecolor($xImgOf, $yImgOf);
            imagecopyresampled($newImg, $img, 0, 0, 0, 0, $xImgOf, $yImgOf,
            $this->originalX, $this->originalY);
            $imgResource = $newImg;
        }
        return $this->saveAs($filename, $imgResource);
    }

    /**
     * @param string $filename
     * @param int $maxSize
     * @return bool
     */
    public function saveCropSquare($filename, $maxSize = 0)
    {
        $img = $this->image();
        $maxSize = $maxSize > 0? $maxSize: min($this->originalX, $this->originalY);
        $fr = $maxSize / (($this->originalX < $this->originalY)?
                $this->originalX: $this->originalY);
        $xSig = $this->originalX * $fr;
        $ySig = $this->originalY * $fr;
        $xCrop = ($xSig > ($maxSize-1))? round(($xSig - $maxSize) / 2): 0;
        $yCrop = ($ySig > ($maxSize-1))? round(($ySig - $maxSize) / 2): 0;
        $xIni = $xCrop;
        $yIni = $yCrop;
        $xFin = $xSig-$xCrop;
        $yFin = $ySig-$yCrop;
        $xIniOri = $xIni/$fr;
        $yIniOri = $yIni/$fr;
        $xFinOri = $xFin/$fr;
        $yFinOri = $yFin/$fr;
        $newImg = imagecreatetruecolor($xFin-$xIni, $yFin-$yIni);
        imagecopyresampled($newImg, $img, 0, 0, $xIniOri, $yIniOri,
            $xFin, $yFin, $xFinOri,$yFinOri);
        $imgResource = $newImg;
        return $this->saveAs($filename, $imgResource);
    }

    public function saveCropTo($filename, $width = 0, $height = 0)
    {
        //TODO: Implements crop method
        echo 'Implement crop method'; exit();
    }

    //TODO review the after code content
    
    /**
     *
     * @param int $newSize
     * @return string
     */
    public function cropTo($newSize)
    {
        $resource = $this->image();
        $maxSize = $newSize;
        $fr = $maxSize / (($this->originalX < $this->originalY)? $this->originalX: $this->originalY);
        $xSig = $this->originalX * $fr;
        $ySig = $this->originalY * $fr;
        $xCrop = ($xSig > ($maxSize-1))? round(($xSig - $maxSize) / 2): 0;
        $yCrop = ($ySig > ($maxSize-1))? round(($ySig - $maxSize) / 2): 0;
        $xIni = $xCrop;
        $yIni = $yCrop;
        $xFin = $xSig-$xCrop;
        $yFin = $ySig-$yCrop;
        $xIniOri = $xIni/$fr;
        $yIniOri = $yIni/$fr;
        $xFinOri = $xFin/$fr;
        $yFinOri = $yFin/$fr;
        $thumb = imagecreatetruecolor($xFin-$xIni, $yFin-$yIni);
        imagecopyresampled($thumb, $resource, 0, 0, $xIniOri, $yIniOri, $xFin, $yFin, $xFinOri,$yFinOri);
        switch($this->mimeExtension){
            case ImageMimeTypes::BMP_EXTENSION:
                imagewbmp($thumb, NAMETHUMB);
                break;
            case ImageMimeTypes::GIF_EXTENSION:
                imagegif($thumb, NAMETHUMB);
                break;
            case ImageMimeTypes::JPG_EXTENSION:
                imagejpeg($thumb, NAMETHUMB);
                break;
            case ImageMimeTypes::PNG_EXTENSION:
                imagepng($thumb, NAMETHUMB);
                break;
            default:
                imagegif($thumb, NAMETHUMB);
                break;
        }
        //TODO: simplyficate the get of image's content
        $fp = fopen(NAMETHUMB, "rb");
        $tthumb = fread($fp, filesize(NAMETHUMB));
        fclose($fp);
        @unlink(NAMETHUMB);
        return $tthumb;
    }

    function resizeTo($newTamanio)
    {
        $img=$this->image();
        $maxSize=$newTamanio;
        $needResize=true;
        $maxLOf=$newTamanio;
        $frOf=1;
        if($this->originalSizeX > $this->originalSizeY){
            $frOf=$maxLOf/$this->originalSizeX;
        }else{
            $frOf=$maxLOf/$this->originalSizeY;
        }
        $xImgOf=$this->originalSizeX*$frOf;
        $yImgOf=$this->originalSizeY*$frOf;
        $imgOf = imagecreatetruecolor($xImgOf, $yImgOf);
        imagecopyresampled($imgOf, $img, 0, 0, 0, 0, $xImgOf,$yImgOf, $this->originalSizeX,$this->originalSizeY);
        switch($this->mimeExtension) {
            case ImageMimeTypes::BMP_EXTENSION:
                imagewbmp($imgOf, NAMERESIZE);
                break;
            case ImageMimeTypes::GIF_EXTENSION:
                imagegif($imgOf, NAMERESIZE);
                break;
            case ImageMimeTypes::JPG_EXTENSION:
                imagejpeg($imgOf, NAMERESIZE);
                break;
            case ImageMimeTypes::PNG_EXTENSION:
                imagepng($imgOf, NAMERESIZE);
            break;
            default:
                imagegif($imgOf, NAMERESIZE);
                break;
        }
        $fp = fopen(NAMERESIZE, "rb");
        $tImgOf = fread($fp, filesize(NAMERESIZE));
        fclose($fp);
        @unlink(NAMERESIZE);
        return $tImgOf;
    }

    public function putInFileResize($dir, $fileName, $newTamanio=0)
    {
        $img = $this->image();
        $maxSize = $newTamanio;
        $needResize = true;
        $maxLOf = $newTamanio;
        $frOf = 1;
        if($this->originalSizeX > $this->originalSizeY){
            $frOf=$maxLOf/$this->originalSizeX;
        }else{
            $frOf=$maxLOf/$this->originalSizeY;
        }
        $xImgOf=$this->originalSizeX*$frOf;
        $yImgOf=$this->originalSizeY*$frOf;
        $imgOf = imagecreatetruecolor($xImgOf, $yImgOf);
        imagecopyresampled($imgOf, $img, 0, 0, 0, 0, $xImgOf,$yImgOf,
                $this->originalSizeX,$this->originalSizeY);
        switch($this->mimeExtension) {
            case ImageMimeTypes::BMP_EXTENSION:
                imagewbmp($imgOf, NAMERESIZE);
                break;
            case ImageMimeTypes::GIF_EXTENSION:
                imagegif($imgOf, NAMERESIZE);
                break;
            case ImageMimeTypes::JPG_EXTENSION:
                imagejpeg($imgOf, NAMERESIZE);
                break;
            case ImageMimeTypes::PNG_EXTENSION:
                imagepng($imgOf, NAMERESIZE);
                break;
            default:
                imagegif($imgOf, NAMERESIZE);
                break;
        }
        file_put_contents($dir.$fileName,file_get_contents(NAMERESIZE));
        @unlink(NAMERESIZE);
    }

    public static function createTmpImageFromText($text, $fileName)
    {
        try {
            $image = imagecreatetruecolor(150, 30) or die("Cannot Initialize new GD image stream");
            $backgroundColor = imagecolorallocate($image, 255, 255, 255);
            $lineColor = imagecolorallocate($image, 64, 64, 64);
            $pixelColor = imagecolorallocate($image, 244, 244, 244);
            imagefilledrectangle($image, 0, 0, 150, 30, $backgroundColor);
            for ($i = 0; $i < 1000; $i++) {
                imagesetpixel($image, rand() % 150, rand() % 30, $pixelColor);
            }
            $textColor = imagecolorallocate($image, 0, 0, 0);
            $n = strlen($text);
            for ($i = 0; $i < $n; $i++) {
                $letter = $text[$i];
                imagestring($image, 9, 15 + ($i * 30), 7, $letter, $textColor);
            }
            $imagePath = PUBLIC_DIR . self::IMG_TMP_PATH . $fileName . ".png";
            imagepng($image, $imagePath);
            return WEB_ROOT . self::IMG_TMP_PATH . $fileName . ".png";
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public static function deleteTmpImage($fileName)
    {
        @unlink(PUBLIC_DIR . self::IMG_TMP_PATH  . $fileName.".png");
    }

}
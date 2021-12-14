<?php
// Auteur : José Carlos Gasser
// Date : 30.11.2021
// Descritption : Classe de rezise d'une image



//Tiré de cet exemple : https://newbedev.com/php-resize-image-on-or-before-upload

class Resize
{
    //Variables de classe
    private $image;
    private $width;
    private $height;
    private $imageResized;

    function __construct($fileName)
    {
        //Ouvre le fichier
        $this->image = $this->openImage($fileName);

        //Obtenir la hauteur et la largeur
        $this->width  = imagesx($this->image);
        $this->height = imagesy($this->image);
    }

    /**
     * Ouvre le fichier image
     *
     * @param string $file
     * @return image
     */
    private function openImage($file)
    {
        //Chercher l'extension du fichier
        $extension = strtolower(strrchr($file, '.'));

        switch($extension)
        {
            case '.jpg':
            case '.jpeg':
                $img = @imagecreatefromjpeg($file);
                break;
            case '.gif':
                $img = @imagecreatefromgif($file);
                break;
            case '.png':
                $img = @imagecreatefrompng($file);
                break;
            default:
                $img = false;
                break;
        }
        return $img;
    }

    /**
     * Redimensionne l'image
     *
     * @param int $newWidth
     * @param int $newHeight
     * @param string $option
     */
    public function resizeImage($newWidth, $newHeight, $option="auto")
    {
        //Obtenir la hauteur et la largeur optimale en fonction de $option
        $optionArray = $this->getDimensions($newWidth, $newHeight, $option);

        $optimalWidth  = $optionArray['optimalWidth'];
        $optimalHeight = $optionArray['optimalHeight'];


        //Redimensionne l'image selon le format souhaité
        $this->imageResized = imagecreatetruecolor($optimalWidth, $optimalHeight);
        imagecopyresampled($this->imageResized, $this->image, 0, 0, 0, 0, $optimalWidth, $optimalHeight, $this->width, $this->height);


        //Option de recadrage
        if ($option == 'crop') {
            $this->crop($optimalWidth, $optimalHeight, $newWidth, $newHeight);
        }
    }

    /**
     * Retourne les dimensions de l'image
     *
     * @param int $newWidth
     * @param int $newHeight
     * @param string $option
     * @return array
     */
    private function getDimensions($newWidth, $newHeight, $option)
    {

        switch ($option)
        {
            case 'exact':
                $optimalWidth = $newWidth;
                $optimalHeight= $newHeight;
                break;
            case 'portrait':
                $optimalWidth = $this->getSizeByFixedHeight($newHeight);
                $optimalHeight= $newHeight;
                break;
            case 'landscape':
                $optimalWidth = $newWidth;
                $optimalHeight= $this->getSizeByFixedWidth($newWidth);
                break;
            case 'auto':
                $optionArray = $this->getSizeByAuto($newWidth, $newHeight);
                $optimalWidth = $optionArray['optimalWidth'];
                $optimalHeight = $optionArray['optimalHeight'];
                break;
            case 'crop':
                $optionArray = $this->getOptimalCrop($newWidth, $newHeight);
                $optimalWidth = $optionArray['optimalWidth'];
                $optimalHeight = $optionArray['optimalHeight'];
                break;
        }
        return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
    }

    /**
     * Retourne la largeur pour une hauteur fixée
     *
     * @param int $newHeight
     * @return int
     */
    private function getSizeByFixedHeight($newHeight)
    {
        $ratio = $this->width / $this->height;
        $newWidth = $newHeight * $ratio;
        return $newWidth;
    }

    /**
     * Retourne la hauteur pour une largeur fixée
     *
     * @param int $newWidth
     * @return int
     */
    private function getSizeByFixedWidth($newWidth)
    {
        $ratio = $this->height / $this->width;
        $newHeight = $newWidth * $ratio;
        return $newHeight;
    }

    /**
     * Retourne les dimensions optimales en fonction des dimensions actuelles et de celles souhaitées
     *
     * @param int $newWidth
     * @param int $newHeight
     * @return array
     */
    private function getSizeByAuto($newWidth, $newHeight)
    {
        if ($this->height < $this->width)
        {
            $optimalWidth = $newWidth;
            $optimalHeight= $this->getSizeByFixedWidth($newWidth);
        }
        elseif ($this->height > $this->width)
        {
            $optimalWidth = $this->getSizeByFixedHeight($newHeight);
            $optimalHeight= $newHeight;
        }
        else
        {
            if ($newHeight < $newWidth) {
                $optimalWidth = $newWidth;
                $optimalHeight= $this->getSizeByFixedWidth($newWidth);
            } else if ($newHeight > $newWidth) {
                $optimalWidth = $this->getSizeByFixedHeight($newHeight);
                $optimalHeight= $newHeight;
            } else {
                $optimalWidth = $newWidth;
                $optimalHeight= $newHeight;
            }
        }

        return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
    }

    /**
     * Retourne les dimensions optimale pour le recadrage de l'image
     *
     * @param int $newWidth
     * @param int $newHeight
     * @return array
     */
    private function getOptimalCrop($newWidth, $newHeight)
    {

        $heightRatio = $this->height / $newHeight;
        $widthRatio  = $this->width /  $newWidth;

        if ($heightRatio < $widthRatio) {
            $optimalRatio = $heightRatio;
        } else {
            $optimalRatio = $widthRatio;
        }

        $optimalHeight = $this->height / $optimalRatio;
        $optimalWidth  = $this->width  / $optimalRatio;

        return array('optimalWidth' => $optimalWidth, 'optimalHeight' => $optimalHeight);
    }

    /**
     * Recadre l'image selon les dimensions souhaitées
     *
     * @param int $optimalWidth
     * @param int $optimalHeight
     * @param int $newWidth
     * @param int $newHeight
     */
    private function crop($optimalWidth, $optimalHeight, $newWidth, $newHeight)
    {
        $cropStartX = ( $optimalWidth / 2) - ( $newWidth /2 );
        $cropStartY = ( $optimalHeight/ 2) - ( $newHeight/2 );

        $crop = $this->imageResized;

        $this->imageResized = imagecreatetruecolor($newWidth , $newHeight);
        imagecopyresampled($this->imageResized, $crop , 0, 0, $cropStartX, $cropStartY, $newWidth, $newHeight , $newWidth, $newHeight);
    }

    /**
     * Enregistre l'image
     *
     * @param int $savePath
     * @param int $imageQuality
     */
    public function saveImage($savePath, $imageQuality="100")
    {
        $extension = strrchr($savePath, '.');
            $extension = strtolower($extension);

        switch($extension)
        {
            case '.jpg':
            case '.jpeg':
                if (imagetypes() & IMG_JPG) {
                    imagejpeg($this->imageResized, $savePath, $imageQuality);
                }
                break;

            case '.gif':
                if (imagetypes() & IMG_GIF) {
                    imagegif($this->imageResized, $savePath);
                }
                break;

            case '.png':
                $scaleQuality = round(($imageQuality/100) * 9);

                $invertScaleQuality = 9 - $scaleQuality;

                if (imagetypes() & IMG_PNG) {
                        imagepng($this->imageResized, $savePath, $invertScaleQuality);
                }
                break;
            default:

                break;
        }
        imagedestroy($this->imageResized);
    }
}
?>
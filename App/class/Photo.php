<?php

/**
 * Class Photo
 * Upload a photo to the server
 * @author Quentin Aslan <quentin.aslan@outlook.com>
 */

Class Photo {
    private $nameBefore;
    private $nameTemp;
    private $name;
    private $extension;
    private $extensions = array('.png','.jpg', '.jpeg');
    private $folder;
    private $path;

    const ERROR_EXTENSION = "Erreur avec l'extension de l'image.";
    const ERROR_UPLOAD = "Erreur lors de l'upload de l'image sur le serveur.";

    public function __construct($photo)
    {
        $this->nameBefore = $photo['photo']['name'];
        $this->nameTemp = $photo['photo']['tmp_name'];
        $this->folder = 'img/articles/';
        $this->extension = strtolower(strrchr($_FILES['photo']['name'], '.'));
        $this->name = uniqid().$this->extension;
        $this->path =$this->folder . $this->name;
    }

    private function checkExtension($extension) {
        return in_array($extension, $this->extensions);
    }

    public function add() {
        if(!$this->checkExtension($this->extension))
            throw new Exception(self::ERROR_EXTENSION);

        if(!move_uploaded_file($this->nameTemp, $this->path))
            throw new Exception(self::ERROR_UPLOAD);

        // FOR FIX IOS PHOTO
        $this->correctImageOrientation($this);
    }

    public static function delete($type, $name) {
        if(!unlink('img/'.$type.'/'.$name))
            throw new Exception("La photo n'a pas été supprimé du serveur.");
    }

    public function getName() {
        return $this->name;
    }


    /**
     * Fix orientation IOS PHOTO
     * @param Photo $photo
     * @throws Exception
     */
    public function correctImageOrientation(Photo $photo) {
        $path = $this->path;
        $filen = $this->getName();
        $ext = $this->extension;
        try {

            $exif = @exif_read_data($path);

            $orientation = isset($exif['Orientation']) ? $exif['Orientation'] : null;

            if (isset($orientation) && $orientation != 1){
                switch ($orientation) {
                    case 3:
                        $deg = 180;
                        break;
                    case 6:
                        $deg = 270;
                        break;
                    case 8:
                        $deg = 90;
                        break;
                }

                if ($deg) {

                    // If png
                    if ($ext == "png") {
                        $img_new = imagecreatefrompng($path);
                        $img_new = imagerotate($img_new, $deg, 0);

                        // Save rotated image
                        imagepng($img_new,$path);
                    }else {
                        $img_new = imagecreatefromjpeg($path);
                        $img_new = imagerotate($img_new, $deg, 0);

                        // Save rotated image
                        imagejpeg($img_new,$path,80);
                    }
                }
            }

        } catch (Exception $e) {
            throw new Exception("L'image n'a pas pu être ré-orienté");
        }
        unset($file);
    }


}
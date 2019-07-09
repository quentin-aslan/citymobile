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
    private $extensions = array('.png', '.gif', '.jpg', '.jpeg');
    private $folder;
    private $path;

    const ERROR_EXTENSION = "Erreur avec l'extension de l'image.";
    const ERROR_UPLOAD = "Erreur lors de l'upload de l'image sur le serveur.";

    public function __construct($photo)
    {
        $this->nameBefore = $photo['photo']['name'];
        $this->nameTemp = $photo['photo']['tmp_name'];
        $this->folder = 'img/';
        $this->extension = strtolower(strrchr($_FILES['photo']['name'], '.'));
        $this->name = uniqid().$this->extension;
        $this->path =$this->folder . $this->name;

        $this->add();
    }

    private function checkExtension($extension) {
        return in_array($extension, $this->extensions);
    }

    private function add() {
        if(!$this->checkExtension($this->extension))
            throw new Exception(self::ERROR_EXTENSION);

        if(!move_uploaded_file($this->nameTemp, $this->path))
            throw new Exception(self::ERROR_UPLOAD);
    }

    public function getName() {
        return $this->name;
    }


}
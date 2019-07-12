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
    }

    private function checkExtension($extension) {
        return in_array($extension, $this->extensions);
    }

    public function add() {
        if(!$this->checkExtension($this->extension))
            throw new Exception(self::ERROR_EXTENSION);

        if(!move_uploaded_file($this->nameTemp, $this->path))
            throw new Exception(self::ERROR_UPLOAD);
        else
            $a=0;
            //$this->redimensionner_image($this->path, 286, 180 );
    }

    public function getName() {
        return $this->name;
    }

    //SCRIPT D'UPLOAD D'IMAGE
    public function redimensionner_image($fichier, $longueur, $largeur) {

        //VARIABLE D'ERREUR
        global $error;

        //TAILLE EN PIXELS DE L'IMAGE REDIMENSIONNEE

        //TAILLE DE L'IMAGE ACTUELLE
        $taille = getimagesize($fichier);

        //SI LE FICHIER EXISTE
        if ($taille) {

            //SI JPG
            if ($taille['mime']=='image/jpeg' ) {
                //OUVERTURE DE L'IMAGE ORIGINALE
                $img_big = imagecreatefromjpeg($fichier);
                $img_new = imagecreate($longueur, $largeur);

                //CREATION DE LA MINIATURE
                $img_petite = imagecreatetruecolor($longueur, $largeur) or $img_petite = imagecreate($longueur, $largeur);

                //COPIE DE L'IMAGE REDIMENSIONNEE
                imagecopyresized($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$taille[0],$taille[1]);
                imagejpeg($img_petite,$fichier);

            }

            //SI PNG
            else if ($taille['mime']=='image/png' ) {
                //OUVERTURE DE L'IMAGE ORIGINALE
                $img_big = imagecreatefrompng($fichier); // On ouvre l'image d'origine
                $img_new = imagecreate($longueur, $largeur);

                //CREATION DE LA MINIATURE
                $img_petite = imagecreatetruecolor($longueur, $largeur) OR $img_petite = imagecreate($longueur, $largeur);

                //COPIE DE L'IMAGE REDIMENSIONNEE
                imagecopyresized($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$taille[0],$taille[1]);
                imagepng($img_petite,$fichier);

            }
            // GIF
            else if ($taille['mime']=='image/gif' ) {
                //OUVERTURE DE L'IMAGE ORIGINALE
                $img_big = imagecreatefromgif($fichier);
                $img_new = imagecreate($longueur, $largeur);

                //CREATION DE LA MINIATURE
                $img_petite = imagecreatetruecolor($longueur, $largeur) or $img_petite = imagecreate($longueur, $largeur);

                //COPIE DE L'IMAGE REDIMENSIONNEE
                imagecopyresized($img_petite,$img_big,0,0,0,0,$longueur,$largeur,$taille[0],$taille[1]);
                imagegif($img_petite,$fichier);

            }
        }
    }


}
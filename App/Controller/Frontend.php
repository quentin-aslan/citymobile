<?php

namespace citymobile;

use Exception;
use Photo;

/**
 * Class ControllerFrontend
 * All front-end functions are here
 * @author Quentin Aslan <quentin.aslan@outlook.com>
 * @since 08/07/2019
 */

class ControllerFrontend {

    /**
     * Require Home Page.
     */
    public function home() {
        require '../views/Frontend/home.php';
    }

    public function addArticle() {

        $photo = new Photo($_FILES);
        $article = new Article($_POST);
        $articleManager = new ArticleManager();
        $article->setPhoto($photo->getName());
        $articleManager->add($article);

        // views.

    }


}
<?php

namespace citymobile;

use Exception;
use Photo;

/**
 * Class ControllerBackend
 * All back-end functions are here
 * @author Quentin Aslan <quentin.aslan@outlook.com>
 * @since 10/07/2019
 */

class ControllerBackend {

    /**
     * Require Home Page.
     */
    public function home() {
        //require '../views/Backend/home.php';
    }

    public function addArticle() {

        $photo = new Photo($_FILES);
        $article = new Article($_POST);
        $articleManager = new ArticleManager();
        $article->setPhoto($photo->getName());
        $articleManager->add($article);

        // views.
    }

    public function editArticle() {
        $photo = new Photo($_FILES);
        $article = new Article($_POST);
        if ($article->isNew())
            throw new Exception("L'article que vous essayer de modifier n'existe pas, veuillez le créé.");
        $articleManager = new ArticleManager();
        $article->setPhoto($photo->getName());
        $articleManager->update($article);

        // View
    }


}
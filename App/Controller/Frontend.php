<?php

namespace citymobile;

use Exception;

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

    public function listArticles() {
        $articleManager = new ArticleManager();
        $articles = $articleManager->getList();

        require '../views/Frontend/listArticle.php';

    }

}
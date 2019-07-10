<?php

namespace citymobile;
session_start();
use Administrator;
use Exception;
use Photo;

/**
 * Class ControllerBackend
 * All back-end functions are here
 * @author Quentin Aslan <quentin.aslan@outlook.com>
 * @since 10/07/2019
 */
class ControllerBackend
{

    private function isConnected() {
        return isset($_SESSION['admin_id']);
    }

    /**
     * Require Home Page.
     */
    public function home()
    {
        require '../views/Backend/home.php';
    }

    /**
     * form administrator login
     */
    public function login()
    {
        if($this->isConnected())
            header('location: index.php?p=admin_home');

        if (!empty($_POST)) {
            $administrator = new Administrator($_POST);
            $errors = $administrator->errors;
            if (!empty($errors)) {
                require '../views/backend/login.php';
            } else {
                $administratorManager = new AdministratorManager();
                $errors = $administratorManager->connect($administrator);
                if(!empty($errors))
                    require '../views/backend/login.php';
                else
                    header('location: index.php?p=admin_home');
            }


        } else {
            require '../views/backend/login.php';
        }

    }

    public function addArticle()
    {
        $photo = new Photo($_FILES);
        $article = new Article($_POST);
        $articleManager = new ArticleManager();
        $article->setPhoto($photo->getName());
        $articleManager->save($article);

        echo '<div class="alert alert-success">L\'article à bien été ajouté</div>';
    }

    public function editArticle()
    {
        $photo = new Photo($_FILES);
        $article = new Article($_POST);
        if ($article->isNew())
            throw new Exception("L'article que vous essayer de modifier n'existe pas, veuillez le créé.");
        $articleManager = new ArticleManager();
        $article->setPhoto($photo->getName());
        $articleManager->save($article);

        // View
    }


}
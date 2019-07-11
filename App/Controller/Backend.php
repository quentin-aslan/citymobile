<?php

namespace citymobile;

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
    private $articleManager;

    public function __construct()
    {
        $this->articleManager = new ArticleManager();
    }


    /**
     * Require Home Page.
     */
    public function home()
    {
        if (!AdministratorManager::isConnected())
            header('location: index.php?p=admin_login');
        require '../views/Backend/home.php';
    }

    /**
     * form administrator login
     */
    public function login()
    {
        if (AdministratorManager::isConnected())
            header('location: index.php?p=admin_home');

        if (!empty($_POST)) {
            $administrator = new Administrator($_POST);
            $errors = $administrator->errors;
            if (!empty($errors))
                require '../views/backend/login.php';
            else {
                $administratorManager = new AdministratorManager();
                $errors = $administratorManager->connect($administrator);
                if (!empty($errors))
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
        if(!AdministratorManager::isConnected())
            header('location: index.php?p=admin_login');
        if(!empty($_POST)) {
            $photo = new Photo($_FILES);
            $article = new Article($_POST);
            $article->setPhoto($photo->getName());
            $errors = $article->errors;
            if(!empty($errors))
                require '../views/backend/addArticle.php';
            else {
                $photo->add(); // Add photo on the server.
                $this->articleManager->save($article);
                echo '<div class="container"><div class="alert alert-success">Votre article à bien été ajouté <br />> <a href="index.php?p=admin_list_articles">Afficher la liste des articles.</a></div></div>';
            }
        } else {
            require '../views/backend/addArticle.php';
        }
    }

    public function updateArticle($id)
    {
        $id = (int)$id;
        if (!AdministratorManager::isConnected())
            header('location: index.php?p=admin_login');

        if (!empty($_POST)) {

            if(empty($_FILES['photo']['name']))
                $photoName = $_POST['oldPhoto'];
            else {
                $photo = new Photo($_FILES);
                $photo->add();
                $photoName = $photo->getName();
            }

            $article = new Article($_POST);
            if ($article->isNew())
                throw new Exception("L'article que vous essayer de modifier n'existe pas, <a href='index.php?p=admin_add_article'>cliquez ici pour en crée un</a>.");

            $article->setPhoto($_POST['oldPhoto']);
            $article->setPhoto($photoName);
            $errors = $article->errors;
            if (!empty($errors))
                require '../views/backend/updateArticle.php';
            else {
                if(!empty($_FILES['name']))
                    $photo->add(); // Add photo on the server.
                $this->articleManager->save($article);
                echo '<div class="container"><div class="alert alert-success">Votre article à bien été modifié <br />> <a href="index.php?p=admin_list_articles">Afficher la liste des articles.</a></div></div>';
            }
        } else {
            $article = $this->articleManager->get($id);
            require '../views/backend/updateArticle.php';
        }

        // View
    }

    public
    function listArticles()
    {
        if (!AdministratorManager::isConnected())
            header('location: index.php?p=admin_login');
        $articles = $this->articleManager->getList();
        require '../views/backend/listArticles.php';
    }

    public
    function deleteArticle($token)
    {
        if (isset($token) && !empty($token)) {
            if ($this->articleManager)
                $this->articleManager->delete($token);
            echo '<div class="container"><div class="alert alert-success">L\'article à bien été supprimé <br />> <a href="index.php?p=admin_list_articles">Afficher la liste des articles.</a></div></div>';
        }
    }

    public function logout()
    {
        session_destroy();
        header('location: index.php?p=home');
    }


}
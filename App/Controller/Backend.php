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
class ControllerBackend extends Controller
{

    /**
     * Require Home Page.
     */
    public function home()
    {
        if (!$this->administratorManager->isConnected())
            header('location: index.php?p=admin_login');
        require '../views/Backend/home.php';
    }

    public function login()
    {
        if ($this->administratorManager->isConnected())
            header('location: index.php?p=admin_home');

        if (!empty($_POST)) {
            $administrator = new Administrator($_POST);
            $errors = $administrator->errors;
            if (!empty($errors))
                require '../views/backend/login.php';
            else {
                $errors = $this->administratorManager->connect($administrator);
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
        if (!$this->administratorManager->isConnected())
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
                echo '<div class="container"><div class="alert alert-success">L\'article <em>"'.$article->getName().'"</em> à bien été ajouté </div></div>';
                $this->listArticles();
            }
        } else {
            require '../views/backend/addArticle.php';
        }
    }

    public function updateArticle($id)
    {
        $id = (int)$id;
        if (!$this->administratorManager->isConnected())
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
                echo '<div class="container"><div class="alert alert-success">L\'article <em>"'.$article->getName().'"</em> à bien été modifié</div></div>';
                $this->listArticles();

            }
        } else {
            $article = $this->articleManager->get($id);
            require '../views/backend/updateArticle.php';
        }

    }

    public function listArticles($page = 1)
    {
        if (!$this->administratorManager->isConnected())
            header('location: index.php?p=admin_login');

        $pagination = $this->pagination($page, $this->articleManager, 10, 'admin_list_articles');
        $articles = $pagination['articles'];
        $paginationView = $pagination['view'];


        require '../views/backend/listArticles.php';
    }

    public function deleteArticle($token)
    {
        if (isset($token) && !empty($token)) {
            if ($this->articleManager)
                $this->articleManager->delete($token);
            echo '<div class="container"><div class="alert alert-success">L\'article à bien été supprimé</div></div>';
            $this->listArticles();
        }
    }

    public function viewArticle($id)
    {
        $article = $this->articleManager->get($id);

        require '../views/backend/article.php';
    }

    public function logout()
    {
        session_destroy();
        header('location: index.php?p=home');
    }


}
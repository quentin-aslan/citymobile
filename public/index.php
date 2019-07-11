<?php

use citymobile\Autoloader;
use citymobile\ControllerBackend;
use citymobile\ControllerFrontend;
session_start();
require '../App/class/Autoloader.php';
Autoloader::register();

require '../App/controller/Frontend.php';
require '../App/controller/Backend.php';
$controllerFrontend = new ControllerFrontend();
$controllerBackend = new ControllerBackend();

$p = isset($_GET['p']) ? $_GET['p'] : 'home';
try {
    ob_start();

    switch ($p) {

        case 'home':
            $controllerFrontend->home();
            break;

        case 'list_articles':
            $controllerFrontend->listArticles();
            break;

        case 'admin_login':
            $controllerBackend->login();
            break;

        case 'admin_logout':
            $controllerBackend->logout();
            break;

        case 'admin_list_articles':
            $controllerBackend->listArticles();
            break;

        case 'admin_home':
            $controllerBackend->home();
            break;

        case 'admin_add_article':
            $controllerBackend->addArticle();
            break;

        case 'admin_update_article':
            $controllerBackend->updateArticle($_GET['token']);
            break;

        case 'admin_delete_article':
            $controllerBackend->deleteArticle($_GET['token']);
            break;

        default:
            require '../views/frontend/home.php';
            break;
    }



    $content = ob_get_clean();
    if(\citymobile\AdministratorManager::isConnected())
        require '../views/template/layoutBack.php';
    else
        require '../views/template/layout.php';
}catch (Exception $e) {
    $content = "<div class='container'><div class='alert alert-danger'>";
    $content.= $e->getMessage();
    $content.= "<br/><a href='index.php?p=home'>Retour à la page d'accueil</a></div></div>";
    if(\citymobile\AdministratorManager::isConnected())
        require '../views/template/layoutBack.php';
    else
        require '../views/template/layout.php';

}
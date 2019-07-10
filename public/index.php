<?php

use citymobile\Autoloader;
use citymobile\ControllerBackend;
use citymobile\ControllerFrontend;

require '../App/Autoloader.php';
Autoloader::register();

require '../App/Controller/Frontend.php';
require '../App/Controller/Backend.php';
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

// ------------ BACK-END ------------
        case 'login':
            $controllerBackend->login();
            break;

        case 'add_article':
            $controllerBackend->addArticle();
            break;

        case 'update_article':
            $controllerBackend->editArticle();


        default:
            require '../views/frontend/home.php';
            break;
    }

    $content = ob_get_clean();
    require '../views/template/layout.php';
}catch (Exception $e) {
    $content = "<div class='alert alert-danger'>";
    $content.= $e->getMessage();
    $content.= "<br/><a href='index.php?p=home'>Retour à la plage d'accueil</a></div>";
    require '../views/template/layout.php';

}
<?php

use citymobile\Autoloader;
use citymobile\ControllerFrontend;

require '../App/Autoloader.php';
Autoloader::register();

require '../App/Controller/Frontend.php';
$controllerFrontend = new ControllerFrontend();

$p = isset($_GET['p']) ? $_GET['p'] : 'home';
try {
    ob_start();

    switch ($p) {

        case 'home':
            $controllerFrontend->home();
            break;

        case 'add_article':
            $controllerFrontend->addArticle();
            break;

        case 'single':
            if (isset($_GET['id']))
                FrontSingle();
            else
                FrontHome();
            break;

        default:
            require '../views/home.php';
            break;
    }

    $content = ob_get_clean();
    require '../views/template/layout.php';
}catch (Exception $e) {
    $error = $e->getMessage();
    echo $error;
    // Page d'erreur à faire.
}
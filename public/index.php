<?php
define('ROOT', dirname(dirname(__FILE__)));
use citymobile\AdministratorManager;
use citymobile\Autoloader;
use citymobile\ControllerBackend;
use citymobile\ControllerFrontend;
session_start();
require '../App/class/Autoloader.php';
Autoloader::register();

$controllerFrontend = new ControllerFrontend();
$controllerBackend = new ControllerBackend();

$p = isset($_GET['p']) ? $_GET['p'] : 'default';
try {
    ob_start();

    switch ($p) {

        case 'home':
            $controllerFrontend->home();
            break;

        case 'list_articles':
            $page = isset($_GET['numberPage']) ? $_GET['numberPage'] : 1;
            $type = isset($_GET['type']) ? $_GET['type'] : 'nothing';
            $search = isset($_GET['search']) ? $_GET['search'] : 'nothing';
            $controllerFrontend->listArticles($page, $type, $search);
            break;

        case 'admin_login':
            $controllerBackend->login();
            break;

        case 'admin_logout':
            $controllerBackend->logout();
            break;

        case 'admin_list_articles':
            $page = isset($_GET['numberPage']) ? $_GET['numberPage'] : 1;
            $search = isset($_GET['search']) ? $_GET['search'] : 'nothing';
            $controllerBackend->listArticles($page, $search);
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
            if(AdministratorManager::isConnected())
                $controllerBackend->home();
            else
                $controllerFrontend->home();
            break;
    }



    $content = ob_get_clean();
    if(AdministratorManager::isConnected())
        require ROOT.'/views/template/layoutBack.php';
    else
        require ROOT.'/views/template/layout.php';
}catch (Exception $e) {
    $content = "<div class='container'><div class='alert alert-danger'>";
    $content.= $e->getMessage();
    $content.= "<br/><a href='index.php?p=home'>Retour à la page d'accueil</a></div></div>";
    if(AdministratorManager::isConnected())
        require ROOT.'/views/template/layoutBack.php';
    else
        require ROOT.'/views/template/layout.php';

}
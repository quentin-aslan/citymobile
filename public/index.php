<?php

use citymobile\Autoloader;

require '../App/Autoloader.php';
Autoloader::register();

$p = isset($_GET['p']) ? $_GET['p'] : 'home';

ob_start();

switch ($p) {

    case 'home':
        require '../views/home.php';
        break;

    case 'single':
        require '../views/single.php';
        break;

    default:
        require '../views/home.php';
        break;
}

$content = ob_get_clean();
require '../views/template/layout.php';
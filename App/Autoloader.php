<?php

namespace citymobile;

/**
 * Class Autoloader
 * @package citymobile
 * @author Quentin Aslan <quentin.aslan@outlook.com>
 * @since 08/07/2019
 */
class Autoloader
{

    public static function register()
    {
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    public static function autoload($class)
    {
        if (strpos($class, __NAMESPACE__ . '\\') == 0) {
            $class = str_replace(__NAMESPACE__ .'\\', '', $class);
            $class = str_replace('\\', '/', $class);
            require(__DIR__ . 'class/' . $class . '.php');
        }
    }

}

<?php

//defined('MK4U') || die;

/**
 * Autoload PSR4
 */

define('DS',DIRECTORY_SEPARATOR);
define('ABS_PATH', dirname(__DIR__));


$namespace = [
    'Mk4U'       => '/src',
];

spl_autoload_register(function ($class) use ($namespace) {
    foreach ($namespace as $key => $value) {
        $len = strlen($key);
        $file = str_replace(['\\', '/'], DS, ABS_PATH . $value . substr($class, $len) . '.php');

        if (is_readable($file)) return require_once $file;
    }
    throw new RuntimeException(sprintf("Clase %s no encontrada en %s", $class, $file));
});

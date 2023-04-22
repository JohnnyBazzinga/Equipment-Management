<?php


/**
 * @autores João Bastos, Cristóvão Lavarinhas, Bruno Lima
 * @copyright 2021
 * @ver 1.0
 */
 
spl_autoload_register(function ($class) {

    $prefix = '';

    $base_dir = __DIR__.'/';

    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);

    $file = $base_dir.str_replace('\\', '/', $relative_class).'.php';

    if (file_exists($file)) {
        require $file;
    }
});

?>
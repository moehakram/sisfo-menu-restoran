<?php
spl_autoload_register(function ($class) {
    $file = ROOT . str_replace('\\', '/', lcfirst($class)) . '.php';
    if (file_exists($file)) {
        require_once $file;
    } else {
        // throw new Exception(sprintf('Class { %s } tidak ditemukan', $class));
        die(sprintf('Class { %s } tidak ditemukan', $class));
    }
});

require_once APP . "helper/public.php";

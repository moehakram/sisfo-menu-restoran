<?php

// Define Path app
define('ROOT', str_replace('\\', '/', rtrim(__DIR__, '/')) . '/../');
define('APP', ROOT . 'app/');
define('CONTROLLERS', ROOT . 'app/Controllers/');
define('MODELS', ROOT . 'app/Models/');
define('VIEWS', ROOT . 'app/Views/');
define('UPLOAD', ROOT . 'upload/');
define('CONFIG', ROOT . 'config/');

define('BASE_URL', "https://localhost:8080/");

define('SRC_UPLOAD', 'http://localhost:8080/upload/');
define('SRC_PUBLIC', 'http://localhost:8080/');


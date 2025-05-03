<?php
    if ($_SERVER['SERVER_NAME'] === 'localhost') {
        define('DB_HOST', 'hostDoBancoDeDados');
        define('DB_USERNAME', 'usuarioDoBancoDeDados');
        define('DB_PASSWORD', 'senhaDoBancoDeDados');
        define('DB_NAME', 'nomeDoBancoDeDados');
        define('BASE_URL', 'urlBaseDoSite');
        define('BASE_PATH', __DIR__);
    }
    else {
        define('DB_HOST', '');
        define('DB_USERNAME', '');
        define('DB_PASSWORD', '');
        define('DB_NAME', '');
        define('BASE_URL', '');
    }
    define('BASE_PATH', __DIR__);
    
?>

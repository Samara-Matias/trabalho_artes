<?php

// Se for necessário utilizar uma determinada classe e o php não está encontrando, essa função será chamada
spl_autoload_register(function($nomeClasse) {
    $filename = '../app/models/' . ucfirst($nomeClasse) . '.php';
    require_once $filename;
});

require_once 'config.template.php';
require_once 'Helper.php';
require_once 'Database.php';
require_once 'Model.php';
require_once 'Controller.php';
require_once 'App.php';
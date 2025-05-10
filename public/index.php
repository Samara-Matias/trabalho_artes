<?php
// CRIAÇÃO DE UM ROUTER
require_once '../app/core/init.php';

// Inicializando uma sessão -> Ela servirá para todas as páginas que forem chamadas a partir dela
Helper::iniciarSessao();



$app = new App;
$app->carregarController();
<?php
// CRIAÇÃO DE UM ROUTER

// Inicializando uma sessão -> Ela servirá para todas as páginas que forem chamadas a partir dela
session_start();

require '../app/core/init.php';

$app = new App;
$app->carregarController();
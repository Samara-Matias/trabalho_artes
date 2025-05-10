<?php
    if (!isset($_SESSION['usuario'])) {
        // Se não estiver logado, redireciona para login
        header('Location: /login');
        exit;
    }

?>

<!DOCTYPE html>
<html lang="pt-bt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Focus List</title>

    <link rel="stylesheet" href="<?= BASE_URL ?>/css/dashboard.css">
</head>
<body>
    <h1>Bem-vindo(a) <?= $_SESSION['usuario']?></h1>
</body>
</html>
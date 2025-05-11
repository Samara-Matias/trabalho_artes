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

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <nav>
        <h2>Focus List</h2>
        <ul>
            <li>
                <a href="#">Dashboard</a>
            </li>
            <li>
                <a href="#">Tarefas</a>
            </li>
            
        </ul>
        <div class="user_control">
            
            <p class="username"><?= $_SESSION['usuario']?></p>
            <img src="<?= BASE_URL ?>/assets/imagens/dropdownIcon.svg" alt="Chevron Down Icon BOXICON">
            
        </div>
        
        <div class="sub-menu-wrap">
            
            <div class="sub-menu">
                <div class="user-info">
                    <p class="username"><?= $_SESSION['usuario']?></p>
                    <a href="<?= BASE_URL ?>/logout">Logout</a>
                </div>
            </div>

        </div>
    </nav>

    <main>

        <header class="main__header">
            <h1>Bem-vindo(a) <?= $_SESSION['usuario']?></h1>
        </header>

        <div class="main__container">

            <div class="progresso">

                <div class="progresso__card">
                    <div class="card__header">
                        <h3 class="card_header__title">Tarefas concluídas:</h3>
                    </div>

                    <div class="card__content">
                        <p class="tarefas_concluidas">0/0</p>
                    </div>

                </div>

                <div class="progresso__card">

                    <div class="card__header">
                        <h3 class="card_header__title">Tarefas pendentes:</h3>
                    </div>

                    <div class="card__content">
                        <p class="tarefas_pendentes">0/0</p>
                    </div>

                </div>

                <div class="progresso__card">

                    <div class="card__header">
                        <h3 class="card_header__title">Tarefas em progresso:</h3>
                    </div>

                    <div class="card__content">
                        <p class="tarefas_em_progresso">0/0</p>
                    </div>

                </div>

            </div>

        </div>
    </main>
</body>
</html>
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
        <!-- <h2>Focus List</h2> -->
        <ul>
            <li>
                <a href="<?= BASE_URL ?>/dashboard">Dashboard</a>
            </li>
            <li>
                <a href="<?= BASE_URL ?>/tarefas">Tarefas</a>
            </li>
            
        </ul>
        <div class="user_control" onclick="toggleMenu()">
            
            <p class="username">Usuário</p>
            <img src="<?= BASE_URL ?>/assets/imagens/dropdownIcon.svg" alt="Chevron Down Icon BOXICON">
            
        </div>
        
        <div class="sub-menu-wrap" id="sub-menu">
            
            <div class="sub-menu">
                <div class="user-info">
                    <p class="username"><?= $_SESSION['usuario']?></p>
                    <hr>
                    <a href="<?= BASE_URL ?>/logout">Logout</a>
                </div>
            </div>
            
        </div>
    </nav>

    <main>

        <header class="main__header">
            <h1>Olá, <?= $_SESSION['usuario']?>!</h1>
        </header>

        <div class="main__progresso_container">

            <div class="progresso">

                <div class="progresso__card">
                    <div class="card__header">
                        <h3 class="card_header__title">Tarefas concluídas</h3>
                    </div>

                    <div class="card__content">
                        <p class="tarefas_concluidas card_content__text">0/0</p>
                    </div>

                </div>

                <div class="progresso__card">

                    <div class="card__header">
                        <h3 class="card_header__title ">Tarefas pendentes</h3>
                    </div>

                    <div class="card__content">
                        <p class="tarefas_pendentes card_content__text">0/0</p>
                    </div>
                    
                </div>
                
                <div class="progresso__card">
                    
                    <div class="card__header">
                        <h3 class="card_header__title">Tarefas em progresso</h3>
                    </div>
                    
                    <div class="card__content">
                        <p class="tarefas_em_progresso card_content__text">0/0</p>
                    </div>

                </div>
                
            </div>
            
        </div>
        
        
        <div id="lista_tarefas__container">
            <div class="lista_tarefas__header">
                <button id="addLista">Adicionar lista</button>
                <button id="addTarefa">Adicionar tarefa</button>
            </div>
            <div class="lista_tarefas">

                <div class="lista_tarefa">

                    <div class="lista_tarefa__header">
                        <h3>Nome da lista</h3>
                        <img src="<?= BASE_URL ?>/assets/imagens/dropdownIcon.svg" alt="Chevron Down Icon BOXICON">
                    </div>

                    <div class="lista_tarefa__content">

                        <div class="lista_tarefa__tarefa">
                            <div class="tarefa">
                                <p class="tarefa_title">Titulo da tarefa</p>
                                <span class="status_tarefa">Status da tarefa</span>
                            </div>

                            <div class="actions">
                                <button id="edit_t1">Editar</button>
                                <!-- Usar outro método de diferenciação dos botões de cada tarefa -->
                                <button id="remove_t1">Deletar</button>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </main>

    <script>
        let subMenu = document.querySelector('#sub-menu');
        let img = document.querySelector('.user_control img');

        function toggleMenu () {
            img.classList.toggle('rotacionar');

            subMenu.classList.toggle('open-menu');
        }
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
    <title>Login - Focus List</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/loginCadastro.css">
</head>
<body>
    <main>
        <aside class="form-image-decoration">

        </aside>

        <div class="form">
            <div class="form-header">
                <h1>Bem-vindo(a) novamente</h1>
                <p>Faça o seu login e realize suas tarefas!</p>
            </div>

            <form method="post" class="login-form">
                <?php if(!empty($erros)): ?>
                    <?= implode('<br>', $erros) ?>
                <?php endif; ?>
                <input type="email" name="email" id="email" placeholder="nome@exemplo.com" required>
                
                <input type="password" name="senha" id="senha" placeholder="Sua senha" required>
                
                <button type="submit">Entrar</button>
                <p>Ainda não tem uma conta? <a href="<?=BASE_URL?>/cadastro">Cadastre-se</a></p>
                
            </form>
        </div>
    </main>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ToDo List</title>
</head>
<body>
    <form method="post">
        <?php if(!empty($erros)): ?>
            <?= implode('<br>', $erros) ?>
        <?php endif; ?>
        <h1>Faça seu login</h1>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" placeholder="nome@exemplo.com" required>
        
        <label for="senha">Senha</label>
        <input type="password" name="senha" id="senha" placeholder="Sua senha" required>
        
        <button type="submit">Entrar</button>
    </form>
    <a href="<?=ROOT?>">Início</a>
    <a href="<?=ROOT?>/register">Cadastre-se</a>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - ToDo List</title>

    <link rel="stylesheet" href="<?= BASE_URL ?>/css/loginCadastro.css">
</head>
<body>
    
    <main>
        <aside class="form-image-decotation">
    
        </aside>
        
        <div class="form">
            <div class="form-header">
                
                <h1>Cadastre-se</h1>
                <p>Crie sua conta e aproveite!</p>
                
            </div>

            <form action="<?= BASE_URL ?>/cadastro/cadastroUsuario" method="POST" class="cadastro-form">
                <?php if(!empty($erros)): ?>
                    <div>
                        <?= implode( "</br>", $erros ) ?>
                    </div>
                <?php endif; ?>
        
                <input type="text" name="usuario" id="usuario" placeholder="Usuário" required>
        
                <input type="email" name="email" id="email" placeholder="Email" required>
        
                <input type="password" name="senha" id="senha" placeholder="Senha" required>
        
                <button type="submit">Cadastrar-se</button>
        
                <p>Já possui uma conta? <a href="<?= BASE_URL?>/login">Faça seu login</a></p>
            </form>
        </div>
        
    </main>

</body>
</html>
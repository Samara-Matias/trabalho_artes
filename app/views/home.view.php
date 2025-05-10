<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>FocusList - Sua Lista de Tarefas</title>
  <link rel="stylesheet" href="../../public/css/root.css" />
  <link rel="stylesheet" href="styles.css" />
</head>
<body>
  <header class="cabecalho">
    <h1>FocusList</h1>
    <nav>
      <a href="#destaques">Funcionalidades</a>
      <a href="auth/login.php">Entrar</a>
    </nav>
  </header>

  <section class="apresentacao">
    <h2>Sua produtividade, repensada.</h2>
    <p>Crie, organize e complete tarefas com estilo e facilidade.</p>
    <a href="auth/register.php" class="botao-principal">Comece Agora</a>
  </section>

  <section class="destaques" id="destaques">
    <h3>Por que escolher o FocusList?</h3>
    <div class="grade-funcionalidades">
      <div class="caixa-funcionalidade">
        <h4>Interface Intuitiva</h4>
        <p>Organize tarefas com um clique em uma UI moderna e responsiva.</p>
      </div>
      <div class="caixa-funcionalidade">
        <h4>Organização Da Sua Rotina</h4>
        <p>Organize suas tarefas diárias de forma simples e eficiente.</p>
      </div>
    </div>
  </section>

  <section class="chamada">
    <h3>Pronto para focar no que importa?</h3>
    <a href="auth/register.php">Criar Conta Grátis</a>
  </section>

  <footer class="rodape">
    <p>2025 FocusList. Todos os direitos reservados.</p>
  </footer>

    <h1>Home page view</h1>
    <a href="<?= BASE_URL ?>/login">Login</a>
    <a href="<?= BASE_URL ?>/cadastro">Register</a>
</body>
</html>

<?php
//classe de login
class Login extends Controller {
    public function index() {
        $dados = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario;
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            // Validação básica
            if (empty($email) || empty($senha)) {
                $dados['erros'] = ['Preencha email e/ou senha'];
            } else {
                $arr['email'] = $email;
                $usuarioEncontrado = $usuario->first($arr);
                if ($usuarioEncontrado && password_verify($senha, $usuarioEncontrado->senha)) { 
                    $_SESSION['usuario'] = $usuarioEncontrado;
                    Helper::redirecionar('home');
                    exit;
                } else {
                    $dados['erros'] = ['Email/senha incorretos'];
                }
            }
        }
        $this->view('login', $dados);
    }
}
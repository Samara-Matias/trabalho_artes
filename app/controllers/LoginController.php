<?php
class Login extends Controller {
    public function index() {
        $dados = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $usuario = new Usuario;
                $email = $_POST['email'];
                $senha = $_POST['senha'];
                // Validação básica
                if (empty($email) || empty($senha)) {
                    $usuario->erros = ['Preencha email e senha'];
                } else {
                    $arr['email'] = $email;
                    $usuarioEncontrado = $usuario->first($arr);
                    
                    if($usuarioEncontrado && password_verify($senha, $usuarioEncontrado['senha'])) { 
                        $_SESSION['usuario'] = $usuarioEncontrado;
                        Helper::redirecionar('dashboard');
                        exit;
                    } else {
                        $usuario->erros = ['Email/senha incorretos'];
                    }
                }
                $dados['erros'] = $usuario->erros;
                
            } catch (PDOException $erro) {
                error_log($erro->getMessage());
                $usuario->erros = [];
                $dados['erros'] = $usuario->erros;
            }
        }
        $this->view('login', $dados);
    }
}
<?php

class Cadastro extends Controller{
    public function index() {
        $this->view('cadastro');
    }
    public function cadastroUsuario() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            try{
                $dados = [
                    'nomeUsuario' => $_POST['usuario'],
                    'email' => $_POST['email'],
                    'senha' => password_hash($_POST['senha'], PASSWORD_DEFAULT)
                ];
                $usuario = new Usuario;
                $usuario->insert($dados);

                $_SESSION['usuario'] = $_POST['usuario'];
                $_SESSION['email'] = $_POST['email'];
                
                Helper::redirecionar('dashboard');
            }
            catch (PDOException $erro) {
                error_log( $erro->getMessage() );
                $usuario->erros = [];
                $usuario->erros = ['Não foi possível criar uma conta com esses dados. Tente novamente.'];
            }
        }
        $dados['erros'] = $usuario->erros;
        $this->view('cadastro', $dados);
    }
}
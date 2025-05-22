<?php
require_once '../models/Lista.php';

class ListaController extends Controller {

    public function index() {
        $lista = new Lista();
        $listas = $lista->where(['usuario_id' => $_SESSION['usuario_id']]);
        $this->view('lista', ['listas' => $listas, 'erros' => $lista->erros]);
    }

    public function criarLista() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $lista = new Lista();
            try {
                $titulo = $_POST['titulo'];
                $descricao = $_POST['descricao'];

                if (empty($titulo)) {
                    throw new Exception('Digite um título para a lista');
                }
                $dados = [
                    'titulo' => $titulo,
                    'descricao' => $descricao,
                    'usuario_id' => $_SESSION['usuario_id']
                ];

                $lista->insert($dados);
                Helper::redirecionar('lista');
            }
            catch (Exception $erro) {
                $lista->erros = [$erro->getMessage()];
                $this->view('lista', ['erros' => $lista->erros]);
            }
        }
         
    }

    private function obterLista($id) {
        $lista = new Lista();
        $listaExistente = $lista->first([
            'lista_id' => $id,
            'usuario_id' => $_SESSION['usuario_id']
        ]);
        if (!$listaExistente) {
            throw new Exception('Lista não encontrada');
        }
        return $listaExistente;
    }

    public function excluirLista($id) {
        $lista = new Lista();
        try {
            $this->obterLista($id);
            $lista->delete($id, 'lista_id');
            Helper::redirecionar('lista');
        } catch (Exception $erro) {
            $lista->erros = [$erro->getMessage()];
            $this->view('lista', ['erros' => $lista->erros]);
        }
    }

    public function editarLista($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $lista = new Lista();
            try {
                $this->obterLista($id);
                $titulo = $_POST['titulo'];
                $descricao = $_POST['descricao'];
                if ($titulo === '') {
                    throw new Exception('Digite um título para a lista');
                }
                $dados = [
                    'titulo' => $titulo,
                    'descricao' => $descricao
                ];
                $lista->update($id, $dados, 'lista_id');
                Helper::redirecionar('lista');
            } catch (Exception $erro) {
                $lista->erros = [$erro->getMessage()];
                $this->view('lista', ['erros' => $lista->erros]);
            }
        } 
    }
}
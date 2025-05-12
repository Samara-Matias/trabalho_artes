<?php
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
                if (empty($_POST['titulo'])) {
                    throw new Exception('Digite um título para a lista');
                }
                $dados = [
                    'titulo' => $_POST['titulo'],
                    'descricao' => $_POST['descricao'],
                    'usuario_id' => $_SESSION['usuario_id']
                ];
                $lista->insert($dados);
                Helper::redirecionar('lista');
            } catch (Exception $erro) {
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
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            parse_str(file_get_contents("php://input"), $_PUT);
            $lista = new Lista();
            try {
                $this->obterLista($id);
                if (empty($_PUT['titulo'])) {
                    throw new Exception('Digite um título para a lista');
                }
                $dados = [
                    'titulo' => $_PUT['titulo'],
                    'descricao' => $_PUT['descricao']
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
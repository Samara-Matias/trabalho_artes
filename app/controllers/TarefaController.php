<?php
class TarefaController extends Controller {
    public function index() {
        $tarefa = new Tarefa();
        $tarefas = $tarefa->where(['lista_id' => $_GET['lista_id']]);
        $this->view('tarefa', ['tarefas' => $tarefas, 'erros' => $tarefa->erros]);
    }

    public function criarTarefa() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tarefa = new Tarefa();
            try {
                if (empty($_POST['titulo'])) {
                    throw new Exception("Título é obrigatório");
                }
                $dados = [
                    'titulo' => $_POST['titulo'],
                    'descricao' => $_POST['descricao'] ?? '',
                    'lista_id' => $_POST['lista_id'],
                    'prioridade' => in_array($_POST['prioridade'], ['Alta', 'Média', 'Baixa', 'Nenhuma']) 
                                    ? $_POST['prioridade'] 
                                    : 'Nenhuma',
                    'status_tarefa' => 'Criada'
                ];
                $tarefa->insert($dados);
                Helper::redirecionar('tarefa?lista_id=' . $dados['lista_id']);
            } catch (Exception $erro) {
                $tarefa->erros = [$erro->getMessage()];
                $this->view('tarefa', ['erros' => $tarefa->erros]);
            }
        }
    }

    private function obterTarefa($id) {
        $tarefa = new Tarefa();
        $tarefaExistente = $tarefa->first(['tarefa_id' => $id]);
        if (!$tarefaExistente) {
            throw new Exception('Tarefa não encontrada');
        }
        $lista = new Lista();
        $listaExistente = $lista->first([
            'lista_id' => $tarefaExistente['lista_id'],
            'usuario_id' => $_SESSION['usuario_id']
        ]);
        if (!$listaExistente) {
            throw new Exception('Lista não encontrada');
        }
        return $tarefaExistente;
    }

    public function excluirTarefa($id) {
        $tarefa = new Tarefa();
        try {
            $tarefaExistente = $this->obterTarefa($id);
            $tarefa->delete($id, 'tarefa_id');
            Helper::redirecionar('tarefa?lista_id=' . $tarefaExistente['lista_id']);
        } catch (Exception $erro) {
            $tarefa->erros = [$erro->getMessage()];
            $this->view('tarefa', ['erros' => $tarefa->erros]);
        }
    }

    public function editarTarefa($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            parse_str(file_get_contents("php://input"), $_PUT);
            $tarefa = new Tarefa();
            try {
                $tarefaExistente = $this->obterTarefa($id);
                if (empty($_PUT['titulo'])) {
                    throw new Exception("Título é obrigatório");
                }
                $dados = [
                    'titulo' => $_PUT['titulo'],
                    'descricao' => $_PUT['descricao'] ?? '',
                    'prioridade' => in_array($_PUT['prioridade'], ['Alta', 'Média', 'Baixa', 'Nenhuma']) 
                                    ? $_PUT['prioridade'] 
                                    : 'Nenhuma',
                    'status_tarefa' => $_PUT['status_tarefa'] ?? 'Criada'
                ];
                $tarefa->update($id, $dados, 'tarefa_id');
                Helper::redirecionar('tarefa?lista_id=' . $tarefaExistente['lista_id']);
            } catch (Exception $erro) {
                $tarefa->erros = [$erro->getMessage()];
                $this->view('tarefa', ['erros' => $tarefa->erros]);
            }
        }
    }
}
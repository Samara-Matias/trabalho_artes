<?php

class Tarefa extends Model
{
    public function __construct()
    {
        $this->tabela = 'tarefa';
        $this->orderColuna = 'tarefa_id';
    }

    protected $colunasPermitidas = [
        'titulo',
        'descricao',
        'lista_id',
        'prioridade',
        'status_tarefa'
    ];
}

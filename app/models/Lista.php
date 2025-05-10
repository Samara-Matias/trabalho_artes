<?php

class Lista extends Model
{
    public function __construct()
    {
        $this->tabela = 'lista';
        $this->orderColuna = 'lista_id';
    }

    protected $colunasPermitidas = [
        'titulo',
        'descricao',
        'usuario_id'
    ];
}

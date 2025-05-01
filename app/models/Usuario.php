<?php

/**
 * Classe Usuário
 */

class Usuario extends Model {
    public function __construct(){
        $this->tabela = 'usuario';
        $this->orderColuna = 'userId';
    }
    protected $colunasPermitidas = [
        'nomeUsuario',
        'email',
        'senha'
    ];
}
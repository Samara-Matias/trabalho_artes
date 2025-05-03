<?php

// Criando uma classe Model para conectar com o banco de dados e manipulá-lo
    // Aqui nessa classe, deve-se criar os métodos que são comuns em cada tabela específica
    // Assim poderá ser reutilizada em cada Model espefícico de cada tabela
class Model extends Database {
    protected $tabela      = '';
    // Para paginação
    protected $limite      = 10;
    protected $offset      = 0;
    // Para ordenação
    protected $orderTipo   = 'DESC';
    protected $orderColuna = 'id';

    // Função para retornar todos os dados da tabela ordenados de alguma forma
    public function findAll () {
        
        $query = "SELECT * FROM $this->tabela order by $this->orderColuna $this->orderTipo limit $this->limite offset $this->offset";

        // Chamando a função 'query' criada na classe Database para execução dessa query
        return $this->query($query);
    }
    /**
     * Essa função receberá um array de chave e valor de informações que serão usadas para pesquisar registro(s) específico(s) no banco de dados (cláusula where)
     * 
     * $dado array -> usado para pegar registro(s) no banco de dados de acordo com as informações contidas no array e que vai ser usado na cláusula where
     *      - EX.: SELECT * from tabela WHERE dadoDoArray = :dadoDoArray;
     * $nao_dado -> é o array de dados que não deverão ser iguais quando fizer a claúsula where, caso não haja necessidade de uma negação, não precisa passar valor algum no parâmetro
     *      - EX.: SELECT * from tabela WHERE dadoDoArray != :dadoDoArray;
     */
    public function where ($dado, $nao_dado = []) {
        $chaves = array_keys($dado);
        $nao_chaves = array_keys($nao_dado);
        $query = "SELECT * FROM $this->tabela WHERE ";

        foreach ($chaves as $chave) {
            $query .= $chave . ' = :' . $chave . " && ";
            // Retorna algo similar a isso: SELECT * FROM users WHERE id = :id && 
        }
        foreach ($nao_chaves as $chave) {
            $query .= $chave . ' != :' . $chave . " && ";
        }

        // Retirando && desnecessários do início e fim da query
        $query = trim($query, " && ");

        $query .= "order by $this->orderColuna $this->orderTipo  limit $this->limite offset $this->offset";

        // Juntando os 2 array porque a função 'query' apenas recebe 2 parâmetros, a query e os dados
        $dado = array_merge($dado, $nao_dado);

        // Chamando a função 'query' criada na classe Database para execução dessa query
        return $this->query($query, $dado);
    }

    // Similar a função anterior, mas ela retorna o primeiro registro que satisfaz a claúsula 'where', não todos os registros

    public function first ($dado, $nao_dado = []) {
        $chaves = array_keys($dado);
        $nao_chaves = array_keys($nao_dado);
        $query = "SELECT * FROM $this->tabela WHERE ";

        foreach ($chaves as $chave) {
            $query .= $chave . ' = :' . $chave . " && ";
        }
        foreach ($nao_chaves as $chave) {
            $query .= $chave . ' != :' . $chave . " && ";
        }

        $query = trim($query, " && ");

        $query .= " limit $this->limite offset $this->offset";

        $dado = array_merge($dado, $nao_dado);

        $resultado = $this->query($query, $dado);

        if ( $resultado ) 
            return $resultado[0];

        return false;
    }

    // Função para inserir algum dado em alguma tabela
    public function insert($dado) {
        // Removendo dados que não fazem parte das informações que sõ necessárias
        if( !empty( $this->colunasPermitidas ) ) {

            foreach( $dado as $chave => $valor ) {
                if( !in_array($chave, $this->colunasPermitidas) ){
                    unset($dado[$chave]);
                }
            }

        }

        $chaves = array_keys($dado);

        $query = "INSERT INTO $this->tabela (". implode(', ', $chaves) . ") VALUES (:". implode(', :', $chaves) . ")";
        
        $this->query($query, $dado);

        return false;
    }

    // 
    public function update($id, $dado, $nomeIdCol = 'id') {
        // Removendo dados que não fazem parte das informações que sõ necessárias
        if( !empty( $this->colunasPermitidas ) ) {

            foreach( $dado as $chave => $valor ) {
                if( !in_array($chave, $this->colunasPermitidas) ){
                    unset($dado[$chave]);
                }
            }

        }

        $chaves = array_keys($dado);
        $query = "UPDATE $this->tabela SET ";
        
        foreach ($chaves as $chave) {
            $query .= $chave . ' = :' . $chave . ", ";
        }
        
        $query = trim($query, ", ");
        
        $query .= " WHERE $nomeIdCol = :$nomeIdCol";
        
        $dado[$nomeIdCol] = $id;

        $this->query($query, $dado);

        return false;
    }

    public function delete($id, $nomeIdCol = 'id') {

        $dado = [
            $nomeIdCol => $id
        ];

        $query = "DELETE FROM $this->tabela WHERE $nomeIdCol = :$nomeIdCol";

        $this->query($query, $dado);

        return false;
    }
}
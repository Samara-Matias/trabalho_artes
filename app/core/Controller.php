<?php

class Controller {

    // Essa função será responsável por carregar as views para o usuário, dependendo da url
        // Qualquer que seja o nome da View, essa função vai retorná-la, se ela existir, se não a página 404.php é retornada
    public function view ($nomeDaView, $dados = []) {
        if( !empty($dados) ) {
            extract($dados);
        }
        $arquivoView = '../app/views/' . $nomeDaView . '.view.php';
        if ( file_exists($arquivoView) ) {
            require_once $arquivoView;
        }
        else {
            $arquivoView = '../app/views/404.view.php';
            require_once $arquivoView;
        }
    }
}
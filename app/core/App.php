<?php
class App {

    private $controllerPadrao = 'Home'; // Declarando uma variável com um Controller padrão p/ uso
    private $metodoPadrao = 'index'; // Declarando uma variável com um método padrão de algum controller

    // Essa função irá retornar o valor do que foi digitado pelo usuário na URL
    // Poderá ser retornado um direcionamento para uma página simples
    // Poderá ser retornado um array contendo mais de um diretório para a página
    private function separarURL() {
        // Pega a url -> caso não exista, colocamos um valor padrão (página padrão);
        $URL = $_GET['url'] ?? 'home';
        $URL = explode('/', trim($URL, '/'));
        return $URL;
    }
    
    // Função para carregar uma página
    public function carregarController() {
        $URL = $this->separarURL();
        
        // Tentar encontrar o controller referente à URL digitada e tratada pela função separarURL
        // Coloca-se a primeira letra da URL retornada como maiúscula por conta do nome do controller
        $arquivoController = '../app/controllers/' . ucfirst($URL[0]) . 'Controller.php';
        if ( file_exists($arquivoController) ) {
            require_once $arquivoController;
            $this->controllerPadrao = ucfirst($URL[0]);
            // Removendo esse dado do array
            unset($URL[0]);
        }
        else {
            $arquivoController = '../app/controllers/_404Controller.php';
            require_once $arquivoController;
            $this->controllerPadrao = '_404';
        }
        
        $controller = new $this->controllerPadrao;
        
        // Verificando se determinado método existe em determinada classe para ser utilizado
        if( !empty($URL[1]) ) {
            if ( method_exists($controller, $URL[1]) ) {
                $this->metodoPadrao = $URL[1];
                // Removendo esse dado do array
                unset($URL[1]);
            }
        }
        
        Helper::exibirDados( $URL );
        call_user_func_array([$controller, $this->metodoPadrao], $URL);
    }
}
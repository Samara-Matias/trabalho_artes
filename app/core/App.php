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
        $URL = explode('/', $URL);

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
        }
        else {
            $arquivoController = '../app/controllers/_404Controller.php';
            require_once $arquivoController;
            $this->controllerPadrao = '_404';
        }

        $controller = new $this->controllerPadrao;
        call_user_func_array([$controller, $this->metodoPadrao], []);
    }
}
<?php
class App {
    // Essa função irá retornar o valor do que foi digitado pelo usuário na URL
    // Poderá ser retornado um direcionamento para uma página simples
    // Poderá ser retornado um array contendo mais de um diretório para a página
    private function separarURL() {
        // Pega a url -> caso não exista, colocamos um valor padrão (página padrão);
        $URL = $_GET['url'] ?? 'home';
        $URL = explode('/', $URL);
        var_dump($_GET['url']);
        return $URL;
    }
    
    // Função para carregar uma página
    public function carregarController() {
        $URL = $this->separarURL();
        
        // Tentar encontrar o controller referente à URL digitada e tratada pela função separarURL
        // Coloca-se a primeira letra da URL retornada como maiúscula por conta do nome do controller
        $arquivoController = '../app/controllers/' . ucfirst($URL[0]) . 'Controller.php';
        if ( file_exists($arquivoController) ) {
            require $arquivoController;
        }
        else {
            $arquivoController = '../app/controllers/_404Controller.php';
            require $arquivoController;
        }
    }
}
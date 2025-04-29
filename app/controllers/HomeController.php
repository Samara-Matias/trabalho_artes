<?php

// Essa classe extende a classe Controller e poderá usar os métodos da classe Controller (herança)
class Home extends Controller {
    public function index () {
        $modelBase = new Model;
        $arr = [
            // 'userId' => 1,
            'nomeUsuario' => 'Fulano',
            'email' => 'fulano@fulano.com',
        ];
        $modelBase->update(2, $arr, 'userId');

        // Utilizando método proveniente da classe  pai Controller
        $this->view('home');
    }
}
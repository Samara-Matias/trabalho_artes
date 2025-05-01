<?php

// Essa classe extende a classe Controller e poderá usar os métodos da classe Controller (herança)
class Home extends Controller {
    public function index () {
        // Utilizando método proveniente da classe  pai Controller
        $this->view('home');
    }
}
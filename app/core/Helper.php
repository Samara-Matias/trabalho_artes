<?php

class Helper {
    public static function exibirDados ($dados) {
        echo '<pre>';
                var_dump($dados);
        echo '</pre>';
    }

    public static function redirecionar($caminho) {
        header('Location: ' . BASE_URL . '/' . $caminho);
        die();
    }

    public static function iniciarSessao() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}
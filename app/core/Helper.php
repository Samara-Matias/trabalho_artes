<?php

class Helper {
    public static function exibirDados ($dados) {
        echo '<pre>';
                var_dump($dados);
        echo '</pre>';
    }

    public static function redirecionar($arquivo){
        header("Location: " . ROOT . "/" .$arquivo);
        die;
    }
}
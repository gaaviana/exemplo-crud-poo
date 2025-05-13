<?php 
namespace ExemploCrud\helpers;

use Throwable;

final class Utils {
    // usando o construtor privado e vazio bloqueamos a criação de objetos/instancias
    private function __construct() { }

    public static function dump(mixed $dados):void {
        echo "<pre>";
        echo var_dump($dados);
        echo "</pre>";
    }
}
?>
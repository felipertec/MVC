<?php

namespace App\Utils;

class View {

    private static $vars = [];

    /**
     * Método responsavel por definir os dados inicias das classes
     * @param array $vars
     */
    public static function init($vars = []){
        self::$vars = $vars;
    }

    private static function getContent($view){
        $file = __DIR__ . '/../../resources/view/'.$view.'.html';
        return file_exists($file) ? file_get_contents($file) : '';
    }


    public static function render($view, $vars = []){
        $contentView = self::getContent($view);

        //Merge de Variaveis da view
        $vars = array_merge(self::$vars,$vars);

        //chaves do array de variaveis
        $keys = array_keys($vars);
        $keys = array_map(function($item){
            return '{{'.$item.'}}';
        },$keys);
        
        return str_replace($keys, array_values($vars), $contentView); 
    }

}
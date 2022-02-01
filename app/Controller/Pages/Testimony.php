<?php

namespace App\Controller\Pages;

use App\Utils\View;


class Testimony extends Page{

    /**
     * Método que retorna o conteudo da view de depoimentos
     * @return string
     */
    public static function getTestimonies(){

        //view de depoimentos
        $content = View::render('pages/testimonies', [
            
        ]);
        return parent::getPage('Depoimentos > FRtec', $content);
    }

}
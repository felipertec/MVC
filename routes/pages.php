<?php


use App\Http\Response;
use App\Controller\Pages;

//Rota Home
$obRouter->get('/',[
    function(){
        return new Response(200,Pages\Home::getHome());
    }
]);

//Rota Sobre
$obRouter->get('/sobre',[
    function(){
        return new Response(200,Pages\About::getAbout());
    }
]);

//Rota Depoimentos
$obRouter->get('/depoimentos',[
    function(){
        return new Response(200,Pages\Testimony::getTestimonies());
    }
]);

//Rota Depoimento (INSERT)
$obRouter->post('/depoimentos',[
    function($request){

        echo "<pre>";
        print_r($request);
        echo "<pre>"; exit;

        return new Response(200,Pages\Testimony::getTestimonies());
    }
]);

//Rota Dinamica
/*$obRouter->get('/pagina/{idPagina}/{acao}',[
    function($idPagina,$acao){
        return new Response(200,'Pagina '. $idPagina.' - '.$acao);
    }
]);*/
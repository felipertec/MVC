<?php

require __DIR__ . "/vendor/autoload.php";

use App\Http\Router;
use App\Utils\View;

define('URL','http://localhost/mvc');

//Define o valor padrão das variaveis 
View::init([
    'URL' => URL
]);


//inicia o router
$obRouter = new Router(URL);

//incluir as rotas de paginas
include __DIR__ .'/routes/pages.php';

//imrpime o Response
$obRouter->run()
            ->sendResponse();
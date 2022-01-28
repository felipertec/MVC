<?php

require __DIR__ . "/vendor/autoload.php";

use App\Http\Router;
use App\Http\Response;
use App\Controller\Pages\Home;

define('URL','http://localhost/mvc');

$obRouter = new Router(URL);

//Rota Home
$obRouter->get('/',[
    function(){
        return new Response(200,Home::getHome());
    }
]);

//imrpime o Response
$obRouter->run()
            ->sendResponse();
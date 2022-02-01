<?php

require __DIR__.'/includes/app.php';

use App\Http\Router;

//inicia o router
$obRouter = new Router(URL);

//incluir as rotas de paginas
include __DIR__ .'/routes/pages.php';

//imrpime o Response
$obRouter->run()
            ->sendResponse();
<?php

require __DIR__ . "/../vendor/autoload.php";


use App\Utils\View;
use \WilliamCosta\DotEnv\Environment;

//Carrega as variaveis de Ambiente
Environment::load(__DIR__.'/../');

//Define a constant da URL
define('URL',getenv('URL'));

//Define o valor padrão das variaveis 
View::init([
    'URL' => URL
]);
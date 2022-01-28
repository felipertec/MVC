<?php

namespace App\Http;

use \Closure;
use \Exception;

class Router{

    
    private $url = '';

    private $prefix = '';

    private $routes = [];

    private $request;


    public function __construct($url){
        $this->request = new Request();
        $this->url = $url;
        $this->setPrefix();
    }

    private function setPrefix(){
        $parseUrl = parse_url($this->url);

        $this->prefix = $parseUrl['path'] ?? '';
    }

    private function addRoute($method, $route, $params = []){
        //Validação dos parametros
        foreach ($params as $key => $value) {
            if ($value instanceof Closure) {
                $params['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        //Padrão de validação da URL
        $pattenRoute = '/^'.str_replace('/','\/',$route).'$/';
       
        //Add a rota na classe
        $this->routes[$pattenRoute][$method] = $params;
    }

    /**
     * método que define uma rota GET
     * @param String $route
     * @param array $params
     */
    public function get($route, $params = []){
        return $this->addRoute('GET',$route,$params);
    }

    /**
     * método que define uma rota POST
     * @param String $route
     * @param array $params
     */
    public function post($route, $params = []){
        return $this->addRoute('POST',$route,$params);
    }

    /**
     * método que define uma rota PUT
     * @param String $route
     * @param array $params
     */
    public function put($route, $params = []){
        return $this->addRoute('PUT',$route,$params);
    }

    /**
     * método que define uma rota DELETE
     * @param String $route
     * @param array $params
     */
    public function delete($route, $params = []){
        return $this->addRoute('DELETE',$route,$params);
    }

    /**
     * Método responsavel por retornar a URI desconsiderando o prefixo
     * #return String
     */
    private function getUri(){
        //URI da Request
        $uri = $this->request->getUri();
        
        //Fatia a uri com prefixo
        $xUri = strlen($this->prefix) ? explode($this->prefix,$uri) : [$uri];

        return end($xUri);
    }

    /**
     * Método que retorna a rota  atual
     * @return array
     */
    private function getRoute(){
        //Uri
        $uri = $this->getUri();
        
        //Method
        $httpMethod = $this->request->getHttpMethod();
        
        //Valida as URLS
        foreach ($this->routes as $pattenRoute => $methods) {
            //Verifica se a Uri Bate coma  padrão
            if(preg_match($pattenRoute, $uri)){
                //Verifica methodo
                if($methods[$httpMethod]){
                    //Retorno dos paramentros da rota
                    return $methods[$httpMethod];
                }
                //Método não permitido
                throw new Exception("Método não permitido", 405);
            }
        }
        //URL nao encontrada
        throw new Exception("Url não encontrada", 404);
    }

    /**
     * Método responsael por executar a rota
     * @return Response
     */
    public function run(){
        try {
            
            $route = $this->getRoute();
            //Verifica o Controllador
            if(!isset($route['controller'])){
                throw new Exception('Url não pode ser Processada', 500);
            }

            $args = [];

            //retorna a execução da função
            return call_user_func_array($route['controller'], $args);

        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }




}
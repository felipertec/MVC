<?php

namespace App\Http;

class Response{

    private $httpCode = 200;

    private $headers = [];

    private $contentType = 'text/html';

    private $content;

    public function __construct($httpCode, $content, $contentType = 'text/html'){
        $this->httpCode = $httpCode;
        $this->content  = $content;
        $this->setContentType($contentType);
    }

    /**
     * Método que altera o content type do response
     * @param String $contentType
     */
    public function setContentType($contentType){
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    /**
     * Método responsavel por add um registor no cabeçalho de response.
     * @param String $key
     * @param String $value
     */
    public function addHeader($key, $value){
        $this->headers[$key] = $value; 
    }

    /**
     * Método que envia os headers par ao navegador
     */
    private function sendHeaders(){
        http_response_code($this->httpCode);

        foreach($this->headers as $key=>$value){
            header($key.':'.$value);
        }
    } 

    /**
     * Método por enviar a resposta para o usuario
     */
    public function sendResponse(){
        $this->sendHeaders();
        
        switch ($this->contentType) {
            case 'text/html':
                Echo $this->content;
                exit;
        }
    }

}
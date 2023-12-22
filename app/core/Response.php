<?php

namespace app\core;

class Response{
    public function setResponseHeader($code, $title){
        header("HTTP/1.0 $code $title");
        $html = <<<HTML
            <h1>404 Not found</h1>
            <p>O recurso que você tentou acessar não existe.</p>
        HTML;
        echo $html;
        exit();
    }
}
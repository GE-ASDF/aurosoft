<?php

namespace app\core;

class Response{
    public function setResponseHeader($code, $title, $message = ''){
        header("HTTP/1.0 $code $title");
        $title = $title ? $code . " " . $title:'404 Not found';
        $message = $message ? $message:"O recurso que você tentou acessar não existe.";
        $html = <<<HTML
            <h1>$title</h1>
            <p>$message</p>
        HTML;
        echo $html;
        exit();
    }
}
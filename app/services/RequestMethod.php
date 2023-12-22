<?php

namespace app\services;
use app\core\Response;

class RequestMethod{

    
    private $post = [];

    private $session = [];

    private $server = [];

    public function __construct(&$post = null, &$session = null, &$server = null)
    {

        if (! \is_null($post)) {
            $this->post = & $post;
        } else {
            $this->post = & $_POST;
        }

        if (! \is_null($server)) {
            $this->server = & $server;
        } else {
            $this->server = & $_SERVER;
        }

        if (! \is_null($session)) {
            $this->session = & $session;
        } elseif (! \is_null($_SESSION) && isset($_SESSION)) {
            $this->session = & $_SESSION;
        } else {
            throw new \Error('No session available for persistence');
        }
    }

    public function check($method = 'POST'){
        if($this->server['REQUEST_METHOD'] != $method){
            $response = new Response;
            $response->setResponseHeader(405, 'Request method not allowed', 'Request method not allowed');
        }
    }

}
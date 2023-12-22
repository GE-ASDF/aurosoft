<?php
namespace app\classes;

class Curl{

    protected $curl;

    public function __construct(string $method = 'POST')
    {
        $this->curl = curl_init();
        curl_setopt_array($this->curl, array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        ));
    }
    
}
<?php

function redirectToLogin($to = ''){
    $url = $to ? $to:"";
    if($url){
        header("Location:" . URL_BASE . $to . "/login");
    }
    header("Location:" . URL_BASE . "login");
}

function hexParaRgb($hex) {
    // Remove qualquer caractere não válido do valor hexadecimal
    $hex = preg_replace('/[^a-fA-F0-9]/', '', $hex);

    // Se o comprimento do valor hexadecimal é diferente de 6 ou 3, não é válido
    if (strlen($hex) != 6 && strlen($hex) != 3) {
        return false;
    }

    // Adiciona zeros à esquerda, se o comprimento for 3
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
    }

    // Converte o valor hexadecimal para decimal
    $rgbArray = array(
        'r' => hexdec(substr($hex, 0, 2)),
        'g' => hexdec(substr($hex, 2, 2)),
        'b' => hexdec(substr($hex, 4, 2))
    );

    return $rgbArray;
}

function setFlash($key, $message, $alert = "danger"){
    if(!isset($_SESSION["message"][$key])){
        $_SESSION["message"][$key] = [
            "message" => $message,
            "alert" => $alert
        ];
    }
}

function getFlash($key){
    if(isset($_SESSION["message"][$key])){
        $flash = $_SESSION["message"][$key];
        unset($_SESSION["message"][$key]);
        return "
        <span class='alert alert-{$flash['alert']} d-flex justify-content-between align-items-center'>
            {$flash['message']}
            <span class='btn mx-1 btn-close'></span>
        </span>
       ";
    }
}

function setOld($key, $value){
    if(!isset($_SESSION["old"][$key])){
        $_SESSION["old"][$key] = $value;
    }
}

function getOld($key){
    if(isset($_SESSION["old"][$key])){
        $flash = $_SESSION["old"][$key];
        unset($_SESSION["old"][$key]);
        return $flash;
    }
}

function encryptId($id){
    return base64_encode(openssl_encrypt($id, 'aes-256-cbc', SECRET_KEY, 0, SECRET_KEY));
}

function decryptId($id){
    return openssl_decrypt(base64_decode($id), 'aes-256-cbc', SECRET_KEY, 0, SECRET_KEY);
}

function backToPage($to){
    header("location: " . URL_BASE . $to);
    exit;
}

function convertDate($date, $format='d/m/Y'){
    return date($format, strtotime($date));
}

function converCurrency($number, string $currency = 'R$',int $qtdDecimais = 2,string $sepDecimais = ',', string $sepThousands = '.'){
    return $currency . " " .number_format($number, intval($qtdDecimais),$sepDecimais, $sepThousands);
}

/**
 * Converte um número para um formato escolhido
 * @param int|float $number - O número no formato float ou inteiro a ser convertido.
 * @param int $qtdDecimais -  O número de casas decimais.
 * @param string $sepDecimais - O separador dos decimais, por padrão será '.' (ponto).
 * @param string $sepThousands - O separador dos milhares, por padrão será '' (vazio).
 * @return float - retorna um número float
 */
function formatNumber(int|float $number, int $qtdDecimais = 2,string $sepDecimais = '.', string $sepThousands = ''){
    if(is_int($qtdDecimais)){
        return number_format($number, intval($qtdDecimais),$sepDecimais, $sepThousands);
    }
    return false;
}

function convertPhone($phone, $formato = '(%codigo%) %parte2%-%parte3%'){
    $phone = preg_replace('/\D/', '', $phone);
    if(strlen($phone) === 10){
        $parte1 = substr($phone, 0, 2);
        $parte2 = substr($phone, 2, 4);
        $parte3 = substr($phone, 6, 4);
        $telefoneFormatado = str_replace(['%codigo%', '%parte2%', '%parte3%'],[$parte1, $parte2, $parte3], $formato);
        return $telefoneFormatado;
    }else if(strlen($phone) === 11){
        $parte1 = substr($phone, 0, 2);
        $parte2 = substr($phone, 2, 5);
        $parte3 = substr($phone, 7, 4);
        $telefoneFormatado = str_replace(['%codigo%', '%parte2%', '%parte3%'],[$parte1, $parte2, $parte3], $formato);
        return $telefoneFormatado;
    }
}

/**
 * Função que retorna a diferença de dias entre duas datas
 * @param string $date1 - a data 1
 * @param string $date2 - a data 2
 * @return int
 */
function daysBetweenDates($date1, $date2){
    $date1New = new DateTime($date1);
    $date2New = new DateTime($date2);
    return $date1New->diff($date2New)->days;
}

/**
 * Função que retorna para a rota anterior a requisitada
 * @param string $option - algum caminho de id html, ex.: #pills-profile, #main-content
 * @return void
 */
function goBack(string $option = ''){
    header("location:" . $_SERVER['HTTP_REFERER'] . $option);
    die;
}

function deepPoint(string $stringWithPoint){
    return implode("/", explode(".", $stringWithPoint));
}

/**
 * Função que aponta para a pasta assets e carrega os arquivos necessários informados pelo usuário
 * @param string $file - caminho até o arquivo
 * @return string
 */
function asset($file){
    return URL_BASE . 'assets/' . $file;
}

function component($component, $props = []){
    extract($props);
    if(str_contains($component, ".")){
        $component = deepPoint($component);
        require PATH_COMPONENTS . $component . ".php";
    }else{
        require PATH_COMPONENTS . $component . ".php";
    }
}

/**
 * Função que aponta para uma rota especificada pelo usuário
 * @param string $route - caminho até a rota, ex.: 'admin.alunos', 'admin/alunos'
 * @return string
 */
use app\core\Route;

function convertToRegex($route)
{
    // Remove todas as partes no formato {id} da rota
    preg_match_all('/\{([^\}]+)??\}/',$route, $matches);

    // Adiciona delimitadores de expressão regular
    // $pattern = '/^' . preg_quote($pattern, '/') . '$/';

    return $matches[1];
}


function extendss(string $pathFile, array $params = []){
    extract($params);
    if(str_contains($pathFile, ".")){
        $pathFile = deepPoint($pathFile);
        include PATH_LAYOUTS . $pathFile . ".php";
    }else{
        include PATH_LAYOUTS . $pathFile . ".php";
    }
}

function route($route){
    if(str_contains($route, ".")){
        $route = str_replace(".", "/", $route);
    }
    return URL_BASE . $route;
}

function dd($data){
    $html = <<<HTML
    <!DOCTYPE html>
    <html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/default.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/languages/go.min.js"></script>
    </head>
    <body>
    HTML;
    $html.= "<div class='view-container'>";
    $html.="<div class='code-block'>";
    $html.= "<pre> <code class='language-php'>";
    $html.= htmlspecialchars(var_export($data, true));
    $html.= "</code>";
    $html.= "</pre>";
    $html.="</div>";
    $html.= "</div>";
    $html.= <<<HTML

    <script>
        document.addEventListener("DOMContentLoaded", (e)=>{
            document.querySelectorAll("pre code").forEach( block =>{
                hljs.highlightElement(block);
            })
        })
    </script>
    </body>
    </html>
    HTML;
    echo $html;
    die;
}
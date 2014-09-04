<?php
require_once("../vendor/autoload.php");

if(!isset($argv[2]))
    die('usage: php exec.php x_your_api_key_x "こんにちは" '.PHP_EOL);
$api_key = $argv[1];
$text = $argv[2];
echo "request {$text}".PHP_EOL;

use \Uzulla\WebApi\VoiceText\Request as VTR;
use \Uzulla\WebApi\VoiceText\Query as VTQ;

// setup
\Uzulla\WebApi\VoiceText\Query::$defaultApiKey = $api_key;

// build query
$query = new VTQ;
$query->text = $text;
$query->speaker = 'santa';

// request
$res = VTR::getResponse($query);

if($res->isSuccess()){
    $file_name = __DIR__."/".time().".wav";
    copy($res->tempFileName, $file_name);
    echo "saved wav file to {$file_name}".PHP_EOL;
}else{
    echo "request fail.".PHP_EOL;
    var_dump($res);
}

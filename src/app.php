<?php
require_once 'code.php';
require_once 'url_match.php';
require_once __DIR__ . '/../vendor/autoload.php';

$resty_request = array();
$resty_request['url'] = @$_SERVER['DOCUMENT_URI'];
$resty_request['url_match'] = array();
$resty_request['query'] = $_GET;
$resty_request['query_str'] = '?'.@$_SERVER['QUERY_STRING'];
$resty_request['charset'] = @$_SERVER['HTTP_ACCEPT_CHARSET'];
$resty_request['body'] = json_encode(@file_get_contents('php://input'),true);
$resty_request['method'] = $_SERVER['REQUEST_METHOD'];
$resty_request['headers'] = getallheaders();
$resty_request['hostname'] = @$_SERVER['REMOTE_HOST'];
$resty_request['ip'] = $_SERVER['REMOTE_ADDR'];
$resty_request['port'] = $_SERVER['REMOTE_PORT'];

$resty_response = array();
$resty_response['body'] = array();
$resty_response['headers'] = array();

$path = _pr_find_path($resty_request['url'],$resty_request['method'],$resty_request['url_match']);
if($path){
	include_once($path);
}else{
	pr_code(404);
}

if(isset($resty_response['status'])){
	if(is_int($resty_response['status'])){
		pr_code($resty_response['status']);
	}
}
if(isset($resty_response['headers'])){
	if(is_array($resty_response['headers']) && !empty($resty_response['body'])){
		foreach($resty_response['headers'] as $k => $v){
			header($k.': '.$v);
		}
	}
}
if(isset($resty_response['redirect'])){
	if(is_string($resty_response['redirect'])){
		header("Location: ".$resty_response['redirect']);
	}
}
if(isset($resty_response['body'])){
	if( is_array($resty_response['body']) &&!empty($resty_response['body'])){
		echo json_encode($resty_response['body']);
	}
}

?>
<?php
require_once('file_utils.php');
function _pr_match_file($path,$name,$method){
	if($filename = _pr_match_strict_file($path,$name,$method)){
		return $filename.'.' . strtolower($method) . '.php';
	}elseif($filename = _pr_match_wildcard_file($path,$method)){
		return $filename;
	}else{
		return false;
	}
}
function _pr_match_dir($path,$name){
	if($filename = _pr_match_strict_dir($path,$name)){
		return $filename;
	}elseif($filename = _pr_match_wildcard_dir($path)){
		return $filename;
	}else{
		return false;
	}
}
?>
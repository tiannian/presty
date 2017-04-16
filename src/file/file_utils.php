<?php
function _pr_match_strict_dir($path,$name){
	$p = $path . '/' . $name;
	if(file_exists($p) && is_dir($p)){
		return $name;
	}else{
		return false;
	}
}

function _pr_match_strict_file($path,$name,$method){
	$p = $path .'/'.$name.'.'.strtolower($method).'.php';
	if(file_exists($p) && is_file($p)){
		return $name;
	}else{
		return false;
	}
}

function _pr_match_wildcard_dir($path){
	$arr = @scandir($path);
	$result = array();
	foreach($arr as $name){
		$p = $path . '/' . $name;
		if(substr($name,0,1) == '_' && is_dir($p)){
			array_push($result,$name);
		}
	}
	if(count($result) == 1){
		return $result[0];
	}elseif(count($result) == 0){
		return false;
	}else{
		die('have too much _file');
	}
}

function _pr_match_wildcard_file($path,$method){
	$arr = @scandir($path);
	$result = array();
	foreach($arr as $name){
		$p = $path.'/'.$name;
		if(substr($name,0,1) == '_' && is_file($p) && strstr($name,strtolower($method))){
			array_push($result,$name);
		}
	}
	if(count($result) == 1){
		return $result[0];
	}elseif(count($result) == 0){
		return false;
	}else{
		die('have too much _file');
	}
}
?>
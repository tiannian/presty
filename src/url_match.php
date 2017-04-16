<?php

require_once('file/file.php');


function _pr_find_path($path,$method,&$urlargs){
	$path_array = explode('/',$path);
	$end = count($path_array)-1;
	$urlpointer = '.';
	foreach($path_array as $k => $v){
		if($v !== ''){
			if($k == $end){
				if($filename = _pr_match_file($urlpointer,$v,$method)){
					if(substr($filename,0,1) == '_'){
						$file_name_arr = explode('.',$filename);
						$urlargs[$file_name_arr[0]] = $v;
					}
					return $urlpointer . '/' . $filename;
				}else{
					return false;
				}
			}else{
				if($filename = _pr_match_dir($urlpointer,$v)){
					$urlpointer .= '/' . $filename;
					if(substr($filename,0,1) == '_'){
						$urlargs[$filename] = $v;
					}
				}else{
					return false;
				}
			}
		}
	}
}


?>
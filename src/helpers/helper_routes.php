<?php
use src\Route;
use src\Request;

function request(){
	return new Request;
}


function resolve($request = null){
	if(is_null($request)) {
		$request = request();
	}
	return Route::resolve($request);		
}


function route($name, $params = null){
	return Route::translate($name, $params);
}

function redirect($pattern){
	return resolve($pattern);
}

function back(){
	return header('Location: ' . $_SERVER['HTTP_REFERER']);
}

?>
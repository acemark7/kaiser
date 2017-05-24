<?php
require_once 'init.php';

$controller = $_POST['data']['page'][0];
$method = $_POST['data']['page'][1];
$param = $_POST['data']['param'];

$file = '../app/controllers/'.$controller.'.php';

if(file_exists($file)){
	require_once $file;
	}
else{
	//require '../app/controllers/error.php';
	//$app = new error();
	require '../app/views/error/index.php';
	return false;
	}

$app = new $controller; // Instantiate controller
$app->loadModel($controller); // Load Model

if(isset($method)){
	if(method_exists($app, $method)){ // Check if method exists
		// Call the method inside the controller	
		if(isset($param)){
			$app->{$method}($param);	
		}
		else{
			$app->{$method}();	
		}
	}
}

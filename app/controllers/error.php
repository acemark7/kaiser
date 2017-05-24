<?php
class error extends Controller{
	
	function __construct(){
		parent:: __construct(); // Construct the parent controlller
		echo 'This is an error!';
		
		$this->view->render('error/index');
	}
	
}
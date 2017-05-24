<?php

class view{
	function __construct(){
		//echo 'This is the view<br>';
	}
	
	public function render($name){
		require '../app/views/'.$name.'.php';
	}
	
}
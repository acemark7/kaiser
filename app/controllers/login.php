<?php
class login extends Controller{
	
	function __construct(){
		parent:: __construct(); // Construct the parent controlller
		//echo 'We are in Login!';
		
	}
	
	public function index($param = array()){
		$this->view->param = $param;
		$this->view->render('login/index');
	}
	
	public function logmein($param = array())
	{
		$this->model->logmein($param);
	}
	public function logmeout()
	{
		$this->model->logmeout();
	}
	
}
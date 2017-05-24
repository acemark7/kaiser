<?php
class users extends Controller{
	
	function __construct(){
		parent:: __construct(); // Construct the parent controlller	
		
	}
	
	public function index($param = array()){

		$user = $this->model->get_users($param);
		
		$this->view->user = $user;
		
		$this->view->render('users/index');
	}
	
	public function user_save($param = array()){
		$result = $this->model->user_save($param);
		$sth = 'Something went wrong. Please try again.';
		
		if($result == 1){
			$sth = 'User has been saved successfully.';
			}
		
		$cb_param = array(
			"id" => $param["id"],
			"fname" => $param["fname"],
			"lname" => $param["lname"],
			"uname" => $param["uname"],
			"pass" => $param["pass"],
			"type" => $param["type"],
			"result" => $result,
			"message" =>  $sth);
		
		$action = 'user.save_userCb';
		
		echo json_encode(array('exec_function' => $action, 'cb_param' => $cb_param));
	
	}	
	public function fetchall_users($param = array()){
		$result = $this->model->fetchall_users($param);
		echo $result;
	}

	public function user_del($param = array()){
		$result = $this->model->user_del($param);
		echo $result;
	}
	public function user_add_save($param = array()){
		$result = $this->model->user_add_save($param);
		$sth = 'Something went wrong. Please try again.';
		
		if($result == 1){
			$sth = 'User has been saved successfully.';
			}
		
		$cb_param = array(
			"fname" => $param["fname"],
			"lname" => $param["lname"],
			"uname" => $param["uname"],
			"pass" => $param["pass"],
			"type" => $param["type"],
			"result" => $result,
			"message" =>  $sth);
		
		$action = 'user.save_adduserCb';
		
		echo json_encode(array('exec_function' => $action, 'cb_param' => $cb_param));

	}	
	

}
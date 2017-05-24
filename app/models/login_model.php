<?php
class login_model extends Model{
	public function __construct(){
		parent::__construct();	
		Session::init();
		//echo '<br>Login Model<br>';
	}
	
	public function logmein($param)
	{
		unset($param['default']);
		
		$pass = 0;
		$message = 'Please enter username and password';
		
		if(count($param) > 0){
			$db = $this->db->prepare("SELECT uid FROM users WHERE username = :username AND password = :password");
					
			$db->execute(array(
				':username' => $param['username'],
				':password' => $param['password']
			));
			
			$data = $db->fetch();
			
			$count =  $db->rowCount();
			
			//print_r($data);
			
			if ($count > 0) {
				$pass = 1;
				$message = 'Login success!';
				Session::set('user_id', $data['uid']);
				//header('location: ../dashboard');
			} else {
				//header('location: ../login');
				$message = 'Login failed! Invalid username or password';
				
			}
		}

		
		//echo $message;
		//echo Session::get('user_id');
		//print_r($_SESSION);
		
		$data = array('result' => $pass, 'message' => $message);
		
		echo json_encode($data);
		
	}
	
	public function logmeout()
	{
		Session::destroy();	
	}
	
}
<?php
class home extends Controller{
	
	function __construct(){
		parent:: __construct(); // Construct the parent controlller
		
		/*
		Session::init();
		$logged = Session::get('user_id');
		if ($logged == false) {
			Session::destroy();
			
			echo 'no session';
			//header('location: ../login');
			exit;
		}
		*/
		//echo 'We are in Home!';
	}
	
	public function index($param = array()){
		
		$room_content = $this->model->room_content($param);
		
		$this->view->room_content = $room_content;
		
		$this->view->render('home/index');
	}
	
	public function search_patient($param = array()){
		$result = $this->model->search_patient($param);
		
		$patients = '';
		
		foreach($result as $patient){
			$patients .= '<li class="p-all-5 b-t-gray pointer">'.$patient['fullname'].'</li>';
			}
		
		$patients = ($patients == '' ? 'No results found' : $patients);
		
		
		$cb_param = array(
			"patients" => $patients,
			"count" => count($result));
		
		$action = 'home.search_patientCb';
		
		echo json_encode(array('exec_function' => $action, 'cb_param' => $cb_param));
		}
	
	public function room_content($param = array()){
		$result = $this->model->room_content($param);

		echo $result;
		}
}
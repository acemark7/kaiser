<?php
class room extends Controller{
	
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
		$room = array();
		$room = $this->model->get_rooms($param);
		
		$this->view->rooms = $room;
		
		$this->view->render('room/index');
	}
	
	public function room_save($param = array()){
		$result = $this->model->room_save($param);
		
		$sth = 'Something went wrong. Please try again.';
		
		if($result == 1){
			$sth = 'Room has been saved successfully.';
			}
		
		$cb_param = array(
			"id" => $param["id"],
			"name" => $param["name"],
			"result" => $result,
			"message" =>  $sth);
		
		$action = 'room.save_roomCb';
		
		echo json_encode(array('exec_function' => $action, 'cb_param' => $cb_param));
	}	
	public function room_del($param = array()){
		$result = $this->model->room_del($param);
		
		
		$sth = 'Something went wrong. Please try again.';
		
		if($result == 1){
			$sth = 'Room has been deleted successfully.';
			}
		
		$cb_param = array(
			"id" => $param["id"],
			"result" => $result,
			"message" =>  $sth);
		
		$action = 'room.delete_roomCb';
		
		echo json_encode(array('exec_function' => $action, 'cb_param' => $cb_param));
	}
	
	public function fetchall_rooms($param = array()){
		$result = array();
		$result = $this->model->fetchall_rooms($param);
		$this->view->rooms = $result;
		$this->view->render('room/index');
	}
	/*
	public function search_patient($param = array()){
		$result = $this->model->search_patient($param);
		
		$patients = '';
		
		foreach($result as $patient){
			$patients .= '<li class="p-all-5 b-t-gray pointer">'.$patient['fullname'].'</li>';
			}
		
		$patients = ($patients == '' ? 'No results found' : $patients);
		
		echo $patients;
		}
	
	public function room_content($param = array()){
		$result = $this->model->room_content($param);

		echo $result;
		}
	*/
}
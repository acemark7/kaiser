<?php
class dashboard extends Controller{
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
		//echo 'We are in Dashboard!';
	}
	
	public function index($param = array()){
		
		$this->view->param = $param;
		
		$count = $this->model->status_count();

		$this->view->counter = $count;
		
		$rooms = $this->room_display();
		
		$this->view->rooms = $rooms;
		
		$this->view->render('dashboard/index');
	}
	
	public function room_display(){
		$rooms = $this->model->room_display();
		
		return $rooms;
		}
}
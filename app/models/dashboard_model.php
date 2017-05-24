<?php
class dashboard_model extends Model{
	public function __construct(){
		parent::__construct();
		
	}
	
	public function status_count(){
		$db = $this->db->prepare("SELECT status, count(*) total FROM `tbl_room` GROUP BY status");
		$db->execute();

		$count =  $db->rowCount();
		
		$count = $db->fetchAll();
		
		$counter = array('ready' => 0, 'waiting' => 0, 'ongoing' => 0, 'toclean' => 0, 'maintenance' => 0, 'video' => 0);
		
		foreach($count as $ctr){
			$counter[$ctr['status']] = $ctr['total'];
			}
		
		return $counter;
		}
	
	public function room_display(){
		$db = $this->db->prepare("SELECT id,name,status FROM tbl_room");
		$db->execute();

		$count =  $db->rowCount();
		
		$rooms = $db->fetchAll();
		
		/** home_model **/
		$path = $_SERVER['DOCUMENT_ROOT'].'/'.folder.'app/models/home_model.php';
		
		if(file_exists($path)){
			require $path;

			$home = new home_model();
			
			}
		/** home_model end **/
		
		$data = array();
		
		foreach($rooms as $key => $room){
			$data[$key]['id'] = $room['id']; 
			$data[$key]['name'] = $room['name']; 
			$data[$key]['status'] = $room['status']; 
			$patient = $home->patient_in_room($room['id']);
			$resources = $home->resources_in_room($patient['id']);

			$data[$key]['patient'] = $patient;
			$data[$key]['resources'] = $resources;
			}
		
		$hmtl = $this->construct_room_display($data);
		
		return $hmtl;
		}
	
	public function construct_room_display($data){
		$html = '';
		
		foreach($data as $key => $room){
			$patient = $room['patient'];
			$resources = $room['resources'];
			
			$source = '';
			$p_name = '&nbsp;';
			
			$component = $this->component_by_status($room['status']);
			
			if(count($resources) > 0){			
				foreach($resources as $sources){

					$src_type = ($sources['type'] == 's' ? 'Service' : $this->get_source_type($sources['RIR_val']));
						
					$source .= '
						<div class="col-md-12 p-all-0">
							<font class="f-bold">'.strtoupper($src_type).'</font> : <font class="">'.$sources['name'].'</font>
						</div>'; 
					}
				}
			 
			if(count($patient) > 1){
				$p_name = '<div class="col-md-12 p-all-0">
							<font class="f-bold">PATIENT</font> : <font class="">'.$patient['fname'].' '.$patient['lname'].'</font>
						</div>';
				}
			
			$bottom = '';
			
			if(count($patient) > 1){	
				$bottom = '<div class="col-md-12 '.$component['bottom_bg'].' rm-bottom p-t-10 p-b-10 b-t-gray size-11 '.$component['bottom_color'].'">
					<div class="col-md-6 p-all-0 center">
						<font class="f-bold">WAITING TIME</font> : <font class="">06:10:22</font>
					</div>
					<div class="col-md-6 p-all-0 center">
						<font class="f-bold">START TIME</font> : <font class="">07:20:12</font>
					</div>
				</div>';
				}
			
			$rm_resources = '';
			
			$html .= '
				<div class="col-md-5ths p-l-0 m-b-15 room" data-id="'.$room['id'].'">
					<div class="col-md-12 p-all-0 b-all-gray radius-3 rm rm '.$component['border'].'">
						<div class="col-md-12 bg-3 rm-top p-t-10 p-b-10 size-14">
							'.$room['name'].'
							<font class="pull-right '.$component['bg'].' color-1 size-11 rm-mark radius-3">'.$component['name'].'</font>
						</div>
						<div class="col-md-12 rm-mid p-t-10 '.$component['icon'].'">
							'.$p_name.'
							'.$source.'
						</div>
						'.$bottom.'
					</div>
				</div>';
			}
		
		return $html;
		}
	
	public function component_by_status($status){
		$bg = 'bg-3';
		$color = '';
		$name = $status;
		$icon = '';
		$border = '';
		$bottom_bg = 'bg-3';
		$bottom_color = '';
		
		switch($status){
			case 'ready':
				$bg = 'bg-4';
				$color = 'color-2';
				$name = 'Ready';
				$icon = 'hotel';
				$border = 'b-t-green';
			break;
			
			case 'waiting':
				$bg = 'bg-5';
				$color = 'color-3';
				$name = 'Waiting';
				$border = 'b-t-blue2';
			break;
			
			case 'ongoing':
				$bg = 'bg-2';
				$color = 'color-4';
				$name = 'On Going';
				$border = 'b-t-blue3';
			break;
			
			case 'maintenance':
				$bg = 'bg-8';
				$color = 'color-10';
				$name = 'Maintenance';
				$icon = 'cogs';
				$border = 'b-t-gray2';
			break;
			
			case 'toclean':
				$bg = 'bg-9';
				$color = 'color-6';
				$name = 'To be Cleaned';
				$icon = 'hand-paper';
				$border = 'b-t-gray3';
			break;
			
			case 'video':
				$bg = 'bg-10';
				$color = 'color-5';
				$name = 'Video';
				$icon = 'video-camera';
				$border = 'b-t-blue4';
			break;
			
			}
		
		return array('bg' => $bg, 'color' => $color, 'name' => $name, 'icon' => $icon, 'border' => $border, 'bottom_bg' => $bottom_bg, 'bottom_color' => $bottom_color);
		
		}
	
	public function get_source_type($id){
		$type = array();
		$type['type'] = '';
		
		$db = $this->db->prepare("
			SELECT 
				type 
			FROM 
				tbl_resource_type
			WHERE 
				id = :id"
			);
		
		$db->execute(
			array(':id' => $id)
		);
		
		$type = $db->fetch();
		
		
		return $type['type'];
		
	}
}
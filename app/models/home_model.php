<?php
class home_model extends Model{
	public function __construct(){
		parent::__construct();	
		Session::init();
	}
	
	public function room_content($param)
	{
		unset($param['default']);
		$status = '';
		$cond = '';
		
		if(array_key_exists('qry',$param)){
			if($param['qry'] != ''){
				$status = $param['qry'];
				$cond = " WHERE status = '$status'";
				}
			}
		
		$db = $this->db->prepare("SELECT id,name,status FROM tbl_room $cond");
		$db->execute();

		$count =  $db->rowCount();
		
		$rooms = $db->fetchAll();
		
		$data = array();
		
		foreach($rooms as $key => $room){
			$data[$key]['id'] = $room['id']; 
			$data[$key]['name'] = $room['name']; 
			$data[$key]['status'] = $room['status']; 
			$patient = $this->patient_in_room($room['id']);
			$resources = $this->resources_in_room($patient['id']);

			$data[$key]['patient'] = $patient;
			$data[$key]['resources'] = $resources;
			}
		
		$hmtl = $this->construct_room_table($data);
		
		return $hmtl;
	}
	
	public function patient_in_room($rid){
		$patient = array();
		
		$db = $this->db->prepare("
			SELECT 
				P.id, 
				P.fname, 
				P.lname, 
				PR.date_time, 
				PR.status 
			FROM 
				tbl_patient_in_room PR, 
				tbl_patient P
			WHERE 
				PR.room_id = :room_id AND 
				P.id = PR.patient_id AND 
				PR.status = 1"
			);
		
		$db->execute(
			array(':room_id' => $rid)
		);
		
		$patient = $db->fetch();
		
		return $patient;
		}
	
	public function resources_in_room($pid){
		$resources = array();

		$db = $this->db->prepare("
			SELECT RIR.type, RIR.value as RIR_val,
				(CASE RIR.type
					WHEN 
						'r' 
					THEN 
						(
						SELECT 
							CONCAT(R.fname,' ',R.lname) as name 
						FROM 
							tbl_resources R, 
							tbl_resources_in_room RIR 
						WHERE 
							RIR.value = R.id AND 
							RIR.pir_id = :patient_id AND 
							RIR.type = 'r' AND R.id = RIR_val
						)
					ELSE 
						(
						SELECT 
							S.name 
						FROM 
							tbl_services S, 
							tbl_resources_in_room RIR 
						WHERE 
							RIR.value = S.id AND 
							RIR.pir_id = :patient_id AND 
							RIR.type = 's'
						)
				END) AS name
			FROM 
				tbl_resources_in_room RIR
			WHERE 
				RIR.pir_id = :patient_id"
			);
		
		$db->execute(
			array(':patient_id' => $pid)
		);
		
		$resources = $db->fetchAll();
		
		return $resources;
		
		}
		
	
	public function construct_room_table($data){
		$html = '';
					
		foreach($data as $key => $room){
			$patient = $room['patient'];
			$resources = $room['resources'];
						
			$source = '';
						
			foreach($resources as $sources){
				$source .= $sources['name'].'<br>';
				}
			
			$p_name = (count($patient) == 1 ? 'No Patient' : $patient['fname'].' '.$patient['lname']);
			
			
			$component = $this->component_by_status($room['status']);
			
			
			$html .= '
				<tr class="rm-item b-t-gray">
					<td align="center">
						<div class="'.$component['bg'].'">
							<i class="fa fa-hotel color-1 size-28" aria-hidden="true"></i> 
						</div>
					</td>
					<td>
						<p class="m-b-0 size-16 f-bold '.$component['color'].'">'.$room['name'].'</p>
						<p class="m-b-0 size-16 f-bold">'.$p_name.'</p>
						<p class="m-b-0 size-14">'.$component['name'].'</p>
					</td>
					<td>
						'.$source.'
					</td>
				</tr>';
			}
		
		return $html;
		}
	
	public function component_by_status($status){
		$bg = 'bg-3';
		$color = '';
		$name = $status;
		
		switch($status){
			case 'ready':
				$bg = 'bg-4';
				$color = 'color-2';
				$name = 'Room is Ready';
			break;
			
			case 'waiting':
				$bg = 'bg-5';
				$color = 'color-3';
				$name = 'Patient Waiting';
			break;
			
			case 'ongoing':
				$bg = 'bg-2';
				$color = 'color-4';
				$name = 'On Going';
			break;
			
			case 'maintenance':
				$bg = 'bg-8';
				$color = 'color-10';
				$name = 'Room on Maintenance';
			break;
			
			case 'toclean':
				$bg = 'bg-9';
				$color = 'color-6';
				$name = 'Room to be Cleaned';
			break;
			
			case 'video':
				$bg = 'bg-10';
				$color = 'color-5';
				$name = 'Video';
			break;
			
			}
		
		return array('bg' => $bg, 'color' => $color, 'name' => $name);
		}
	
	public function search_patient($param){
		$result = array();
		
		if(array_key_exists('qry',$param)){
			$db = $this->db->prepare("
				SELECT 
					id, 
					CONCAT(fname,' ',lname) as fullname 
				FROM 
					tbl_patient
				WHERE 
					CONCAT(fname,' ',lname) LIKE '%".$param['qry']."%'"
				);
			
			$db->execute();
			
			$result = $db->fetchAll();
		}

		return $result;
		}
	
}
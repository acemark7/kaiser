<?php
class room_model extends Model{
	public function __construct(){
		parent::__construct();	
		Session::init();
	}
	
	public function get_rooms($param)
	{
		//	echo 'We are in room model';

		
		unset($param['default']);
		$query = "SELECT id,name,status FROM tbl_room";
		/*$db = $this->db->prepare("SELECT id,name,status FROM tbl_room");
		$db->execute();

		$count =  $db->rowCount();
		
		$rooms = $db->fetchAll();		
		
		$data = array();
		
		foreach($rooms as $key => $room){
			$data[$key]['id'] = $room['id']; 
			$data[$key]['name'] = $room['name']; 
			$data[$key]['status'] = $room['status']; 
			}
		
		$hmtl = $this->construct_room_table($data); */
		$data = array();
		

		$data['firstload'] = 1;
		$data['page'] = 1;
		$data['query'] = $query;
		$data = $this->pagination($data); 	
		
		return $data;			
	}
	public function room_save($param)
	{
		unset($param['default']);
		$name = $param['name'];
		$id = $param['id'];

		$db = $this->db->prepare("UPDATE tbl_room SET name = :name WHERE id = :id");
		$db->execute(array(':id'=> $id, ':name' => $name));
		//$err = $db->errorCode();
		$err =  $db->rowCount();
		return $err;			
	}
	public function room_del($param)
	{
		unset($param['default']);
		$id = $param['id'];

		$db = $this->db->prepare("DELETE FROM tbl_room WHERE id = :id");
		$db->execute(array(':id'=> $id));
		//$err = $db->errorCode();
		$err =  $db->rowCount();
		return $err;			
	}
	public function fetchall_rooms($param){
		unset($param['default']);
		$page = $param['page'];
		$query = "SELECT id,name,status FROM tbl_room";
		
			$data = array();
			$data['query'] = $query;
			$data['page'] = $page;
		$html = $this->pagination($data);		
		return $html;			
	}
	public function construct_room_table($data){
	
		$html1 = '<tr class="rm-item-room b-b-gray">
					<td colspan="2">
					<p class="m-l-10 f-bold">ROOM NAME</p>
					</td>
				</tr>';	
		$count=0;
		$temp = 0;
		foreach($data as $key => $room){
			if($temp <3){
				$html1 .= '
					<tr class="rm-item-room b-b-gray" id="edit-room-tr'.$room['id'].'">
						<td >						
							<p class="m-b-0 m-l-10 size-13">'.$room['name'].'</p>	
														
						</td>
						<td align="right">
						<i class="fa fa-pencil m-b-0 m-r-20 pointer editbtn-room" data-id="'.$room['id'].'" data-name="'.$room['name'].'" aria-hidden="true" ></i>
						</td>
					</tr>';
				$html2='<tr class="rm-item-room b-b-gray">
					<td colspan="2">
					<p class="m-l-10 f-bold">ROOM NAME</p>
					</td>
				</tr>';
			
			}else{
				$html2 .= '
					<tr class="rm-item-room b-b-gray" id="edit-room-tr'.$room['id'].'">
						<td >						
							<p class="m-b-0 m-l-10 size-13">'.$room['name'].'</p>	
														
						</td>
						<td align="right">
						<i class="fa fa-pencil m-b-0 m-r-20 pointer editbtn-room" data-id="'.$room['id'].'" data-name="'.$room['name'].'" aria-hidden="true" ></i>
						</td>
					</tr>';
					
			}
			$count++;
			$temp++;
			if($temp == 7){ $temp = 0;}	
		}
		$html = array('html1'=>$html1, 'html2'=>$html2, 'counter'=>$count);
		return $html;
	}

	//pagination
	public function pagination($param){
		unset($param['default']);

		if(array_key_exists('firstload',$param)){
			$query = $query = "SELECT id,name,status FROM tbl_room";
		}else{
			$query = $param['query'];
		}
		
		$page = $param['page'];
		if ($page == '' || $page == '1'){
			$page1 = 0;
		}else{
			$page1 =($page*6)-6;
		}
		
		$db = $this->db->prepare("SELECT * FROM tbl_room");
		$db->execute();
		$count =  $db->rowCount();

		/*if(array_key_exists('keyword',$param)){
			$db = $this->db->prepare($query);
			$db->execute();
			$count =  $db->rowCount();
		}else{*/
			
		//}
		
		$db = $this->db->prepare($query." LIMIT $page1,6 ");
		$db->execute();
		
		$rooms = $db->fetchAll();		
		
		$data = array();
		
		foreach($rooms as $key => $room){
			$data[$key]['id'] = $room['id']; 
			$data[$key]['name'] = $room['name'];  
			}
	$page_number = $page;
	$count_data = $count;
	if( $count_data > 0 ){
		$page = (int) $page_number;
		$limit = 6;
		if($page==""){
		    $page =1;
		    $start_limit = 0;
		    $end_limit = $page * $limit;
		}
		else{              
		    $end_limit = $page * $limit; 
		    $start_limit =$end_limit - $limit;
		}

		$array_count_res = (int) $count_data;

		$choice = ceil($array_count_res /$limit);               
		$previous_page = $page-1;
		$next_page = $page+1;
		$first_paging = $page - 2; 
		$second_paging = $page - 1; 
		$third_paging = $page + 1;
		$four_paging = $page + 2;
		$last_page =$choice -$page;
		
		$link ='<td colspan="5" align="right">';
		if($page > 3) {  
		    $link .= '<span class="paginate-room " data-val="1"><i class="fa fa-angle-double-left"></i> First</span>';
		}
		if($page !=1) { 
		    $link .= '<span class="paginate-room " data-val="'.$previous_page.'"><i class="fa fa-fw fa-angle-left"></i> Previous</span>';
		}
		if($first_paging > 0 ) {   
		    $link .= '<span class="paginate-room " data-val="'.$first_paging.'">'.$first_paging.'</span>';   
		}
		if($second_paging > 0 ) {       
		    $link .='<span class="paginate-room " data-val="'.$second_paging.'">'.$second_paging.'</span>';   
		}
		if( $array_count_res > $limit){
			$link .= '<span class="paginate-room page-active" data-val="'.$page.'">'.$page.'</span>';   
		}
		if($third_paging <= $choice ) {           
		    $link .='<span class="paginate-room " data-val="'.$third_paging.'">'.$third_paging.'</span>'; 
		} 
		if($four_paging <= $choice ) {     
		    $link .= '<span class="paginate-room " data-val="'.$four_paging.'">'.$four_paging.'</span>'; 
		}  
		if($page !=$choice) { 
		    $link .= '<span class="paginate-room " data-val="'.$next_page.'"> Next <i class="fa fa-fw fa-angle-right"></i></span>';
		}
		if($last_page > 1) {
		    $link .= '<span class="paginate-room " data-val="'.$choice.'"> Last <i class="fa fa-angle-double-right"></i></span>';
		} 
		$link .='</td>';

		//$page = $page_number;
		$total = $count_data; //total items in array    
		//$limit = 4; //per page    
		$totalPages = ceil( $total/ $limit ); //calculate total pages
		$page = max($page, 1); //get 1 page when $_GET['page'] <= 0
		$page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
		$offset = ($page - 1) * $limit;
		if( $offset < 0 ) $offset = 0;
	}
		/*if(array_key_exists('keyword',$param)){
			$data = $this->construct_user_table_search($data,$param['keyword']);
			$html = $data['html'];
			$count2 = $data['counter'];
		}else{*/
			$data = $this-> construct_room_table($data);
			$html1 = $data['html1'];
			$html2 = $data['html2'];
			$count2 = $data['counter'];
		//}
		$pagination = '';
		if( $count_data > 0 ){
			$upto =  $offset + 1;
			$tothen = $upto + $count2 - 1;
			$pagination = '<tr class="pagination-row"><td>Showing '.$upto.' to '.$tothen.' of '.$count.' rooms. </td>'.$link.'</tr>';
		}	
		if($count_data != 0){
		//$link = $c_text.$link;	
		//$html1 .= $c_text;
		//$html2 .= $link;
		}	
		$html = array('html1'=>$html1, 'html2'=>$html2, 'pagination'=>$pagination);
		return $html;				
	}	
	
}
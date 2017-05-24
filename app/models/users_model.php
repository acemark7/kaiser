<?php
class users_model extends Model{
	public function __construct(){
		parent::__construct();	
		Session::init();
	}
	
	public function get_users($param){
		unset($param['default']);

		$query = "SELECT id,username,password,fname,lname,type FROM tbl_users ORDER BY fname ASC";	
		
		$data = array();

		$data['firstload'] = 1;
		$data['page'] = 1;
		$data['query'] = $query;
		$html = $this->pagination($data); 
		return $html;	
	}
	public function user_save($param){
		unset($param['default']);
		$id = $param['id'];
		$fname = $param['fname'];
		$lname = $param['lname'];
		$uname = $param['uname'];
		$pass = $param['pass'];
		$type = $param['type'];

		$db = $this->db->prepare("UPDATE tbl_users SET fname = :fname, lname = :lname, username = :uname, password = :pass, type = :type WHERE id = :id");
		$db->execute(array(':fname' => $fname, ':lname' => $lname, ':uname' => $uname, ':pass' => $pass, ':type' => $type, ':id'=> $id));
		$err =  $db->rowCount();
		return $err;			
	}
	public function user_add_save($param){
		unset($param['default']);
		$fname = $param['fname'];
		$lname = $param['lname'];
		$uname = $param['uname'];
		$pass = $param['pass'];
		$type = $param['type'];

		$db = $this->db->prepare("INSERT INTO tbl_users (fname, lname, username, password, type) VALUES (:fname, :lname, :uname, :pass, :type)");
		$db->execute(array(':fname' => $fname, ':lname' => $lname, ':uname' => $uname, ':pass' => $pass, ':type' => $type));
		$err = $db->errorCode();
		$err =  $db->rowCount();
		return $err;			
	}
	public function user_del($param){
		unset($param['default']);
		$id = $param['id'];

		$db = $this->db->prepare("DELETE FROM tbl_users WHERE id = :id");
		$db->execute(array(':id'=> $id));
		$err = $db->errorCode();
		return $err;			
	}
	public function fetchall_users($param){
		unset($param['default']);
		$order = $param['order'];
		$page = $param['page'];
		$keyword = $param['keyword'];
		$query = "SELECT 
					 id,username,password,fname,lname,type
				FROM 
					tbl_users
				WHERE 
					CONCAT(fname,' ',lname) LIKE '%".$keyword."%' OR
					username LIKE '%".$keyword."%' OR
					type LIKE'%".$keyword."%'
				ORDER BY
					fname ".$order." ";
		
			$data = array();
			$data['query'] = $query;
			$data['page'] = $page;
			$data['keyword'] = $keyword;
		$html = $this->pagination($data);		
		return $html;			
	}
	
	public function construct_user_table($data){
		
		$html = '';	
		$count = 0;
		foreach($data as $key => $user){
				$count++;
				$html .= '
					<tr class="rm-item-users m-r-10 b-b-gray" id="edit-user-tr'.$user['id'].'">
						<td >						
							<p class="m-b-0 m-l-10 p-all-10size-13">'.$user['fname'].' '.$user['lname'].'</p>	
														
						</td>
						<td >						
							<p class="m-b-0 m-l-10 size-13">'.$user['username'].'</p>	
														
						</td>
						<td >						
							<p class="m-b-0 m-l-10 size-13">'.str_repeat("*", strlen($user['password'])).'</p>	
														
						</td>
						<td >						
							<p class="m-b-0 m-l-10 size-13">'.$user['type'].'</p>	
														
						</td>
						<td align="right">
						<i class="fa fa-pencil m-b-0 m-r-20 pointer editbtn-user" data-all="'.$user['id'].','.$user['fname'].','.$user['lname'].','.$user['username'].','.$user['password'].','.$user['type'].'" aria-hidden="true" ></i>
						<i class="fa fa-trash m-b-0 m-r-20 pointer delbtn-user" data-id="'.$user['id'].'" aria-hidden="true" ></i>
						</td>
					</tr>';
				
		}
		$result = array();
		$result['html'] = $html;
		$result['counter'] = $count;
		return $result;
	}
//pagination
	public function pagination($param){
		unset($param['default']);

		if(array_key_exists('firstload',$param)){
			$query = "SELECT id,username,password,fname,lname,type FROM tbl_users ORDER BY fname ASC";
		}else{
			$query = $param['query'];
		}
		$page = $param['page'];
		if ($page == '' || $page == '1'){
			$page1 = 0;
		}else{
			$page1 =($page*5)-5;
		}
		if(array_key_exists('keyword',$param)){
			$db = $this->db->prepare($query);
			$db->execute();
			$count =  $db->rowCount();
		}else{
			$db = $this->db->prepare("SELECT * FROM tbl_users");
			$db->execute();
			$count =  $db->rowCount();
		}
		
		$db = $this->db->prepare($query." LIMIT $page1,5 ");
		$db->execute();
		
		$users = $db->fetchAll();		
		
		$data = array();
		
		foreach($users as $key => $user){
			$data[$key]['id'] = $user['id']; 
			$data[$key]['fname'] = $user['fname']; 
			$data[$key]['lname'] = $user['lname']; 
			$data[$key]['username'] = $user['username']; 
			$data[$key]['password'] = $user['password']; 
			$data[$key]['type'] = $user['type']; 
			}
	$page_number = $page;
	$count_data = $count;
	if( $count_data > 0 ){
		$page = (int) $page_number;
		$limit = 5;
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
		    $link .= '<span class="paginate " data-val="1"><i class="fa fa-angle-double-left"></i> First</span>';
		}
		if($page !=1) { 
		    $link .= '<span class="paginate " data-val="'.$previous_page.'"><i class="fa fa-fw fa-angle-left"></i> Previous</span>';
		}
		if($first_paging > 0 ) {   
		    $link .= '<span class="paginate " data-val="'.$first_paging.'">'.$first_paging.'</span>';   
		}
		if($second_paging > 0 ) {       
		    $link .='<span class="paginate " data-val="'.$second_paging.'">'.$second_paging.'</span>';   
		}
		if( $array_count_res > $limit){
			$link .= '<span class="paginate page-active" data-val="'.$page.'">'.$page.'</span>';   
		}
		if($third_paging <= $choice ) {           
		    $link .='<span class="paginate " data-val="'.$third_paging.'">'.$third_paging.'</span>'; 
		} 
		if($four_paging <= $choice ) {     
		    $link .= '<span class="paginate " data-val="'.$four_paging.'">'.$four_paging.'</span>'; 
		}  
		if($page !=$choice) { 
		    $link .= '<span class="paginate " data-val="'.$next_page.'"> Next <i class="fa fa-fw fa-angle-right"></i></span>';
		}
		if($last_page > 1) {
		    $link .= '<span class="paginate " data-val="'.$choice.'"> Last <i class="fa fa-angle-double-right"></i></span>';
		} 
		$link .='</td></tr>';

		//$page = $page_number;
		$total = $count_data; //total items in array    
		//$limit = 4; //per page    
		$totalPages = ceil( $total/ $limit ); //calculate total pages
		$page = max($page, 1); //get 1 page when $_GET['page'] <= 0
		$page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
		$offset = ($page - 1) * $limit;
		if( $offset < 0 ) $offset = 0;
	}
		if(array_key_exists('keyword',$param)){
			$data = $this->construct_user_table_search($data,$param['keyword']);
			$html = $data['html'];
			$count2 = $data['counter'];
		}else{
			$data = $this->construct_user_table($data);
			$html = $data['html'];
			$count2 = $data['counter'];
		}
		$c_text = '';
		if( $count_data > 0 ){
			$upto =  $offset + 1;
			$tothen = $upto + $count2 - 1;
			$c_text = '<tr class="pagination-row"><td>Showing '.$upto.' to '.$tothen.' of '.$count.' users. </td>';
		}	
		if($count_data != 0){
		$link = $c_text.$link;	
		$html .= $link;
		}		
		return $html;				
	}	
	public function construct_user_table_search($data,$keyword){
		$count = 0;
		$html = '';	
		
		foreach($data as $user){
			$count++;
			$fullname = strtolower($user['fname'].' '.$user['lname']);
			$html .= '
					<tr class="rm-item-users m-r-10 b-b-gray" id="edit-user-tr'.$user['id'].'">
						<td >						
							<p class="m-b-0 m-l-10 p-all-10size-13">'.str_replace($keyword,'<font class="bold color-3">'.$keyword.'</font>',$fullname).'</p>	
														
						</td>
						<td >						
							<p class="m-b-0 m-l-10 size-13">'.str_replace($keyword,'<font class="bold color-3">'.$keyword.'</font>',$user['username']).'</p>	
														
						</td>
						<td >						
							<p class="m-b-0 m-l-10 size-13">'.str_repeat("*", strlen($user['password'])).'</p>	
														
						</td>
						<td >						
							<p class="m-b-0 m-l-10 size-13">'.str_replace($keyword,'<font class="bold color-3">'.$keyword.'</font>',strtolower($user['type'])).'</p>	
														
						</td>
						<td align="right">
						<i class="fa fa-pencil m-b-0 m-r-20 pointer editbtn-user" data-all="'.$user['id'].','.$user['fname'].','.$user['lname'].','.$user['username'].','.$user['password'].','.$user['type'].'" aria-hidden="true" ></i>
						<i class="fa fa-trash m-b-0 m-r-20 pointer delbtn-user" data-id="'.$user['id'].'" aria-hidden="true" ></i>
						</td>
					</tr>';
			}
		$result = array();
		$users = ($count == 0 ? '<tr class="rm-item-users m-r-10 b-b-gray"><td colspan="5" align="center"><b>No results found</b></td></tr>' : $html);	
		$result['html'] = $users;
		$result['counter'] = $count;
		return $result;
	}
}
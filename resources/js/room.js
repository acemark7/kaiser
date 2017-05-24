$(document).ready(function(){
	var room_temp = [];
	$('body').on('click','.editbtn-room',function(){
		if (room_temp.id > 0){
			room.def_view(room_temp.id,room_temp.name);
		}
		room_temp['id'] = $(this).data('id');
		room_temp['name'] = $(this).data('name');
		var html = '<td><input class="input-room p-l-5 " id="room'+room_temp.id+'" type="text" name="roomname" value="'+room_temp.name+'"> </td>';
			html+= '<td align="right"><i class="fa fa-check color-3 pointer editroom-save" data-id="'+room_temp.id+'" aria-hidden="true" ></i><i class="fa fa-times m-all-20 pointer editroom-delete" aria-hidden="true" data-id="'+room_temp.id+'" data-name="'+room_temp.name+'"></i></td>';
		$('#edit-room-tr'+room_temp.id).empty();
		$('#edit-room-tr'+room_temp.id).append(html);				
	})
	$('body').on('click','.editroom-save',function(){
		var id = $(this).data('id');
		var name = $('#room'+id).val();

		room.save(id,name);
	
	})	
	$('body').on('click','.paginate-room', function(){
		var page = $(this).attr('data-val');
		$('#rm-content').empty();
		main.ajaxRequest('room','fetchall_rooms',{'page':page},'views')
	})
	$('body').on('click','.editroom-delete',function(){
		var id = $(this).data('id');
		var name = $(this).data('name');
		
		room.def_view(id,name);
		//var r = confirm("Press a button!");
		//if (r == true) {
		//room.del(id);
		//$('#edit-room-tr'+id).remove();
		//}
		})
})	
	

	



room.def_view = function(id,name){
	$('#edit-room-tr'+ id).empty();
	var html = '<td>' + 						
				'<p class="m-b-0 m-l-10 size-13">' + name + '</p>' +							
			'</td>' +
			'<td align="right">' +
				'<i class="fa fa-pencil m-b-0 m-r-20 pointer editbtn-room" data-id="'+ id +'" data-name="' + name + '" aria-hidden="true"></i>' +
			'</td>';
		
	$('#edit-room-tr'+ id).append(html);		
	}

room.save = function(id,name){
	var param = {'id':id,'name':name};
	//main.ajaxRequest('home','search_patient',{'qry':'j'},'patient-src',)		
	main.ajaxRequest('room','room_save',param,'');
	}

room.save_roomCb = function(param){
	var param = JSON.parse(JSON.stringify(param));
	
	room.def_view(param.id,param.name);
	
	popup.basic("Save Room",param.message);
	}

room.del = function(id){
	var param = {'id':id};
			
	main.ajaxRequest('room','room_del',param,'')
	}

room.delete_roomCb = function(param){
	var param = JSON.parse(JSON.stringify(param));
	$('#edit-room-tr' + param.id).remove();
	popup.basic("Delete Room",param.message);
	}
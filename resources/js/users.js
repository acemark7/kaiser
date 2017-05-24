$(document).ready(function(){
	var user_temp = [];
	
	$('body').on('click','.editbtn-user',function(){
		if (user_temp.id > 0){
			user.def_view(user_temp.id,user_temp.fname,user_temp.lname,user_temp.uname,user_temp.pass,user_temp.type);
		}	
		if($('#add').length){
			$('#add').remove();
		}
		var data = $(this).data('all').split(',');
		user_temp['id'] = data[0];
		user_temp['fname']= data[1];
		user_temp['lname']= data[2];
		user_temp['uname']= data[3];
		user_temp['pass']= data[4];
		user_temp['type']= data[5];

		var html = '<td><input class="input-user" id="flname'+user_temp.id+'" type="text" name="flname" value="'+user_temp.fname+' '+user_temp.lname+'"> </td>'+
		  '<td><input class="input-user" id="uname'+user_temp.id+'" type="text" name="uname" value="'+user_temp.uname+'"> </td>'+
		  '<td><input class="input-user" id="pass'+user_temp.id+'" type="password" name="pass" value="'+user_temp.pass+'"> </td>'+
		  '<td><select class="input-user" id="type'+user_temp.id+'">';
			 if (user_temp.type == 'Admin'){html+='<option class="user-select-option" value="Admin" selected>Admin</option><option class="user-select-option" value="User" >User</option>';}
			 else{html+='<option class="user-select-option" value="Admin">Admin</option><option class="user-select-option" value="User" selected>User</option>';}
		 html+='</select> </td>'+
		 '<td align="right"><i class="fa fa-check color-3 pointer edituser-save" data-id="'+user_temp.id+'" aria-hidden="true" ></i><i class="fa fa-times m-all-20 pointer close-user" data-all="'+user_temp.id+','+user_temp.fname+','+user_temp.lname+','+user_temp.uname+','+user_temp.pass+','+user_temp.type+'" aria-hidden="true" ></i></td>'; 
 
		$('#edit-user-tr'+user_temp.id).empty();
		$('#edit-user-tr'+user_temp.id).append(html);			
	})
	
	$('body').on('click','.close-user',function(){
		var data = $(this).data('all').split(',');
		var id = data[0],
		 fname = data[1],
		 lname = data[2],
		 uname = data[3],
		 pass = data[4],
		 type = data[5];
		 
		user.def_view(id,fname,lname,uname,pass,type);
	})
	
	$('body').on('click','.add-user-form',function(){
		if (user_temp.id > 0){
			user.def_view(user_temp.id,user_temp.fname,user_temp.lname,user_temp.uname,user_temp.pass,user_temp.type);
		}
		
		if(!$('#add').length){
			html = '<tr id="add" class="b-b-gray" ><td><input class="input-user" id="flname_add" type="text" name="flname" placeholder="Type Name Here" ></td>'+
			 '<td><input class="input-user" id="uname_add" type="text" name="uname" placeholder="Type Username Here"></td>'+
			 '<td><input class="input-user" id="pass_add" type="password" name="pass" placeholder="Type Password Here"></td>'+
			 '<td><select class="input-user" id="type_add"><option value="" disabled selected>Select User Type</option><option class="user-select-option" value="Admin">Admin</option><option class="user-select-option" value="User">User</option></select> </td>'+
			 '<td align="right"><i class="fa fa-check color-3 pointer add-user-save" aria-hidden="true" ></i><i class="fa fa-times m-all-20 pointer close-add" aria-hidden="true"><i/></td></tr>';
			$(".usertbl tr:first").after(html);	
		}
	})
	
	$('body').on('click','.close-add',function(){
		$('#add').remove();
	})
	
	$('body').on('click','.add-user-save',function(){
		var fullname = $('#flname_add').val(),
			uname = $('#uname_add').val(),
			pass = $('#pass_add').val(),
			type = $('#type_add').val();
		var arr = fullname.split(' ');
		console.log(arr[1])
			if(typeof arr[1] == 'undefined'){
				popup.basic("Alert","Please input lastname!");
			}
			else{
				user.add(arr[0],arr[1],uname,pass,type);
			}
		
	
	})	
	$('body').on('click','.delbtn-user',function(){
		var id = $(this).data('id');
		
		popup.action_button(
		'Test',
		'are you sure you want to delete this user?', 
		[{"text" : "Proceed", "class" : "", "click" : function(){user.del(id);$('#edit-user-tr'+id).remove();}}, 
		{"text" : "Cancel", "class" : "", "click" : function(){popup.destroy()}}], 'divid', 300
		);
	

	})	
	
	$('body').on('click','.edituser-save',function(){
		var id = $(this).data('id');
		var fullname = $('#flname'+id).val(),
			uname = $('#uname'+id).val(),
			pass = $('#pass'+id).val(),
			type = $('#type'+id).val();
		var arr = fullname.split(' ');
		if(typeof arr[1] == 'undefined'){
				popup.basic("Alert","Please input lastname!");
			}
			else{
				user.edit(id,arr[0],arr[1],uname,pass,type);
			}	
	})	
	
	$('body').on('keyup','#search-user',function(){
		keyword = $.trim($(this).val());
		page =1;
		delay(function(){
			user.search_user(keyword,page);
		},500);				
	})
	
	$('body').on('click','.descend-user',function(){
		$(this).removeClass('fa-sort-desc');
		$(this).removeClass('descend-user');
		$(this).addClass('fa-sort-asc');
		$(this).addClass('ascend-user');
		var str = $.trim($('#search-user').val());
		sort = 'DESC';
		page = 1;
		user.search_user(str,page);
	})
	$('body').on('click','.ascend-user',function(){
		$(this).removeClass('fa-sort-asc');
		$(this).removeClass('ascend-user');
		$(this).addClass('fa-sort-desc');
		$(this).addClass('descend-user');
		var str = $.trim($('#search-user').val());
		sort = 'ASC';
		page = 1;
		user.search_user(str,page);
	})
	
	// PAGINATION
	$('body').on('click','.paginate', function(){
		page = $(this).attr('data-val');
		main.ajaxRequest('users','fetchall_users',{'order':sort,'page':page,'keyword':keyword},'user-content2')
	});
})
var page = 1;
var sort = 'ASC';
var keyword = '';
var delay = (function(){
	var timer = 0;
	return function(callback, ms){
	clearTimeout (timer);
	timer = setTimeout(callback, ms);
	};
})();
user.edit = function(id,fname,lname,uname,pass,type){
	var param = {'id':id,'fname':fname,'lname':lname,'uname':uname,'pass':pass,'type':type};
			
	main.ajaxRequest('users','user_save',param,'')
	}
user.del = function(id){
	var param = {'id':id};
	popup.destroy();	
	popup.basic("User Deleted","Deleted");	
	main.ajaxRequest('users','user_del',param,'')
	}
user.add = function(fname,lname,uname,pass,type){
	var param = {'fname':fname,'lname':lname,'uname':uname,'pass':pass,'type':type};
			
	main.ajaxRequest('users','user_add_save',param,'')
	}
user.search_user = function(str,page){
		if(str.length > 0){
			if($('.sort').hasClass('descend-user')){
				var param = {'keyword':str,'order':'ASC','page':page};
			}else{
				var param = {'keyword':str,'order':'DESC','page':page};
			}
		main.ajaxRequest('users','fetchall_users',param,'user-content2')
		}else{
			if($('.sort').hasClass('descend-user')){
				main.ajaxRequest('users','fetchall_users',{'keyword':str,'order':'ASC','page':page},'user-content2')
			}else{
				main.ajaxRequest('users','fetchall_users',{'keyword':str,'order':'DESC','page':page},'user-content2')
			}
		}
	}
user.save_userCb = function(param){
	var param = JSON.parse(JSON.stringify(param));
	
	user.def_view(param.id,param.fname,param.lname,param.uname,param.pass,param.type);
	
	popup.basic("Save User",param.message);
	}
	
user.def_view = function(id,fname,lname,uname,pass,type){
	$('#edit-user-tr'+ id).empty();
	 var html = '<td ><p class="m-b-0 m-l-10 p-all-10size-13">'+fname+' '+lname+'</p></td>'+
	 '<td ><p class="m-b-0 m-l-10 size-13">'+uname+'</p></td>'+
	 '<td ><p class="m-b-0 m-l-10 size-13">'+pass.replace(/./g, '*')+'</p></td>'+
	 '<td ><p class="m-b-0 m-l-10 size-13">'+type+'</p></td>'+
	 '<td align="right"><i class="fa fa-pencil m-b-0 m-r-20 pointer editbtn-user" aria-hidden="true" data-all="'+id+','+fname+','+lname+','+uname+','+pass+','+type+'"></i><i class="fa fa-trash m-b-0 m-r-20 pointer delbtn-user" data-id="'+id+'" aria-hidden="true"></i></td>';
		
	$('#edit-user-tr'+ id).append(html);		
	}
user.save_adduserCb = function(param){
	var param = JSON.parse(JSON.stringify(param));
	popup.basic("Save User",param.message);
	main.ajaxRequest('users','index',{'default':1},'views')
	}


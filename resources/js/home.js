$(document).ready(function(){
	$('body').on('keyup','#search-patient',function(){
		var str = $.trim($(this).val());
		
		home.search_patient(str);
				
	})
	
	$('body').on('click','#src-input',function(){
		var str = $.trim($('#search-patient').val());
		
		home.search_patient(str);
				
	})
	
	$('body').on('click','#select-status li a',function(){
		var str = $(this).data('status');
		home.room_content(str);
				
	})
})

home.search_patient = function(str){
	if(str.length > 0){
		var param = {'qry':str};	
		main.ajaxRequest('home','search_patient',param,'')
		}
	else{
		$('.src-result').addClass('hide');
		}
	}


home.search_patientCb = function(param){
	var param = JSON.parse(JSON.stringify(param));
	
	if(param.count > 0){
		if($('.src-result').hasClass('hide')){
			$('.src-result').removeClass('hide');
			}
		$('#patient-src').html(param.patients);
		}
	else{
		$('.src-result').addClass('hide');
		}
	}		
	
home.room_content = function(str){
	var param = {'qry':str};
			
	main.ajaxRequest('home','room_content',param,'rm-content')
	}

home.templates = function(name){
	var html = '';
	
	switch(name){
		case 'search-default':
			html = '<div class="col-md-12 center no-p-record p-all-20">' +
				'<img src="resources/images/Icons/icon-searchpatient.png">' +
			'</div>';
		break;
		
		case 'search-no-result':
			html = '<div class="col-md-12 center no-p-record p-all-20">' +
				'<img src="resources/images/Icons/icon-searchpatient.png">' +
			'</div>';
		break;
		}
	
	return html;
	}
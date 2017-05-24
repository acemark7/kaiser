/** Login Functions **/

$(document).ready(function(){
	$('body').on('click','#logme',function(){
			var required = main.requiredFields('logme-form');
			
			if(required.length > 0) {
				
				
				alert('Required Fields:' + required.toString())
				return false;
				}
			
			var param = main.inputsToObject('logme-form');
			login.logmein('login','logmein',param);
		
		});
	
	});


login.logmein = function(controller,method,param){
	/**
	controller 	= name of the controller
	method 		= name of the method
	param		= parameters - object form
	**/
	page = [];
	
	page[0] = controller;
	page[1] = method;
	
	var query = {};
		query.page = page,
		query.param = param;
	
	if(loader['main']) loader['main'].abort();
	
	var dataSend = (JSON.stringify(query)).replace(/'/g,'\u2019');
	
	loader['main'] = $.ajax({
		url: '/template/app/route.php',
		type: "POST",
		data : {'data':$.parseJSON(dataSend)},
		dataType:"text",
        contentType: "application/x-www-form-urlencoded;charset=utf-8",
		success: function(response){
			var data = $.parseJSON(response);
			console.log(data);
			
			alert(data.message);
			//$('#' + views).html(response);
			}
		});
	}
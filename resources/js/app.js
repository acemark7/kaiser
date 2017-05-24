
window.addEventListener('hashchange', function(){
	main.loadContent();
});

main.loadContent = function(){
	/******
	HASH STRUCTURE
	
	/#controller/method?parameter1=1&paramerter2=2
	
	******/
	var hash = window.location.hash,
		hashProperty = hash.split('?'),
		hashPage = hashProperty[0].substring(1, hash.length), //remove leading #
		pageControl = main.remove_special_chars(hashPage),
		page = [], // Controller and Method Array 
		param = {}; // Parameter's Object
	
	
	if(hashProperty[0] != undefined && hashProperty[0] != ''){
		page = pageControl.split('/'); // split values and assign them to 'page' Array
		/***** 
		NOTES
		page[0] = Controller
		page[1] = Method
		page[2] and the so on, you can decide what values you can reference with the indexes depending on your project
		*****/
		if(page[1] == undefined) page[1] = 'index';
		}
	else{
		//Set dashboard as default page and index as default method
		page = ['dashboard','index'];
		}
		
	if(hashProperty[1] != undefined){
		var hashVariables = hashProperty[1].split('&');
		
		for ( i in hashVariables ) { // get and assign parameters to 'param' object
			var variables = hashVariables[i].split('=');
			param[main.remove_special_chars(variables[0])] = main.remove_special_chars(variables[1]);
			}
		}
	else{
		param['default'] = 1;
		}
	
	var query = {};
		query.page = page,
		query.param = param;
	
	
	main.loader(query,'views');
	}
	
main.ajaxRequest = function(controller,method,param,view){
	/**
	controller 	= name of the controller
	method 		= name of the method
	param		= parameters - object form
	view 		= element id to where the response is placed
	**/
	page = [];
	
	page[0] = controller;
	page[1] = method;
	
	var query = {};
		query.page = page,
		query.param = param;
	
	main.loader(query,view);
	}

main.loader = function(query,views){
	popup.loader('show','Loading...');
	if(loader['main']) loader['main'].abort();
	
	var dataSend = (JSON.stringify(query)).replace(/'/g,'\u2019');
	
	loader['main'] = $.ajax({
		url: '/'+ folder +'app/route.php',
		type: "POST",
		data : {'data':$.parseJSON(dataSend)},
		dataType:"text",
        contentType: "application/x-www-form-urlencoded;charset=utf-8",
		success: function(response){
			$('#' + views).html(response);
			popup.loader('hide');
			
			var data = JSON.parse(JSON.stringify(response));
			
			if(data.indexOf('exec_function') > -1){
				var dt = JSON.parse(data);
				var cb_param = JSON.stringify(dt.cb_param);
				eval(dt.exec_function + '('+ cb_param +')');
				}
			}
			
		});
	}
	
main.remove_special_chars = function(str){
	/** Allow Alpha Numeric, Slash, Underscore and Dash **/ 
	return str.replace(/([~!@#$%^&*()+=`{}\[\]\|\\:;'<>,.\? ])+/g,'');
}

// Initialize Page Load
main.loadContent();
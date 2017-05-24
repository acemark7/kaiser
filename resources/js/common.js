/** Initialize Objects **/
var main = {},
	home = {},
	room = {},
	user = {},
	loader = {},
	popup = {},
	login = {},
	dashboard = {};
	
var folder = 'kaiser/';
	
main.requiredFields = function(wrapper){
	//Get INPUT types
	var nodata = [];
	$('#' + wrapper + ' input[data-required]').each(function (index) { 
		if($.trim($(this).val()) == 0){
			nodata[index] = $(this).data('name');
			}
		});
	
	return nodata;
	}

main.inputsToObject = function(wrapper){
	var param = {};
	
	//Get INPUT types
	$('#' + wrapper + ' input').each(function () { 
		var value = $(this).val();
		var name = $(this).data('name');
		
		param[name] = value;
		});
	
	return param;
	}

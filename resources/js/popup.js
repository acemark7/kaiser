/** Popup Functions **/

/* 
BASIC POPUP 
Parameters
title = Title of the popup
msg = Content of the popup, can contain text or html
id = ID of the popup
width = Popup width
*/
popup.basic = function(title,msg,id,width){
	if($(".pop-basic").length == 0){
		$("body").prepend("<div class='pop-basic' id='"+ id +"'>" +
			"<div class='font-13'>" +
			 	msg +
			"</div>" +
		"</div>");
		}
	
	var width = (width == '' ? 300 : width);
	
	$(".pop-basic").dialog({
		width: width,
		title:title,
		draggable: false,
		resizable: false,
		modal: true,
		show: {
			effect: "fade",
			duration: 200
		},
		hide: {
			effect: "fade",
			duration: 200
		},
		buttons:{'OK':{
			'text':'OK',
			"class": '',
			'click':function(){
				popup.destroy();	
				}
			}
		},
		open:function(event,ui){
			$('body').css('overflow','hidden');
		},
		close:function(event,ui){
			$('body').css('overflow','');
			$('.pop-basic').dialog('destroy').remove();
		}
	});
	}

/*
ACTION BUTTON

Parameters
title = Title of the popup
msg = Content of the popup, can contain text or html
buttons = Contains button array objects

FORMAT, each button must be enclosed with an object, see sample below
	[
		{
		'text'	:'Button Title',
		"class"	: 'Button Class',
		'click'	:function(){
			Here goes the function to trigger when button is clicked
			}
		}
	]
id = ID of the popup
width = Popup width
*/	

popup.action_button = function(title,msg,buttons,id,width){
	if($(".pop-action").length == 0){
		$("body").prepend("<div class='pop-action' id='"+ id +"'>" +
			"<div class='font-13'>" +
			 	msg +
			"</div>" +
		"</div>");
		}
	
	var width = (width == '' ? 300 : width);
	
	$(".pop-action").dialog({
		width:width,
		title:title,
		draggable: false,
		resizable: false,
		modal: true,
		show: {
			effect: "fade",
			duration: 200
		},
		hide: {
			effect: "fade",
			duration: 200
		},
		buttons: buttons,
		open:function(event,ui){
			$('body').css('overflow','hidden');
		},
		close:function(event,ui){
			$('body').css('overflow','');
			$('.pop-action').dialog('destroy').remove();
		}
	});
	}	

/** POPUP LOADER **/

popup.loader = function(type,title){
	var type = (type == 'show' ? 'show' : 'hide');
	
	$("body").find('.pop-loader').remove();
	
	if(type == 'show'){
		$("body").prepend("<div class='pop-loader'>" +
			"<div class='loader-outer'></div>" +
			"<div class='loader-inner'>" +
				"<i class='fa fa-spinner fa-pulse fa-3x fa-fw'></i>" +
				"<div class='font-13'>" +
					title +
				"</div>" +
			"</div>" +
		"</div>");
		}
	}
	
/** CLOSE POPUP **/
popup.destroy = function(){
	$('body').find('.ui-dialog-content').dialog('destroy').remove();
	}

$('body').on('click','.ui-dialog-titlebar-close',function(){
	$(this).parent().find('.ui-dialog-content').dialog('destroy').remove();
	})
	

	
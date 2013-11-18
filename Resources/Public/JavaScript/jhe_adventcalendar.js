//alert('Einbindung geht!!!');

function clearVariables(){
	document.getElementById('adventcalendar_dialog').style.top = "";
	document.getElementById('adventcalendar_dialog').style.left = "";
	document.getElementById('dialogheader').innerHTML = "";
	document.getElementById('dialogcontent').innerHTML = "";
}

$(document).ready(function(){
	
	var serializedjquerydataObj = $.parseJSON($('#serializedjquerydata').val());

	var layerWidth = serializedjquerydataObj.layerWidth;
	var layerHeight = serializedjquerydataObj.layerHeight;
	var username = serializedjquerydataObj.username;
	var pathToAjaxLoaderImage = serializedjquerydataObj.pathToAjaxLoaderImage;
	var pathToCloseButtonImage = serializedjquerydataObj.pathToCloseButtonImage;
	var modalFadeInTime = serializedjquerydataObj.modalFadeInTime;
	var dialogFadeInTime = serializedjquerydataObj.dialogFadeInTime;
	var modalDialogFadeOutTime = serializedjquerydataObj.modalDialogFadeOutTime;
	var snowUsage = serializedjquerydataObj.snowUsage;
	var snowFlakeColor = serializedjquerydataObj.snowFlakeColor;
	var snowFlakeMinSize = serializedjquerydataObj.snowFlakeMinSize;
	var snowFlakeMaxSize = serializedjquerydataObj.snowFlakeMaxSize;
	var snowTimeForNewFlake = serializedjquerydataObj.snowTimeForNewFlake;

	if(snowUsage){
		$.fn.snow({ 
			minSize: snowFlakeMinSize, 
			maxSize: snowFlakeMaxSize, 
			newOn: snowTimeForNewFlake, 
			flakeColor: snowFlakeColor
		});
	}
	
	$('<div id="boxes"><div id="adventcalendar_dialog" class="window" style="width: ' + layerWidth + 'px;min-height: ' + layerHeight + 'px;"><div id="dialogheader"></div><div id="dialogcontent"></div></div><div id="mask"></div></div>').appendTo('body');
							
	$('area').click(function(e){
		e.preventDefault();
		var id = $(this).attr('id');
	
		if(snowUsage){	
			$.fn.snow({ 
				minSize: snowFlakeMinSize, 
				maxSize: snowFlakeMaxSize, 
				newOn: snowTimeForNewFlake, 
				flakeColor: snowFlakeColor,
				appendTo: '#mask'
			});
		}
		
		$('#dialogcontent').append('<div id="ajax-loader"><img src="' + pathToAjaxLoaderImage + '" /></div>');

		var winH = $(window).height();
		var winW = $(window).width();
		$('#adventcalendar_dialog').css('top',  winH/2-$('#adventcalendar_dialog').height()/2);
		$('#adventcalendar_dialog').css('left', winW/2-$('#adventcalendar_dialog').width()/2);
		$('#adventcalendar_dialog').css('width', layerWidth);
		$('#adventcalendar_dialog').css('min-height', layerHeight);
		$('adventcalendar_#dialog').css('height', 'auto');

		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
		$('#mask').css({'width':maskWidth,'height':maskHeight});

		$('#mask').fadeIn(modalFadeInTime);
		$('#mask').fadeTo("slow",0.8);
		$('#adventcalendar_dialog').fadeIn(dialogFadeInTime);

		var extensionName = 'JheAdventcalendar';
		var pluginName ='Adventcalendar';
		var controllerName ='Ajax';
		var actionName ='processAjax';

		$.ajax({
			url: 'index.php',
			type: 'POST',
			data: { 
				eID : 'adventcalenderAjax',
				pageID : id,
				user : username,
				extensionName : extensionName,
				pluginName : pluginName,
				controllerName : controllerName,
				actionName : actionName,
				type : '24122013'
			},
			dataType: 'json',
			success: function(result) {
				$('#ajax-loader').hide();
				$('#dialogheader').html('<h2>' + result.pageTitle + '</h2><div id="dialogclose"><img src="' + pathToCloseButtonImage+ '" width="25" height="25" alt="schliessen..."</div>');
				$('#dialogcontent').html(result.code);
				if($(document).height() < $('#adventcalendar_dialog').height()){
					maskHeight = $('#adventcalendar_dialog').height(); 
				} else {
					maskHeight = $(document).height();
				}
				$('#mask').css({'width':maskWidth,'height':maskHeight});
			},
			error: function(result){
				alert('FEHLER: ' + result);
			}
		});
	});

	//if mask is clicked
	$('#mask').click(function () {
		
		if(snowUsage){
			$.fn.stopsnow('#mask');
			$.fn.stopsnow('body');
		}
		
		$(this).fadeOut(modalDialogFadeOutTime);
		$('.window').fadeOut(modalDialogFadeOutTime);
		window.setTimeout('clearVariables()','500');
	});

	//if close button is clicked
	$(document).on('click', '#dialogclose', function(){
		
		if(snowUsage){
			$.fn.stopsnow('#mask');
			$.fn.stopsnow('body');
		}
		
		$('#mask, .window').fadeOut(modalDialogFadeOutTime);
		window.setTimeout('clearVariables()','500');
	});
});
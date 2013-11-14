//alert('Einbindung geht!!!');

function clearVariables(){
	document.getElementById('dialog').style.top = "";
	document.getElementById('dialog').style.left = "";
	document.getElementById('dialogheader').innerHTML = "";
	document.getElementById('dialogcontent').innerHTML = "";
}

$(document).ready(function(){
	
	var layerWidth = '960';
	var layerHeight = '720';
	
	var user = 'jari-hermann.ernst';
	
	var pathToAjaxLoaderImage = 'http://dev.teampoint.info/typo3conf/ext/jhe_adventcalendar/Resources/Public/Images/ajax-loader.gif';
	var pathToCloseButtonImage = 'http://dev.teampoint.info/typo3conf/ext/jhe_adventcalendar/Resources/Public/Images/bt_close.gif';
	
	var modalFadeInTime = '500';
	var dialogFadeInTime = '1000';
	var modalDialogFadeOutTime = '1000';
	
	$('<div id="boxes"><div id="adventcalendar_dialog" class="window" style="width: 960px;min-height:720px;"><div id="dialogheader"></div><div id="dialogcontent"></div></div><div id="mask"></div></div>').appendTo('body');
							
	$('area').click(function(e){
		e.preventDefault();
		var id = $(this).attr('id');
		var username = user;
	
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

		$.ajax({
			url: '?eID=adventcalender',
			type: 'GET',
			data: 'pageID=' + id + '&user=' + username,
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
			}
		});
	});

	//if mask is clicked
	$('#mask').click(function () {
		$(this).fadeOut(modalDialogFadeOutTime);
		$('.window').fadeOut(modalDialogFadeOutTime);
		window.setTimeout('clearVariables()','500');
	});

	//if close button is clicked
	//$('#dialogclose').live('click', function(){
	//	$('#mask, .window').fadeOut(modalDialogFadeOutTime);
	//	window.setTimeout('clearVariables()','500');
	//});
	$(document).on('click', '#dialogclose', function(){
		$('#mask, .window').fadeOut(modalDialogFadeOutTime);
		window.setTimeout('clearVariables()','500');
	});
});
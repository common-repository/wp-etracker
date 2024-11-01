jQuery(document).ready( function($) {


	$('input[name=active]').click(function(){
		
		if($('input[name=active]').prop('checked') == true) {
			var data21 ={
				'action' : 'auto_update',
				'item' : 'on',
			}
		} else {
			var data21 ={
				'action' : 'auto_update',
				'item' : 'of',
			}
		}
		
		jQuery.ajax({
			type : "POST",
			url : the_ajax_script.ajaxurl,
			data : data21,
			success: function(data, textStatus, jqXHR){
			},
			error: function (jqXHR, textStatus, errorThrown){
			}
		});

	});


	//K. Meffert: YouTube Event Tracking
	$('input[name=active2]').click(function(){
		
		if($('input[name=active2]').prop('checked') == true) {
			var data22 ={
				'action' : 'youtube_tracking',
				'item' : 'on',
			}
		} else {
			var data22 ={
				'action' : 'youtube_tracking',
				'item' : 'of',
			}
		}
		
		jQuery.ajax({
			type : "POST",
			url : the_ajax_script.ajaxurl,
			data : data22,
			success: function(data, textStatus, jqXHR){
			},
			error: function (jqXHR, textStatus, errorThrown){
			}
		});

	});

	//K. Meffert: Tracking Code in header or footer
	$('input[name=active3]').click(function(){
		
		if($('input[name=active3]').prop('checked') == true) {
			var data22 ={
				'action' : 'tracking_code_hf',
				'item' : 'on',
			}
		} else {
			var data22 ={
				'action' : 'tracking_code_hf',
				'item' : 'of',
			}
		}
		
		jQuery.ajax({
			type : "POST",
			url : the_ajax_script.ajaxurl,
			data : data22,
			success: function(data, textStatus, jqXHR){
			},
			error: function (jqXHR, textStatus, errorThrown){
			}
		});

	});

	$('#upt').submit(function(){
		
		var datau ={
			'action' : 'auto_update_p',
			'item' : '',
		}
		jQuery.ajax({
			type : "POST",
			url : the_ajax_script.ajaxurl,
			data : datau,
			success: function(data, textStatus, jqXHR){
			},
			error: function (jqXHR, textStatus, errorThrown){	 
			}
		}); 
		jQuery.ajax({
			type : "POST",
			url : the_ajax_script.ajaxurl,
			data : datau,
			success: function(data, textStatus, jqXHR){
			},
			error: function (jqXHR, textStatus, errorThrown){
			}
		});
	});

	$('#upt2').submit(function(){

		var datau ={
			'action' : 'auto_update_p',
			'item' : '',
		}
		jQuery.ajax({
			type : "POST",
			url : the_ajax_script.ajaxurl,
			data : datau,
			success: function(data, textStatus, jqXHR){
			},
			error: function (jqXHR, textStatus, errorThrown){
			}
		});
		jQuery.ajax({
			type : "POST",
			url : the_ajax_script.ajaxurl,
			data : datau,
			success: function(data, textStatus, jqXHR){
			},
			error: function (jqXHR, textStatus, errorThrown){
			}
		});
	});

	$('#s').keyup(function(){
		var search_item = $(this).val();
		var data ={
			'action' : 'category_search',
			'item' : search_item,
		}
		jQuery.ajax({
			type : "POST",
			url : the_ajax_script.ajaxurl,
			data : data,
			success: function(data, textStatus, jqXHR){
				$('#categ').html(data);
				reload_scr();

			},
			error: function (jqXHR, textStatus, errorThrown){

			}

		});
	});

	$('#s_pages').keyup(function(){

		var search_item = $(this).val();
		var data ={
			'action' : 'pages_search',
			'item' : search_item,
		}
		jQuery.ajax({
			type : "POST",
			url : the_ajax_script.ajaxurl,
			data : data,
			success: function(data, textStatus, jqXHR){
				$('.content-pages').html(data);

				reload_scr2();
			},
			error: function (jqXHR, textStatus, errorThrown){

			}

		});
	});

	function reload_scr(){
		
		$('input[name=active]').change(function(){
			$('#active').submit();
		});

		$('.check-box').change(function() {

			if ($(this).is(':checked')) {
				id = $(this).attr('id');
				par = $('#'+id+'1').parent().removeClass('hidden');
				$('#'+id+'1').attr('checked','checked');

			} else {
				id = $(this).attr('id');
				par = $('#'+id+'1').parent().addClass('hidden');
				newid = id.substring(0, id.length - 1);
				$('#'+newid).attr('checked', false);
			}
		});

		$('.check-box1').change(function() {
			$(this).parent().addClass('hidden');
		});

	}

	function reload_scr2(){

		$('input[name=active]').change(function(){
			$('#active').submit();
		});

		$('.check-box-2').change(function() {

			if ($(this).is(':checked')) {
				id = $(this).attr('id');
				par = $('#'+id+'1').parent().removeClass('hidden');
				$('#'+id+'1').attr('checked','checked');

			} else {
				id = $(this).attr('id');
				par = $('#'+id+'1').parent().addClass('hidden');
				newid = id.substring(0, id.length - 1);
				$('#'+newid).attr('checked', false);
			}
		});
		$('.check-box1').change(function() {
			$(this).parent().addClass('hidden');
		});

	}

	$('input[name="tos_check"]').click(function(){
		
		if($('input[name="tos_check"]').prop('checked') == true) {
			var tos_check_value ={
				'action' : 'wpetracker_accept_tos',
				'accept_tos_value' : 'on',
			}
		} else {
			var tos_check_value ={
				'action' : 'wpetracker_accept_tos',
				'accept_tos_value' : 'off',
			}
		}
		
		jQuery.ajax({
			type : "POST",
			url : the_ajax_script.ajaxurl,
			data : tos_check_value,
			success: function(data, textStatus, jqXHR){
				if(data == 'enabled') {
					$('.shadow').removeClass('disabled');
				} else {
					$('.shadow').addClass('disabled');
				}
				$('.shadow.key-account').removeClass('disabled');
			},
			error: function (jqXHR, textStatus, errorThrown){
			}
		});

	});

});

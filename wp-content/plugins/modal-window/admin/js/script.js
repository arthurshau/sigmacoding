jQuery(document).ready(function($) {
	//* Vertical table
	$('.tab-nav li:first').addClass('select'); 
	$('.tab-panels>div').hide().filter(':first').show();    
	$('.tab-nav a').click(function(){
		$('.tab-panels>div').hide().filter(this.hash).show(); 
		$('.tab-nav li').removeClass('select');
		$(this).parent().addClass('select');
		return (false); 
	})
	
	$('[name="modal_height_par"]').click(function(){		
		var height_par = $('input[name="modal_height_par"]:checked').val();		
		if (height_par == 'auto'){
			$('[name="modal_height"]').val('');
			$('[name="modal_height"]').attr("disabled", "disabled");			
		}
		else {
			$('[name="modal_height"]').val('0');
			$('[name="modal_height"]').removeAttr("disabled");
		}
	});	
	wpchange();
	displaybutton();
});
function wpchange(){
	var change = jQuery('#modal_show').val();
	jQuery('#wpchange1').css('display', 'none');
	jQuery('#wpchange2').css('display', 'none');
	jQuery('.reached').css('display', 'none');
	jQuery('.wpcookie').css('display', '');
	jQuery('#delay').css('display', '');
	if (change == 'click' || change == 'hoverid'){
		jQuery('#wpchange1').css('display', 'block');
		jQuery('.wpcookie').css('display', 'none');
		jQuery('#delay').css('display', 'none');
	}
	if (change == 'anchor' || change == 'hoveranchor'){
		jQuery('#wpchange2').css('display', 'block');
		jQuery('.wpcookie').css('display', 'none');
		jQuery('#delay').css('display', 'none');
	}
	if (change == 'scroll'){
		jQuery('.reached').css('display', 'block');
	}
}
function displaybutton(){
	var show = jQuery('[name="umodal_button"]').val();
	if (show == 'yes'){			
		jQuery('.showbutton').css('display', '');			
	}
	else {			
		jQuery('.showbutton').css('display', 'none');
	}
}
<?php if(empty($val->close_delay )){ $close_delay = "0"; } else{ $close_delay = $val->close_delay; } ?>   
jQuery(document).ready(function($) {
	pageY<?php echo $val->id; ?> = 0;	
	Click<?php echo $val->id; ?> = '';
	$('#wow-modal-id-<?php echo $val->id; ?>, a[href$="wow-modal-id-<?php echo $val->id; ?>"]').click( function(event){
		event.preventDefault();
		$('#wow-modal-overlay-<?php echo $val->id;?>').fadeIn(400, function(){		
		$('#wow-modal-window-<?php echo $val->id; ?>').fadeIn(400);			
		});
	    $('html, body').css('overflow', 'hidden', 'important');
		showclose_<?php echo $val->id; ?>(); 
		Click<?php echo $val->id; ?> = 1; 
	});  
	<?php if ($val->modal_show == 'hoveranchor' || $val->modal_show == 'hoverid'){ ?>
	$('#wow-modal-id-<?php echo $val->id; ?>, a[href$="wow-modal-id-<?php echo $val->id; ?>"]').hover( function(event){
		event.preventDefault();
		$('#wow-modal-overlay-<?php echo $val->id;?>').fadeIn(400, function(){		
		$('#wow-modal-window-<?php echo $val->id; ?>').fadeIn(400);			
		});
	    $('html, body').css('overflow', 'hidden', 'important');
		showclose_<?php echo $val->id; ?>(); 
		Click<?php echo $val->id; ?> = 1; 
	});
	
	<?php } ?>
	<?php if ($val->modal_show == 'load' ){ ?>	
	var open_wpcmodal = <?php if ($val->modal_timer == "") {echo "0";} else{echo $val->modal_timer*1000;} ; ?>; 
	setTimeout(function(){
		$('#wow-modal-overlay-<?php echo $val->id;?>').fadeIn(400, function(){		
		$('#wow-modal-window-<?php echo $val->id; ?>').fadeIn(400);		
		});
		$('html, body').css('overflow', 'hidden', 'important'); 
		showclose_<?php echo $val->id; ?>();
		Click<?php echo $val->id; ?> = 1;
		}, open_wpcmodal);  
	
	<?php } ?>  
	<?php if ($val->modal_show == 'scroll' ){?> 	
	$(window).bind('scroll.once<?php echo $val->id;?>', function(){
		show_wow_modal_<?php echo $val->id;?>(); 
		}); 
	function show_wow_modal_<?php echo $val->id;?>() {
		if ($(window).scrollTop() >= ($(document).height() - $(window).height())*0.5) {
			var open_wow_modal = <?php echo $val->modal_timer*1000; ?>; 
			setTimeout(function(){
				$('#wow-modal-overlay-<?php echo $val->id;?>').fadeIn(400, function(){				
				$('#wow-modal-window-<?php echo $val->id; ?>').fadeIn(400);				
				}); 
			} , open_wow_modal); 
			$('html, body').css('overflow', 'hidden', 'important'); 
			showclose_<?php echo $val->id; ?>(); 
			$(window).unbind('scroll.once<?php echo $val->id;?>'); 
			Click<?php echo $val->id; ?> = 1; 
		} 
	}
	
	<?php } ?> 
	<?php if ($val->modal_show == 'close' ){?> 
	$(document).bind('mousemove', function(e) {
		if (pageY<?php echo $val->id; ?>) {
			if (e.pageY < pageY<?php echo $val->id; ?>) {
				if( e.pageY - $(document).scrollTop() <= 5) {					
					show_wow_modal_<?php echo $val->id;?>();					
					}  
				}
			}
		pageY<?php echo $val->id; ?> = e.pageY;
	}); 
	function show_wow_modal_<?php echo $val->id;?>() {
		var open_wow_modal = <?php echo $val->modal_timer*1000; ?>; 
		setTimeout(function(){
			$('#wow-modal-overlay-<?php echo $val->id;?>').fadeIn(400, function(){			
				$('#wow-modal-window-<?php echo $val->id; ?>').fadeIn(400);				
			}); 
		} , open_wow_modal); 
		$('html, body').css('overflow', 'hidden', 'important'); 
		showclose_<?php echo $val->id; ?>(); 
		$(document).unbind('mousemove');
		Click<?php echo $val->id; ?> = 1;
	}; 
	<?php } ?>  
	$('#wow-modal-close-<?php echo $val->id;?>, #wow-button-close-<?php echo $val->id;?>').click( function(){		
			$('#wow-modal-window-<?php echo $val->id; ?>').fadeOut(400,function(){				
			$('#wow-modal-overlay-<?php echo $val->id; ?>').fadeOut(400);
			$('html, body').css('overflow', ''); 
			$('#wow-modal-close-<?php echo $val->id; ?>').fadeOut(400);
			Click<?php echo $val->id; ?> = 0;
			});
			<?php if ($val->use_cookies == 'yes'){;?>
			$.cookie('wow-modal-id-<?php echo $val->id;?>', 'yes', { expires: <?php if (empty($val->modal_cookies)) {echo 1;} else {echo $val->modal_cookies;};?>, path: '/' });
			<?php } ?>
	}); 
	function showclose_<?php echo $val->id; ?>() { 	
	var show_close = 0; 
	setTimeout(function(){
		$('#wow-modal-close-<?php echo $val->id; ?>').fadeIn(400); 
		}, show_close); 
	}  
	<?php if (!empty($val->close_button_esc) ){ ?> 
	$(this).keydown(function(eventObject){
		if (eventObject.which == 27){			
			$('#wow-modal-window-<?php echo $val->id; ?>').fadeOut(400,function(){			
			$('#wow-modal-overlay-<?php echo $val->id; ?>').fadeOut(400);
			$('html, body').css('overflow', ''); 
			$('#wow-modal-close-<?php echo $val->id; ?>').fadeOut(400); 
			Click<?php echo $val->id; ?> = 0;
			});
			<?php if ($val->use_cookies == 'yes'){;?>
			$.cookie('wow-modal-id-<?php echo $val->id;?>', 'yes', { expires: <?php if (empty($val->modal_cookies)) {echo 1;} else {echo $val->modal_cookies;};?>, path: '/' });
			<?php } ?>
		} 
	});  
	 <?php } ?> 
	<?php if (!empty($val->close_button_overlay)){ ?> 	
		$('#wow-modal-overclose-<?php echo $val->id;?>').click( function(){		
			$('#wow-modal-window-<?php echo $val->id; ?>').fadeOut(400, function(){			
			$('#wow-modal-overlay-<?php echo $val->id; ?>').fadeOut(400);
			$('html, body').css('overflow', ''); 
			$('#wow-modal-close-<?php echo $val->id; ?>').fadeOut(400);
			Click<?php echo $val->id; ?> = 0;
			});
			<?php if ($val->use_cookies == 'yes'){;?>
			$.cookie('wow-modal-id-<?php echo $val->id;?>', 'yes', { expires: <?php if (empty($val->modal_cookies)) {echo 1;} else {echo $val->modal_cookies;};?>, path: '/' });
			<?php } ?>
	}); 	
	<?php } ?> 	
}); 
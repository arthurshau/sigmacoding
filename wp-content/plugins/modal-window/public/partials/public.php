<?php if ( ! defined( 'ABSPATH' ) ) exit; 
	$content_close = '<span class="fa-stack fa-lg">
	<i class="fa fa-circle fa-stack-2x" id="close-circle-'.$val->id.'"></i>
	<i class="fa fa-times fa-stack-1x fa-inverse" id="close-times-'.$val->id.'"></i></span>';
	$button_width = "150"; 
	$button_width_top = $button_width/2;
	
	if(empty($val->umodal_button_text )){
	$umodal_button_text = "Feedback"; }
	else{
		$umodal_button_text = $val->umodal_button_text;
	}		
	if ($val->umodal_button_position == "wow_modal_button_right" || $val->umodal_button_position == "wow_modal_button_left"){
		$button_position = "margin-top:".$button_width_top."px";
	}
	else{
		$button_position = "";
	}
	$modal = '';
	if ($val->umodal_button == 'yes')
	$modal .= '<div class="wow-modal-botton-'.$val->id.' '.$val->umodal_button_position.'" style="width:'.$button_width.'px;'.$button_position.'" id="wow-modal-id-'.$val->id.'">'.$umodal_button_text.'</div>';
	$modal .= '<div id="wow-modal-overlay-'.$val->id.'" class="wow-modal-overlay">';	
	$modal .= '<div id="wow-modal-overclose-'.$val->id.'" class="wow-modal-overclose"></div>';     
	$modal .= '<div id="wow-modal-window-'.$val->id.'" class="wow-modal-window">';
	$modal .= '<div id="wow-modal-close-'.$val->id.'">'.$content_close.'</div>';
	$modal .= do_shortcode(html_entity_decode($val->content));	 
	$modal .= '</div></div>';	 
	echo $modal;	 
?>
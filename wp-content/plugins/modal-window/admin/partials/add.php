<?php if ( ! defined( 'ABSPATH' ) ) exit; 
include ('include/data.php'); ?>
<form action="admin.php?page=<?php echo $this->pluginname; ?>" method="post">	
	<div class="wowcolom">		
		<div id="wow-leftcol">		
			<input  placeholder="Name is used only for admin purposes" type='text' name='title' value="<?php echo $title; ?>" class="input-100 wow-title"/>
			<div class="wow-admin">
				<?php wp_editor(stripcslashes($content), 'content', $settings); ?>
			</div>
			<div class="tab-box wow-admin">
				<ul class="tab-nav">
					<li><a href="#t1"><i class="fa fa-css3" aria-hidden="true"></i> Style</a></li>					
					<li><a href="#t3"><i class="fa fa-times-circle" aria-hidden="true"></i> Close Button</a></li>
					<li><a href="#t4"><i class="fa fa-eye" aria-hidden="true"></i> Display</a></li>					
					<li><a href="#t6"><i class="fa fa-hand-pointer-o" aria-hidden="true"></i> Button</a></li> 
					<li><a href="#t7"><i class="fa fa-flag-o" aria-hidden="true"></i> Icons</a></li>  					
				</ul>
				<div class="tab-panels">
					<div id="t1">
						<div class="itembox">
							<div class="item-title">
								<h3>Style</h3>									
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-4">
									Width:<br/>
									<input type='text' placeholder="662"  name='modal_width' value="<?php echo $modal_width; ?>" style="margin-bottom:5px;"/><br/> 
									<input name="modal_width_par" type="radio" value="px" <?php if($modal_width_par=='px') { echo 'checked="checked"'; } ?>>px <input name="modal_width_par" type="radio" value="pr" <?php if($modal_width_par=='pr') { echo 'checked="checked"'; } ?>>%
								</div>
								<div class="wow-admin-col-4">
									Height:<br/> 
									<input type='text' placeholder="auto" name='modal_height' value="<?php echo $modal_height; ?>" style="margin-bottom:5px;"/><br/> 
									<input name="modal_height_par" type="radio" value="auto" <?php if($modal_height_par=='auto') { echo 'checked="checked"'; } ?>>auto <input name="modal_height_par" type="radio" value="px" <?php if($modal_height_par=='px') { echo 'checked="checked"'; } ?>>px <input name="modal_height_par" type="radio" value="pr" <?php if($modal_height_par=='pr') { echo 'checked="checked"'; } ?>>%	
								</div>  
								<div class="wow-admin-col-4">
									Padding (px) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<input type='text'  placeholder="10" disabled="disabled" />
								</div>
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-4">
									Border width (px) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<input type='text'  placeholder="0" disabled="disabled" /> 
								</div>
								<div class="wow-admin-col-4">
									Border radius (px) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<input type='text'  placeholder="5" disabled="disabled" /> 
								</div>
								<div class="wow-admin-col-4">
									Z-index <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<input type='text'  placeholder="99999" disabled="disabled" />
								</div>
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-4">
									Background image <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<input type='text'  placeholder="link" disabled="disabled" />
								</div>
								<div class="wow-admin-col-4">
									Position <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<select disabled="disabled">										
										<option>Fixed</option> 		           		 
									</select>
								</div>
								<div class="wow-admin-col-4">
									Top position (%) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>: <input type="checkbox" checked="checked" disabled="disabled"><br/>
									<input type='text'  placeholder="10" disabled="disabled" /> 
								</div>
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-4">
									Bottom position (%) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>: <input type="checkbox" disabled="disabled"><br/>
									<input type='text'  placeholder="0" disabled="disabled" /> 
								</div>
								<div class="wow-admin-col-4">
									Left position (%) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>: <input type="checkbox" checked="checked" disabled="disabled"><br/>
									<input type='text'  placeholder="0" disabled="disabled" /> 
								</div>
								<div class="wow-admin-col-4">
									Right position (%) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>: <input type="checkbox" checked="checked" disabled="disabled"><br/>
									<input type='text'  placeholder="0" disabled="disabled" /> 
								</div>
							</div>
							<div class="wow-admin-col"> 
								<div class="wow-admin-col-4">
									Overlay <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<input type="checkbox" checked="checked" disabled="disabled"><br/>
									<div id="overlay">
										<img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/background.jpg">
									</div>
								</div>
								<div class="wow-admin-col-4">	
									Background color <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/white.jpg">
								</div>
								<div class="wow-admin-col-4">
									Border color <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/> 
									<img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/border.jpg">
								</div>
							</div>
						</div>
						<div class="itembox">
							<div class="item-title">
								<h3>Mobile Style</h3>									
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-6">
									Trigger for screens less than (px):<br/>
									<input type='text' placeholder="1024" name='screen_size' value="<?php echo $screen_size; ?>"/>
								</div>
								<div class="wow-admin-col-6">
									Width: <br/>
									<input type='text' placeholder="85" name='mobile_width' value="<?php echo $mobile_width; ?>"/> <br/>
									<input name="mobile_width_par" type="radio" value="px" <?php if($mobile_width_par=='px') { echo 'checked="checked"'; } ?>>px <input name="mobile_width_par" type="radio" value="pr" <?php if($mobile_width_par=='pr' || $mobile_width_par =='') { echo 'checked="checked"'; } ?>> %
								</div>	
							</div>
						</div>
					</div>
					<div id="t3">
						<div class="itembox">
							<div class="item-title">
								<h3>Close Button</h3>									
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-4">
									Select a type <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br> 
									<select disabled="disabled">
										<option>Icon close</option>		 	
									</select>	
								</div>
								<div class="wow-admin-col-4">
									Icon shape <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/icon.jpg">
								</div>
								<div class="wow-admin-col-4">
									Also enable closing on:<br>
									Overlay <input name="close_button_overlay" type="checkbox" value="1" <?php if(!empty($close_button_overlay)) { echo 'checked="checked"'; } ?>> Esc  <input name="close_button_esc" type="checkbox" value="1" <?php if(!empty($close_button_esc)) { echo 'checked="checked"'; } ?>>
								</div>
							</div>
							<div class="wow-admin-col">	
								<div class="wow-admin-col-4">
									Size (px) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<input type='text'  placeholder="14" disabled="disabled" />
								</div>
								<div class="wow-admin-col-4">
									Top position (px) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<input type='text'  placeholder="-15" disabled="disabled" />
								</div>
								<div class="wow-admin-col-4">
									Right position (px) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<input type='text'  placeholder="-15" disabled="disabled" />
								</div>
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-4">
									Delay (sec) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<input type='text'  placeholder="0" disabled="disabled" />
								</div>	
								<div class="wow-admin-col-4"></div>
								<div class="wow-admin-col-4"></div>
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-4">
									Background color <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/black.jpg">
								</div>		
								<div class="wow-admin-col-4">
									Color <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/> 
									<img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/white.jpg">
								</div>
								<div class="wow-admin-col-4"></div>	
							</div>
						</div>
					</div>
					<div id="t4">
						<div class="itembox">
							<div class="item-title">
								<h3>Display a Modal Window</h3>									
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-12">
									Show a modal window:<br/>
									<select name='modal_show' id="modal_show" onchange="wpchange();">        
										<option value="load" <?php if($modal_show=='load') { echo 'selected="selected"'; } ?>>When the page loads</option>
										<option value="click" <?php if($modal_show=='click') { echo 'selected="selected"'; } ?>>Click on a link (with id)</option>
										<option value="anchor" <?php if($modal_show=='anchor') { echo 'selected="selected"'; } ?>>Click on a link (with an #anchor link)</option>
										<option value="scroll" <?php if($modal_show=='scroll') { echo 'selected="selected"'; } ?>>When the window is scrolled</option>
										<option value="close" <?php if($modal_show=='close') { echo 'selected="selected"'; } ?>>When the user tries to leave the page</option>	
										<option value="hoverid" <?php if($modal_show=='hoverid') { echo 'selected="selected"'; } ?>>Hover on an element (with id)</option>
										<option value="hoveranchor" <?php if($modal_show=='hoveranchor') { echo 'selected="selected"'; } ?>>Hover on a link (with an #anchor link)</option>
									</select><br/>
									<div id="wpchange1" style="display:none; width:80%; font-size:12px;">
										Add an <b>id='wow-modal-id-X'</b> to the element, where X is the number of the modal window
									</div>
									<div id="wpchange2" style="display:none; width:80%; font-size:12px;">
										Add an anchor to the link: <b>a href='#wow-modal-id-X'</b>, where X is the number of the modal window
									</div>
								</div>
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-6 wpcookie">
									Show only once? (use cookies):<br/>
									<select name='use_cookies'>
										<option value="no" <?php if($use_cookies=='no') { echo 'selected="selected"'; } ?>>no</option>
										<option value="yes" <?php if($use_cookies=='yes') { echo 'selected="selected"'; } ?>>yes</option>        
									</select>
								</div>
								<div class="wow-admin-col-6 wpcookie">
									Reset in (days):<br/>
									<input type='text'  placeholder="5" name='modal_cookies' value="<?php echo $modal_cookies; ?>"/>
								</div>
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-6" id="delay">
									Delay (sec):<br/>
									<input type='text'  placeholder="0" name='modal_timer' value="<?php echo $modal_timer; ?>"/> 
								</div>
								<div class="wow-admin-col-6">
									<div class="reached">
										Reach (%) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
										<input type='text'  placeholder="50" disabled="disabled" />
									</div>
								</div>
							</div>
						</div>
						<div class="itembox">
							<div class="item-title">
								<h3>Animation</h3>									
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-6">
									Animate In <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<select disabled="disabled">
										<option>no</option>
									</select>
								</div>
								<div class="wow-admin-col-6">
									Animation duration (ms) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<input type='text'  placeholder="400" disabled="disabled" /> 
								</div>
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-6">
									Animate Out <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<select disabled="disabled">
										<option>no</option>
									</select>
								</div>
								<div class="wow-admin-col-6">
									Animation duration (ms) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<input type='text'  placeholder="400" disabled="disabled" /> 
								</div>
							</div>
						</div>	
					</div>	
					<div id="t6">
						<div class="itembox">
							<div class="item-title">
								<h3>Modal Window button</h3>									
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-4">
									Show button:<br/>
									<select name='umodal_button' onchange="displaybutton();">
										<option value="no" <?php if($umodal_button=='no') { echo 'selected="selected"'; } ?>>no</option>
										<option value="yes" <?php if($umodal_button=='yes') { echo 'selected="selected"'; } ?>>yes</option> 
									</select>
								</div>
								<div class="wow-admin-col-4">
									<div class="showbutton">
										Button position:<br/>
										<select name='umodal_button_position'>
											<option value="wow_modal_button_right" <?php if($umodal_button_position=='wow_modal_button_right') { echo 'selected="selected"'; } ?>><?php esc_attr_e("right", "wow-marketings") ?></option>
											<option value="wow_modal_button_left" <?php if($umodal_button_position=='wow_modal_button_left') { echo 'selected="selected"'; } ?>><?php esc_attr_e("left", "wow-marketings") ?></option>
											<option value="wow_modal_button_top" <?php if($umodal_button_position=='wow_modal_button_top') { echo 'selected="selected"'; } ?>><?php esc_attr_e("top", "wow-marketings") ?></option>
											<option value="wow_modal_button_bottom" <?php if($umodal_button_position=='wow_modal_button_bottom') { echo 'selected="selected"'; } ?>><?php esc_attr_e("bottom", "wow-marketings") ?></option>
										</select>
									</div>
								</div>
								<div class="wow-admin-col-4">
									<div class="showbutton">
										Button's text:<br/>
										<input type="text" name="umodal_button_text" value="<?php echo $umodal_button_text; ?>" placeholder="Feedback"/>
									</div>
								</div>
							</div>
							<div class="wow-admin-col showbutton">
								<div class="wow-admin-col-4">
									Button's text size (em) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<input type='text'  placeholder="1.2" disabled="disabled" /> 
								</div>
								<div class="wow-admin-col-4">
									Animation <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<select disabled="disabled">
										<option>no</option>										
									</select>								
								</div>
								<div class="wow-admin-col-4">
									Animation duration (sec) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>						
									<input type='text'  placeholder="1" disabled="disabled" /> 
								</div>
							</div>
							<div class="wow-admin-col showbutton">
								<div class="wow-admin-col-4">
									Animation Time (sec) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>						
									<input type='text'  placeholder="5" disabled="disabled" />
								</div>
								<div class="wow-admin-col-4">
									Animation Pause (sec) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a> :<br/>						
									<input type='text'  placeholder="5" disabled="disabled" />
								</div>
								<div class="wow-admin-col-4"></div>
							</div>
							<div class="wow-admin-col showbutton">
								<div class="wow-admin-col-4">
									Button Text color <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/white.jpg">
								</div>
								<div class="wow-admin-col-4">
									Button Text hover color <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/white.jpg">
								</div>
								<div class="wow-admin-col-4">
									Button color <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/black.jpg">
								</div>
							</div>
							<div class="wow-admin-col showbutton">
								<div class="wow-admin-col-4">
									Button hover color <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/black.jpg">
								</div>
								<div class="wow-admin-col-4"></div>
								<div class="wow-admin-col-4"></div>
							</div>
						</div>	
					</div>
					<div id="t7">
						<div class="itembox">
							<div class="item-title">
								<h3>Generate Icon</h3>									
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-4">
									Select Icon <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/icon.jpg">	
								</div>							
								<div class="wow-admin-col-4">
									Icon color <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<img src="<?php echo plugin_dir_url( __FILE__ ); ?>img/black.jpg">
								</div>
								<div class="wow-admin-col-4">
									Icon size (px) <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<input type='text'  placeholder="24" disabled="disabled" />
								</div>
							</div>	
							<div class="wow-admin-col">
								<div class="wow-admin-col-4">
									Icon link <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<input type='text'  placeholder="https://wow-estore.com/" disabled="disabled" />									
								</div>
								<div class="wow-admin-col-4">
									Link target <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
									<select disabled="disabled">
										<option>_blank</option>																		
									</select>
								</div>
								<div class="wow-admin-col-4"></div>
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-12">
									<center><input type="button" value="GENERATE" class="wow-btn"></center>
								</div>	
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-12">
									<b>Shortcode <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:</b><br/>									
								</div>						
							</div>
							<div class="wow-admin-col">
								<div class="wow-admin-col-12">
									<b>Preview <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:</b><br/>									
								</div>						
							</div>
						</div>	
					</div>					
				</div>
			</div>			
		</div>
		<div id="wow-rightcol">
			<div class="wowbox">
				<h3>Publish</h3>
				<div class="wow-admin" style="display: block;">
					<div class="wow-admin-col">
						<div class="wow-admin-col-6">
							<?php if ($id != ""){ echo '<p class="wowdel"><a href="admin.php?page='.$pluginname.'&info=del&did='.$id.'">Delete</a></p>';}; ?>
						</div>
						<div class="wow-admin-col-6 right">
							<p/>
							<input name="submit" id="submit" class="button button-primary" value="<?php echo $btn; ?>" type="submit">
						</div>
					</div>
				</div>
			</div>
			<div class="wowbox">
				<h3>Display</h3>
				<div class="inside wow-admin" style="display: block;">
					<div class="wow-admin-col wow-wrap">
						<div class="wow-admin-col-12">
							Show for users: <br/>
							<input type="radio" checked="checked"> All users <br />
							<input type="radio" disabled="disabled"> If a user logged in <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a><br />
							<input type="radio" disabled="disabled"> If user not logged <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a> 
						</div>	
						<div class="wow-admin-col-12">
							<input type="checkbox" disabled="disabled"> Show after popup<a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>							
						</div>
						<div class="wow-admin-col-12">
							<input type="checkbox" disabled="disabled"> Don’t show on screens less than (px)<a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>							
						</div>
						<div class="wow-admin-col-12">
							<input type="checkbox" disabled="disabled"> Depending on the language <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>
						</div>
						<div class="wow-admin-col-12">
							Show modal window  <a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' title="Only Pro version"><span class="dashicons dashicons-lock" style="color:#37c781;"></span></a>:<br/>
							<select disabled="disabled">
								<option value="shortecode">Where shortcode is inserted</option>
							</select>							
						</div>
						<div class="wow-admin-col-12">
							<b>[Wow-Modal-Windows  id=<?php echo $id; ?>]</b>
						</div>
					</div>
				</div>
			</div>
			<div class="wowbox">
				<h3><i class="fa fa-star" style="color:#ffd400"></i> Review </h3>
				<div class="wow-admin wow-plugins">
					<p><a href="https://wordpress.org/plugins/modal-window/" target="_blank">Leave your rating and review</a> on the work of the plugin and get a 30% discount on all plugins on site https://wow-estore.com. <a href="admin.php?page=<?php echo $pluginname;?>&tool=pro" target="_blank">More information</a> <br/><br/>
						<em>Best Regards,<br/>
							<a href="https://wow-estore.com/author/admin/?author_downloads=true" target="_blank">Wow-Company Team</a><br/>
						<a href="mailto:wow@wow-company.com">wow@wow-company.com</a></em>
					</p>					
				</div>
			</div>
		</div>
	</div>	    
	<input type="hidden" name="add" value="<?php echo $hidval; ?>" />    
	<input type="hidden" name="id" value="<?php echo $id; ?>" />
	<input type="hidden" name="data" value="<?php echo $data; ?>" />
	<input type="hidden" name="page" value="<?php echo $pluginname;?>" />	
	<input type="hidden" name="plugdir" value="<?php echo $pluginname;?>" />		
	<?php wp_nonce_field('wow_plugin_action','wow_plugin_nonce_field'); ?>
</form>
<?php
	global $wpdb;
	$data = $wpdb->prefix . "modalsimple";
	$info = (isset($_REQUEST["info"])) ? $_REQUEST["info"] : '';
	if ($info == "saved") {
		echo "<div class='updated' id='message'><p><strong>Record Added</strong>.</p></div>";
	}
	if ($info == "update") {
		echo "<div class='updated' id='message'><p><strong>Record Updated</strong>.</p></div>";
	}
	if ($info == "del") {
		$delid = $_GET["did"];
		$wpdb->query("delete from " . $data . " where id=" . $delid);
		$file_style = $this->plugindir.'asset/css/style-'.$delid.'.css';
		$file_script = $this->plugindir.'asset/js/script-'.$delid.'.js';
		wp_delete_file($file_style);
		wp_delete_file($file_script);		
		echo "<div class='updated' id='message'><p><strong>Record Deleted</strong>.</p></div>";
	}
	$resultat = $wpdb->get_results("SELECT * FROM " . $data . " order by id asc");
	$count = count($resultat);
?>
<div class="wow">
    <span class="wow-plugin-title"><?php echo $name; ?></span> <span class="wow-plugin-version">(version <?php echo $version; ?>)</span>
	<ul class="wow-admin-menu">
		<li><a href='admin.php?page=<?php echo $pluginname;?>' title="List of Records">List <i class="fa fa-list"></i></a></li>
		<?php if($count<3){?>
			<li><a href='admin.php?page=<?php echo $pluginname;?>&tool=add' title="Add New Record">Add new <i class="fa fa-plus"></i></a></li>	
		<?php } ?>
		<li><a href='admin.php?page=<?php echo $pluginname;?>&tool=pro' >Pro version <i class="fa fa-external-link"></i></a></li>
		<li><a href='https://wordpress.org/support/plugin/modal-window' target="_blank" title="Support page">Support <i class="fa fa-life-ring"></i></a></li>
		<li><a href='https://wordpress.org/plugins/modal-window/#reviews' target="_blank" title="Rate this plugin">Rate Us <i class="fa fa-star"></i></a></li>
		<li><a href='https://www.facebook.com/wowaffect/' target="_blank" title="Join Us on Facebook">Join Us <i class="fa fa-facebook"></i></a></li>	
	</ul>
	<?php
		$tool= (isset($_REQUEST["tool"])) ? sanitize_text_field($_REQUEST["tool"]) : '';
		if ($tool == "add"){
			include_once( 'add.php' );
			return;	
		}
		if ($tool == ""){
			include_once( 'list.php' );
			return;
		}		
		if ($tool == "pro"){
			include_once( 'pro.php' );	
			return;
		}
		else {		
		}
	?>
</div>
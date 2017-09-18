<?php



/*

Plugin Name: Flipping Cards

Plugin URI: 

Version: 1.2

Description: Create sexy flipping cards !

Author: Manu225

Author URI: 

Network: false

Text Domain: flipping-cards

Domain Path: 

*/



register_activation_hook( __FILE__, 'flipping_cards_install' );

//register_deactivation_hook( __FILE__, 'flipping_cards_desinstall' );

register_uninstall_hook(__FILE__, 'flipping_cards_desinstall');

function flipping_cards_install() {



	global $wpdb;



	$flipping_cards_table = $wpdb->prefix . "flipping_cards";

	$flipping_cards_images_table = $wpdb->prefix . "flipping_cards_images";



	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');



	$sql = "

        CREATE TABLE `".$flipping_cards_table."` (

          id int(11) NOT NULL AUTO_INCREMENT,          

          name varchar(50) NOT NULL,

          width int(11) NOT NULL,

          height int(11) NOT NULL,

          PRIMARY KEY  (id)

        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

    ";



    dbDelta($sql);



    $sql = "

        CREATE TABLE `".$flipping_cards_images_table."` (

          id int(11) NOT NULL AUTO_INCREMENT,          

          text varchar(500) NOT NULL,

          image varchar(500) NOT NULL,

          link varchar(500) NOT NULL,

          blank int(1) NOT NULL,

          `order` int(11) NOT NULL,

          id_card int(11),

          PRIMARY KEY  (id)

        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

    ";

    

    dbDelta($sql);

}



function flipping_cards_desinstall() {



	global $wpdb;



	$flipping_cards_table = $wpdb->prefix . "flipping_cards";

	$flipping_cards_images_table = $wpdb->prefix . "flipping_cards_images";



	//suppression des tables

	$sql = "DROP TABLE ".$flipping_cards_table.";";

	$wpdb->query($sql);



    $sql = "DROP TABLE ".$flipping_cards_images_table.";";   

	$wpdb->query($sql);

}



add_action( 'admin_menu', 'register_flipping_cards_menu' );



function register_flipping_cards_menu() {



	add_menu_page('Flipping Cards', 'Flipping Cards', 'edit_pages', 'flipping_cards', 'flipping_cards',   '', 32);



}



add_action('admin_print_styles', 'flipping_cards_css' );

function flipping_cards_css() {

    wp_enqueue_style( 'FlippingCardsStylesheet', plugins_url('css/admin.css', __FILE__) );

}



// UPLOAD ENGINE

function load_wp_media_files() {

    wp_enqueue_media();

}

add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );

   

function flipping_cards() {



	if (is_admin()) {



		global $wpdb;



		$flipping_cards_table = $wpdb->prefix . "flipping_cards";

		$flipping_cards_images_table = $wpdb->prefix . "flipping_cards_images";



		if(is_numeric($_GET['id']))

		{

			//on récupère toutes les cards

			$card = $wpdb->get_row("SELECT * FROM ".$flipping_cards_table." WHERE id=".$_GET['id']);

			$images = $wpdb->get_results("SELECT * FROM ".$flipping_cards_images_table." WHERE id_card = ".$_GET['id']." ORDER BY `order` ASC", OBJECT);

			include(plugin_dir_path( __FILE__ ) . 'views/card.php');

		}

		else

		{

			if(sizeof($_POST) > 0)

			{

				if(empty($_POST['name']))

					echo '<h2>You must enter a name for your flipping card !</h2>';

				else if(!is_numeric($_POST['id'])) //nouvelle flipping card

				{

					check_admin_referer( 'new_fc' );

					$query = $wpdb->prepare( "INSERT INTO ".$flipping_cards_table." (`name`, `width`, `height`) VALUES (%s, %d, %d)", stripslashes_deep($_POST['name']), $_POST['width'], $_POST['height']);

					$wpdb->query($query);

					//$wpdb->insert( $flipping_cards_table , array('name' => stripslashes_deep($_POST['name']), 'width' => esc_sql($_POST['width']), 'height' => esc_sql($_POST['height'])) );



				}

				else //mise à jour d'un flipping card

				{

					check_admin_referer( 'update_fc_'.$_POST['id'] );

					$query = $wpdb->prepare( "UPDATE ".$flipping_cards_table." SET `name` = %s, `width` = %d, `height` = %d WHERE id = %d",

					stripslashes_deep($_POST['name']), $_POST['width'], $_POST['height'], $_POST['id'] );

					$wpdb->query($query);

				}

			}

			

			//on récupère toutes les cards

			$cards = $wpdb->get_results("SELECT * FROM ".$flipping_cards_table);

			include(plugin_dir_path( __FILE__ ) . 'views/cards.php');

		}

	}

}



//Ajax : suppression d'un flipping card

add_action( 'wp_ajax_remove_fc', 'remove_fc_callback' );



function remove_fc_callback() {



	check_ajax_referer( 'remove_fc' );



	if (is_admin()) {



		global $wpdb; // this is how you get access to the database



		$flipping_cards_table = $wpdb->prefix . "flipping_cards";

		$flipping_cards_images_table = $wpdb->prefix . "flipping_cards_images";



		if(is_numeric($_POST['id']))

		{

			//supprime toutes les images

			$query = $wpdb->prepare( 

				"DELETE FROM ".$flipping_cards_images_table."

				 WHERE id_card=%d", $_POST['id']

			);

			$res = $wpdb->query( $query	);

			//supprime la flipping card

			$query = $wpdb->prepare( 

				"DELETE FROM ".$flipping_cards_table."

				 WHERE id=%d", $_POST['id']

			);

			$res = $wpdb->query( $query	);

		}

		wp_die(); // this is required to terminate immediately and return a proper response

	}

}



//Ajax : ajout d'une image

add_action( 'wp_ajax_fc_add_image', 'fc_add_image' );



function fc_add_image() {



	check_admin_referer( 'new_image_fc' );



	if (is_admin()) {



		global $wpdb;



		$flipping_cards_images_table = $wpdb->prefix . "flipping_cards_images";



		if(is_numeric($_POST['id']) && !empty($_POST['image']))

		{

			$max_order = $wpdb->get_row( $wpdb->prepare( "SELECT MAX(`order`) as max_order FROM ".$flipping_cards_images_table." WHERE id_card = %d", $_POST['id'] ));

			if($max_order)

				$max_order = ($max_order->max_order+1);

			else

				$max_order = 1;

			$query = $wpdb->prepare( "INSERT INTO ".$flipping_cards_images_table." (`image`, `text`, `link`, `blank`, `order`, `id_card`) VALUES (%s, %s, %s, %d, %d, %d)", $_POST['image'], stripslashes_deep($_POST['text']), stripslashes_deep($_POST['link']), ($_POST['blank'] == '1' ? 1 : 0), $max_order, $_POST['id'] );

			$res = $wpdb->query( $query	);

			//$wpdb->insert( $flipping_cards_images_table, array('image' => esc_sql($_POST['image']), 'text' => stripslashes_deep($_POST['text']), 'link' => stripslashes_deep($_POST['link']), 'blank' => ($_POST['blank'] == '1' ? '1' : '0'), 'order' => $max_order, 'id_card' => $_POST['id'] ));

		}

		wp_die($wpdb->insert_id); // this is required to terminate immediately and return a proper response

	}

}



//Ajax : update d'une image	

add_action( 'wp_ajax_fc_save_img', 'fc_save_img');



function fc_save_img() {



	check_admin_referer( 'update_image_fc_'.$_POST['id'] );



	if (is_admin()) {	

		if(is_numeric($_POST['id']) && !empty($_POST['image']))

		{

			global $wpdb;



			$flipping_cards_images_table = $wpdb->prefix . "flipping_cards_images";



			$query = $wpdb->prepare( "UPDATE ".$flipping_cards_images_table." SET `image` = %s, `text` = %s, `link` = %s, `blank` = %d WHERE id = %d",

			$_POST['image'], stripslashes_deep($_POST['text']), stripslashes_deep($_POST['link']), ($_POST['blank'] == '1' ? 1 : 0), $_POST['id'] );

			$res = $wpdb->query( $query	);

		}

	}

}



//Ajax : suppression d'une image

add_action( 'wp_ajax_fc_remove_img', 'fc_remove_img' );



function fc_remove_img() {



	check_ajax_referer( 'remove_image_fc' );



	if (is_admin()) {

		global $wpdb;



		$flipping_cards_images_table = $wpdb->prefix . "flipping_cards_images";



		if(is_numeric($_POST['id']))

		{

			//on trouve l'ordre de l'image à supprimer

			$query = $wpdb->prepare( 

				"SELECT `order`, id_card FROM ".$flipping_cards_images_table."

				 WHERE id=%d", $_POST['id']

			);



			$image = $wpdb->get_row( $query );



			if($image)

			{

				//on supprime l'image

				$query = $wpdb->prepare( 

					"DELETE FROM ".$flipping_cards_images_table."

					 WHERE id=%d", $_POST['id']

				);



				$res = $wpdb->query( 

					$query

				);



				//on redifini les ordres des autres images

				$query = $wpdb->prepare( 

					"UPDATE ".$flipping_cards_images_table."

					 SET `order` = `order` - 1

					 WHERE id_card=%d

					 AND `order` >= %d", $image->id_card, $image->order

				);



				$res = $wpdb->query( 

					$query

				);



			}

		}

		wp_die(); // this is required to terminate immediately and return a proper response

	}

}



//Ajax : changement de position d'une image

add_action( 'wp_ajax_fc_order_img', 'fc_order_img' );



function fc_order_img() {



	check_ajax_referer( 'order_image_fc' );



	if (is_admin()) {

		global $wpdb;



		$flipping_cards_images_table = $wpdb->prefix . "flipping_cards_images";



		if(is_numeric($_POST['id']) && is_numeric($_POST['order']))

		{

			$image = $wpdb->get_row( $wpdb->prepare( "SELECT id_card, `order` FROM ".$flipping_cards_images_table." WHERE id = %d", $_POST['id'] ));

			if($_POST['order'] > $image->order)

				$wpdb->query( $wpdb->prepare( "UPDATE ".$flipping_cards_images_table." SET `order` = `order` - 1 WHERE id_card = %d AND `order` <= %d AND `order` > %d", $image->id_card, $_POST['order'], $image->order ));

			else

				$wpdb->query( $wpdb->prepare( "UPDATE ".$flipping_cards_images_table." SET `order` = `order` + 1 WHERE id_card = %d AND `order` >= %d AND `order` < %d", $image->id_card, $_POST['order'], $image->order ));

			$wpdb->query( $wpdb->prepare( "UPDATE ".$flipping_cards_images_table." SET `order` = %d WHERE id = %d", $_POST['order'], $_POST['id'] ));

			

		}

		wp_die(); // this is required to terminate immediately and return a proper response

	}

}



function display_flipping_card($atts) {



        if(is_numeric($atts['id']))

        {	

        	global $wpdb;



			$flipping_cards_table = $wpdb->prefix . "flipping_cards";

			$flipping_cards_images_table = $wpdb->prefix . "flipping_cards_images";



			$card = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM ".$flipping_cards_table." WHERE id = %d", $atts['id'] ));



			if($card)

			{

				$images = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM ".$flipping_cards_images_table." WHERE id_card = %d ORDER BY `order` ASC", $atts['id'] ));

				$flipping_card = '<div class="flipping-card">';

				foreach($images as $image)

				{

					$flipping_card .= '<div class="flipping-card-image" style="width: '.$card->width.'px; height: '.$card->height.'px;">

						<a href="'.$image->link.'" '.($image->blank == '1' ? 'target="_blank"' : '').'><img src="'.$image->image.'" />

						<h2 style="line-height: '.$card->height.'px;"><span>'.$image->text.'</span></h2></a>

					</div>';

				}

				$flipping_card .= '</div>';



				wp_enqueue_style( 'flipping-card', plugins_url( 'css/style.css', __FILE__ ));



				return $flipping_card;

			}

			else

				return 'Card with ID '.$atts['id'].' doesn\'t exists !';

		}



}

add_shortcode('flipping-card', 'display_flipping_card');
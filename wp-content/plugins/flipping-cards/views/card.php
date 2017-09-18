<script>

	jQuery(document).ready(function($){



		//changement d'ordre des images

		jQuery('#flipping-card').sortable({

			update: function( event, ui ) {

				//effectuer le changement de position en BDD par Ajax

				jQuery.post(ajaxurl, {action: 'fc_order_img', id: jQuery(ui.item).find('img.thumbnail').attr('rel'), order: (ui.item.index()+1), _ajax_nonce: '<?= wp_create_nonce( "order_image_fc" ); ?>' });

			}

		});

	    

		//choix d'une image

	    jQuery('.upload-btn').click(function(e) {

	    	var _this = this;

	        e.preventDefault();

	        var image = wp.media({ 

	            title: 'Upload Image',

	            // mutiple: true if you want to upload multiple files at once

	            multiple: false

	        }).open()

	        .on('select', function(e){

	            // This will return the selected image from the Media Uploader, the result is an object

	            var uploaded_image = image.state().get('selection').first();

	            // We convert uploaded_image to a JSON object to make accessing it easier

	            // Output to the console uploaded_image

	            var image_url = uploaded_image.toJSON().url;

	            // Let's assign the url value to the input field

	            jQuery(_this).parent().find('input[name="image"]').val(image_url);

	        });

	    });



	    //ajout de la carte

	    jQuery('#form_new_fc').submit(function(){

	    	//save TinyMCE
	    	//tinyMCE.triggerSave();

	    	if(jQuery('#form_new_fc input[name="image"]').val() == '')

	    		alert('Please choose an image !');

	    	else if(jQuery('#form_new_fc textarea[name=text]').val() == '')

	    		alert('Text can\'t be empty !');

	    	else

	    	{

	    		//on ajoute l'image en ajax

	    		jQuery.post(ajaxurl, jQuery(this).serialize(), function(id_img){

	    			window.location.reload();

		    	});

			}

	    	return false;

	    });



		//click suppression

	    jQuery('#flipping-card img.remove').click(function(){

	    	var _this = this;

	    	jQuery.post(ajaxurl, {action: 'fc_remove_img', id: jQuery(_this).attr('rel'), _ajax_nonce: '<?= wp_create_nonce( "remove_image_fc" ); ?>'}, function(){

	    		jQuery(_this).parent('li').remove();

	    	});

	    });



	    //click changement image

	    jQuery('#flipping-card li img.thumbnail').click(function(){

	    	var li = jQuery(this).parent('li');

	    	if(jQuery(li).hasClass('opened'))

	    		jQuery(li).removeClass('opened');

	    	else

	    	{

	    		var li_opened = jQuery('#flipping-card li.opened');

	    		if(li_opened)

	    		{

	    			jQuery(li_opened).find('.form_edit_fc_img').toggle('fast');

	    			jQuery(li_opened).removeClass('opened');

	    		}

	    		jQuery(li).addClass('opened');

	    	}

	    	jQuery(this).parent('li').find('.form_edit_fc_img').toggle('fast');

	    });



	    //click sauvegarde

	    jQuery('.form_edit_fc_img').submit(function(){

	    	var _this = this;
	    	//save TinyMCE
	    	//tinyMCE.triggerSave();

	    	if(jQuery(_this).find('input[name="image"]').val() == '')

	    		alert('Please choose an image !');

	    	else if(jQuery(_this).find('textarea[name=text]').val() == '')

	    		alert('Text can\'t be empty !');

	    	else

	    	{

		    	jQuery(_this).find('img.loading').show();

		    	jQuery.post(ajaxurl, jQuery(this).serialize(), function(){

		    		//récupère la nouvelle image

		    		var new_image = jQuery(_this).find('input[name="image"]').val();

		    		jQuery(_this).parent('li').find('img.thumbnail').attr('src', new_image);

		    		jQuery(_this).find('img.loading').hide();

		    	});

		    }

	    	return false;

	    });

	});

</script>



<h2><?= $card->name ?></h2>

<form action="" method="post" id="form_new_fc">

	<?php wp_nonce_field( 'new_image_fc' ) ?>

	<input type="hidden" name="id" value="<?= $card->id ?>" />

	<input type="hidden" name="action" value="fc_add_image" />

	<b>Add a new image</b><br />

	<label>Image : </label><input type="text" name="image"><input type="button" name="upload-btn" class="upload-btn button-secondary" value="Choose Image"><br />

	<label>Text : </label><textarea name="text"></textarea><br />

	<label>Link : </label><input type="text" name="link" /><input type="checkbox" name="blank" value="1" /> Open in a new window ?<br />

	<input type="submit" value="Add the image" />

</form>



<ul id="flipping-card">

<?php



	if(sizeof($images) > 0)

	{

		foreach($images as $img)

		{

			echo '<li><img class="thumbnail" rel="'.$img->id.'" src="'.$img->image.'" /><img class="remove" rel="'.$img->id.'" src="'.plugins_url( 'flipping-cards/images/remove.png' ).'" />

			<form class="form_edit_fc_img">'.

				wp_nonce_field( 'update_image_fc_' .$img->id, "_wpnonce", true, false ).'

				<input type="hidden" name="id" value="'.$img->id.'" />

				<input type="hidden" name="action" value="fc_save_img" />

				<label>Image : </label><input type="text" name="image" value="'.$img->image.'"><input type="button" name="upload-btn" class="upload-btn button-secondary" value="Change Image"><br />

				<label>Text : </label><textarea name="text">'.$img->text.'</textarea><br />

				<label>Link : </label><input type="text" name="link" value="'.$img->link.'" /><input type="checkbox" name="blank" value="1" '.($img->blank == 1 ? 'checked="checked"' : '').' /> Open in a new window ?<br />

				<input type="submit" value="Save" /><img src="'.plugins_url( 'flipping-cards/images/loading.gif' ).'" class="loading" />

			</form>

			</li>';

		}

	}

	else

		echo 'No image found for this flipping card !';



?>

</ul>
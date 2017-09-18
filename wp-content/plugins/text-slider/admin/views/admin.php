<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Plugin_Name
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.compact(varname)
 * @copyright 2014 Your Name or Company Name
 */

//@TODO add default fallback array.

$text_slider_settings = get_option('text_slider_settings');
$text_slider_admin_notices = get_option('text_slider_admin_notices', array());

if(!$text_slider_settings) {
  $multi_key = -1;  
  $text_slider_settings = array(
    'multi_key' => '0',   
    'text_slides' => array(),
    'delay' => 9,
    'duration' => 1,
    'maintext_fontfamily' =>  'Arial,Arial,Helvetica,sans-serif',
    'maintext_fontsize' =>  '90',
    'maintext_fontweight' =>  '400',
    'maintext_color' =>  '#ffffff',
    'subtext_fontfamily' =>  "'Times New Roman',Times,serif",
    'subtext_fontsize' =>  '60',
    'subtext_fontweight' =>  '400',
    'subtext_color' =>  '#eeeeee',
    'icon_color' => '#eeeeee',
    'icon_hover_color' => '#eeeeee',
    'icon_fontsize' => '86'


  );  

  add_option('text_slider_settings', array());

} else {
  
  $text_slider_settings = $text_slider_settings[0]; 
}

?>
<?php if(!empty($text_slider_admin_notices)) :?>
  <?php foreach((array)$text_slider_admin_notices['error_notice'] as $error) : ?>

  <div class="error">  
  <p><?php echo esc_html($error); ?></p>
  </div>
  
  <?php endforeach; ?>

  <?php foreach((array)$text_slider_admin_notices['update_notice'] as $update) : ?>

  <div class="updated">  
  <p><?php echo esc_html($update); ?></p>
  </div>  
  <?php endforeach; ?>
  <?php update_option('text_slider_admin_notices', array()); ?>
<?php endif; ?>


<div class="wrap">
<h2><?php echo __('Text Slider',$this->plugin_slug); ?></h2>
<p><?php echo __('Choose you settings for the text slider and then include it in your page by using the shortcode', $this->plugin_slug); ?> <code>[text-slider]</code><?php echo __('or including it in your theme file by using the function', $this->plugin_slug); ?> <code>wp_text_slider();</code></p>
<h4><?php echo __('Add New Text Slide',$this->plugin_slug); ?></h4>

<form method="POST" action="options.php">
<?php settings_fields( 'text_slider_settings' ); ?>
  <p>
    <label for="text_slider_settings[main_text]" style="display:inline-block; width:80px"><?php echo __('Main Text: ', $this->plugin_slug); ?></label>
    <input type="text" name="text_slider_settings[main_text]" id="main_text" size="50" />
  </p>
  <p>
    <label for="text_slider_settings[sub_text]" style="display:inline-block; width:80px"><?php echo __('Sub Text: ', $this->plugin_slug); ?></label>
    <input type="text" name="text_slider_settings[sub_text]" id="sub_text" size="50" />
  </p>
  <input type="hidden" value="<?php echo esc_attr($text_slider_settings['multi_key']) ?>" name="text_slider_settings[multi_key]" />
  <?php submit_button(__('Add', $this->plugin_slug), 'primary', 'add_slide_text'); ?>

  <br />
  <?php if(!empty($text_slider_settings['text_slides'])) : ?>
  <table class="widefat fixed" cellspacing="0">
    <thead>
      <tr>
        <th width="43%"><?php echo __('Main Text', $this->plugin_slug); ?></th>
        <th width="43%"><?php echo __('Sub Text', $this->plugin_slug); ?></th>
        <th width="14%"><?php echo __('Actions', $this->plugin_slug); ?></th>
      </tr>
    </thead>
    <tbody>
      <?php foreach((array)$text_slider_settings['text_slides'] as $key => $data) : ?>
      <tr>
        <td><input type="text" name="text_slider_settings[text_slides][<?php echo esc_attr($key); ?>][main_text]" value="<?php echo esc_attr($data['main_text']); ?>" style="width:100%" /></td>
        <td><input type="text" name="text_slider_settings[text_slides][<?php echo esc_attr($key); ?>][sub_text]" value="<?php echo esc_attr($data['sub_text']); ?>" style="width:100%" /></td>
        <td>
        <?php submit_button(__('Update', $this->plugin_slug), 'primary', 'update_slide_text', false); ?>  
        <?php submit_button(__('Delete', $this->plugin_slug), 'primary', 'delete_slide_text['.esc_attr($key).']', false); ?>         
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>  
  </table>
  <?php endif; ?>

  <p>&nbsp;</p>
  <h2><?php echo __('Text Slider Settings', $this->plugin_slug); ?></h2>
  <table class="form-table">
    <tr>
      <th scope="row"><?php echo __('Transition Delay', $this->plugin_slug); ?></th>
      <td><input type="text" name="text_slider_settings[delay]" value="<?php echo esc_attr($text_slider_settings['delay']) ?>" size="4" />
        <small><?php echo __('Length of time (in seconds) you would like each text slide to be visible.', $this->plugin_slug); ?></small></td>
    </tr>
    <tr>
      <th scope="row"><?php echo __('Transition Duration', $this->plugin_slug); ?></th>
      <td><input type="text" name="text_slider_settings[duration]" value="<?php echo esc_attr($text_slider_settings['duration']) ?>" size="4" />
        <small><?php echo __('Length of time (in seconds) you would like the transition length to be.', $this->plugin_slug); ?></small></td>
    </tr>
    <tr>
      <th scope="row"><?php echo __('Defined Height', $this->plugin_slug); ?></th>
      <td><input type="text" name="text_slider_settings[defined_height]" value="<?php echo esc_attr($text_slider_settings['defined_height']) ?>" size="4" />
        <small><?php echo __('It is strongly recommended to leave this blank as the slider calculates its own height. If you must have a fixed value then enter a value for the height in pixels', $this->plugin_slug); ?></small></td>
    </tr>
    <tr>
      <th scope="row"><?php echo __('Custom CSS', $this->plugin_slug); ?></th>
      <td><textarea class="large-text code" name = "text_slider_settings[custom_css]" ><?php echo esc_textarea($text_slider_settings['custom_css']); ?></textarea>
        <small><?php echo __('CSS that you may want to add to override the default CSS', $this->plugin_slug); ?></small></td>
    </tr>
    <tr>
      <th scope="row"><?php echo __('Specifiy Font Details', $this->plugin_slug); ?></th>
      <td>
        <input type="radio" name="text_slider_settings[use_font_css]"  value="1" <?php checked( $text_slider_settings['use_font_css'], '1' ); ?> /><?php echo __('Yes', $this->plugin_slug); ?>
        <input type="radio" name="text_slider_settings[use_font_css]"  value="0" <?php checked( $text_slider_settings['use_font_css'], '0'  ); ?> /><?php echo __('No', $this->plugin_slug); ?><br />
        <small><?php echo __('Select YES if you want to choose your font styles below. Select NO if you prefer to style the plugin yourself using the custom CSS box above.', $this->plugin_slug); ?></small>
      </td>
    </tr>
    <tr>
      <th scope="row"><?php echo __('Main Text Font', $this->plugin_slug); ?></th>
      <td>
        <div id="maintext-font" class="fontSelect font-select">
          <div class="arrow-down"></div>
        </div>
        <input name="text_slider_settings[maintext_fontfamily]" id="maintext-font" value="<?php echo esc_attr($text_slider_settings['maintext_fontfamily']);?>" type="hidden" />
        <small><?php echo __('Select a font for the main text'); ?></small>
      </td>
    </tr>
    <tr>
      <th scope="row"><?php echo __('Main Text Font Size', $this->plugin_slug); ?></th>
      <td><input type="text" name="text_slider_settings[maintext_fontsize]" value="<?php echo esc_attr($text_slider_settings['maintext_fontsize']); ?>" size="4" />
      <small><?php echo __('The font size in pixels.', $this->plugin_slug); ?></small>
      </td>
    </tr>
    <tr>
      <th scope="row"><?php echo __('Main Text Font Weight', $this->plugin_slug); ?></th>
      <td><input type="text" name="text_slider_settings[maintext_fontweight]" value="<?php echo esc_attr($text_slider_settings['maintext_fontweight']); ?>" size="4" />
        <small><?php echo __('The font weight. Allowable values are 200, 400 or 600.', $this->plugin_slug); ?></small>
      </td>
    </tr>
    <tr>
      <th scope="row"><?php echo __('Main Text Font Color', $this->plugin_slug); ?></th>
      <td><input type="text" name="text_slider_settings[maintext_color]" value="<?php echo esc_attr($text_slider_settings['maintext_color']); ?>" class="my-color-field"  /><br />
        <small><?php echo __('Choose a color for the font for the main text',$this->plugin_slug); ?></small>
      </td>
    </tr>
    <tr>
      <th scope="row"><?php echo __('Sub Text Font',$this->plugin_slug); ?></th>
      <td>
        <div id="subtext-font" class="fontSelect font-select">
          <div class="arrow-down"></div>
        </div>
        <input name="text_slider_settings[subtext_fontfamily]" id="subtext-font" value="<?php echo esc_attr($text_slider_settings['subtext_fontfamily']); ?>" type="hidden" />
        <small><?php echo __('Select a font for the sub text', $this->plugin_slug); ?></small>
      </td>
    </tr>
    <tr>
      <th scope="row"><?php echo __('Sub Text Font Size', $this->plugin_slug); ?></th>
      <td><input type="text" name="text_slider_settings[subtext_fontsize]" value="<?php echo esc_attr($text_slider_settings['subtext_fontsize']) ;?>" size="4" />
      <small><?php echo __('The font size in pixels.', $this->plugin_slug); ?></small>
      </td>
    </tr>
    <tr>
      <th scope="row"><?php echo __('Sub Text Font Weight', $this->plugin_slug); ?></th>
      <td><input type="text" name="text_slider_settings[subtext_fontweight]" value="<?php echo esc_attr($text_slider_settings['subtext_fontweight']); ?>" size="4" />
        <small><?php echo __('The font weight. Allowable values are 200, 400 or 600.'); ?></small>
      </td>
    </tr>
    <tr>
      <th scope="row"><?php echo __('Sub Text Font Color', $this->plugin_slug); ?></th>
      <td><input type="text" name="text_slider_settings[subtext_color]" value="<?php echo esc_attr($text_slider_settings['subtext_color']); ?>" class="my-color-field"  /><br />
        <small><?php echo __('Choose a color for the font the sub text', $this->plugin_slug); ?></small>
      </td>
    </tr>
    <tr>
      <th scope="row"><?php echo __('Navigation Color', $this->plugin_slug); ?></th>
      <td><input type="text" name="text_slider_settings[icon_color]" value="<?php echo esc_attr($text_slider_settings['icon_color']); ?>" class="my-color-field"  /><br />
        <small><?php echo __('Choose a color for navigation icons.',$this->plugin_slug); ?></small>
      </td>
    </tr>
    <tr>
      <th scope="row"><?php echo __('Navigation Hover Color', $this->plugin_slug); ?></th>
      <td><input type="text" name="text_slider_settings[icon_hover_color]" value="<?php echo esc_attr($text_slider_settings['icon_hover_color']); ?>" class="my-color-field"  /><br />
        <small><?php echo __('Choose a color for the navigation icons when the mouse pointer hovers over.',$this->plugin_slug); ?></small>
      </td>
    </tr>
    <tr>
      <th scope="row"><?php echo __('Navigation Icon Size', $this->plugin_slug); ?></th>
      <td><input type="text" name="text_slider_settings[icon_fontsize]" value="<?php echo esc_attr($text_slider_settings['icon_fontsize']) ;?>" size="4" />
      <small><?php echo __('The icon size in pixels.', $this->plugin_slug); ?></small>
      </td>
    </tr>
  </table>
  <?php submit_button(__('Save Settings'), 'primary', 'add_text_slider', $this->plugin_slug); ?>        
</form>
</div>
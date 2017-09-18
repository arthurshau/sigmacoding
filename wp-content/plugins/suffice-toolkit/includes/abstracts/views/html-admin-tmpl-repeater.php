<?php
/**
 * Admin View: Template - Repeater Field
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$repeater_field_id = strtolower( str_replace( ' ', '-', $setting['title'] ) ) . '-{{ data.field_id }}';
$max_field_entries = count( $value ) >= apply_filters( 'suffice_toolkit_maximum_repeater_field_entries', 5 ) ? 'disabled' : 'enabled';

?>
<div id="tg-widget-repeater-field" class="accordion-sortables">
	<p><label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo esc_html( $setting['label'] ); ?></label></p>
	<ul class="tg-widget-repeater-field-items" data-widget_id="<?php echo esc_attr( $this->id ); ?>">
		<?php if ( ! empty( $value ) ) : ?>
			<?php foreach ( $value as $field_key => $field ) : ?>
				<li class="tg-widget-accordion-item" data-id="<?php echo esc_attr( $field_key ); ?>">
					<div class="accordion-top">
						<div class="accordion-title-action"><a class="accordion-action" href="#available-fields"></a></div>
						<div class="accordion-title"><h3><?php echo esc_attr( $setting['title'] ); ?><span class="in-accordion-title"></span></h3></div>
					</div>
					<div class="accordion-inside">
						<?php $this->output_repeater_field( $setting['fields'], $instance, $key, $field_key, $setting['std'] ); ?>
						<div class="accordion-control-actions alignright">
							<a href="#" class="accordion-control-remove"><?php esc_html_e( 'Delete', 'suffice-toolkit' ); ?></a> | <a href="#" class="accordion-control-close"><?php esc_html_e( 'Close', 'suffice-toolkit' ); ?></a>
						</div>
						<br class="clear">
					</div>
				</li>
			<?php endforeach; ?>
		<?php endif; ?>
	</ul>
	<div class="tg-widget-repeater-field-button">
		<p><a href="#" class="button button-secondary tg-widget-repeater-field-add <?php echo esc_attr( $max_field_entries ); ?>"><?php echo esc_html( $setting['button'] ); ?></a></p>
	</div>
	<?php if ( isset( $setting['desc'] ) ) : ?>
		<small><?php echo wp_kses_post( $setting['desc'] ); ?></small>
	<?php endif; ?>
</div>

<script type="text/html" id="tmpl-tg-widget-repeater-field-<?php echo esc_attr( $this->id ); ?>">
	<li class="tg-widget-accordion-item open" data-id="<?php echo esc_attr( $repeater_field_id ); ?>">
		<div class="accordion-top">
			<div class="accordion-title-action"><a class="accordion-action" href="#available-fields"></a></div>
			<div class="accordion-title"><h3><?php echo esc_attr( $setting['title'] ); ?><span class="in-accordion-title"></span></h3></div>
		</div>
		<div class="accordion-inside">
			<?php $this->output_repeater_field( $setting['fields'], $instance, $key, $repeater_field_id, $setting['std'] ); ?>
			<div class="accordion-control-actions alignright">
				<a href="#" class="accordion-control-remove"><?php esc_html_e( 'Delete', 'suffice-toolkit' ); ?></a> | <a href="#" class="accordion-control-close"><?php esc_html_e( 'Close', 'suffice-toolkit' ); ?></a>
			</div>
			<br class="clear">
		</div>
	</li>
</script>

<script type="text/html" id="tmpl-tg-widget-repeater-field-blank">
	<li class="tg-widget-repeater-field-blank-state">
		<h3 class="tg-widget-repeater-field-BlankState-message"><?php _e( 'When you add field, it will appear here.', 'suffice-toolkit' ); ?></h3>
		<a class="tg-widget-repeater-field-BlankState-cta button-primary tg-widget-repeater-field-add" href="#"><?php _e( 'Create your first field!', 'suffice-toolkit' ); ?></a>
	</li>
</script>

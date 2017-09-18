<?php
/**
 * The template for displaying portfolio widget.
 *
 * This template can be overridden by copying it to yourtheme/suffice-toolkit/content-widget-portfolio.php.
 *
 * HOWEVER, on occasion SufficeToolkit will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     http://docs.themegrill.com/suffice-toolkit/template-structure/
 * @author  ThemeGrill
 * @package SufficeToolkit/Templates
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$categories    = isset( $instance['categories'] ) ? $instance['categories'] : '';
$number        = isset( $instance['number'] ) ? $instance['number'] : '';
$filter        = empty( $instance['filter'] ) ? 0 : 1;
$style         = isset( $instance['style'] ) ? $instance['style'] : 'portfolio-with-text';
$column        = isset( $instance['column'] ) ? $instance['column'] : '4';
?>
<?php
$output = ''; // Start output.
$output .= '<div class="portfolio-container">';


if ( $filter && ! $categories ) {
	$terms = get_terms( 'portfolio_cat' );

	// Filter.
	$output .= '<nav class="portfolio-navigation portfolio-navigation-normal portfolio-navigation-center">';
	$output .= '<ul class="navigation-portfolio">';
	$output .= '<li class="active"><a data-filter="*">' . esc_html__( 'All', 'suffice-toolkit' ) . '</a></li>';
	$count = count( $terms );
	if ( $count > 0 ) {
		foreach ( $terms as $term ) {
			$output .= "<li><a data-filter='." . $term->slug . "'>" . $term->name . "</a></li>\n";
		}
	}
	$output .= '</ul>';
	$output .= '</nav>';
}

if ( '0' === $categories ) {
	$terms          = get_terms( 'portfolio_cat' );
	$included_terms = wp_list_pluck( $terms, 'term_id' );
} else {
	$included_terms = $categories;
}

// Grid.
$output .= '<ul class="portfolio-items row ' . $style . '">';

$project_query = new WP_Query(
	array(
		'post_type'      => 'portfolio',
		'posts_per_page' => $number,
		'tax_query' => array(
	        array(
	            'taxonomy' => 'portfolio_cat',
	            'field'    => 'id',
	            'terms'    => $included_terms,
	        ),
	    ),
	)
);

while ( $project_query->have_posts() ) : $project_query->the_post();
	global $post;

	$id          = $post->ID;
	$terms_array  = get_the_terms( $id, 'portfolio_cat' );
	$term_string = '';

	if ( $terms_array ) {
		foreach ( $terms_array as $term ) {
			$term_string .= $term->slug . ' ';
		}
	}
	if ( has_post_thumbnail() ) {
		$image_per = get_the_permalink( $post->ID );
		$output .= '<li class="portfolio-item ' . suffice_get_column_class( $column ) . ' ' . $term_string . '" data-category="' . $term_string . '">';
		$output .= '<figure class="portfolio-item-thumbnail">';
		$output .= '<a href="' . $image_per . '" >' . get_the_post_thumbnail( $post->ID, (  0 === $project_query->current_post % 2  && 'portfolio-masonry' === $style ? 'suffice-thumbnail-portfolio-masonry' : 'suffice-thumbnail-portfolio' ) ) . '</a>';
		$output .= '<figcaption class="portfolio-item-description">';
		$output .= '<h5 class="portfolio-item-title"><a href = "' . $image_per . '">' . get_the_title( $post->ID ) . '</a></h5>';
		$output .= '<span class="portfolio-item-categories">' . suffice_get_terms_list( $post->ID, 'portfolio_cat' ) . '</span>';
		$output .= '</figcaption>';
		$output .= '</figure>';
		$output .= '</li>';
	}
endwhile;
wp_reset_postdata();

$output .= '</ul><!-- /ul.portfolio-items -->';
$output .= '</div><!-- /.portfolio-container -->';
echo $output;

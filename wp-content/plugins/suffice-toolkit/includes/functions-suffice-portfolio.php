<?php
/**
 * SufficeToolkit Portfolio Functions
 *
 * Functions for portfolio specific things.
 *
 * @author   ThemeGrill
 * @category Core
 * @package  SufficeToolkit/Functions
 * @version  1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter to allow portfolio_cat in the permalinks for portfolio.
 *
 * @param  string  $permalink The existing permalink URL.
 * @param  WP_Post $post
 * @return string
 */
function suffice_portfolio_post_type_link( $permalink, $post ) {
	// Abort if post is not a portfolio.
	if ( $post->post_type !== 'portfolio' ) {
		return $permalink;
	}

	// Abort early if the placeholder rewrite tag isn't in the generated URL.
	if ( false === strpos( $permalink, '%' ) ) {
		return $permalink;
	}

	// Get the custom taxonomy terms in use by this post.
	$terms = get_the_terms( $post->ID, 'portfolio_cat' );

	if ( ! empty( $terms ) ) {
		usort( $terms, '_usort_terms_by_ID' ); // order by ID.

		$category_object = apply_filters( 'suffice_toolkit_portfolio_post_type_link_portfolio_cat', $terms[0], $terms, $post );
		$category_object = get_term( $category_object, 'portfolio_cat' );
		$portfolio_cat   = $category_object->slug;

		if ( $category_object->parent ) {
			$ancestors = get_ancestors( $category_object->term_id, 'portfolio_cat' );
			foreach ( $ancestors as $ancestor ) {
				$ancestor_object = get_term( $ancestor, 'portfolio_cat' );
				$portfolio_cat   = $ancestor_object->slug . '/' . $portfolio_cat;
			}
		}
	} else {
		// If no terms are assigned to this post, use a string instead (can't leave the placeholder there)
		$portfolio_cat = _x( 'uncategorized', 'slug', 'suffice-toolkit' );
	}

	$find = array(
		'%year%',
		'%monthnum%',
		'%day%',
		'%hour%',
		'%minute%',
		'%second%',
		'%post_id%',
		'%category%',
		'%portfolio_cat%'
	);

	$replace = array(
		date_i18n( 'Y', strtotime( $post->post_date ) ),
		date_i18n( 'm', strtotime( $post->post_date ) ),
		date_i18n( 'd', strtotime( $post->post_date ) ),
		date_i18n( 'H', strtotime( $post->post_date ) ),
		date_i18n( 'i', strtotime( $post->post_date ) ),
		date_i18n( 's', strtotime( $post->post_date ) ),
		$post->ID,
		$portfolio_cat,
		$portfolio_cat
	);

	$permalink = str_replace( $find, $replace, $permalink );

	return $permalink;
}
add_filter( 'post_type_link', 'suffice_portfolio_post_type_link', 10, 2 );

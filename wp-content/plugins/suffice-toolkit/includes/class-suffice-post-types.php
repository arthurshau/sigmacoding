<?php
/**
 * Post Types
 *
 * Registers post types and taxonomies.
 *
 * @class    ST_Post_Types
 * @version  1.0.0
 * @package  SufficeToolkit/Classes/Portfolio
 * @category Class
 * @author   ThemeGrill
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * ST_Post_Types Class
 */
class ST_Post_Types {

	/**
	 * Hook in methods.
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_taxonomies' ), 5 );
		add_action( 'init', array( __CLASS__, 'register_post_types' ), 5 );
		add_action( 'init', array( __CLASS__, 'support_jetpack_omnisearch' ) );
		add_filter( 'rest_api_allowed_post_types', array( __CLASS__, 'rest_api_allowed_post_types' ) );
		add_action( 'suffice_toolkit_flush_rewrite_rules', array( __CLASS__, 'flush_rewrite_rules' ) );
	}

	/**
	 * Register core taxonomies.
	 */
	public static function register_taxonomies() {
		if ( taxonomy_exists( 'portfolio_cat' ) ) {
			return;
		}

		do_action( 'suffice_toolkit_register_taxonomy' );

		$permalinks = get_option( 'suffice_toolkit_permalinks' );

		register_taxonomy( 'portfolio_cat',
			apply_filters( 'suffice_toolkit_taxonomy_objects_portfolio_cat', array( 'portfolio' ) ),
			apply_filters( 'suffice_toolkit_taxonomy_args_portfolio_cat', array(
				'hierarchical' => true,
				'label'        => __( 'Categories', 'suffice-toolkit' ),
				'labels'       => array(
						'name'              => __( 'Project Categories', 'suffice-toolkit' ),
						'singular_name'     => __( 'Category', 'suffice-toolkit' ),
						'menu_name'         => _x( 'Categories', 'Admin menu name', 'suffice-toolkit' ),
						'search_items'      => __( 'Search Categories', 'suffice-toolkit' ),
						'all_items'         => __( 'All Categories', 'suffice-toolkit' ),
						'parent_item'       => __( 'Parent Category', 'suffice-toolkit' ),
						'parent_item_colon' => __( 'Parent Category:', 'suffice-toolkit' ),
						'edit_item'         => __( 'Edit Category', 'suffice-toolkit' ),
						'update_item'       => __( 'Update Category', 'suffice-toolkit' ),
						'add_new_item'      => __( 'Add New Category', 'suffice-toolkit' ),
						'new_item_name'     => __( 'New Category Name', 'suffice-toolkit' ),
						'not_found'         => __( 'No categories found', 'suffice-toolkit' ),
					),
				'show_ui'      => true,
				'query_var'    => true,
				'capabilities' => array(
					'manage_terms' => 'manage_portfolio_terms',
					'edit_terms'   => 'edit_portfolio_terms',
					'delete_terms' => 'delete_portfolio_terms',
					'assign_terms' => 'assign_portfolio_terms',
				),
				'rewrite'      => array(
					'slug'         => empty( $permalinks['category_base'] ) ? _x( 'portfolio-category', 'slug', 'suffice-toolkit' ) : $permalinks['category_base'],
					'with_front'   => false,
					'hierarchical' => true,
				),
			) )
		);

		register_taxonomy( 'portfolio_tag',
			apply_filters( 'suffice_toolkit_taxonomy_objects_portfolio_tag', array( 'portfolio' ) ),
			apply_filters( 'suffice_toolkit_taxonomy_args_portfolio_tag', array(
				'hierarchical' => false,
				'label'        => __( 'Tags', 'suffice-toolkit' ),
				'labels'       => array(
						'name'                       => __( 'Project Tags', 'suffice-toolkit' ),
						'singular_name'              => __( 'Tag', 'suffice-toolkit' ),
						'menu_name'                  => _x( 'Tags', 'Admin menu name', 'suffice-toolkit' ),
						'search_items'               => __( 'Search Tags', 'suffice-toolkit' ),
						'all_items'                  => __( 'All Tags', 'suffice-toolkit' ),
						'edit_item'                  => __( 'Edit Tag', 'suffice-toolkit' ),
						'update_item'                => __( 'Update Tag', 'suffice-toolkit' ),
						'add_new_item'               => __( 'Add New Tag', 'suffice-toolkit' ),
						'new_item_name'              => __( 'New Tag Name', 'suffice-toolkit' ),
						'popular_items'              => __( 'Popular Tags', 'suffice-toolkit' ),
						'separate_items_with_commas' => __( 'Separate Tags with commas', 'suffice-toolkit' ),
						'add_or_remove_items'        => __( 'Add or remove Tags', 'suffice-toolkit' ),
						'choose_from_most_used'      => __( 'Choose from the most used tags', 'suffice-toolkit' ),
						'not_found'                  => __( 'No tags found', 'suffice-toolkit' ),
					),
				'show_ui'      => true,
				'query_var'    => true,
				'capabilities' => array(
					'manage_terms' => 'manage_portfolio_terms',
					'edit_terms'   => 'edit_portfolio_terms',
					'delete_terms' => 'delete_portfolio_terms',
					'assign_terms' => 'assign_portfolio_terms',
				),
				'rewrite'      => array(
					'slug'       => empty( $permalinks['tag_base'] ) ? _x( 'portfolio-tag', 'slug', 'suffice-toolkit' ) : $permalinks['tag_base'],
					'with_front' => false
				),
			) )
		);

		do_action( 'suffice_toolkit_after_register_taxonomy' );
	}

	/**
	 * Register core post types.
	 */
	public static function register_post_types() {
		if ( post_type_exists( 'portfolio' ) ) {
			return;
		}

		do_action( 'suffice_toolkit_register_post_type' );

		$permalinks          = get_option( 'suffice_toolkit_permalinks' );
		$portfolio_permalink = empty( $permalinks['portfolio_base'] ) ? _x( 'portfolio', 'slug', 'suffice-toolkit' ) : $permalinks['portfolio_base'];

		register_post_type( 'portfolio',
			apply_filters( 'suffice_toolkit_register_post_type_portfolio',
				array(
					'labels'              => array(
							'name'                  => __( 'Projects', 'suffice-toolkit' ),
							'singular_name'         => __( 'Project', 'suffice-toolkit' ),
							'menu_name'             => _x( 'Portfolio', 'Admin menu name', 'suffice-toolkit' ),
							'all_items'             => __( 'All Projects', 'suffice-toolkit' ),
							'add_new'               => __( 'Add Project', 'suffice-toolkit' ),
							'add_new_item'          => __( 'Add New Project', 'suffice-toolkit' ),
							'edit'                  => __( 'Edit', 'suffice-toolkit' ),
							'edit_item'             => __( 'Edit Project', 'suffice-toolkit' ),
							'new_item'              => __( 'New Project', 'suffice-toolkit' ),
							'view'                  => __( 'View Project', 'suffice-toolkit' ),
							'view_item'             => __( 'View Project', 'suffice-toolkit' ),
							'search_items'          => __( 'Search Projects', 'suffice-toolkit' ),
							'not_found'             => __( 'No Projects found', 'suffice-toolkit' ),
							'not_found_in_trash'    => __( 'No Projects found in trash', 'suffice-toolkit' ),
							'parent'                => __( 'Parent Project', 'suffice-toolkit' ),
							'featured_image'        => __( 'Project Image', 'suffice-toolkit' ),
							'set_featured_image'    => __( 'Set project image', 'suffice-toolkit' ),
							'remove_featured_image' => __( 'Remove project image', 'suffice-toolkit' ),
							'use_featured_image'    => __( 'Use as project image', 'suffice-toolkit' ),
							'insert_into_item'      => __( 'Insert into project', 'suffice-toolkit' ),
							'uploaded_to_this_item' => __( 'Uploaded to this project', 'suffice-toolkit' ),
							'filter_items_list'     => __( 'Filter Projects', 'suffice-toolkit' ),
							'items_list_navigation' => __( 'Projects navigation', 'suffice-toolkit' ),
							'items_list'            => __( 'Projects list', 'suffice-toolkit' ),
						),
					'description'         => __( 'This is where you can add new portfolio items to your project.', 'suffice-toolkit' ),
					'public'              => true,
					'show_ui'             => true,
					'capability_type'     => 'portfolio',
					'map_meta_cap'        => true,
					'publicly_queryable'  => true,
					'exclude_from_search' => false,
					'hierarchical'        => false,
					'query_var'           => true,
					'menu_icon'           => 'dashicons-portfolio',
					'rewrite'             => $portfolio_permalink ? array( 'slug' => untrailingslashit( $portfolio_permalink ), 'with_front' => false, 'feeds' => true ) : false,
					'supports'            => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'author', 'custom-fields', 'page-attributes', 'publicize', 'wpcom-markdown' ),
					'has_archive'         => true,
					'show_in_nav_menus'   => true
				)
			)
		);
	}

	/**
	 * Add Portfolio Support to Jetpack Omnisearch.
	 */
	public static function support_jetpack_omnisearch() {
		if ( class_exists( 'Jetpack_Omnisearch_Posts' ) ) {
			new Jetpack_Omnisearch_Posts( 'portfolio' );
		}
	}

	/**
	 * Added portfolio for Jetpack related posts.
	 * @param  array $post_types
	 * @return array
	 */
	public static function rest_api_allowed_post_types( $post_types ) {
		$post_types[] = 'portfolio';

		return $post_types;
	}

	/**
	 * Flush rewrite rules.
	 */
	public static function flush_rewrite_rules() {
		flush_rewrite_rules();
	}
}

ST_Post_Types::init();

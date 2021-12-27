
<?php 

require_once get_template_directory() . '/widgets/class-gym-widget-recent-posts.php';

function woodworking_scripts() {

		wp_enqueue_style( 'woodworking-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	}
	add_action( 'wp_enqueue_scripts', 'woodworking_scripts' );

	
	register_nav_menus(
		array(
			'primary' => esc_html__( 'Primary menu', 'twentytwentyone' ),
			'footer'  => __( 'Secondary menu', 'twentytwentyone' ),
		)
	);



    /**
		 * Add post-formats support.
		 */
		add_theme_support(
			'post-formats',
			array(
				'link',
				'aside',
				'gallery',
				'image',
				'quote',
				'status',
				'video',
				'audio',
				'chat',
			)
		);

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

    function mytheme_widgets_init() {
      register_sidebar( array (
          'name' => __( 'Main Sidebar', 'your-text-domain' ),
          'id' => 'sidebar-1',
          'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'your-text-domain' ),
          'before_widget' => '<li>',
          'after_widget' => '</li>',
          'before_title' => '<h2>',
          'after_title' => '</h2>',
      ));
  }
  add_action( 'widgets_init', 'mytheme_widgets_init' );

  /* Custom Post Type Start */
function create_posttype() {
	register_post_type( 'Gym',
	// CPT Options
	array(
	  'labels' => array(
	   'name' => __( 'Gym' ),
	   'singular_name' => __( 'Gym' )
	  ),
	  'public' => true,
	  'has_archive' => false,
	  'rewrite' => array('slug' => 'Gym'),
	 )
	);
	}
	// Hooking up our function to theme setup
	add_action( 'init', 'create_posttype' );

	/*Custom Post type start*/
function cw_post_type_news() {
	$supports = array(
	'title', // post title
	'editor', // post content
	'author', // post author
	'thumbnail', // featured images
	'excerpt', // post excerpt
	'custom-fields', // custom fields
	'comments', // post comments
	'revisions', // post revisions
	'post-formats', // post formats
	);
	$labels = array(
	'name' => _x('Gym', 'plural'),
	'singular_name' => _x('Gym', 'singular'),
	'menu_name' => _x('Gym', 'admin menu'),
	'name_admin_bar' => _x('Gym', 'admin bar'),
	'add_new' => _x('Add New', 'add new'),
	'add_new_item' => __('Add New Gym'),
	'new_item' => __('New Gym'),
	'edit_item' => __('Edit Gym'),
	'view_item' => __('View Gym'),
	'all_items' => __('All Gym'),
	'search_items' => __('Search Gym'),
	'not_found' => __('No Gym found.'),
	);
	$args = array(
	'supports' => $supports,
	'labels' => $labels,
	'public' => true,
	'query_var' => true,
	'rewrite' => array('slug' => 'Gym'),
	'has_archive' => true,
	'hierarchical' => false,
	);
	register_post_type('Gym', $args);
	}
	add_action('init', 'cw_post_type_news');
	/*Custom Post type end*/


//hook into the init action and call create_book_taxonomies when it fires
 
add_action( 'init', 'create_equipments_hierarchical_taxonomy', 0 );
 
//create a custom taxonomy name it subjects for your posts
 
function create_equipments_hierarchical_taxonomy() {
 
// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI
 
  $labels = array(
    'name' => _x( 'Equipments', 'taxonomy general name' ),
    'singular_name' => _x( 'Equipment', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Equipments' ),
    'all_items' => __( 'All Equipments' ),
    'parent_item' => __( 'Parent Equipment' ),
    'parent_item_colon' => __( 'Parent Equipment:' ),
    'edit_item' => __( 'Edit Equipment' ), 
    'update_item' => __( 'Update Equipment' ),
    'add_new_item' => __( 'Add New Equipment' ),
    'new_item_name' => __( 'New Equipment Name' ),
    'menu_name' => __( 'Equipments' ),
  );    
 
// Now register the taxonomy
  register_taxonomy('Equipments',array('gym'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'Equipment' ),
  ));
 
}

//hook into the init action and call create_topics_nonhierarchical_taxonomy when it fires
 
add_action( 'init', 'create_Exercises_nonhierarchical_taxonomy', 0 );
 
function create_Exercises_nonhierarchical_taxonomy() {
 
// Labels part for the GUI
 
  $labels = array(
    'name' => _x( 'Exercises', 'taxonomy general name' ),
    'singular_name' => _x( 'Exercise', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Exercises' ),
    'popular_items' => __( 'Popular Exercises' ),
    'all_items' => __( 'All Exercises' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Exercise' ), 
    'update_item' => __( 'Update Exercise' ),
    'add_new_item' => __( 'Add New Exercise' ),
    'new_item_name' => __( 'New Exercise' ),
    'separate_items_with_commas' => __( 'Separate Exercises with commas' ),
    'add_or_remove_items' => __( 'Add or remove Exercises' ),
    'choose_from_most_used' => __( 'Choose from the most used Exercises' ),
    'menu_name' => __( 'Exercises' ),
  ); 
 
// Now register the non-hierarchical taxonomy like tag
 
  register_taxonomy('Exercises','gym',array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'Exercises' ),
  ));
}

// post view counter

function gt_get_post_view() {
    $count = get_post_meta( get_the_ID(), 'post_views_count', true );
    return "$count views";
}
function gt_set_post_view() {
    $key = 'post_views_count';
    $post_id = get_the_ID();
    $count = (int) get_post_meta( $post_id, $key, true );
    $count++;
    update_post_meta( $post_id, $key, $count );
}
function gt_posts_views( $columns ) {
    $columns['post_views'] = 'Views';
    return $columns;
}
function gt_posts_custom_views( $column ) {
    if ( $column === 'post_views') {
        echo gt_get_post_view();
    }
}
add_filter( 'manage_posts_columns', 'gt_posts_views' );
add_action( 'manage_posts_custom_column', 'gt_posts_custom_views' );


function GYM_register_custom_widgets() {
    register_widget( 'Gym_Widget_Recent_Posts' );
}
add_action( 'widgets_init', 'GYM_register_custom_widgets' );

  
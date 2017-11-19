<?php

function awesome_script_enqueue() {
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.6', 'all');
    wp_enqueue_style('uikit', get_template_directory_uri() . '/css/uikit.min.css', array(), '3.3.6', 'all');
    wp_enqueue_style('uikit_css_slideshow', get_template_directory_uri() . '/css/slideshow.min.css', array(), '3.3.6', 'all');
    wp_enqueue_style('uikit_css_slider', get_template_directory_uri() . '/css/slider.min.css', array(), '3.3.6', 'all');
    wp_enqueue_style('jquery-ui_css', get_template_directory_uri() . '/css/jquery-ui.min.css', array(), '1.0.0', 'all');
    wp_enqueue_style('uikit_sticky', get_template_directory_uri() . '/css/sticky.min.css', array(), '1.0.0', 'all');
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css', array(), random_int(0, 1000), 'all');
    wp_enqueue_style('style', get_template_directory_uri() . '/style2.css', array(), random_int(0, 1000), 'all');

    
    //wp_enqueue_script('my_jquery', get_template_directory_uri() . '/js/jquery-1.12.4.min.js', array(), '1.12.4', true);
    wp_enqueue_script('bootstrapjs', get_template_directory_uri() . '/js/bootstrap.min.js', array(), '3.3.6', true);
    wp_enqueue_script('UiKit_js', get_template_directory_uri() . '/js/uikit.min.js', array(), '1.0.0', true);
    wp_enqueue_script('UiKit_slideshow', get_template_directory_uri() . '/js/slideshow.min.js', array(), '1.0.0', true);
    wp_enqueue_script('UiKit_grid', get_template_directory_uri() . '/js/grid.min.js', array(), '2.0.0', true);
    wp_enqueue_script('UiKit_slideshow_fx', get_template_directory_uri() . '/js/slideshow-fx.min.js', array(), '1.0.0', true);
    wp_enqueue_script('UiKit_slider_js', get_template_directory_uri() . '/js/slider.min.js', array(), '1.0.0', true);
    wp_enqueue_script('countdown', get_template_directory_uri() . '/js/jquery.countdown.min.js', array(), '1.0.0', true);
    wp_enqueue_script('validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array(), '1.0.0', true);
    wp_enqueue_script('jquery-ui', get_template_directory_uri() . '/js/jquery-ui.min.js', array(), '1.0.0', true);
    wp_enqueue_script('uikit_lightbox', get_template_directory_uri() . '/js/lightbox.min.js', array(), '1.0.0', true);
    wp_enqueue_script('uikit_sticky_js', get_template_directory_uri() . '/js/sticky.min.js', array(), '1.0.0', true);
    
    wp_enqueue_script('myscript_js', get_template_directory_uri() . '/js/script.js', array(), random_int(0, 1000), true);
   
    wp_localize_script('myscript_js', 'ajaxurl', admin_url( 'admin-ajax.php' ));
}
add_action( 'wp_enqueue_scripts', 'awesome_script_enqueue');

/*
	==========================================
	 Activate menus
	==========================================
*/

function awesome_theme_setup() {
	
	add_theme_support('menus');	
	register_nav_menu('header', 'Header Navigation');
	register_nav_menu('footer', 'Footer Navigation');
}

add_action('init', 'awesome_theme_setup');


function create_post_type() {
	register_post_type( 'Slider',
		array(
		  'labels' => array(
		    'name' => __( 'SlideShow' )
		  ),
		  'public' => true,
		  'supports' => array('title',  'thumbnail'),
		)
	);
        register_post_type( 'intervenant',
		array(
		  'labels' => array(
		    'name' => __( 'Intervenant' )
		  ),
		  'public' => true,
		  'supports' => array('title', 'editor','thumbnail'),
                  'has_archive' => true,
                  'taxonomies'  => array( 'category' ),
		)
	);
        register_post_type( 'partenaires',
		array(
		  'labels' => array(
		    'name' => __( 'Partenaires' )
		  ),
		  'public' => true,
		  'supports' => array('title','thumbnail'),
                  'has_archive' => true,
		)
	);
        
}
add_action( 'init', 'create_post_type' );

add_theme_support( 'post-thumbnails', array( 'page', 'post', 'slider') );


add_action( 'wp_ajax_getProduct', 'getProduct' );
add_action( 'wp_ajax_nopriv_getProduct', 'getProduct' );
function getProduct() {
    $p = $_POST['p'];
    $post_type = $_POST['post_type'];
	$args  = array(
            'p' => $p,
            'post_type' => $post_type,
            'posts_per_page'=> 1
        );
        $the_query = new WP_Query( $args ); 
        $product=array();
        if ( $the_query->have_posts() ) :
            while ( $the_query->have_posts() ) : $the_query->the_post(); 
               $product["image"] = get_field('image_de_fond');
               $product["content"] = get_the_content();
               $product["title"] = get_the_title();
               $product["varite"] = strip_tags(get_field('varite'));
               $product["origine"] = strip_tags(get_field('origine'));
               $product["calibres"] = strip_tags(get_field('calibres'));
               $product["calendrier"] = get_field('calendrier');
               
            endwhile;
        endif; 
        echo json_encode($product);
	die();
}

add_theme_support( 'post-thumbnails', array( 'intervenant') );
add_action( 'pre_get_posts', 'my_change_sort_order'); 
    function my_change_sort_order($query){
        if(is_archive()):
         //If you wanted it for the archive of a custom post type use: is_post_type_archive( $post_type )
           //Set the order ASC or DESC
           $query->set( 'order', 'ASC' );
           //Set the orderby
           $query->set( 'orderby', 'title' );
        endif;    
    };
    
add_action( 'init', 'build_taxonomies', 0 );
 
function build_taxonomies() {
register_taxonomy( 'gouvernance', 'intervenant', array( 'hierarchical' => true, 'label' => 'Gouvernance Catégories', 'query_var' => true, 'rewrite' => true ) );
register_taxonomy( 'partenariat', 'partenaires', array( 'hierarchical' => true, 'label' => 'Partenaires Catégories', 'query_var' => true, 'rewrite' => true ) );
}
add_filter('template_include','start_buffer_EN',1);
function start_buffer_EN($template) {
  ob_start('end_buffer_EN');  
  return $template;
}
function end_buffer_EN($buffer) {
  return str_replace('<span>English</span>','<span>EN</span>',$buffer);  
}

add_filter('template_include','start_buffer_FR',1);
function start_buffer_FR($template) {
  ob_start('end_buffer_FR');
  return $template;
}
function end_buffer_FR($buffer) {  
  return str_replace('<span>Français</span>','<span>FR</span>',$buffer);
}
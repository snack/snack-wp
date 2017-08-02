<?php
if ( ! function_exists( 'snack_setup' ) ) :

    function snack_setup() {

        //  Add support for multiple languages
        load_theme_textdomain( 'snack-wp', get_template_directory() . '/languages' );

        //  Enables visual editor
        add_editor_style();

        //  Enable / Disable site admin bar
        if ( is_user_logged_in() ){
            show_admin_bar(true);
        }

        //  Enables customizable images and thumbs
        add_theme_support( 'post-thumbnails' );

        //  Habilita RSS feeds no <head>
        add_theme_support( 'automatic-feed-links' );

        //  Add tag <title>
        add_theme_support( 'title-tag' );

        //  Change default search form tags, comments form, 
        //  and comments to HTML5 tags
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption'
            )
        );

        //  Remove items from the function wp_head()
        remove_action( 'wp_head', 'rsd_link' );
        remove_action( 'wp_head', 'wlwmanifest_link' );
        remove_action( 'wp_head', 'index_rel_link' );
        remove_action( 'wp_head', 'parent_post_rel_link' );
        remove_action( 'wp_head', 'start_post_rel_link' );
        remove_action( 'wp_head', 'adjacent_posts_rel_link' );
        remove_action( 'wp_head', 'check_and_publish_future_post' );
        remove_action( 'wp_head', 'wp_print_styles' );
        remove_action( 'wp_head', 'wp_generator' );
        remove_action( 'wp_head', 'rel_canonical' );
        remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );

        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_action( 'admin_print_styles', 'print_emoji_styles' );

        //  New formats of thumbnaills
        if ( function_exists( 'add_image_size' ) ) {
            //Ex: add_image_size('thumb-780x350', 780, 350, true)
            add_image_size( 'thumb-700x480', 700, 480, true );
            add_image_size( 'thumb-140x120', 140, 120, true );
        }

        //  Summary on pages
        add_post_type_support( 'page', 'excerpt' );

        //  Register nav menus
        register_nav_menus( array(
            'primary' => __( 'Navegação Principal', 'snack-wp' )
                // Add new menus here
            ));

        //  Register Widgets
        register_sidebar( 
            array(
            'id' => 'widget',
            'name' => __( 'Primeiro Widget' ),
            'description' => __( '1º Widget'),
            'before_widget' => '<div class="widget %s">',
            'after_widget' => '</div>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
            )
        );
    }
endif; 

add_action('after_setup_theme','snack_setup' );

//  Atoms
require_once get_template_directory() . '/inc/atoms/snack-pagination.php';
require_once get_template_directory() . '/inc/atoms/snack-excerpt.php';
require_once get_template_directory() . '/inc/atoms/snack-breadcrumbs.php';
require_once get_template_directory() . '/inc/atoms/snack-debug.php';
require_once get_template_directory() . '/inc/atoms/snack-social-share-buttons.php';
require_once get_template_directory() . '/inc/atoms/snack-get-term-meta.php';
require_once get_template_directory() . '/inc/atoms/snack-optimize.php';
require_once get_template_directory() . '/inc/atoms/snack-get-image-url.php';
require_once get_template_directory() . '/inc/atoms/snack-thumbnail.php';
require_once get_template_directory() . '/inc/atoms/snack-custom-admin.php';

//  Molecules
require_once get_template_directory() . '/inc/molecules/snack-post-type.php';
require_once get_template_directory() . '/inc/molecules/snack-taxonomy.php';
require_once get_template_directory() . '/inc/molecules/snack-metabox.php';
require_once get_template_directory() . '/inc/molecules/snack-thumbnail-resizer.php';
require_once get_template_directory() . '/inc/molecules/snack-comment-remover.php';

//  Organisms
require_once get_template_directory() . '/inc/organisms/snack-gallery.php';
require_once get_template_directory() . '/inc/organisms/snack-related-posts.php';

// Customizations

//  Contact Form 7 - Remover scripts, css e add class .form
add_filter( 'wpcf7_form_class_attr', 'snack_form_class_attr' );

function snack_form_class_attr( $class ) {
	$class .= ' form';
	return $class;
}

add_filter( 'wpcf7_load_js', '__return_false' );
add_filter( 'wpcf7_load_css', '__return_false' );

//  Add stylesheet URI
function snack_stylesheet_uri( $uri, $dir ) {
    return $dir . '/build/css/main.min.css';
}

add_filter( 'stylesheet_uri', 'snack_stylesheet_uri', 10, 2 );

//  Add site scripts
function snack_enqueue_css_and_scripts() {

    $template_url = get_template_directory_uri();

    wp_enqueue_style( 'snack-wp-style', get_stylesheet_uri(), array(), null, 'all' );

    wp_enqueue_script( 'snack-wp-script', $template_url . '/build/js/scripts.min.js', array(), null, true );

    global $post;
    if ( has_shortcode( $post->post_content, 'contact-form-7' ) ) {
        wp_enqueue_script( 'wpcf7-jquery-form', wpcf7_plugin_url( 'includes/js/jquery.form.min.js' ), array(), WPCF7_VERSION, true );
        wp_enqueue_script( 'wpcf7-scripts', wpcf7_plugin_url( 'includes/js/scripts.js' ), array(), WPCF7_VERSION, true );
        $_wpcf7 = array(
            'recaptcha' => array(
                'messages' => array(
                    'empty' => __( 'Please verify that you are not a robot.',
                        'contact-form-7' ) ) ) );
        wp_localize_script( 'wpcf7-scripts', '_wpcf7', $_wpcf7 );
    }
}

add_action( 'wp_enqueue_scripts', 'snack_enqueue_css_and_scripts' );

// Disable pre-defined Widgets in WordPress
function snack_unregister_default_wp_widgets() {
    unregister_widget('WP_Widget_Pages');
    unregister_widget('WP_Widget_Calendar');
    unregister_widget('WP_Widget_Archives');
    unregister_widget('WP_Widget_Links');
    unregister_widget('WP_Widget_Meta');
    unregister_widget('WP_Widget_Search');
    unregister_widget('WP_Widget_Text');
    unregister_widget('WP_Widget_Categories');
    unregister_widget('WP_Widget_Recent_Posts');
    unregister_widget('WP_Widget_Recent_Comments');
    unregister_widget('WP_Widget_RSS');
    unregister_widget('WP_Widget_Tag_Cloud');
    unregister_widget('WP_Nav_Menu_Widget');
    unregister_widget('Akismet_Widget');
    unregister_widget('qTranslateXWidget');
}
add_action('widgets_init', 'snack_unregister_default_wp_widgets');

// Remove update notifications admin panel
function snack_remove_core_updates() {
    global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
}
add_filter('pre_site_transient_update_core','snack_remove_core_updates');
add_filter('pre_site_transient_update_plugins','snack_remove_core_updates');
add_filter('pre_site_transient_update_themes','snack_remove_core_updates');


//  Add Google Analytics UA-code field on General Settings
$ga_code_setting = new ga_code_setting();

class ga_code_setting {
    
    function ga_code_setting( ) {
        add_filter( 'admin_init' , array( &$this , 'register_fields' ) );
    }
    
    function register_fields() {
        register_setting( 'general', 'ga_ua_code', 'esc_attr' );
        add_settings_field('fav_color', '<label for="ga_ua_code">'.__('GA UA-code' , 'ga_ua_code' ).'</label>' , array(&$this, 'fields_html') , 'general' );
    }
    
    function fields_html() {
        $value = get_option( 'ga_ua_code', '' );
        echo '<input type="text" id="ga_ua_code" name="ga_ua_code" value="' . $value . '" />';
    }
}

add_action('wp_head','snack_ga_script', 10, 2);

function snack_ga_script() {

    $ga_code = get_option("ga_ua_code");
    $output  = '';

    if ( $ga_code ):

        $output="<script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='https://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','".$ga_code."','auto');
            ga('require', 'displayfeatures');
            ga('send', 'pageview');
            </script>";

    endif;

    echo $output;
}

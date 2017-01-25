<?php
/*
 * Snack Wp - Funções
 *
 * @package Snack WP
 * @since 2.0
 */

/**
 *  Setup theme.
 */
if ( ! function_exists( 'snack_setup' ) ):

    function snack_setup() {

        //  Add support for multiple languages.

            load_theme_textdomain( 'snack-wp', get_template_directory() . '/languages' );

        //  Habilita o editor visual

            add_editor_style();

        //  Habilitar/Desabilitar barra de admin dos site

            if ( is_user_logged_in() ){
                show_admin_bar(true);
            }

        //  Habilita Imagens e Thumbs Customizáveis

            add_theme_support('post-thumbnails');

        //  Habilita RSS feeds no <head>

            add_theme_support( 'automatic-feed-links' );

        //  Tag <title>

            add_theme_support( 'title-tag' );

        //  Alterar tags padrão de formulário de busca, formulário de comentários,
        //  e comentários, para tags HTML5

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

        //  Post Formats

            // add_theme_support( 'post-formats', array(
            //    'aside',
            //    'gallery',
            //    'link',
            //    'image',
            //    'quote',
            //    'status',
            //    'video',
            //    'audio',
            //    'chat'
            // ) );*/

        //  Remove itens da função wp_head();

            remove_action('wp_head', 'rsd_link');
            remove_action('wp_head', 'wlwmanifest_link');
            remove_action('wp_head', 'index_rel_link');
            remove_action('wp_head', 'parent_post_rel_link');
            remove_action('wp_head', 'start_post_rel_link');
            remove_action('wp_head', 'adjacent_posts_rel_link');
            remove_action('wp_head', 'check_and_publish_future_post');
            remove_action('wp_head', 'wp_print_styles');
            remove_action('wp_head', 'wp_generator');
            remove_action('wp_head', 'rel_canonical');
            remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
            remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
            remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
            remove_action( 'wp_print_styles', 'print_emoji_styles' );
            remove_action( 'admin_print_styles', 'print_emoji_styles' );

        //  Novos formatos de thumbnaills

            if ( function_exists( 'add_image_size' ) ) {
                //Adicionar aqui os novos formatos:
                //Ex: add_image_size('thumb-780x350', 780, 350, true);
                add_image_size('thumb-700x480', 700, 480, true);
                add_image_size('thumb-700x320', 700, 320, true);
                add_image_size('thumb-140x120', 140, 120, true);
            }

        //  Resumo nas páginas

            add_post_type_support( 'page', 'excerpt' );

        //  Register Nav Menus

            register_nav_menus( array(
                'primary' => __( 'Navegação Principal', 'snack-wp' )
                //adicionar novos menus aqui
            ));

        //  Register Widgets

            register_sidebar( array(
                'id' => 'widget',
                'name' => __( 'Primeiro Widget' ),
                'description' => __( '1º Widget'),
                'before_widget' => '<div class="widget %s">',
                'after_widget' => '</div>',
                'before_title' => '<h3>',
                'after_title' => '</h3>',
            ));
    }

endif; //End snack_setup();

add_action('after_setup_theme','snack_setup' );

/*
 *  Atoms
 */
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

/*
 *  Molecules
 */
require_once get_template_directory() . '/inc/molecules/snack-post-type.php';
require_once get_template_directory() . '/inc/molecules/snack-taxonomy.php';
require_once get_template_directory() . '/inc/molecules/snack-metabox.php';
require_once get_template_directory() . '/inc/molecules/snack-thumbnail-resizer.php';

/*
 *  Organisms
 */
require_once get_template_directory() . '/inc/organisms/snack-gallery.php';
require_once get_template_directory() . '/inc/organisms/snack-related-posts.php';

/*
 *  Custom
 */

/*  Habilitar o funcionamento dos links no localhost
 *  Adicionar no header: <?php ob_start("snack_fix_links"); ?>
 *  E adicionar no footer: <?php ob_end_flush(); ?>
    ========================================================================== */
	function snack_fix_links($buffer){
	   return (str_replace(home_url().'/', "/", $buffer));
	}

/*  Formulário de Contato - Plugin Contact Form 7
 *  remover scripts, css e add class .form
    ========================================================================== */
	add_filter( 'wpcf7_form_class_attr', 'snack_form_class_attr' );

	function snack_form_class_attr( $class ) {
		$class .= ' form';
		return $class;
	}

	add_filter( 'wpcf7_load_js', '__return_false' );
    add_filter( 'wpcf7_load_css', '__return_false' );

/*  Add stylesheet URI
    ========================================================================== */
    function snack_stylesheet_uri( $uri, $dir ) {
        return $dir . '/build/css/main.min.css';
    }

    add_filter( 'stylesheet_uri', 'snack_stylesheet_uri', 10, 2 );

/*  Add site scripts
    ========================================================================== */
    function snack_enqueue_css_and_scripts() {
        $template_url = get_template_directory_uri();

        // Carregar CSS
        wp_enqueue_style( 'snack-wp-style', get_stylesheet_uri(), array(), null, 'all' );

        // Carregar Scripts
        wp_enqueue_script( 'snack-wp-script', $template_url . '/build/js/scripts.min.js', array(), null, true );

        // Carregar Scripts Contact Form 7
        global $post;
        if ( has_shortcode( $post->post_content, 'contact-form-7') ) {
            wp_enqueue_script( 'wpcf7-jquery-form', wpcf7_plugin_url( 'includes/js/jquery.form.min.js' ), array(), WPCF7_VERSION, true );
            wp_enqueue_script( 'wpcf7-scripts', wpcf7_plugin_url( 'includes/js/scripts.js' ), array(), WPCF7_VERSION, true );
            $_wpcf7 = array(
                'loaderUrl' => wpcf7_ajax_loader(),
                'sending' => __( 'Enviando ...', 'wpcf7-scripts' )
            );
            wp_localize_script( 'wpcf7-scripts', '_wpcf7', $_wpcf7 );
        }
    }

    add_action( 'wp_enqueue_scripts', 'snack_enqueue_css_and_scripts' );

/*  Desativar Widgets pré-definidos no WordPress
    ========================================================================== */
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

/*  Remove update notifications admin panel
    ========================================================================== */
    function snack_remove_core_updates() {
        global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
    }
    add_filter('pre_site_transient_update_core','snack_remove_core_updates');
    add_filter('pre_site_transient_update_plugins','snack_remove_core_updates');
    add_filter('pre_site_transient_update_themes','snack_remove_core_updates');


/*  Add Google Analytics UA-code field on General Settings
    ========================================================================== */
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

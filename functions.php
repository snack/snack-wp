<?php
/*
 * Snack Wp - Funções
 *
 * @package Snack WP
 * @since 2.0
 */

    add_action('after_setup_theme','snack_wp_setup' );

    if ( ! function_exists( 'snack_wp_setup' ) ):

    	function snack_wp_setup() {

    		/*  Habilita o editor visual
                ========================================================================== */
    		    add_editor_style();

            /*  Habilitar/Desabilitar barra de admin dos site
                ========================================================================== */
                if ( is_user_logged_in() ){
                    show_admin_bar(true);
                }

            /*  Habilita Imagens e Thumbs Customizáveis
                ========================================================================== */
                add_theme_support('post-thumbnails');

            /*  Tag <title>
                ========================================================================== */
        		//add_theme_support( 'title-tag' );

            /*  Alterar tags padrão de formulário de busca, formulário de comentários,
             *  e comentários, para tags HTML5
                ========================================================================== */
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

            /*  Post Formats
                ========================================================================== */
                // add_theme_support( 'post-formats', array(
                //     'aside',
                //     'gallery',
                //     'link',
                //     'image',
                //     'quote',
                //     'status',
                //     'video',
                //     'audio',
                //     'chat'
                // ) );

            /*  Remove itens da função wp_head();
                ========================================================================== */
                remove_action('wp_head', 'feed_links', 2);
                remove_action('wp_head', 'feed_links_extra', 3);
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

            /*  Novos formatos de thumbnaills
                ========================================================================== */
        		if ( function_exists( 'add_image_size' ) ) {
        			//Adicionar aqui os novos formatos:
                    //Ex: add_image_size('thumb-780x350', 780, 350, true);
                    add_image_size('thumb-700x480', 700, 480, true);
                    add_image_size('thumb-700x320', 700, 320, true);
        			add_image_size('thumb-140x120', 140, 120, true);
        		}

            /*  Resumo nas páginas
                ========================================================================== */
                add_post_type_support( 'page', 'excerpt' );

            /*  Register Nav Menus
                ========================================================================== */
        		register_nav_menus( array(
        			'primary' => 'Navegação Principal'
        			//adicionar novos menus aqui
        		));

            /*  Register Widgets
                ========================================================================== */
        		register_sidebar( array(
        			'id' => 'widget',
        			'name' => __( 'Widget' ),
        			'description' => __( '1º Widget'),
        			'before_widget' => '<li class="widget %s">',
        			'after_widget' => '</li>',
        			'before_title' => '<h3>',
        			'after_title' => '</h3>',
        		));
    	}

    endif; //End snack_wp_setup();

/*  Habilitar links relativos - adicionar no header - ob_start("fix_links"); -
 *  e adicionar no footer - ob_end_flush(); -
    ========================================================================== */
	function fix_links($buffer){
	   return (str_replace(home_url().'/', "/", $buffer));
	}

/*  Formulário de Contato - Plugin Contact Form 7
 *  remover scripts, css e add class .form
    ========================================================================== */
	add_filter( 'wpcf7_form_class_attr', 'snack_wp_form_class_attr' );

	function snack_wp_form_class_attr( $class ) {
		$class .= ' form';
		return $class;
	}

	add_filter( 'wpcf7_load_js', '__return_false' );
    add_filter( 'wpcf7_load_css', '__return_false' );

/*  Remover css de comentários do head
    ========================================================================== */
	function remove_recent_comments_style() {
	   global $wp_widget_factory;
	   remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
	}
	add_action( 'widgets_init', 'remove_recent_comments_style' );

/*  Galeria de Imagens customizada
    ========================================================================== */
    add_shortcode('gallery', 'snack_gallery_shortcode');
    function snack_gallery_shortcode($attr) {
        $post = get_post();

        static $instance = 0;
        $instance++;

        if ( ! empty( $attr['ids'] ) ) {
            // 'ids' is explicitly ordered, unless you specify otherwise.
            if ( empty( $attr['orderby'] ) )
                $attr['orderby'] = 'post__in';
                $attr['include'] = $attr['ids'];
        }

        // Allow plugins/themes to override the default gallery template.
        $output = apply_filters('post_gallery', '', $attr);
        if ( $output != '' )
            return $output;

        // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
        if ( isset( $attr['orderby'] ) ) {
            $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
            if ( !$attr['orderby'] )
                unset( $attr['orderby'] );
        }

        extract(
            shortcode_atts(
                array(
                    'order'      => 'ASC',
                    'orderby'    => 'menu_order ID',
                    'id'         => $post->ID,
                    'itemtag'    => 'li',
                    'icontag'    => '',
                    'captiontag' => '',
                    'columns'    => 3,
                    'size'       => 'thumb-647x360',
                    'include'    => '',
                    'exclude'    => ''
                ), $attr)
        );

        $id = intval($id);
        if ( 'RAND' == $order )
            $orderby = 'none';

        if ( !empty($include) ) {
            $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

            $attachments = array();
            foreach ( $_attachments as $key => $val ) {
                $attachments[$val->ID] = $_attachments[$key];
            }
        } elseif ( !empty($exclude) ) {
            $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        } else {
            $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        }

        if ( empty($attachments) )
            return '';

        if ( is_feed() ) {
            $output = "\n";
            foreach ( $attachments as $att_id => $attachment )
                $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
            return $output;
        }

        $itemtag = tag_escape($itemtag);
        $captiontag = tag_escape($captiontag);
        $icontag = tag_escape($icontag);
        $valid_tags = wp_kses_allowed_html( 'post' );
        if ( ! isset( $valid_tags[ $itemtag ] ) )
            $itemtag = 'dl';
        if ( ! isset( $valid_tags[ $captiontag ] ) )
            $captiontag = 'dd';
        if ( ! isset( $valid_tags[ $icontag ] ) )
            $icontag = 'dt';

        $columns = intval($columns);
        $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
        $float = is_rtl() ? 'right' : 'left';

        if ( apply_filters( 'use_default_gallery_style', true ) )
            $size_class = sanitize_html_class( $size );
            $i = 0;

            $output .= '<div class="gallery loading"><div id="slideshow" class="flexslider slide-gallery">';
                $output .= '<ul class="slides">';

                foreach ( $attachments as $id => $attachment ) {
                    //$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, false, false);
                    $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_image($id, 'thumb-700x480') : wp_get_attachment_image($id, 'thumb-700x480');

                    $meta = get_post_meta($id, 'credito_imagem', true);

                    if ( $captiontag && trim($attachment->post_title) ) {

                        /*echo "<pre>";
                        print_r($attachment);
                        echo "</pre>";*/

                        $output .= '<li>';
                            $output .= '<span class="credits">'.$meta.'</span>';
                            $output .= $link;
                            $output .= '<div class="legend">'.wptexturize($attachment->post_excerpt).'</div>';
                        $output .= '</li>';

                    }
                }
                $output .='</ul>';
            $output .='</div>';
            $output .='<div id="carousel" class="flexslider thumbs-gallery">';
                $output .='<ul class="slides">';

                    foreach ( $attachments as $id => $attachment ) {
                        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_image($id, 'thumb-140x120') : wp_get_attachment_image($id, 'thumb-140x120');

                        if ( $captiontag && trim($attachment->post_title) ) {

                            $output .='<li>';
                               $output .= $link;
                            $output .='</li>';

                        }
                    }

                $output .='</ul>';
            $output .='</div></div>';

            return $output;
    }

/*  Add stylesheet URI
    ========================================================================== */
    function snack_wp_stylesheet_uri( $uri, $dir ) {
        return $dir . '/build/css/main.min.css';
    }

    add_filter( 'stylesheet_uri', 'snack_wp_stylesheet_uri', 10, 2 );

/*  Add site scripts
    ========================================================================== */
    function snack_wp_enqueue_scripts() {
        $template_url = get_template_directory_uri();

        // Carregar CSS
        wp_enqueue_style( 'snack-wp-style', get_stylesheet_uri(), array(), null, 'all' );

        // Carregar Scripts
        wp_enqueue_script( 'snack-wp-script', $template_url . '/build/js/scripts.min.js', array(), null, true );

        // Carregar Scripts Contact Form 7
        global $post;
        if ( has_shortcode( $post->post_content, 'contact-form-7') ) {
            wpcf7_enqueue_scripts();
        }
    }

    add_action( 'wp_enqueue_scripts', 'snack_wp_enqueue_scripts' );

/*  Desativar Widgets pré-definidos no WordPress
    ========================================================================== */
    function unregister_default_wp_widgets() {
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
    }
    add_action('widgets_init', 'unregister_default_wp_widgets', 1);

/*  Desativar Widgets pré-definidos nos Plugins
    ========================================================================== */
    function unregister_default_plugins_widgets() {
        unregister_widget('Akismet_Widget');
        unregister_widget('qTranslateXWidget');
    }
    add_action('widgets_init', 'unregister_default_plugins_widgets');

/*  Remove update notifications admin panel
    ========================================================================== */
    function remove_core_updates() {
        global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
    }
    add_filter('pre_site_transient_update_core','remove_core_updates');
    add_filter('pre_site_transient_update_plugins','remove_core_updates');
    add_filter('pre_site_transient_update_themes','remove_core_updates');

/**
 * Core Helpers.
 */
require_once get_template_directory() . '/inc/helpers.php';

/**
 * WP Custom Admin.
 */
require_once get_template_directory() . '/inc/admin.php';

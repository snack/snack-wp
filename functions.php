<?php

// Roda as configurações do Tema
add_action('after_setup_theme','wordpress_boilerplate_setup' );

if ( ! function_exists( 'wordpress_boilerplate_setup' ) ):

	function wordpress_boilerplate_setup() {

		// Habilita o editor visual
		add_editor_style();

		// Habilita Imagens e Thumbs Customizáveis
		add_theme_support('post-thumbnails');
		set_post_thumbnail_size(640);


		// Remove itens da função wp_head();
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

		// Remover barra de admin das paginas
		show_admin_bar(false);

		// Novos formatos de thumbnaills
		if ( function_exists( 'add_image_size' ) ) {
			//Adicionar aqui os novos formatos:
            //Ex: add_image_size('thumb-780x350', 780, 350, true);
            add_image_size('thumb-700x480', 700, 480, true);
            add_image_size('thumb-700x320', 700, 320, true);
			add_image_size('thumb-140x120', 140, 120, true);
		}

		// MENUS
		register_nav_menus( array(
			'primary' => 'Navegação Principal',
            'secondary' => 'Navegação Topo',
            'footer' => 'Navegação Rodapé'
			//adicionar novos menus aqui
		));

		// WIDGETS
		register_sidebar( array(
			'id' => 'widget',
			'name' => __( 'Widget' ),
			'description' => __( '1º Widget'),
			'before_widget' => '<li class="widget %s">',
			'after_widget' => '</li>',
			'before_title' => '<h3>',
			'after_title' => '</h3>',
		));


     	// CUSTOMIZANDO MENU PRINCIPAL
		class custom_menu extends Walker_Nav_Menu{

			function start_lvl(&$output, $depth) {
				$indent = str_repeat("", $depth);
				$output .= "<i class=\"icon-caret-down\"></i><ul class=\"nav-submenu\" role=\"menu\" aria-hidden=\"true\">";
			}

			function start_el(&$output, $item, $depth, $args){
				global $wp_query;
				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
				$class_names = $value = '';
				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				$class_names = in_array("current_page_item",$item->classes) ? 'current' : '';
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
				$output .= $indent . '<li class="item'.$item->ID.' '.$value.$class_names.'" role="menuitem">';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
				$item_output .= '</a>';
				$item_output .= $args->after;
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}

		// CUSTOMIZANDO MENU INTERNO SIDEBAR
		class custom_sidebar extends Walker_Nav_Menu{

			function start_lvl(&$output, $depth) {
				$indent = str_repeat("", $depth);
				$output .= "<ul class=\"side-sub\">";
			}

			function start_el(&$output, $item, $depth, $args){
				global $wp_query;
				$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
				$class_names = $value = '';
				$classes = empty( $item->classes ) ? array() : (array) $item->classes;
				$class_names = in_array("current_page_item",$item->classes) ? 'current' : '';
				$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
				$output .= $indent . '<li class="item'.$item->ID.' '.$value.$class_names.'">';
				$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
				$item_output = $args->before;
				$item_output .= '<a'. $attributes .'>';
				$item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
				$item_output .= '</a>';
				$item_output .= $args->after;
				$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
			}
		}
	}

	endif;

	// LINK CANONICAL
	function fix_links($buffer){
	   return (str_replace(home_url().'/', "/", $buffer));
	}

	// Resumo nas páginas
	add_action( 'init', 'my_add_excerpts_to_pages' );
	function my_add_excerpts_to_pages() {
		add_post_type_support( 'page', 'excerpt' );
	}

	// Formulario contato
	add_filter( 'wpcf7_form_class_attr', 'your_custom_form_class_attr' );

	function your_custom_form_class_attr( $class ) {
		$class .= ' form';
		return $class;
	}

	add_action( 'wp_print_scripts', 'deregister_cf7_javascript', 34 );
	function deregister_cf7_javascript() {
		if ( !is_page(34) ) {
			wp_deregister_script( 'contact-form-7' );
		}
	}

	add_action( 'wp_print_styles', 'deregister_cf7_styles', 34 );
	function deregister_cf7_styles() {
		if ( !is_page(34) ) {
			wp_deregister_style( 'contact-form-7' );
		}
	}

	// Remover css de comentários do head
	function remove_recent_comments_style() {
	global $wp_widget_factory;
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
	}
	add_action( 'widgets_init', 'remove_recent_comments_style' );


    /*  ==========================================================================
        GALERIA DE IMAGENS
        ========================================================================== */
        add_shortcode('gallery', 'my_gallery_shortcode');
        function my_gallery_shortcode($attr) {
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

    /*  ==========================================================================
        Pagination (WordPress)
        ========================================================================== */
        function show_pagination_links($page_total){
            if($page_total){
                $page_tot = $page_total;
            }else{
                global $wp_query;
                $page_tot = $wp_query->max_num_pages;
            }


            $page_cur = get_query_var( 'paged' );
            $big = 999999999;

            if ( $page_tot == 1 ) return;

            $args = array(
                'base'          => str_replace( $big, '%#%', get_pagenum_link( $big ) ), // need an unlikely integer cause the url can contains a number
                'format'        => '?paged=%#%',
                'current'       => max( 1, $page_cur ),
                'total'         => $page_tot,
                'prev_next'     => true,
                'end_size'      => 1,
                'mid_size'      => 2,
                'prev_text'     => __('«'),
                'next_text'     => __('»'),
                'type'          => 'plain'
            );

            $values = paginate_links( $args );

            if ( $args ) {
               echo '<div class="box pagination">';
               echo $values;
               echo '</div><!--// end .pagination -->';
            }
        }

    /*  ==========================================================================
        Add styles and scripts
        ========================================================================== */
        function atlantic_scripts() {
            wp_enqueue_style( 'basic-style', get_template_directory_uri() . '/build/css/main.min.css' );
            wp_enqueue_script( 'basic-script', get_template_directory_uri() . '/build/js/scripts.min.js', '', '', true );
        }

        add_action( 'wp_enqueue_scripts', 'atlantic_scripts' );

    /*  ==========================================================================
        Desativar Widgets pré-definidos no WordPress
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

    /*  ==========================================================================
        Desativar Widgets pré-definidos nos Plugins
        ========================================================================== */
        function unregister_default_plugins_widgets() {
            unregister_widget('Akismet_Widget');
            unregister_widget('qTranslateXWidget');
        }
        add_action('widgets_init', 'unregister_default_plugins_widgets');

    /*  ==========================================================================
        Remove update notifications admin panel
        ========================================================================== */
        function remove_core_updates() {
            global $wp_version;return(object) array('last_checked'=> time(),'version_checked'=> $wp_version,);
        }
            add_filter('pre_site_transient_update_core','remove_core_updates');
            add_filter('pre_site_transient_update_plugins','remove_core_updates');
            add_filter('pre_site_transient_update_themes','remove_core_updates');

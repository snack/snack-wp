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

		// Remover barra de admin das paginas
		show_admin_bar(false);

		// Novos formatos de thumbnaills
		if ( function_exists( 'add_image_size' ) ) {
			//Adicionar aqui os novos formatos:
			//Ex: add_image_size('thumb-780x350', 780, 350, true);
		}

		// MENUS
		register_nav_menus( array(
			'primary' => __( 'Navegação Principal', 'wordpress-boilerplate' )
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

		
		//METABOX
		add_action( 'add_meta_boxes', 'chapeu_meta_box_add' );
		function chapeu_meta_box_add() {
			add_meta_box( 'my-meta-box-id', 'Chapéu do Post', 'chapeu_meta_box', 'post', 'normal', 'high' );
		}

		//FORMULARIO PARA SALVAS OS DADOS DO METABOX
		function chapeu_meta_box() {
			$values = get_post_custom( $post->ID );
			$text = isset( $values['texto_chapeu'] ) ? esc_attr( $values['texto_chapeu'][0] ) : '';
			wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );
			?>
			<label for="texto_chapeu">Digite o texto</label>
			<input type="text" name="texto_chapeu" id="texto_chapeu" size="35" value="<? echo $text; ?>" />
			<?php
		}

		add_action( 'save_post', 'chapeu_meta_box_save' );
		function chapeu_meta_box_save( $post_id ) {
			if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

			if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;

			if( !current_user_can( 'edit_post' ) ) return;

			if( isset( $_POST['texto_chapeu'] ) )
				update_post_meta( $post_id, 'texto_chapeu', wp_kses( $_POST['texto_chapeu'], $allowed ) );

			update_post_meta( $post_id, 'meta_box_check', $chk );
		}


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

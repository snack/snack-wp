<!DOCTYPE html>
<!--[if IE 7]>    <html class="no-js ie7" <?php language_attributes(); ?>>     <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8" <?php language_attributes(); ?>>     <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" <?php language_attributes(); ?>>     <![endif]-->
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo get_template_directory_uri() ?>/favicon.ico">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri() ?>/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri() ?>/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri() ?>/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo get_template_directory_uri() ?>/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri() ?>/apple-touch-icon-precomposed.png">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri() ?>/apple-touch-icon.png">
    <?php wp_head(); ?>
    <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri(); ?>/build/js/libs/html5shiv-respond.min.js"></script>
    <![endif]-->
</head>
<body <?php body_class(); ?>>
	<a href="#conteudo" class="sr-only go-content" tabindex="1" accesskey="1"><?php _e( 'Ir para conteúdo', 'snack-wp' ); ?></a>
    <header class="header" role="banner">
    	<div class="container-fluid">
            <?php if ( is_home() ) : ?>
            <h1 class="site-title">
            	<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                	<?php bloginfo( 'name' ); ?>
                </a>
            </h1>
            <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
            <?php else : ?>
            <div class="site-title">
            	<a href="<?php echo home_url(); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                	<?php bloginfo( 'name' ); ?>
                </a>
                </div>
                <div class="site-description">
                    <?php bloginfo( 'description' ); ?>
                </div>
            <?php endif ?>
            <nav aria-label="main navigation" role="navigation" class="navbar">
            <?php
                $args = array(
                    'theme_location'    => 'primary',
                    'container'         => '',
                    'container_class'   => '',
                    'menu_class'        => 'nav-menu',
                    'items_wrap'        => '<ul class="%2$s" role="menubar" id="main-menu">%3$s</ul>'
                    );
                wp_nav_menu( $args );
            ?>
            </nav>
        </div>
    </header>

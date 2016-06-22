<?php ob_start("fix_links"); ?>
<!DOCTYPE html>
<!--[if IE 7]>    <html class="no-js ie7" <?php language_attributes(); ?>>     <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8" <?php language_attributes(); ?>>     <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" <?php language_attributes(); ?>>     <![endif]-->
<html class="no-js" <?php language_attributes(); ?>>
<head>

    <title><?php wp_title(""); ?></title>

    <!-- Metas -->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
    <link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/apple-touch-icon.png">

    <?php wp_head(); ?>

    <!-- Html5 Tags && Media Queries -->
    <!--[if lt IE 9]>
        <script src="<?php echo get_template_directory_uri(); ?>/build/js/libs/html5shiv-respond.min.js"></script>
    <![endif]-->
    <?php
        $ga_code = get_option("ga_ua_code");
        if ( $ga_code ): ?>
        <script>
        (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='https://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
        ga('create','<?php echo $ga_code;?>','auto');
        ga('require', 'displayfeatures');
        ga('send', 'pageview');
        </script>
    <?php endif; ?>

</head>
<body <?php body_class(); ?>>
    <a href="#conteudo" class="sr-only go-content" tabindex="1" accesskey="1">Ir para conteúdo</a>

    <!-- Header -->
    <header class="header" role="banner">
        <div class="row">

            <!-- Logo -->
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

            <!-- Menu -->
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



<?php ob_start("fix_links"); ?>
<!DOCTYPE html>
<!--[if IE 7]>    <html class="no-js ie7" <?php language_attributes(); ?>>     <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8" <?php language_attributes(); ?>>     <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" <?php language_attributes(); ?>>     <![endif]-->
<html class="no-js" <?php language_attributes(); ?>>
<head>

<title><?php wp_title(""); ?></title>

<!-- Metas -->
<?php include __DIR__ . '/build/in/meta.php'; ?>

<!-- Estilos -->
<?php include __DIR__ . '/build/in/estilos.php'; ?>

<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
    <a href="#conteudo" class="sr-only go-content" tabindex="1" accesskey="1">Ir para conteúdo</a>

    <!-- Header -->
    <header class="header" role="banner">
        <div class="row">
            <div class="fourcol">
                <!-- Logo -->
                <h1 class="logo">
                    <a class="hover" href="<?php echo home_url( '/' ); ?>" title="Campanha">
                        <img src="<?php echo get_template_directory_uri(); ?>/build/img/logo.png" alt="Logo Campanha">
                    </a>
                </h1>
            </div>

            <!-- Menu -->
            <nav aria-label="main navigation" role="navigation" class="navbar">
                <?php
                    $args = array(
                        'theme_location'    => 'primary',
                        'container'         => '',
                        'container_class'   => '',
                        'menu_class'        => 'nav-menu',
                        'items_wrap'        => '<ul class="%2$s" role="menubar" id="main-menu">%3$s</ul>',
                        'walker'            => new custom_menu()
                        );
                    wp_nav_menu( $args );
                ?>
            </nav>
        </div>
    </header>



<?php ob_start("fix_links"); ?>
<!DOCTYPE html>
<!--[if IE 7]>    <html class="no-js ie7" <?php language_attributes(); ?>>     <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8" <?php language_attributes(); ?>>     <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9" <?php language_attributes(); ?>>     <![endif]-->
<html <?php language_attributes(); ?>>
<head>

<title><?php global $page, $paged; wp_title( '-', true, 'right' ); bloginfo( 'name' ); $site_description = get_bloginfo( 'description', 'display' ); if ( $site_description && ( is_home() || is_front_page() ) ) echo " | $site_description"; if ( $paged >= 2 || $page >= 2 ) echo ' | ' . sprintf( __( 'Page %s', 'twentyten' ), max( $paged, $page ) );	?></title>

<!-- Metas -->
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">
<meta name="description" content="">
<meta name="keywords" content=""> 
<meta name="author" content="A2 Comunicação">
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1">

<!-- Facebook -->
<meta property="fb:app_id" content="218733564947932" />
<meta property="fb:admins" content="100003036613503" />
<meta property="og:site_name" content=""/>
<meta property="og:title" content="<?php wp_title(); ?>" />
<meta property="og:description" content="" />
<meta property="og:url" content="" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?php echo get_template_directory_uri(); ?>/img/avatar.jpg" />

<!-- Favicons -->
<link rel="icon" href="/favicon.ico">
<link rel="apple-touch-icon" sizes="144x144" href="apple-touch-icon-144x144.png">
<link rel="apple-touch-icon" sizes="114x114" href="apple-touch-icon-114x114.png">
<link rel="apple-touch-icon" sizes="72x72" href="apple-touch-icon-72x72.png">
<link rel="apple-touch-icon" href="apple-touch-icon.png">

<!-- CSS Custom -->
<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/main.css">

<!-- Modernizr -->
<script src="//cdnjs.cloudflare.com/ajax/libs/modernizr/2.6.2/modernizr.min.js"></script>

<!-- Respond -->
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/libs/respond.min.js"></script>
<![endif]-->

<?php wp_head(); ?>

<!-- Verif Mobile -->
<?php
   require_once(get_template_directory().'/in/mobile_detect.php');
   $detect = new Mobile_Detect();

   $isMobile = $detect->isMobile();
   $isTablet = $detect->isTablet();

   $notMobile = ! $isMobile || $isTablet;
   $onlyMobile = $isMobile && ! $isTablet;
?>    
</head>
<body <?php body_class(); ?>>

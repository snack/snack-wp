<?php
define('WP_USE_THEMES', false);
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
?>
<!doctype html>
<html class="no-js" lang="pt-br" ng-app="snackApp" ng-controller="snackController as snack">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Guia de Estilos - Snack Framework Front End</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/wp-content/themes/desenvolvesp/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="/wp-content/themes/desenvolvesp/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="/wp-content/themes/desenvolvesp/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="/wp-content/themes/desenvolvesp/manifest.json">
    <link rel="mask-icon" href="/wp-content/themes/desenvolvesp/safari-pinned-tab.svg" color="#0d4da1">
    <link rel="shortcut icon" href="/wp-content/themes/desenvolvesp/favicon.ico">
    <meta name="msapplication-config" content="/wp-content/themes/desenvolvesp/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">

    <!-- Snack CSS -->
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri();?>/build/css/main.min.css">

    <!-- Styleguide CSS -->
    <link rel="stylesheet" href="build/css/main.min.css">

</head>
<body class="styleguide-page" ng-class="{ mobile: snack.isCurrent('/mobile'), tablet: snack.isCurrent('/tablet'), desktop: snack.isCurrent('/desktop'), 'sg-show-grid': snack.isCurrent('/grid') }">
    <header class="styleguide-header">
        <div class="entry-brand">
            <!-- Logo -->
            <h1 class="brand"><img src="/wp-content/themes/desenvolvesp/build/img/logo.png"></h1>

            <!-- Subtítulo -->
            <h2 class="subtitle">Guia de Estilos</h2>

            <!-- Ir -->
            <a class="ir" ng-click="scrollTo('conteudo')"><i class="fa fa-angle-double-down"></i></a>
        </div>
    </header>

    <div id="conteudo"></div>

    <!-- Navbar -->
    <nav class="navbar navbar-styleguide" aria-label="main navigation" role="navigation">

        <!-- Navbar hold -->
        <div class="navbar-hold container-fluid">

            <!-- Navbar Brand -->
            <div class="navbar-brand">
                <a href="/styleguide/"><img src="build/img/logo-snack.png" alt=""></a>
            </div>

            <!-- Navbar menu -->
            <ul class="navbar-menu" role="menubar">
                <li class="menu-item" ng-class="{ current: snack.isCurrent('/grid') }"><a href="#/grid"><i class="fa fa-table" aria-hidden="true"></i></a></li>
                <li class="menu-item" ng-class="{ current: snack.isCurrent('/mobile') }"><a href="#/mobile"><i class="fa fa-mobile" aria-hidden="true"></i></a></li>
                <li class="menu-item" ng-class="{ current: snack.isCurrent('/tablet') }"><a href="#/tablet"><i class="fa fa-tablet" aria-hidden="true"></i></a></li>
                <li class="menu-item" ng-class="{ current: snack.isCurrent('/desktop') }"><a href="#/desktop"><i class="fa fa-desktop" aria-hidden="true"></i></a></li>
                <li class="btn-item"><a href="https://github.com/snack/snack/blob/master/doc/index.md" class="btn btn-primary">Documentação</a></li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">

        <!-- Styleguide Item -->
        <div class="styleguide-item" ng-include="'views/colors.html'"></div>

        <!-- Styleguide Item -->
        <!--<div class="styleguide-item" ng-include="'views/navigation.html'"></div>-->

        <!-- Styleguide Item -->
        <div class="styleguide-item" ng-include="'views/typography.html'"></div>

        <!-- Styleguide Item -->
        <div class="styleguide-item" ng-include="'views/lists.html'"></div>

        <!-- Styleguide Item -->
        <div class="styleguide-item" ng-include="'views/tables.html'"></div>

        <!-- Styleguide Item -->
        <div class="styleguide-item" ng-include="'views/buttons.html'"></div>

        <!-- Styleguide Item -->
        <div class="styleguide-item" ng-include="'views/forms.html'"></div>

        <!-- Styleguide Item -->
        <!-- <div class="styleguide-item" ng-include="'views/template.html'"></div> -->

    </div>


    <!-- Back top -->
    <a class="back-top" href="#">&#8593;</a>

    <!-- Footer -->
    <footer class="styleguide-footer">
        <p class="styleguide-copyright">Guia de Estilos <i class="fa fa-heart" aria-hidden="true"></i> <a href="https://github.com/snack/snack">Snack Framework</a></p>
    </footer>

    <!-- Scripts -->
    <script src="build/js/scripts.js"></script>

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
        (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
        function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
        e=o.createElement(i);r=o.getElementsByTagName(i)[0];
        e.src='https://www.google-analytics.com/analytics.js';
        r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
        ga('create','UA-XXXXX-X','auto');ga('send','pageview');
    </script>
</body>
</html>

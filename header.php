<!DOCTYPE html>
<html lang="<?php language_attributes() ?>">

<head>
    <meta charset="<?php bloginfo("charset") ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body>

    <div class="site-wrap">

        <div class="site-mobile-menu">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>

        <header class="site-navbar" role="banner">
            <!-- <div class="container-fluid">
                <div class="row align-items-center">

                    <div class="col-12 search-form-wrap js-search-form">
                        <form method="get" action="#">
                            <input type="text" id="s" class="form-control" placeholder="Search...">
                            <button class="search-btn" type="submit"><span class="icon-search"></span></button>
                        </form>
                    </div>

                    <div class="col-4 site-logo">
                        <a href="index.html" class="text-black h2 mb-0">Mini Blog</a>
                    </div>

                    <div class="col-8 text-right">
                        <nav class="site-navigation" role="navigation">
                            <ul class="site-menu js-clone-nav mr-auto d-none d-lg-block mb-0">
                                <li><a href="category.html">Home</a></li>
                                <li><a href="category.html">Politics</a></li>
                                <li><a href="category.html">Tech</a></li>
                                <li><a href="category.html">Entertainment</a></li>
                                <li><a href="category.html">Travel</a></li>
                                <li><a href="category.html">Sports</a></li>
                                <li class="d-none d-lg-inline-block"><a href="#" class="js-search-toggle"><span class="icon-search"></span></a></li>
                            </ul>
                        </nav>
                        <a href="#" class="site-menu-toggle js-menu-toggle text-black d-inline-block d-lg-none"><span class="icon-menu h3"></span></a>
                    </div>
                </div>

            </div> -->
            <nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'your-theme-slug'); ?>">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <a class="navbar-brand" href="<?php echo site_url() ?>">miniBlog</a>
                    <?php
                    $navMenu = wp_nav_menu(array(
                        'theme_location'    => 'primary-menu',
                        'depth'             => 2,
                        'container'         => 'div',
                        'container_class'   => 'collapse navbar-collapse',
                        'container_id'      => 'bs-example-navbar-collapse-1',
                        'menu_class'        => 'nav navbar-nav ml-auto',
                        'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
                        'walker'            => new WP_Bootstrap_Navwalker(),
                        'echo' => false

                    ));
                    $navMenu = str_replace("dropdown-menu", "dropdown-menu animate slideIn", $navMenu);
                    echo $navMenu;
                    ?>
                </div>
            </nav>
            <?php wp_head() ?>
        </header>
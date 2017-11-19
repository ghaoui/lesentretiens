<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width">
        <title><?php bloginfo('name'); ?><?php wp_title('|'); ?></title>
        <?php wp_head(); ?>	 
    </head>
    <body>
        <header data-uk-sticky="{top:-200, animation: 'uk-animation-slide-top'}">
            
            <div class="top-header">
                <div class="container">
                    <div class="logo">
                        <a href="<?php bloginfo('url'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.png" alt=""></a>       
                    </div>
                    <ul class="menu-top-header">
                        <li>
                            <a href="#">FAQ</a>
                        </li>
                        <li>
                            <a href="#">Contact</a>
                        </li>
                        <li>
                            <a href="#">Sitemap</a>
                        </li>
                        <li>
                            <div><input ></div>
                        </li>
                        <li>
                       <?php echo qtranxf_generateLanguageSelectCode('text'); ?>
                        </li>
                    </ul>
                </div>     
            </div>
            <div class="menu-header">
                <div class="container">
                    <div class="menu-header-container">
                 <?php wp_nav_menu(array('theme_location' => 'header')); ?>
                        <a href="#">LOGIN</a>
                    </div>
                </div> 
            </div>
            
        </header>

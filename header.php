<?php
/**
 * The header for our theme.
 *
 * @package QOD_Starter_Theme
 */

 ?><!DOCTYPE html>
 <html <?php language_attributes(); ?>>
	 <head>
		 <meta charset="<?php bloginfo( 'charset' ); ?>">
		 <meta name="viewport" content="width=device-width, initial-scale=1">
		 <link rel="profile" href="http://gmpg.org/xfn/11">
		 <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	 <?php wp_head(); ?>
	 </head>

	 <body <?php body_class(); ?>>
		 <div id="page" class="hfeed site container">
			 <a class="skip-link screen-reader-text" href="#content"><?php esc_html( 'Skip to content' ); ?></a>

			 <header id="masthead" class="site-header" role="banner">
				 <div class="site-branding">
					 <div class="logo">
						 <h1 class="site-title screen-reader-text"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						 <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							 <img src="<?php echo get_template_directory_uri() . '/images/qod-logo.svg'?>" class="logo" alt="Quotes on Dev logo" />
						 </a>
					 </div>
				 </div><!-- .site-branding -->
			 </header><!-- #masthead -->

			 <div id="content" class="site-content">

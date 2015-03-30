<?php
/**
* 	Childrootstrap header personalizado
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<!-- favicon -->

<?php if ( rootstrap_get_option( 'custom_favicon' ) ) { ?>
<link rel="icon" href="<?php echo rootstrap_get_option( 'custom_favicon' ); ?>" />
<?php } ?>

<!--[if IE]><?php if ( rootstrap_get_option( 'custom_favicon' ) ) { ?><link rel="shortcut icon" href="<?php echo rootstrap_get_option( 'custom_favicon' ); ?>" /><?php } ?><![endif]-->

<?php wp_head(); ?>
</head>

<!-- <body <?php body_class(); ?>> -->
<body <?php body_class(); ?>>

<div id="page" class="hfeed site">
<?php do_action( 'nav-before' ); ?>
	<div class="div-header">
		<nav class="navbar navbar-default" role="navigation">
			<div class="container mode-mobile">
			    <div id="navbar-header" class="navbar-header">
			        <button id="btn-toggle-header" type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
			            <span class="sr-only">Toggle navigation</span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			            <span class="icon-bar"></span>
			        </button>
					<div id="logo" class="col-xs-8">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						    <figure class="logo_website">
						    	<img src="<?php echo esc_url( home_url('wp-content/themes/childrootstrap/images/Logo.png') ); ?>">
						    </figure>
						</a>
					</div>
					<!-- <button id="btn-share" class="icon-share btn-share"></button> -->
			    </div>
				<?php header_menu(); ?>
			</div>
			<div class="container mode-table-desktop col-md-11 col-lg-8">
			   	<div id="logo" class="col-md-3 col-sm-4 col-lg-3">
			   		<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					    <figure class="logo_website">
					    	<img src="<?php echo esc_url( home_url('wp-content/themes/childrootstrap/images/Logo.png') ); ?>">
					    </figure>
					</a>
				</div>
				<div class="col-sm-5 col-lg-5 social-header">
					<?php rootstrap_social(); ?>
				</div>
				<a href="#" class="btn-blog col-xs-11 col-sm-2 col-md-2 btn-default btn btn-lg">Blog</a>
			</div>
		</nav><!-- .site-navigation -->
		<h2 class="cita_header">Stay Positive. Share. Be happy.</h2>
<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package rootstrap
 */
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
get_header(); ?>

		<div class="top-section">
			<?php rootstrap_call_for_action(); ?>
		</div>
	</div> <!-- Cierre bloque div del header -->

	<?php
		// $query_term_ids = "SELECT term_id FROM prot_terms WHERE slug = 'male' OR slug = 'female'";
		$query_term_ids = "SELECT term_id FROM o5ok_terms WHERE slug = 'male' OR slug = 'female'";
		$terms_ids = $wpdb->get_results($query_term_ids);
	?>

	<div id="content" class="site-content container col-xs-12">
		<div class="title-products">
			<p><span class="text-left">Our Products</span><span class="text-right">Live with Happiness</span></p>
		</div>
		<div class="content-area col-xs-12 col-md-11">
			<div id="main" class="site-main" role="main">
				<div class="estruct-xs">
					<section class="slider">
						<a href="#" class="icon-chevron-thin-left"></a>
						<div id="frame-slider">
							<ul></ul>
						</div>
						<a href="#" class="icon-chevron-thin-right"></a>
					</section>
					<div class="options">
						<div class="col-xs-12 gender" data-check="">
							<p class="col-xs-12">GENDER</p>
							<a id="btn-gender-female"  href="#" class="btn-gender" data-idterm="<?php echo $terms_ids[0]->term_id; ?>">
								<figure class="btn-gender-female">
									<img src="<?php echo esc_url( home_url( '/wp-content/themes/childrootstrap/images/icon-female.png' ) ); ?>">
								</figure>
							</a>
							<a id="btn-gender-male"  href="#" class="btn-gender" data-idterm="<?php echo $terms_ids[1]->term_id; ?>">
								<figure class="btn-gender-male">
									<img src="<?php echo esc_url( home_url( '/wp-content/themes/childrootstrap/images/icon-male.png' ) ); ?>">
								</figure>
							</a>
						</div>
						<div class="col-xs-12 quantity">
							<p class="col-xs-12">QUANTITY</p>
							<a href="#" class="btn-op btn-minus icon-circle-minus"></a>
							<span class="text-option">1</span>
							<a href="#" class="btn-op btn-plus icon-circle-plus"></a>
						</div>
						<div class="col-xs-12 size">
							<p class="col-xs-12">SIZE</p>
							<a href="#" class="btn-op btn-left icon-chevron-thin-left"></a>
							<span class="text-option"></span>
							<a href="#" class="btn-op btn-right icon-chevron-thin-right"></a>
						</div>
						<div class="col-xs-12">
							<p class="col-xs-12">PRICE</p>
							<span class="text-option price"></span>
						</div>
						<div id="circularG" class="loading">
							<div id="circularG_1" class="circularG">
							</div>
							<div id="circularG_2" class="circularG">
							</div>
							<div id="circularG_3" class="circularG">
							</div>
							<div id="circularG_4" class="circularG">
							</div>
							<div id="circularG_5" class="circularG">
							</div>
							<div id="circularG_6" class="circularG">
							</div>
							<div id="circularG_7" class="circularG">
							</div>
							<div id="circularG_8" class="circularG">
							</div>
						</div>
					</div>
				</div>
				<div class="estruct-sm col-lg-11">
					<section class="slider col-sm-7 col-lg-7">
						<a href="#" class="icon-chevron-thin-left"></a>
						<div id="frame-slider">
							<ul></ul>
						</div>
						<a href="#" class="icon-chevron-thin-right"></a>
					</section>
					<div class="options col-sm-5 col-lg-4">
						<div class="col-xs-12 col-sm-12 gender" data-check="">
							<p class="col-xs-12">GENDER</p>
							<a id="btn-gender-female" href="#" class="btn-gender" data-idterm="<?php echo $terms_ids[0]->term_id; ?>">
								<figure class="btn-gender-female">
									<img src="<?php echo esc_url( home_url( '/wp-content/themes/childrootstrap/images/icon-female.png' ) ); ?>">
								</figure>
							</a>
							<a id="btn-gender-male" href="#" class="btn-gender" data-idterm="<?php echo $terms_ids[1]->term_id; ?>">
								<figure class="btn-gender-male">
									<img src="<?php echo esc_url( home_url( '/wp-content/themes/childrootstrap/images/icon-male.png' ) ); ?>">
								</figure>
							</a>
						</div>
						<div class="col-xs-12 col-sm-12 quantity">
							<p class="col-xs-12">QUANTITY</p>
							<a href="#" class="btn-op btn-minus icon-circle-minus"></a>
							<span class="text-option">1</span>
							<a href="#" class="btn-op btn-plus icon-circle-plus"></a>
						</div>
						<div class="col-xs-12 col-sm-12 size">
							<p class="col-xs-12">SIZE</p>
							<a href="#" class="btn-op btn-left icon-chevron-thin-left"></a>
							<span class="text-option"></span>
							<a href="#" class="btn-op btn-right icon-chevron-thin-right"></a>
						</div>
						<div class="col-xs-12">
							<p class="col-xs-12">PRICE</p>
							<span class="text-option price"></span>
						</div>
						<div class="sec-button col-xs-12 col-sm-12 mode-table-desktop">
							<button id="btn-get" class="btn-content col-md-8 col-sm-12 col-xs-6 btn btn-lg">Get It!</button>
						</div>
						<div id="circularG" class="loading">
							<div id="circularG_1" class="circularG">
							</div>
							<div id="circularG_2" class="circularG">
							</div>
							<div id="circularG_3" class="circularG">
							</div>
							<div id="circularG_4" class="circularG">
							</div>
							<div id="circularG_5" class="circularG">
							</div>
							<div id="circularG_6" class="circularG">
							</div>
							<div id="circularG_7" class="circularG">
							</div>
							<div id="circularG_8" class="circularG">
							</div>
						</div>
					</div>
				</div>
				<div class="sec-button col-xs-12 mode-mobile">
					<button id="btn-get" class="btn-content col-md-2 col-sm-4 col-xs-6 btn btn-lg">Get It!</button>
				</div>
			</div><!-- #main -->
		</div><!-- #primary -->
<?php get_footer(); ?>
<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package rootstrap
 */
?>
<?php do_action( 'rootstrap_content_end' ); ?>
	</div><!-- #content -->
<?php do_action( 'rootstrap_footer_before' ); ?>
	<div id="">
	<?php do_action( 'rootstrap_footer_start' ); ?>
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="suscription col-xs-12 col-sm-12 col-md-11 col-lg-9">
				<p class="text-footer col-sm-5 col-lg-4">Receive Valuable quotes & news for a positive life in your email!</p>
				<form id="form-suscription" action="#" class="col-sm-7 col-lg-8 form-estruct-sm">
					<input id="email-suscription" name="email-suscription" class="col-xs-9 col-lg-10 field-email" type="email" required>
					<input id="btn-suscription" class="col-xs-3 col-lg-2" type="submit" value="Yes!">
				</form>
				<p id="text-msj" class="col-lg-12 col-md-9 col-sm-8 col-xs-12"></p>
			</div>
			<div class="logo-social col-xs-12 col-md-11 col-lg-8">
				<div class="col-sm-12">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
					    <figure class="logo_website col-sm-7">
					    	<img src="<?php echo esc_url( home_url('wp-content/themes/childrootstrap/images/Logo.png') ); ?>">
					    </figure>
					</a>
					<p class="text-footer">Get inspiration & good information at</p>
					<?php rootstrap_social(); ?>
				</div>
			</div>
			<div id="container-copyright" class="site-info container col-xs-12">
				<div class="copyright">
					<p>Developed by Uppersky Enterprise Ltd. &copy; 2015</p>
				</div>
			</div><!-- .site-info -->
			<div class="scroll-to-top"><i class="fa fa-angle-up"></i></div><!-- .scroll-to-top -->
		</footer><!-- #colophon -->
	</div>
	<?php do_action( 'rootstrap_footer_end' ); ?>
</div><!-- #page -->
<?php do_action( 'rootstrap_footer_after' ); ?>
<?php do_action( 'rootstrap_body_end' ); ?>
<?php wp_footer(); ?>
</body>
</html>
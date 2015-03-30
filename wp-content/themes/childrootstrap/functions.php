<?php
    function theme_topmenu_social() {
        echo '<div><div id="barra-header" class="container"><div class="col-md-12 col-xs-12">';
            echo '<div class="social col-md-11 col-sm-10 col-xs-9"><ul>';
                links_social();
            echo '</ul></div>';
            links_idiomas();
        echo '</div></div></div>';
    }
    add_action('iconos_sociales_idiomas_header', 'theme_topmenu_social');

    function theme_bottommenu_social(){
        echo '<div><div id="barra-footer" class="container"><div class="col-md-12 col-xs-12">';
            echo '<div class="social col-sm-12"><ul>';
                links_social();
            echo '</ul></div>';
        echo '</div></div></div>';
    }
    add_action('iconos_sociales_footer', 'theme_bottommenu_social');

    function links_idiomas(){
        $idiomas = array('es' => 'images/flag_spain.ico', 'en' => 'images/flag_england.ico');
        echo '<div id="idioma" class="lista_idiomas col-md-1 col-sm-2 col-xs-3"><ul>';
        foreach ($idiomas as $idioma => $icono):
            echo '<li><a class="link_idioma" href="#"><img src="'.esc_url( home_url( '/wp-content/themes/childrootstrap/'.$icono ) ).'"></a></li>';
        endforeach;
        echo '</ul></div>';
    }

    function registrar_scripts() {
        wp_enqueue_script( 'child-scripts', esc_url( home_url( '/wp-content/themes/childrootstrap/js/scripts.js') ), array('jquery') );
    }
    add_action( 'wp_enqueue_scripts', 'registrar_scripts' );

    function header_menu() {
            // display the WordPress Custom Menu if available
?>
        <div id="navbar-header-collapse" class="collapse navbar-collapse navbar-ex1-collapse">
<?php
            wp_nav_menu(array(
                        'menu'              => 'primary',
                        'theme_location'    => 'primary',
                        'depth'             => 2,
                        'container'         => false,
                        'menu_class'        => 'nav navbar-nav main-nav',
                        'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
                        'walker'            => new wp_bootstrap_navwalker()
            ));
?>
            <a href="#" class="btn-blog col-xs-11 btn-default btn btn-lg">Blog</a>
            <div class="col-xs-12 social-header">
                <?php rootstrap_social(); ?>
            </div>
        </div>
<?php }

?>
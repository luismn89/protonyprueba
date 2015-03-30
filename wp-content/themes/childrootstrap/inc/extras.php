<?php

//* adding top menu and top solcialbar
/*function rootstrap_theme_topmenu_social() {
     echo '<div class="top-link">' ?>
        <div  class="container">
            <div class="col-md-6">
            <?php rootstrap_top_links(); ?>
            </div>
            <div class="col-md-6 header-social">
            <?php rootstrap_social(); ?>
            </div>
        </div>
    </div>
<?php };
add_action('iconos_sociales', 'rootstrap_theme_topmenu_social');*/

//Display social links
/*function rootstrap_social(){
    $services = array ('facebook','twitter','googleplus','youtube','linkedin','pinterest','rss','tumblr','flickr','instagram','dribbble');

    echo '<div id="social" class="social"><ul>';

    foreach ( $services as $service ) :

        $active[$service] = rootstrap_get_option ('social_'.$service);
        if ($active[$service]) { echo '<li><a class="social-profile" href="'.$active[$service].'" class="icon-'. $service .'" title="'. __('Follow us on ','rootstrap').$service.'"><i class="social_icon fa fa-'.$service.'"></i></a></li>';}

    endforeach;
    echo '</ul></div>';
}*/
?>
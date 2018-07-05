<?php
/**
 * Created by PhpStorm.
 * User: ra
 * Date: 4/22/14
 * Time: 10:07 AM
 */

//check to see if we show the socials from our theme or from wordpress
if(td_util::get_option('td_social_networks_show') == 'show') { ?>
<div class="td-header-sp-top-widget">
    <div class="follow-us">
        <div class="textSub">Síguenos en:</div>
        <?php

            //get the socials that are set by user
            $td_get_social_network = td_util::get_option('td_social_networks');

            if(!empty($td_get_social_network)) {
                foreach($td_get_social_network as $social_id => $social_link) {
                    if(!empty($social_link)) {
                       echo td_social_icons::get_icon($social_link, $social_id, 4, 16, true);
                    }
                }
            }
        ?>
    </div>
    <div class="thisCNATVWrap">
        <div class="textSub">
            Televisión en vivo
        </div>
        <div>
            <a href="#sectionCnaEnVivo" class="thisCNATV" title="CNA en vivo">
                En vivo
                <span class="en-vivo-trending"><img src="https://cna.pe/wp-content/uploads/2018/03/en-vivo.gif"></span>
            </a>
        </div>
    </div>
    <div class="CNA_header_apps">
        <div class="textSub">
            Descarga la aplicación
        </div>
        <div class="wrap_header_apps">
            <a href="" class="" title="CNA en Play Store">    
                <img class="imgStore" src="<?php echo get_template_directory_uri(); ?>/images/custom/android-cna-small.png" alt="Play store">
            </a>
            <a href="" class="" title="CNA en App Store">    
                <img class="imgStore" src="<?php echo get_template_directory_uri(); ?>/images/custom/app-store-small.png" alt="App Store">
            </a>
        </div>
    </div>
</div>
<?php
}
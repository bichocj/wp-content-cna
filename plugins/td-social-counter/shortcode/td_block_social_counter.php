<?php
/**
 * This is the UI part of the social counter. 009 and 010 use different ui versions
 * User: ra
 * Date: 10/1/2014
 * Time: 11:26 AM
 */


class td_block_social_counter extends td_block {

    function render($atts, $content = null){
        parent::render($atts);

        $td_social_api = new td_social_api();

        extract(shortcode_atts(
            array(
                'icon_style' => '1', //not used
                'icon_size' => '32', //not yet used
                'custom_title' => '',
                'header_color' => '',
                'open_in_new_window' => ''
            ), $atts));

        $td_target = '';
        if (!empty($open_in_new_window)) {
            $td_target = ' target="_blank"';
        }

        $buffy = '';

        $buffy .= '<div class="' . $this->get_block_classes() . '">';
        $buffy .= $this->get_block_title();

	    foreach (td_social_icons::$td_social_icons_array as $td_social_id => $td_social_name) {
            if (!empty($atts[$td_social_id])) {
	            $access_token = '';
	            if (array_key_exists($td_social_id . '_access_token', $atts)) {
		            $access_token = $atts[$td_social_id . '_access_token'];
	            }
	            $social_network_meta = $this->get_social_network_meta($td_social_id, $atts[$td_social_id], $td_social_api, $access_token);
                
                if ( $td_social_id == 'whatsapp') {
                    $buffy .= '<div class="td_social_type td-pb-margin-side td_social_' . $td_social_id . '">';
                    $buffy .= '<div class="td-sp td-sp-' . $td_social_id . '"></div>';
                    // $buffy .= '<span class="td_social_info">' . number_format($social_network_meta['api']) . '</span>';
                    $buffy .= '<span class="td_social_info td_social_info_name">' . $social_network_meta['text'] . '</span>';
                    $buffy .= '<span class="td_social_button"><a href="' . $social_network_meta['url'] . '"' . $td_target . '>' .
                        $social_network_meta['button'] . '</a></span>';
                    $buffy .= '</div>';
                } else if ( $td_social_id == 'periscope') {
                  
                    $buffy .= '<div class="td_social_type td-pb-margin-side td_social_' . $td_social_id . '">';
                    $buffy .= '<div class="td-sp td-sp-' . $td_social_id . '"></div>';
                    // $buffy .= '<span class="td_social_info">' . number_format($social_network_meta['api']) . '</span>';
                    $buffy .= '<span class="td_social_info td_social_info_name">' . $social_network_meta['text'] . '</span>';
                    $buffy .= '<span class="td_social_button"><a href="' . $social_network_meta['url'] . '"' . $td_target . '>' .
                        $social_network_meta['button'] . '</a></span>';
                    $buffy .= '</div>';
                } else {
                    $buffy .= '<div class="td_social_type td-pb-margin-side td_social_' . $td_social_id . '">';
                    $buffy .= '<div class="td-sp td-sp-' . $td_social_id . '"></div>';
                    $buffy .= '<span class="td_social_info">' . number_format($social_network_meta['api']) . '</span>';
                    $buffy .= '<span class="td_social_info td_social_info_name">' . $social_network_meta['text'] . '</span>';
                    $buffy .= '<span class="td_social_button"><a href="' . $social_network_meta['url'] . '"' . $td_target . '>' .
                        $social_network_meta['button'] . '</a></span>';
                    $buffy .= '</div>';
                }
            }
        }
        $buffy .= '</div> <!-- ./block -->';

        return $buffy;
    }

    //used only on render
    function get_social_network_meta($service_id, $user_id, &$td_social_api, $access_token = '') {
	    switch ($service_id) {
            case 'facebook':
                return array(
                    'button' => __td('Like'),
                    'url' => "https://www.facebook.com/$user_id",
                    'text' => __td('Fans'),
                    'api' => $td_social_api->get_social_counter($service_id, $user_id, false, $access_token),
                );
                break;

            case 'twitter':
                return array(
                    'button' => __td('Follow'),
                    'url' => "https://twitter.com/$user_id",
                    'text' => __td('Followers'),
                    'api' => $td_social_api->get_social_counter($service_id, $user_id, false, $access_token),
                );
                break;

            case 'vimeo':
                return array(
                    'button' => __td('Like'),
                    'url' => "http://vimeo.com/$user_id",
                    'text' => __td('Likes'),
                    'api' => $td_social_api->get_social_counter($service_id, $user_id, false, $access_token),
                );
                break;

            case 'youtube':
                return array(
                    'button' => __td('Subscribe'),
                    'url' => (strpos('channel/', $user_id) >= 0) ? "http://www.youtube.com/$user_id" : "http://www.youtube.com/user/$user_id",
                    'text' => __td('Subscribers'),
                    'api' => $td_social_api->get_social_counter($service_id, $user_id, false, $access_token),
                );
                break;

            case 'googleplus':
                return array(
                    'button' => __td('Follow'),
                    'url' => "https://plus.google.com/$user_id",
                    'text' => __td('Followers'),
                    'api' => $td_social_api->get_social_counter($service_id, $user_id, false, $access_token),
                );
                break;

            case 'instagram':
                return array(
                    'button' => __td('Follow'),
                    'url' => "http://instagram.com/$user_id#",
                    'text' => __td('Followers'),
                    'api' => $td_social_api->get_social_counter($service_id, $user_id, false, $access_token),
                );
                break;

            case 'soundcloud':
                return array(
                    'button' => __td('Follow'),
                    'url' => "https://soundcloud.com/$user_id",
                    'text' => __td('Followers'),
                    'api' => $td_social_api->get_social_counter($service_id, $user_id, false, $access_token),
                );
                break;

            case 'periscope':
                return array(
                    'button' => __td('Ver'),
                    'url' => "https://www.pscp.tv/$user_id",
                    'text' => __td('Transmisión'),
                    // 'api' => $td_social_api->get_social_counter($service_id, $user_id, false, $access_token),    
                );
                break;

            case 'whatsapp':
                return array(
                    'button' => __td('Contacto'),
                    'url' => "https://api.whatsapp.com/send?phone=$user_id",
                    'text' => __td('985339090'),
                    // 'api' => $td_social_api->get_social_counter($service_id, $user_id, false, $access_token),    
                );
                break;
            
            case 'rss':
                return array(
                    'button' => __td('Follow'),
                    'url' => get_bloginfo('rss2_url'),
                    'text' => __td('Followers'),
                    'api' => $td_social_api->get_social_counter($service_id, $user_id, false, $access_token),
                );
                break;
        }
    }
}


<?php

class td_social_icons {
    static $td_social_icons_array = array( //*Reorder client requirement
        'facebook' => 'Facebook',
        'periscope' => 'Periscope', //Ojo se debe agregar un icon aquí
        'youtube' => 'Youtube',
        'twitter' => 'Twitter', 
        'instagram' => 'Instagram',
        'whatsapp' => 'Whatsapp',
        //Order client requirement
        'behance' => 'Behance',
        'blogger' => 'Blogger',
        'delicious' => 'Delicious',
        'deviantart' => 'Deviantart',
        'digg' => 'Digg',
        'dribbble' => 'Dribbble',
        'evernote' => 'Evernote',
        'flickr' => 'Flickr',
        'forrst' => 'Forrst',
        'googleplus' => 'Google+',
        'grooveshark' => 'Grooveshark',
        'html5' => 'Html5',
        'lastfm' => 'Lastfm',
        'linkedin' => 'Linkedin',
        'mail-1' => 'Mail',
        'myspace' => 'Myspace',
        'path' => 'Path',
        'paypal' => 'Paypal',
        'picasa' => 'Picasa',
        'pinterest' => 'Pinterest',
        'posterous' => 'Posterous',
        'reddit' => 'Reddit',
        'rss' => 'RSS',
        'share' => 'Share',
        'skype' => 'Skype',
        'soundcloud' => 'Soundcloud',
        'spotify' => 'Spotify',
        'stackoverflow' => 'Stackoverflow',
        'steam' => 'Steam',
        'stumbleupon' => 'StumbleUpon',
        'tumblr' => 'Tumblr',
        'vimeo' => 'Vimeo',
        'vk' => 'VKontakte',
        'windows' => 'Windows',
        'wordpress' => 'WordPress',
        'yahoo' => 'Yahoo',
    );




    static function get_icon($url, $icon_id, $open_in_new_window = false) {
        if ($open_in_new_window !== false) {
            $td_a_target = ' target="_blank"';
        } else {
            $td_a_target = '';
        }

		// append mailto: the email only if we have an @ and we don't have the mailto: already in place
	    if (
		    $icon_id == 'mail-1'
		    and strpos($url, '@') !== false
		        and strpos(strtolower($url), 'mailto:') === false
	    ) {
		    $url = 'mailto:' . $url;
	    }

        return '<span class="td-social-icon-wrap"><a' . $td_a_target . ' href="' . $url . '" title="' . self::$td_social_icons_array[$icon_id] . '"><i class="td-icon-font td-icon-' . $icon_id . '"></i></a></span>';
    }

}

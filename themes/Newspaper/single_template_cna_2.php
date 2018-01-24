<?php
// Template CNA 2 
// Template for videos

locate_template('includes/wp_booster/td_single_template_vars.php', true);

get_header();

global $loop_sidebar_position, $td_sidebar_position, $post;

$td_mod_single = new td_module_single($post);

?>
<div class="td-main-content-wrap">

    <div class="td-container td-post-template-2 post-template-cna-2">
        <article id="post-<?php echo $td_mod_single->post->ID;?>" class="<?php echo join(' ', get_post_class());?>" <?php echo $td_mod_single->get_item_scope();?>>
            <div class="td-pb-row">
                <div class="td-pb-span12">
                    <div class="td-post-header">
                        <div class="td-post-actions clearfix">
                            <!-- Breadcrumb -->
                            <div class="td-crumb-container"><?php echo td_page_generator::get_single_breadcrumbs($td_mod_single->title); ?></div>
                            <!-- Sharing 2 - module -->
                            <?php
                                $twitter_user = td_util::get_option( 'tds_tweeter_username' );
                                echo '<div class="td-default-sharing share_module_block post-sharing-buttons clearfix">
                                    <a class="td-social-sharing-buttons td-social-facebook" href="http://www.facebook.com/sharer.php?u=' . urlencode( esc_url( get_permalink() ) ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="td-icon-facebook"></i></a>
                                    <a class="td-social-sharing-buttons td-social-instagram"  target="_blank" href="https://www.instagram.com/cna.pe/" title="Instagram" ><i class="td-icon-font td-icon-instagram"></i></a>
                                    <a class="td-social-sharing-buttons td-social-twitter" href="https://twitter.com/intent/tweet?text=' . htmlspecialchars(urlencode(html_entity_decode(esc_html(get_the_title()), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . '&url=' . urlencode( esc_url( get_permalink() ) ) . '&via=' . urlencode( $twitter_user ? $twitter_user : get_bloginfo( 'name' ) ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="td-icon-twitter"></i></a>
                                    <a class="td-social-sharing-buttons td-social-youtube" target="_blank" href="https://www.youtube.com/channel/UCClyftK9ZJKavq9TaAyJl8w" title="Youtube"><i class="td-icon-font td-icon-youtube"></i></a>
                                    <a class="td-social-sharing-buttons td-social-whatsapp" href="whatsapp://send?text=' . htmlspecialchars(urlencode(html_entity_decode(esc_html(get_the_title()), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . ' - ' . urlencode( esc_url( get_permalink() ) ) . '" data-action="share/whatsapp/share" ><i class="td-icon-whatsapp"></i></a>

                                </div>'; ?>
                            <!-- end Sharing module -->    
                        </div>    
                        <?php echo $td_mod_single->get_category(); ?>                            
                        <header class="td-post-title">
                            <?php echo $td_mod_single->get_title();?>
                            <?php if (!empty($td_mod_single->td_post_theme_settings['td_subtitle'])) { ?>
                                <p class="td-post-sub-title"><?php echo $td_mod_single->td_post_theme_settings['td_subtitle'];?></p>
                            <?php } ?>
                            <!-- Sharing Top -->
                            <?php echo $td_mod_single->get_social_sharing_top();?>
                        </header>
                        <div class="wrapper-feature">
                                <?php
                                // override the default featured image by the templates (single.php and home.php/index.php - blog loop)
                                if (!empty(td_global::$load_featured_img_from_template)) {
                                    echo $td_mod_single->get_image(td_global::$load_featured_img_from_template);
                                } else {
                                    echo $td_mod_single->get_image('td_696x0');
                                }
                                ?>

                        </div>
                    </div>
                </div>
            </div> <!-- /.td-pb-row -->

            <div class="td-pb-row">
                <?php

                //the default template
                switch ($loop_sidebar_position) {
                    default:
                        ?>
                            <div class="td-pb-span8 td-main-content" role="main">
                                <div class="td-ss-main-content">
                                    <?php
                                    locate_template('loop-single-cna-2.php', true);
                                    comments_template('', true);
                                    ?>
                                </div>
                            </div>
                            <div class="sidebar-post-cna td-pb-span4 td-main-sidebar" role="complementary">
                                <div class="td-ss-main-sidebar">
                                    <?php get_sidebar(); ?>
                                </div>
                            </div>
                        <?php
                        break;

                    case 'sidebar_left':
                        ?>
                        <div class="td-pb-span8 td-main-content <?php echo $td_sidebar_position; ?>-content" role="main">
                            <div class="td-ss-main-content">
                                <?php
                                locate_template('loop-single-2.php', true);
                                comments_template('', true);
                                ?>
                            </div>
                        </div>
	                    <div class="sidebar-post-cna td-pb-span4 td-main-sidebar" role="complementary">
		                    <div class="td-ss-main-sidebar">
			                    <?php get_sidebar(); ?>
		                    </div>
	                    </div>
                        <?php
                        break;

                    case 'no_sidebar':
                        td_global::$load_featured_img_from_template = 'td_1068x0';
                        ?>
                        <div class="td-pb-span12 td-main-content" role="main">
                            <div class="td-ss-main-content">
                                <?php
                                locate_template('loop-single-2.php', true);
                                comments_template('', true);
                                ?>
                            </div>
                        </div>
                        <?php
                        break;

                }
                ?>
            </div> <!-- /.td-pb-row -->
        </article> <!-- /.post -->
    </div> <!-- /.td-container -->
</div> <!-- /.td-main-content-wrap -->

<?php

get_footer();
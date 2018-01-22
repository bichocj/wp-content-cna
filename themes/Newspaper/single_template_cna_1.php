<?php
// Template CNA 1
// Template for CNA news

locate_template('includes/wp_booster/td_single_template_vars.php', true);

get_header();

global $loop_sidebar_position, $td_sidebar_position, $post;

$td_mod_single = new td_module_single($post);

?>
<div class="td-main-content-wrap">

    <div class="td-container td-post-template-2 post-template-cna-1">
        <article id="post-<?php echo $td_mod_single->post->ID;?>" class="<?php echo join(' ', get_post_class());?>" <?php echo $td_mod_single->get_item_scope();?>>
            <div class="td-pb-row">
                <div class="td-pb-span12">
                    <div class="td-post-header">
                        <div class="td-crumb-container"><?php echo td_page_generator::get_single_breadcrumbs($td_mod_single->title); ?></div>
                        
                        <div class="td-post-actions clearfix">
                            <!-- Sharing module -->
                            <div class="td-default-sharing share_module_block post-sharing-buttons clearfix">
                                <a class="td-social-sharing-buttons td-social-facebook" href="http://www.facebook.com/sharer.php?u=http://localhost/wordpress/?p=722" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="td-icon-facebook"></i></a>
                                <a class="td-social-sharing-buttons td-social-twitter" href="https://twitter.com/intent/tweet?text=Papa+Francisco+en+Per%C3%BA%3A+PPK+inspeccion%C3%B3+las+instalaciones+de+Las+Palmas&amp;url=http://localhost/wordpress/?p=722&amp;via=CNA" onclick="window.open(this.href, 'mywin','left=50,top=50,width=600,height=350,toolbar=0'); return false;"><i class="td-icon-twitter"></i></a>
                                <a class="td-social-sharing-buttons td-social-whatsapp" href="whatsapp://send?text=Papa+Francisco+en+Per%C3%BA%3A+PPK+inspeccion%C3%B3+las+instalaciones+de+Las+Palmas - http%3A%2F%2Flocalhost%2Fwordpress%2F%3Fp%3D722" data-action="share/whatsapp/share"><i class="td-icon-whatsapp"></i></a>

                                <a class="td-social-sharing-buttons td-social-youtube" target="_blank" href="https://www.youtube.com/channel/UCClyftK9ZJKavq9TaAyJl8w" title="Youtube"><i class="td-icon-font td-icon-youtube"></i></a>
                                <a class="td-social-sharing-buttons td-social-instagram"  target="_blank" href="https://www.instagram.com/cna.pe/" title="Instagram"><i class="td-icon-font td-icon-instagram"></i></a>
                            </div>
                            <!-- end Sharing module -->
                            <?php echo $td_mod_single->get_category(); ?>                            

                        </div>
                        
                        <header class="td-post-title">
                            <?php echo $td_mod_single->get_title();?>


                            <?php if (!empty($td_mod_single->td_post_theme_settings['td_subtitle'])) { ?>
                                <p class="td-post-sub-title"><?php echo $td_mod_single->td_post_theme_settings['td_subtitle'];?></p>
                            <?php } ?>

                        </header>
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
                                    locate_template('loop-single-cna-1.php', true);
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
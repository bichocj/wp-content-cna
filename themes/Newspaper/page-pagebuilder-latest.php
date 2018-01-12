<?php
/* Template Name: Pagebuilder + latest articles + pagination */

get_header();

td_global::$current_template = 'page-homepage-loop';

global $paged, $loop_module_id, $loop_sidebar_position, $post, $more; //$more is a hack to fix the read more loop
$td_page = (get_query_var('page')) ? get_query_var('page') : 1; //rewrite the global var
$td_paged = (get_query_var('paged')) ? get_query_var('paged') : 1; //rewrite the global var


//paged works on single pages, page - works on homepage
if ($td_paged > $td_page) {
    $paged = $td_paged;
} else {
    $paged = $td_page;
}


$list_custom_title_show = true; //show the article list title by default




/*
    read the settings for the loop
---------------------------------------------------------------------------------------- */
if (!empty($post->ID)) {
    td_global::load_single_post($post);

    //read the metadata for the post
	//
	// the $td_homepage_loop is used instead
    // $td_homepage_loop_filter = get_post_meta($post->ID, 'td_homepage_loop_filter', true); //it's send to td_data_source
    $td_homepage_loop = get_post_meta($post->ID, 'td_homepage_loop', true);


    if (!empty($td_homepage_loop['td_layout'])) {
        $loop_module_id = $td_homepage_loop['td_layout'];
    }

    if (!empty($td_homepage_loop['td_sidebar_position'])) {
        $loop_sidebar_position = $td_homepage_loop['td_sidebar_position'];
    }

	// sidebar position used to align the breadcrumb on sidebar left + sidebar first on mobile issue
	$td_sidebar_position = '';
	if($loop_sidebar_position == 'sidebar_left') {
		$td_sidebar_position = 'td-sidebar-left';
	}

    if (!empty($td_homepage_loop['td_sidebar'])) {
        td_global::$load_sidebar_from_template = $td_homepage_loop['td_sidebar'];
    }

    if (!empty($td_homepage_loop['list_custom_title'])) {
        $td_list_custom_title = $td_homepage_loop['list_custom_title'];
    } else {
        $td_list_custom_title =__td('LATEST ARTICLES', TD_THEME_NAME);
    }


    if (!empty($td_homepage_loop['list_custom_title_show'])) {
        $list_custom_title_show = false;
    }


}
?>

<div class="td-main-content-wrap td-main-page-wrap">

<?php
/*
the first part of the page (built with the page builder)  - empty($paged) or $paged < 2 = first page
---------------------------------------------------------------------------------------- */
// td_global::$cur_single_template_sidebar_pos = 'no_sidebar';
if(!empty($post->post_content)) { //show this only when we have content
    if (empty($paged) or $paged < 2) { //show this only on the first page
        if (have_posts()) { ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <div class="td-container">
                    <?php the_content(); ?>
                </div>

            <?php endwhile; ?>
        <?php }
    }
}

?>

<?php if (is_home() || is_front_page()) { ?>
<!-- Lo Más visto -->
<div class="most_viewed_news td-main-content-wrap">
    <div class="td-container">
        <div class="block-title">
            <span>Lo más visto en CNA</span>
        </div>
        <?php $news_query = new WP_Query( array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 4) );
                 ?>
        <?php if($news_query->have_posts()) : ?>
        <ul class="lnList">
            <?php while($news_query->have_posts()) : $news_query->the_post(); ?>
            <li>
                <?php 
                        $thumbID = get_post_thumbnail_id( $post->ID );
                        $imgDestacada = wp_get_attachment_image_src( $thumbID, 'thumbnail' ); // Thumbnail, medium, large, full
                        $imgTitle = get_the_title();
                        $urlNews = get_permalink();
                        echo '<a class="nImage hidden-xs" href="'. $urlNews .'"> <img width="150" height="150" class="entry-thumb td-animation-stack-type0-1 hidden-xs" src="'.$imgDestacada[0].'"
                        alt="" title="'.$imgTitle.'"> </a>'
                ?>
                <div class="nTitle">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </div>
            </li>
            <?php endwhile; ?>
        </ul>
        <?php endif ?>
    </div>
</div>
<!-- end Lo Más Visto -->
<?php } ?>

<div class="td-container td-pb-article-list">
    <div class="td-pb-row">
        <?php
        // set the $cur_single_template_sidebar_pos - for gallery and video playlist
        td_global::$cur_single_template_sidebar_pos = $loop_sidebar_position;
        //the default template
        switch ($loop_sidebar_position) {
            default: //sidebar right
                ?>
                    <div class="td-pb-span8 td-main-content" role="main">
                        <div class="td-ss-main-content">
                            <!-- CNA TV -->
                            <div class="cnaTV">
                                <h4 class="block-title"><span>Video de CNA</span></h4>                                
                                <div
                                    style="height: 450px"> Aquí video de CNA
                                </div>
                            </div>
                            <!-- End CNA TV -->
                            <!-- Noticias -->
                            <?php if ((empty($paged) or $paged < 2) and $list_custom_title_show === true) { ?>
                                <h4 class="block-title"><span><?php echo $td_list_custom_title?></span></h4>
                            <?php }


                            //query_posts(td_data_source::metabox_to_args($td_homepage_loop_filter, $paged));
                            query_posts(td_data_source::metabox_to_args($td_homepage_loop, $paged));
                            locate_template('loop.php', true);
                            td_page_generator::get_pagination();
                            wp_reset_query();
                            ?>
                            <!-- end Noticias -->
                        </div>
                    </div>
                    <div class="td-pb-span4 td-main-sidebar" role="complementary">
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
                        <?php if ((empty($paged) or $paged < 2) and $list_custom_title_show === true) { ?>
                            <h4 class="block-title"><span><?php echo $td_list_custom_title?></span></h4>
                        <?php }

                        //query_posts(td_data_source::metabox_to_args($td_homepage_loop_filter, $paged));
                        query_posts(td_data_source::metabox_to_args($td_homepage_loop, $paged));
                        locate_template('loop.php', true);
                        td_page_generator::get_pagination();
                        wp_reset_query();
                        ?>
                    </div>
                </div>
	            <div class="td-pb-span4 td-main-sidebar" role="complementary">
		            <div class="td-ss-main-sidebar">
			            <?php get_sidebar(); ?>
		            </div>
	            </div>
                <?php
                break;

            case 'no_sidebar':
                //td_global::$load_featured_img_from_template = 'art-slide-big';
                td_global::$load_featured_img_from_template = 'full';
                ?>
                <div class="td-pb-span12 td-main-content" role="main">
                    <div class="td-ss-main-content">
                        <?php if ((empty($paged) or $paged < 2) and $list_custom_title_show === true) { ?>
                            <h4 class="block-title"><span><?php echo $td_list_custom_title?></span></h4>
                        <?php }

                        //query_posts(td_data_source::metabox_to_args($td_homepage_loop_filter, $paged));
                        query_posts(td_data_source::metabox_to_args($td_homepage_loop, $paged));
                        locate_template('loop.php', true);
                        td_page_generator::get_pagination();
                        wp_reset_query();
                        ?>
                    </div>
                </div>
                <?php
                break;

        }
        ?>
    </div> <!-- /.td-pb-row -->
</div> <!-- /.td-container -->
</div> <!-- /.td-main-content-wrap -->

<?php

get_footer();
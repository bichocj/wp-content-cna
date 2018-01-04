<?php
/**
 * single Post template CNA 1
 **/

if (have_posts()) {
    the_post();

    $td_mod_single = new td_module_single($post);

    ?>

        <?php echo $td_mod_single->get_social_sharing_top();?>

        
        <div class="td-post-content">

            <?php
            // override the default featured image by the templates (single.php and home.php/index.php - blog loop)
            if (!empty(td_global::$load_featured_img_from_template)) {
                echo $td_mod_single->get_image(td_global::$load_featured_img_from_template);
            } else {
                echo $td_mod_single->get_image('td_696x0');
            }
            ?>
            <div class="td-module-meta-info">
                <?php echo $td_mod_single->get_author_1();?>
                <?php echo $td_mod_single->get_date(false);?>
                <?php echo $td_mod_single->get_views();?>
                <?php echo $td_mod_single->get_comments();?>
            </div>
            <?php echo $td_mod_single->get_content();?>
        </div>


        <footer>
            <?php echo $td_mod_single->get_post_pagination();?>
            <?php echo $td_mod_single->get_review();?>

            <div class="td-post-source-tags">
                <?php echo $td_mod_single->get_source_and_via();?>
                <?php echo $td_mod_single->get_the_tags();?>
            </div>

            <?php echo $td_mod_single->get_social_sharing_bottom();?>
            <?php echo $td_mod_single->get_next_prev_posts();?>
            <?php echo $td_mod_single->get_author_box();?>
	        <?php echo $td_mod_single->get_item_scope_meta();?>
        </footer>

    <?php echo $td_mod_single->related_posts();?>

<?php
} else {
    //no posts
    echo td_page_generator::no_posts();
}
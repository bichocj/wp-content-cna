<!--
Header style 6 - CNA
-->

<div class="td-header-wrap td-header-style-6 td-header-cna">

    <div class="td-banner-wrap-full">
        <div class="td-container td-container-header td-header-row td-header-header">
            <div class="td-header-sp-recs">
                <?php locate_template('parts/header/ads.php', true); ?>
            </div>
        </div>
    </div>


    <div class="td-header-top-menu-full">
        <div class="td-container td-header-row td-header-top-menu">
            <?php td_api_top_bar_template::_helper_show_top_bar() ?>
        </div>
    </div>

    <div class="td-header-menu-wrap-full">
        <div class="td-header-menu-wrap">
            <div class="td-container td-header-row td-header-main-menu black-menu">
                <?php locate_template('parts/header/header-menu.php', true);?>
            </div>
        </div>
    </div>
    <!-- <hr class="menu-separator"> -->

    <div class="td-banner-wrap-full">
        <div class="td-container td-container-header td-header-row td-header-header">
            <div class="td-header-sp-recs">
                <?php locate_template('parts/header/ads.php', true); ?>
            </div>
        </div>
    </div>


    <?php // If is home
        if (is_home() || is_front_page()) { ?>
        <div class="headerBlockTop"
            <!-- Trending News -->
            <div id="trendingNews" class="td_block_trending_now">
                <div class="td-trending-now-wrapper trending-now-header" id="td_uid_2_5a543d4bd7620" data-start="">
                    <div class="td-container">
                        <div class="td-trending-now-title"><span>Titulares</span></div>
                        <div class="td-trending-now-display-area">

                            <?php   $args = array(
                                    'post_type' => 'post',
                                    'post_status' => 'publish',
                                    'posts_per_page' => 4
                                );
                                $queryTrend = new WP_Query($args); 
                            ?>
                                
                            <?php if ($queryTrend->have_posts()) : ?>
                                <!-- <div class="td_module_trending_now td-trending-now-post-0 td-trending-now-post" style="opacity: 0; z-index: 0;"> -->
                                <?php while ($queryTrend->have_posts()) : $queryTrend->the_post() ;?>
                                    <div class="td_module_trending_now td-trending-now-post" style="opacity: 0; z-index: 0;">
                                        <h3 class="entry-title td-module-title">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                    </div>
                                    
                                <?php endwhile; ?>

                            <?php else: 
                                echo 'No hay nada para mostrar en este momentos';
                            ?> 
                                
                            <?php endif; wp_reset_postdata(); ?>
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Last News -->
            <div id="last-news-bar" class="td_block_wrap td_block_15 ">
                <div id="" class=" td-column-3">
                    <div class="td-block-row">
                    <?php $newsQuery = new WP_Query( array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 4) );?>
                    <?php if($newsQuery->have_posts()) : ?>
                        <div id="header-bxslider">
                            <?php while($newsQuery->have_posts()) : $newsQuery->the_post(); ?>
                            <!-- td-block-span4 -->
                            <div class="td-block-span4">
                                <div class="td_module_mx4 td_module_wrap td-animation-stack">
                                    <div class="td-module-image">
                                        <div class="td-module-thumb">
                                            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
                                            <?php 
                                                    $thumbID = get_post_thumbnail_id( $post->ID );
                                                    $imgDestacada = wp_get_attachment_image_src( $thumbID, 'large' ); // Thumbnail, medium, large, full
                                                    $imgTitle = get_the_title();
                                                    echo '<img width="218" height="150" class="entry-thumb td-animation-stack-type0-1" src="'.$imgDestacada[0].'"
                                                    alt="" title="'.$imgTitle.'">'
                                            ?>
                                            </a>
                                        </div>
                                        <?php 
                                            foreach((get_the_category()) as $key => $category){
                                                $category_name = $category->name;
                                                $category_id = get_cat_ID( $category_name ); 
                                                $category_link = get_category_link( $category_id ); 
                                                if($key == 0) {
                                                    echo '<a href="'. $category_link.'" class="td-post-category">'. $category_name .'</a>';
                                                }
                                            }
                                        ?>
                                    </div>

                                    <h3 class="entry-title td-module-title">
                                        <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                </div>
                            </div> 
                            <!-- ./td-block-span4 -->
                            <?php endwhile; ?>
                        </div>
                    <?php endif; wp_reset_postdata(); ?>
                    </div>
                </div>
            </div>
        </div>
    
    <?php  // If is a post single
        } elseif (is_single()) { ?>
            <div class="td-container">
                <div class="headerSingleTop">
                    <!-- 6 Last News -->
                    <div id="last-6-news" class="">
                        <h4 class="l6-title"> <span> Más noticias </span> </h4>
                        <div class="l6-row clearfix">
                            <?php $news6Query = new WP_Query( array('post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 6) );?>
                            <?php if($news6Query->have_posts()) : ?>
                                <div id="last-6-news-bxslider">
                                    <?php while($news6Query->have_posts()) : $news6Query->the_post(); ?>
                                    <!-- l6-block-->
                                    <div class="l6-block2">
                                        <div class="l6-module td-animation-stack">
                                            <div class="td-module-image">
                                                <div class="td-module-thumb">
                                                    <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">
                                                    <?php 
                                                            $thumbID = get_post_thumbnail_id( $post->ID );
                                                            $imgDestacada = wp_get_attachment_image_src( $thumbID, array(218,150) ); // Thumbnail, medium, large, full
                                                            $imgTitle = get_the_title();
                                                            echo '<img width="218" height="150" class="entry-thumb td-animation-stack-type0-1" src="'.$imgDestacada[0].'"
                                                            alt="" title="'.$imgTitle.'">'
                                                    ?>
                                                    </a>
                                                </div>
                                                <!-- <?php 
                                                    foreach((get_the_category()) as $key => $category){
                                                        $category_name = $category->name;
                                                        $category_id = get_cat_ID( $category_name ); 
                                                        $category_link = get_category_link( $category_id ); 
                                                        if($key == 0) {
                                                            echo '<a href="'. $category_link.'" class="td-post-category">'. $category_name .'</a>';
                                                        }
                                                    }
                                                ?> -->
                                            </div>

                                            <h5 class="entry-title td-module-title">
                                                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
                                            </h5>
                                        </div>
                                    </div> 
                                    <!-- ./l6-block  -->
                                    <?php endwhile; ?>
                                </div>    
                            <?php endif; wp_reset_postdata(); ?>
                        </div>
                    </div>
                </div>
            </div>
    <?php }?>


</div>
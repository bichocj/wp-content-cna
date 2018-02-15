<?php if (td_util::get_option('tds_top_bar') != 'hide_top_bar') { ?>

    <div class="top-bar-style-2 clearfix">
        <?php locate_template('parts/header/top-widget.php', true); ?>
        <div class="td-header-sp-logo">
            <h1 class="td-logo"> 
                <a class="td-main-logo" href="/">
                    <img class="td-retina-data" src="<?php echo get_template_directory_uri(); ?>/images/custom/nuevologocna-header-white.png" alt="CNA en todo el mundo" title="CNA, en todo el mundo">
                    <span class="td-visual-hidden">CNA NOTICIAS</span>
                </a>
            </h1> 
        </div>
        <?php locate_template('parts/header/top-menu.php', true); ?>
    </div>

<?php } ?> 
<?php

class td_module_10 extends td_module {

    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();
        ?>

        <div class="<?php echo $this->get_module_classes();?>">
            <?php echo $this->get_image('td_218x150');?>

            <div class="item-details">
            <?php echo $this->get_title();?>

                <div class="td-module-meta-info">
                    <?php if (td_util::get_option('tds_category_module_10') == 'yes') { echo $this->get_category(); }?>
                        <?php echo $this->get_author();?>
                        <?php echo $this->get_date();?>
                        <?php echo $this->get_comments();?>
                </div>

                <div class="td-excerpt">
                    <?php echo $this->get_excerpt();?>
                </div>
                <?php echo '<div class="td-default-sharing share_module_block share_module_mx11">
                <a class="td-social-sharing-buttons td-social-facebook" href="https://www.facebook.com/sharer.php?u=' . $this->href . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="td-icon-facebook"></i></a>
                <a class="td-social-sharing-buttons td-social-twitter" href="https://twitter.com/intent/tweet?text=' . htmlspecialchars(urlencode(html_entity_decode($this->title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . '&url=' . $this->href . '&via=' . urlencode( $twitter_user ? $twitter_user : get_bloginfo( 'name' ) ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="td-icon-twitter"></i></a>
                <a class="td-social-sharing-buttons td-social-whatsapp hidden-xs" href="whatsapp://send?text=' . htmlspecialchars(urlencode(html_entity_decode($this->title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . ' - ' . urlencode( esc_url( $this->href ) ) . '" data-action="share/whatsapp/share" ><i class="td-icon-whatsapp"></i></a>
            </div>'; ?>
            </div>

        </div>

        <?php return ob_get_clean();
    }

}
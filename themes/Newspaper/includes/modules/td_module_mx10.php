<?php
/**
 * Created by PhpStorm.
 * User: tagdiv
 * Date: 03.02.2015
 * Time: 10:05
 */

class td_module_mx10 extends td_module {

    function __construct($post) {
        parent::__construct($post);
    }

    function render($order_no) {
        ob_start();
        ?>

        <div class="<?php echo $this->get_module_classes(array("td-big-grid-post-$order_no", "td-big-grid-post", "td-small-thumb")); ?> smallGrid2Gallery">
            <?php
                echo $this->get_image('td_324x160');
            ?>
            <?php echo '<div  class="td-default-sharing share_module_block share_module_mx10">

                <a class="td-social-sharing-buttons td-social-facebook" href="http://www.facebook.com/sharer.php?u=' . $this->href . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="td-icon-facebook"></i></a>

                <a class="td-social-sharing-buttons td-social-twitter" href="https://twitter.com/intent/tweet?text=' . htmlspecialchars(urlencode(html_entity_decode($this->title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . '&url=' . $this->href . '&via=' . urlencode( $twitter_user ? $twitter_user : get_bloginfo( 'name' ) ) . '" onclick="window.open(this.href, \'mywin\',\'left=50,top=50,width=600,height=350,toolbar=0\'); return false;"><i class="td-icon-twitter"></i></a>
                
                <a class="td-social-sharing-buttons td-social-whatsapp" href="whatsapp://send?text=' . htmlspecialchars(urlencode(html_entity_decode($this->title, ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8') . ' - ' . urlencode( esc_url( $this->href ) ) . '" data-action="share/whatsapp/share" ><i class="td-icon-whatsapp"></i></a>

            </div>'; ?>

            <div class="td-meta-info-container">
                <div class="td-meta-align">
                    <div class="td-big-grid-meta">
                        <?php if (td_util::get_option('tds_category_module_mx10') == 'yes') { echo $this->get_category(); }?>
                        <?php echo $this->get_title();?>
                        <div class="module_excerpt">
                        <?php echo $this->get_excerpt(); ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <?php return ob_get_clean();
    }
}
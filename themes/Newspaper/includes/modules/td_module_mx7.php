<?php
class td_module_mx7 extends td_module {
    function __construct($post) {
        //run the parrent constructor
        parent::__construct($post);
    }

    function render() {
        ob_start();
        ?>

        <div class="<?php echo $this->get_module_classes();?>">
            <div class="td-module-image">
                <?php echo $this->get_image('td_218x150');?>
                <?php if (td_util::get_option('tds_category_module_mx7') == 'yes') { echo $this->get_category(); }?>
            </div>

            <div class="item-details">
                <?php echo $this->get_title();?>

                <div class="td-module-meta-info">
                    <?php echo $this->get_author();?>
                    <?php echo $this->get_date();?>
                    <?php echo $this->get_comments();?>
                </div>

                <div class="td-excerpt">
                    <?php echo $this->get_excerpt();?>
                </div>
            </div>

        </div>

        <?php
        return ob_get_clean();
    }
}
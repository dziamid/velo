<?php
/**
 * The template for displaying product category thumbnails within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product_cat.php
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
    $woocommerce_loop['loop'] = 0;
}

$woocommerce_loop['li_class'] = array();

//standard li class
$woocommerce_loop['li_class'][] = 'product-category product';

if ( YIT_Layout()->sidebars['layout'] == 'sidebar-double' ) {
    $woocommerce_loop['li_class'][] = 'col-sm-6';
    $woocommerce_loop['columns']    = '2';
}
elseif ( YIT_Layout()->sidebars['layout'] == 'sidebar-right' || YIT_Layout()->sidebars['layout'] == 'sidebar-left' ) {
    $woocommerce_loop['li_class'][] = 'col-sm-4';
    $woocommerce_loop['columns']    = '3';
}
else {
    $woocommerce_loop['li_class'][] = 'col-sm-3';
    $woocommerce_loop['columns']    = '4';
}

// Increase loop count
$woocommerce_loop['loop'] ++;

// add class first/last
if ( ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] == 0 || $woocommerce_loop['columns'] == 1 ) {
    $woocommerce_loop['li_class'][] = 'first';
}
if ( $woocommerce_loop['loop'] % $woocommerce_loop['columns'] == 0 ) {
    $woocommerce_loop['li_class'][] = 'last';
}

?>

<li <?php post_class( $woocommerce_loop['li_class'] ) ?> >

    <?php do_action( 'woocommerce_before_subcategory', $category ); ?>

    <a href="<?php echo get_term_link( $category->slug, 'product_cat' ); ?>" class="product-category-link">

        <div class="category-thumb">
            <?php
            /**
             * woocommerce_before_subcategory_title hook
             *
             * @hooked woocommerce_subcategory_thumbnail - 10
             */
            do_action( 'woocommerce_before_subcategory_title', $category );


            if ( ( isset( $show_counter ) && $show_counter == 1 ) && $category->count > 0 ) : ?>

                <div class="category-count">
                    <div class="category-count-content">
                        <?php
                            echo apply_filters( 'woocommerce_subcategory_count_html', ' <span class="count">' . $category->count . _n( " product", " products", $category->count, "yit" ) . '</span>', $category );
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="category-name">
            <h4>
                <?php echo $category->name; ?>
            </h4>
        </div>

        <?php
        /**
         * woocommerce_after_subcategory_title hook
         */
        do_action( 'woocommerce_after_subcategory_title', $category );
        ?>

    </a>

    <?php do_action( 'woocommerce_after_subcategory', $category ); ?>

</li>
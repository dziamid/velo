<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

global $product, $woocommerce_loop;

// check if is mobile
$isMobile = YIT_Mobile()->isMobile();

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
    return;
}

$woocommerce_loop['shown_product'] = true;

// Set the products layout style
if( ! isset( $woocommerce_loop['products_layout'] ) || $woocommerce_loop['products_layout'] == 'default' ) {
    $woocommerce_loop['products_layout'] = yit_get_option( 'shop-layout-type' );
}

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
    $woocommerce_loop['loop'] = 0;
}

// Increase loop count
$woocommerce_loop['loop'] ++;

// Extra post classes
$woocommerce_loop['li_class'] = array();

// view
if ( ! isset( $woocommerce_loop['view'] ) ) {
    $woocommerce_loop['view'] = yit_get_option( 'shop-view-type', 'grid' );
}

//force flip layout in masonry
if( $woocommerce_loop['view'] == 'masonry_item' || $isMobile ) {
    $woocommerce_loop['products_layout'] = 'flip';
}

$woocommerce_loop['li_class'][] = $woocommerce_loop['view'];

// Set column
if ( ( is_shop() || is_product_category() ) && ! $isMobile ) {
    $woocommerce_loop['li_class'][] = 'col-sm-' . intval( 12/ intval( yit_get_option( 'shop-num-column' ) ) );
    $woocommerce_loop['columns'] = intval( yit_get_option( 'shop-num-column' ) );
}
else {

    $sidebar = YIT_Layout()->sidebars;

    if ( $sidebar['layout'] == 'sidebar-double' ) {
        $woocommerce_loop['li_class'][] = 'col-sm-6 col-xs-6';
        $woocommerce_loop['columns']    = '2';
    }
    elseif ( $sidebar['layout'] == 'sidebar-right' || $sidebar['layout'] == 'sidebar-left' ) {
        $woocommerce_loop['li_class'][] = 'col-sm-4 col-xs-6';
        $woocommerce_loop['columns']    = '3';
    }
    else {
        $woocommerce_loop['li_class'][] = 'col-sm-3 col-xs-6';
        $woocommerce_loop['columns']    = '4';
    }
}

// Add class first or last
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
    $woocommerce_loop['li_class'][] = 'first';
} if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
    $woocommerce_loop['li_class'][] = 'last';
}

?>
<li <?php post_class( $woocommerce_loop['li_class'] ); ?> >


    <div class="clearfix product-wrapper <?php echo $woocommerce_loop['products_layout'] ?>">

        <?php do_action( 'woocommerce_before_shop_loop_item' ); ?>

        <div class="thumb-wrapper <?php echo $woocommerce_loop['products_layout'] ?>">

            <?php
            /**
             * woocommerce_before_shop_loop_item_title hook
             *
             * @hooked woocommerce_show_product_loop_sale_flash - 10
             * @hooked woocommerce_template_loop_product_thumbnail - 10
             */
            do_action( 'woocommerce_before_shop_loop_item_title' );
            ?>

        </div>

        <div class="product-meta">
            <?php if ( yit_get_option( 'shop-product-title' ) == 'yes' ): ?>
                <h3 class="product-name">
                    <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                </h3>
            <?php endif ?>

            <?php
            /**
             * woocommerce_after_shop_loop_item_title hook
             *
             * @hooked woocommerce_template_loop_rating - 5
             * @hooked woocommerce_template_loop_price - 10
             */
            do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
        </div>


        <div class="product-actions-wrapper">
            <div class="product-actions">
                <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
            </div>
        </div>
    </div>

</li>

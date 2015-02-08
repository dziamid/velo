<?php
/**
 * Loop Add to Cart
 *
 * @author        WooThemes
 * @package       WooCommerce/Templates
 * @version       2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
} // Exit if accessed directly

if ( yit_get_option( 'shop-add-to-cart-button' ) == 'no' && yit_get_option( 'shop-view-details-button' ) == 'no' ) {
    return;
}

global $product;

?>

<div class="product-buttons">

    <?php

    if ( yit_get_option( 'shop-add-to-cart-button' ) == 'yes' && yit_get_option( 'shop-enable' ) == 'yes' ) {

        if ( ! $product->is_in_stock() ) : ?>
            <a href="<?php echo apply_filters( 'out_of_stock_add_to_cart_url', get_permalink( $product->id ) ); ?>" class="out-of-stock btn btn-flat"><?php echo apply_filters( 'out_of_stock_add_to_cart_text', __( 'Out Of Stock', 'yit' ) ); ?></a>
        <?php

        else :

            $link = array(
                'url'      => '',
                'label'    => '',
                'class'    => '',
                'quantity' => 1
            );

            $handler = apply_filters( 'woocommerce_add_to_cart_handler', $product->product_type, $product );

            switch ( $handler ) {
                case "variable" :
                    $link['url']   = apply_filters( 'variable_add_to_cart_url', get_permalink( $product->id ) );
                    $link['label'] = apply_filters( 'variable_add_to_cart_text', __( 'Set options', 'yit' ) );
                    break;
                case "grouped" :
                    $link['url']   = apply_filters( 'grouped_add_to_cart_url', get_permalink( $product->id ) );
                    $link['label'] = apply_filters( 'grouped_add_to_cart_text', __( 'View options', 'yit' ) );
                    break;
                case "external" :
                    $link['url']   = apply_filters( 'external_add_to_cart_url', get_permalink( $product->id ) );
                    $link['label'] = apply_filters( 'external_add_to_cart_text', __( 'Read More', 'yit' ) );
                    break;
                default :
                    if ( $product->is_purchasable() ) {
                        $link['url']      = apply_filters( 'add_to_cart_url', esc_url( $product->add_to_cart_url() ) );
                        $link['label']    = apply_filters( 'add_to_cart_text', __( 'Add to cart', 'yit' ) );
                        $link['class']    = apply_filters( 'add_to_cart_class', 'add_to_cart_button' );
                        $link['quantity'] = apply_filters( 'add_to_cart_quantity', ( get_post_meta( $product->id, 'minimum_allowed_quantity', true ) ? get_post_meta( $product->id, 'minimum_allowed_quantity', true ) : 1 ) );
                    }
                    else {
                        $link['url']   = apply_filters( 'not_purchasable_url', get_permalink( $product->id ) );
                        $link['label'] = apply_filters( 'not_purchasable_text', __( 'Read More', 'yit' ) );
                    }
                    break;
            }

            echo apply_filters( 'woocommerce_loop_add_to_cart_link', sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-quantity="%s" data-product_sku="%s" class="%s btn btn-flat product_type_%s">%s</a>', esc_url( $link['url'] ), esc_attr( $product->id ), esc_attr( $link['quantity'] ), esc_attr( $product->get_sku() ), esc_attr( $link['class'] ), esc_attr( $product->product_type ), esc_html( $link['label'] ) ), $product, $link );

        endif;
    }

    if (yit_get_option( 'shop-quick-view-enable' ) == 'yes' && ( ( YIT_Mobile()->isMobile() && YIT_Mobile()->is( 'iPad' ) ) || ! YIT_Mobile()->isMobile() ) ) {
        $text = apply_filters( 'quick_view_text', __( 'Quick View', 'yit' ) );
        $sc_index = function_exists('YIT_Shortcodes') && YIT_Shortcodes()->is_inside ? '-' . YIT_Shortcodes()->index() : '';
        echo '<a id="quick-view-trigger-' . esc_attr( $product->id ) . $sc_index . '" href="#" class="trigger-quick-view btn btn-alternative details" data-item_id="'. $product->id . '">'.$text.'</a>';
    }
    else if ( yit_get_option( 'shop-view-details-button' ) == 'yes' ) {
        $text = apply_filters( 'view_details_text', __( 'View Details', 'yit' ) );
        echo '<a href="' . get_permalink( $product->id ) . '" rel="nofollow" title="' . $text . '" class="btn btn-alternative details">' . $text . '</a>';
    }

    ?>
</div>



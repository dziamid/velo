<?php
/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for list all (or limited) product categories (slider)
 *
 * @package Yithemes
 * @author  Francesco Licandro <francesco.licandro@yithemes.com>
 * @since   1.0.0
 */

wp_enqueue_script( 'owl-carousel' );

global $woocommerce_loop;

$animate = ( $animate != '' ) ? ' yit_animate ' . $animate : '';
$delay = ( $animation_delay != '' ) ? 'data-delay="' . $animation_delay . '"' : '';

$ids = '';
if ( isset( $category ) && $category != '' ) {
    $ids = explode( ',', $category );
    $ids = array_map( 'trim', $ids );
    if ( in_array( '0', $ids ) ) {
        $ids = '';
    }
}

$woocommerce_loop['setLast'] = true;

if ( ! ( $show_counter ) || $show_counter == 'no' || $show_counter != 'yes' ) {
    $show_counter = '0';
}
elseif ( $show_counter == 'yes' ) {
    $show_counter = '1';
}
else {
    $show_counter = '1';
}

$hide_empty = ( !isset($hide_empty) || $hide_empty == 'yes' ) ? 1 : 0;


$args = array(
    'orderby'      => $orderby,
    'order'        => $order,
    'hide_empty'   => $hide_empty,
    'include'      => $ids,
    'hierarchical' => 1,
    'taxonomy'     => 'product_cat',
);


if ( $orderby == 'menu_order' ) {
    unset( $args ['orderby'], $args['order'] );
    $args ['menu_order'] = $order;
}

$terms = get_categories( $args );

if ( $terms ) {

    ob_start();

    $html = $html_mobile = '';

    $i = 0;
    echo '<div class="woocommerce' . $animate .'"' . $delay .'>';


    echo '<div class="categories-slider-wrapper" data-columns="%columns%" data-autoplay="' . $autoplay . '">';

    if( isset( $title ) && $title != '' ) {
        echo '<h3 class="categories-slider-title">' . $title . '</h3>';
    }

    echo '<div class="categories-slider">';

    echo '<div class="row"><ul class="products">';
    foreach ( $terms as $category ) {
        wc_get_template( 'content-product_cat.php', array(
            'category'       => $category,
            'show_counter'   => $show_counter,
        ) );
    }
    echo '</ul></div>';

    echo '<div class="es-nav"><div class="es-nav-prev"><span class="fa fa-chevron-left"></span></div><div class="es-nav-next"><span class="fa fa-chevron-right"></span></div></div>';

    echo '</div><div class="es-carousel-clear"></div>';

    echo '</div>';

    echo '</div>';

    $content = ob_get_clean();
    echo str_replace( '%columns%', $woocommerce_loop['columns'], $content );

}

wp_reset_query();

$woocommerce_loop['loop'] = 0;
unset( $woocommerce_loop['setLast'] );

?>
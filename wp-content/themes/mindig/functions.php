<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Theme's functions.php file.
 *
 * This file bootstrap the entire framework.
 *
 * @package Yithemes
 *
 */


/*
 * WARNING: This file is part of the Your Inspiration Themes framework core.
 * Edit this section at your own risk.
 */

//let's start the game!
require_once('core/yit.php');
add_filter( 'woocommerce_variable_free_price_html',  'hide_free_price_notice' );
add_filter( 'woocommerce_free_price_html',           'hide_free_price_notice' );
add_filter( 'woocommerce_variation_free_price_html', 'hide_free_price_notice' );
 
/**
 * Скрываем метку 'Бесплатно!' со страниц магазина
 */
function hide_free_price_notice( $price ) {
 
  return '';
}
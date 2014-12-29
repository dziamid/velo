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
 * Template file for show an info box
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com>
 * @since 1.0.0
 */
$animate = ( $animate != '' ) ? ' yit_animate '.$animate : '';
$delay = ( $animation_delay  != '' ) ? 'data-delay="'.$animation_delay.'"' : '';
?>

<div class="box info-box  <?php echo $animate ?>" <?php echo $delay ?>>
    <span class="ico"></span><?php echo do_shortcode($content); ?>
</div>
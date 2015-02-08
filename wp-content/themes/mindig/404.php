<?php
/*
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
$file = yit_get_option('content-no-header-footer')=="yes" ? '404' : '';

get_header( $file );

$sidebar = YIT_Layout()->sidebars;
$sidebar = is_array( $sidebar ) ? $sidebar : array( 'layout' => $sidebar );

do_action( 'yit_before_primary' ) ?>
   <!-- START PRIMARY -->
    <div id="primary" class="<?php echo $sidebar['layout'] ?>">
        <div class="container group">
            <div class="row">
                <?php do_action( 'yit_before_content' ); ?>
                <!-- START CONTENT -->

                <div id="content-index" class="col-sm-<?php echo $sidebar['layout'] != "sidebar-no" ? 9 : 12 ?> content group">
                    <?php do_action( 'yit_404' ) ?>
                </div>
				
				
                <!-- END CONTENT -->
                <?php do_action( 'yit_after_content' ) ?>



                <?php do_action( 'yit_after_sidebar' ) ?>
            </div>
			<br>
			<h1>Категории товаров:</h1>
<div class="slidertov"><?php echo do_shortcode ("[products_categories_slider title='' show_counter='yes' hide_empty='yes' animation_delay='0' orderby='menu_order' order='desc' animate='' autoplay='true' category='48, 41, 61, 49, 45, 43, 50, 44' ]"); ?></div>        
	   </div>
   
   </div>
	
    <!-- END PRIMARY -->
	  
<?php
do_action( 'yit_after_primary' );
get_footer( $file );
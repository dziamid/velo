<?php
/**
 * YITH WooCommerce Ajax Search template
 *
 * @author Your Inspiration Themes
 * @package YITH WooCommerce Ajax Search
 * @version 1.1.1
 */

if ( !defined( 'YITH_WCAS' ) ) { exit; } // Exit if accessed directly


wp_enqueue_script('yith_wcas_jquery-autocomplete' );

?>

<div class="yith-ajaxsearchform-container">
    <label class="screen-reader-text" for="yith-s"><?php _e( 'Search', 'yit' ) ?></label>
    <?php


    $args = apply_filters( 'yit_ajaxsearch_form_cat_args', array(
        'menu_order'	=> 'ASC',
        'parent'        => 0,
        'hide_empty'	=> 1,
        'hierarchical'	=> 0,
    ) );

    $product_categories = get_terms( 'product_cat', $args );

    $selected_category = ( isset( $_REQUEST['product_cat']) ) ?  $_REQUEST['product_cat'] : '';

    if(  !empty( $product_categories ) ) : ?>
        <select class="search_categories selectbox" id="search_categories">
            <option value="" <?php selected( '', $selected_category ) ?>><?php _e( 'All', 'yit' ) ?></option>
            <?php foreach( $product_categories as $cat ): ?>
                <option value="<?php echo $cat->slug ?>" <?php selected( $cat->slug, $selected_category ) ?>><?php echo $cat->name ?></option>
            <?php endforeach; ?>
        </select>
    <?php endif ?>
<form role="search" method="get" id="yith-ajaxsearchform" action="<?php echo esc_url( home_url( '/'  ) ) ?>">
    <div>
        <input type="submit" id="yith-searchsubmit" value="<?php echo get_option('yith_wcas_search_submit_label') ?>" />

        <div class="nav-searchfield">
            <div id="nav-searchfield-container">
            <input type="search" value="<?php echo get_search_query() ?>" name="s" id="yith-s" class="yith-s" placeholder="<?php echo get_option('yith_wcas_search_input_label') ?>" />
            </div>
        </div>
        <input type="hidden" name="post_type" value="product" />
        <input type="hidden" id="product_cat" name="product_cat" value="" />
    </div>
</form>
</div>
<script type="text/javascript">
jQuery(function($){

    $.fn.setCursorToTextEnd = function() {
        var $initialVal = this.val();
        this.val($initialVal);
    };

    var search =  $('#yith-s'),
        search_loader_url = <?php echo apply_filters('yith_wcas_ajax_search_icon', 'woocommerce_params.ajax_loader_url') ?>,
        search_categories = $('#search_categories'),
        cat = '',
        options = {
            minChars: <?php echo get_option('yith_wcas_min_chars') * 1; ?>,
            appendTo: '.yith-ajaxsearchform-container',
            serviceUrl: woocommerce_params.ajax_url + '?action=yith_ajax_search_products',
            onSearchStart: function(){

                $(this).css('background', 'url('+search_loader_url+') no-repeat right center');
                $(document).trigger('yit_ajax_search_init');


            },
            onSearchComplete: function(){
                $(this).css('background', 'transparent');
            },
            onSelect: function (suggestion) {
                if( suggestion.id != -1 ) {
                    window.location.href = suggestion.url;
                }
            }
        };

        var ac = search.autocomplete(options);

    if( search_categories.length ){
        search_categories.on( 'change', function( e ){
            $('#product_cat').val( search_categories.val() ) ;
            if( search_categories.val() != '' ) {
                ac.autocomplete( 'setOptions', { serviceUrl:  woocommerce_params.ajax_url + '?action=yith_ajax_search_products&product_cat=' + search_categories.val() });
            }else{
                ac.autocomplete( 'setOptions', { serviceUrl:  woocommerce_params.ajax_url + '?action=yith_ajax_search_products' });
            }
        });
    }


});
</script>
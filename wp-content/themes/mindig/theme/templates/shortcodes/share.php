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
 * Template file for print share buttons
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com> ,Andrea Frascaspata <andrea.frascaspata@yithemes.com>, Emanuela Castorina <emanuela.castorina@yithemes.com>
 * @since 1.0.0
 */

/* Social list */

$morphbutton =  array(
    'src'           => YIT_THEME_ASSETS_URL . '/css/morphbutton.css',
    'enqueue'       => true,
    'registered'    => false
);

$ui_morphing_button   = array(
    'src'       => YIT_THEME_ASSETS_URL . '/js/uiMorphingButton_inflow.js',
    'enqueue'   => true,
    'deps'      => array('jquery', 'jquery-commonlibraries')
);

YIT_Asset()->set( 'style', 'morphbutton-stylesheet', $morphbutton );
YIT_Asset()->set( 'script', 'ui-morphing-button', $ui_morphing_button );

$socials_accepted = array( 'facebook', 'twitter', 'google', 'pinterest');

if( is_serialized( $socials ) ){
    $socials = unserialize( $socials );
    $socials = empty( $socials ) ? $socials_accepted : $socials;
}else{
    $socials = empty( $socials ) ? $socials_accepted : array_map( 'trim', explode( ',', $socials ) );
}

$class_container ="";

switch( $show_in ):
    case 'inline':

        if( !empty( $class ) )
        { $class = ' ' . $class; }

        echo "<div class='share-container'>";

                if(!empty($icon_share)) echo '<i class="fa fa-'. $icon_share .'"></i>';    //icon

                if ( ! empty( $title ) ) echo '<span class="share-text">' . $title . '</span>';   // title

                echo "<div class='socials-container ".$class_container."'>";

                echo '<div class="socials' . $class . '">';   // begin list of socials


                foreach ( $socials as $i => $social ) {
                    if ( in_array( $social, $socials_accepted ) ) {

                        $url = $script = $attrs = '';

                        global $post;

                        $title = urlencode( get_the_title() );
                        $permalink = urlencode( get_permalink() );
                        $excerpt = urlencode( get_the_excerpt() );

                        if ( $social == 'facebook' ) {
                            $url = apply_filters( 'yiw_share_facebook', 'https://www.facebook.com/sharer.php?u=' . $permalink . '&t=' . $title . '' );

                        } else if ( $social == 'twitter' ) {
                            $url = apply_filters( 'yiw_share_twitter', 'https://twitter.com/share?url=' . $permalink . '&text=' . $title . '' );

                        } else if ( $social == 'google' ) {
                            $social="google-plus";//fix after social.php use awesome icons
                            $url = apply_filters( 'yiw_share_google', 'https://plus.google.com/share?url=' . $permalink . '&title=' . $title . '' );
                            $attrs = " onclick=\"javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;\"";

                        } else if ( $social == 'pinterest' ) {
                            $src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
                            $url = apply_filters( 'yiw_share_pinterest', 'http://pinterest.com/pin/create/button/?url=' . $permalink . '&media=' . $src[0] . '&description=' . $excerpt );
                            $attrs = ' onclick="window.open(this.href); return false;';

                        }

                        if ($size=="small"){
                            $icon_size="18";
                            $circle_size="35";
                        }
                        else {
                            $icon_size="34";
                            $circle_size="55";
                        }

                        echo do_shortcode( '[social icon_type="'.$icon_type.'"  icon_social="' . $social . '" href="' . $url . '"' . $attrs . ' target="_blank" size="' . $size . '" icon_size="'.$icon_size.'" circle="yes" circle_size="'.$circle_size.'" circle_border_size="1" title="'.$social.'"]' );
                        echo $script;
                    }
                }

                echo '</div>';   // end list of socials

                echo '</div>';

        echo '</div>';


        break;
    case 'modal':

        $style = '';
        $icon = '';
        $text = '<span class="share-text">' . __( 'Share it', 'yit' ) . '</span>';
        if( $icon_source == 'custom'){
            if( $icon_url != '' ){
                $image_id = yit_get_attachment_id( $icon_url );
                list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = wp_get_attachment_image_src( $image_id, "full" );
                $style = 'background:url('.$icon_url.') no-repeat; width:'.$thumbnail_width.'px; height:'.$thumbnail_height.'px;text-indent:-999999px;display:block';
            }
        }elseif( $icon_source == 'theme-icon'){
            if( !empty($icon_theme) ){
                $icon = '<i class="fa fa-'. $icon_theme .'"></i>';    //icon
            }
        }
        if ( ! empty( $title ) ) {
            $text = '<span class="share-text">' . $title . '</span>';
        }   // title
        echo '<div class="share-modal">';
        echo '<div class="share-button"><a href="#" class="yit_share" style="'.$style.'">'. $icon . $text . '</a></div>';
        echo '<div class="share-container"><h3>' . __( 'share on: ', 'yit' ) . '</h3>';

        yit_get_social_share( 'text' );
        echo '</div>';
        echo '</div>';

        break;
    case 'dropdown':
        $style = '';
        $icon = '';
        $text = '<span class="share-text">' . __( 'Share it', 'yit' ) . '</span>';
        if( $icon_source == 'custom'){
            if( $icon_url != '' ){
                $image_id = yit_get_attachment_id( $icon_url );
                list( $thumbnail_url, $thumbnail_width, $thumbnail_height ) = wp_get_attachment_image_src( $image_id, "full" );
                $style = 'background:url('.$icon_url.') no-repeat; width:'.$thumbnail_width.'px; height:'.$thumbnail_height.'px;text-indent:-999999px;display:block';
            }
        }elseif( $icon_source == 'theme-icon'){
            if( !empty($icon_theme) ){
                $icon = '<i class="fa fa-'. $icon_theme .'"></i>';    //icon
            }
        }
        if ( ! empty( $title ) ) {
            $text = '<span class="share-text">' . $title . '</span>';
        }   // title
        echo '<div class="shortcode morph-button morph-button-inflow morph-button-inflow-2">';
        echo '<button type="button">';
        echo '<span class="share" style="'.$style.'">' . $icon . $text . '</span></button>';
        echo '<div class="morph-content"><div>';
                    yit_get_social_share( 'text', 'content-style-social', array( 'facebook', 'twitter', 'google' ) );
        echo '</div></div>';

    break;
endswitch;



/**
 * This file belongs to the YIT Plugin Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Template file for print share buttons
 *
 * @package Yithemes
 * @author Francesco Licandro <francesco.licandro@yithemes.com> ,Andrea Frascaspata <andrea.frascaspata@yithemes.com>
 * @since 1.0.0
 */

/*

$class_container ="";
if ($show_in_cloud=="yes"){

    $class_container="cloud" ;

    ?>
    <script>

        (function ($) {
            "use strict";

            $('body').on( 'yit_share_init_shortcode', yit_share_init_shortcode );

            function yit_share_init_shortcode(){

                $( '.single-post .blog .share' ).add( '.share-container').off('click').on('click', function(){
                    var t       = $(this);
                    var social  = t.find('.socials-container');

                    if( social.is(':visible') ) {
                        social.slideUp('slow');
                    }else{
                        social.slideDown('slow');
                    }
                });
            }

            $('body').trigger('yit_share_init_shortcode');

        })(jQuery);

    </script>

<?php

}

if( !empty( $class ) )
{ $class = ' ' . $class; }

echo "<div class='share-container'>";

if(!empty($icon_share)) echo '<i class="fa fa-'. $icon_share .'"></i>';    //icon

if ( ! empty( $title ) ) echo '<span class="share-text">' . $title . '</span>';   // title

echo "<div class='socials-container ".$class_container."'>";

echo '<div class="socials' . $class . '">';   // begin list of socials

$socials_accepted = array( 'facebook', 'twitter', 'google', 'pinterest');
if( is_serialized( $socials ) ){
    $socials = unserialize( $socials );
    $socials = empty( $socials ) ? $socials_accepted : $socials;
}
else{
    $socials = empty( $socials ) ? $socials_accepted : array_map( 'trim', explode( ',', $socials ) );
}

foreach ( $socials as $i => $social ) {
    if ( in_array( $social, $socials_accepted ) ) {

        $url = $script = $attrs = '';

        global $post;

        $title = urlencode( get_the_title() );
        $permalink = urlencode( get_permalink() );
        $excerpt = urlencode( get_the_excerpt() );

        if ( $social == 'facebook' ) {
            $url = apply_filters( 'yiw_share_facebook', 'https://www.facebook.com/sharer.php?u=' . $permalink . '&t=' . $title . '' );

        } else if ( $social == 'twitter' ) {
            $url = apply_filters( 'yiw_share_twitter', 'https://twitter.com/share?url=' . $permalink . '&text=' . $title . '' );

        } else if ( $social == 'google' ) {
            $social="google-plus";//fix after social.php use awesome icons
            $url = apply_filters( 'yiw_share_google', 'https://plus.google.com/share?url=' . $permalink . '&title=' . $title . '' );
            $attrs = " onclick=\"javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;\"";

        } else if ( $social == 'pinterest' ) {
            $src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full');
            $url = apply_filters( 'yiw_share_pinterest', 'http://pinterest.com/pin/create/button/?url=' . $permalink . '&media=' . $src[0] . '&description=' . $excerpt );
            $attrs = ' onclick="window.open(this.href); return false;';

        }

        if ($size=="small"){
            $icon_size="18";
            $circle_size="35";
        }
        else {
            $icon_size="34";
            $circle_size="55";
        }

        echo do_shortcode( '[social icon_type="'.$icon_type.'"  icon_social="' . $social . '" href="' . $url . '"' . $attrs . ' target="_blank" size="' . $size . '" icon_size="'.$icon_size.'" circle="yes" circle_size="'.$circle_size.'" title="'.$social.'"]' );
        echo $script;
    }
}

echo '</div>';   // end list of socials

echo '</div>';

echo '</div>';

$socials = array( 'facebook', 'twitter', 'google', 'pinterest' );
echo '<div class="product-share">'.__("Share on","yit").': ' . do_shortcode('[share show_in_cloud="no" icon_type="text" socials=' . serialize( $socials ) . ']') . '</div><div class="clearfix"></div>';

*/


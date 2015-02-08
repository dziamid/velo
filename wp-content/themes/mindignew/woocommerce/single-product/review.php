<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $post;
$rating = esc_attr( get_comment_meta( $GLOBALS['comment']->comment_ID, 'rating', true ) );
?>
<li itemprop="reviews" itemscope itemtype="http://schema.org/Review" <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
    <div id="comment-<?php comment_ID(); ?>" class="comment_container">



        <div class="comment-text arrow-down">

                <div itemprop="description" class="description"><?php comment_text(); ?></div>

        </div>

        <div class="clearfix comment-info">

            <?php echo get_avatar( $GLOBALS['comment'], $size='71' ); ?>

            <?php if ($GLOBALS['comment']->comment_approved == '0') : ?>
                <p class="meta"><em><?php _e( 'Your comment is awaiting approval', 'yit' ); ?></em></p>
            <?php else : ?>

                <div class="meta">

                <span class="vcard author" itemprop="author">
                        <span class="fn"><?php comment_author(); ?></span>
                    </span>

                    <?php
                    //check if the user is registered
                    $user_id = ! get_user_by( 'id', $GLOBALS['comment']->user_id ) ? false : $GLOBALS['comment']->user_id;

                    if ( $rating && get_option('woocommerce_review_rating_verification_label') == 'yes' )
                        if ( wc_customer_bought_product( $GLOBALS['comment']->comment_author_email, $user_id, $post->ID ) )
                            echo '<em class="verified">(' . __( 'verified owner', 'yit' ) . ')</em> ';
                    ?>

                    <time class='timestamp-link' expr:href='data:post.url' title='permanent link' itemprop="datePublished">
                        <abbr class='updated published' expr:title='data:post.timestampISO8601'>
                            <data:post.timestamp/>
                            <?php echo get_comment_date(__( get_option('date_format'), 'yit' )); ?>
                        </abbr>
                    </time>

                    <?php if ( get_option('woocommerce_enable_review_rating') == 'yes' ) : ?>
                        <div class="woocommerce-product-rating" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" title="<?php echo sprintf( __( 'Rated %d out of 5', 'yit' ), $rating ) ?>">
                            <div class="star-rating">
                                <span style="width:<?php echo ( ( $rating / 5 ) * 100 ) ?>%"></span>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>

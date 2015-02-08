<?php

/**
 * BuddyPress - Groups Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_legacy_theme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php
wp_enqueue_script( 'jquery-masonry' );
?>

<?php do_action( 'bp_before_groups_loop' ); ?>

<?php if ( bp_has_groups( bp_ajax_querystring( 'groups' ) ) ) : ?>

	<div id="pag-top" class="pagination">

		<div class="pag-count" id="group-dir-count-top">

			<?php bp_groups_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="group-dir-pag-top">

			<?php bp_groups_pagination_links(); ?>

		</div>

	</div>

	<?php do_action( 'bp_before_directory_groups_list' ); ?>

    <div class="clearfix"></div>

	<ul id="groups-list" class="row clearfix" role="main">

	<?php while ( bp_groups() ) : bp_the_group(); ?>

		<li class="yit_animate fadeInUp col-md-4 col-sm-6 masonry_item">
            <div class="item-container">
                <div class="item-header clearfix">
                    <div class="item-avatar">
                        <a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( 'type=thumb&width=50&height=50' ); ?></a>
                    </div>

                    <div class="item">
                        <div class="item-username"><a href="<?php bp_group_permalink(); ?>"><?php bp_group_name(); ?></a></div>
                        <div class="item-meta"><span class="activity"><?php printf( __( 'active %s', 'buddypress' ), bp_get_group_last_active() ); ?></span></div>
                    </div>
                </div>

                <div class="item-quote">
                    <div class="item-desc"><?php bp_group_description_excerpt(); ?></div>

                    <?php do_action( 'bp_directory_groups_item' ); ?>

                </div>

                <div class="action">

				<?php do_action( 'bp_directory_groups_actions' ); ?>

                    <div class="meta">

                        <?php bp_group_type(); ?> / <?php bp_group_member_count(); ?>

                    </div>

                    <?php do_action( 'bp_directory_groups_actions' ); ?>

                </div>

                <div class="clear"></div>
            </div>
		</li>

	<?php endwhile; ?>

	</ul>

	<?php do_action( 'bp_after_directory_groups_list' ); ?>

	<div id="pag-bottom" class="pagination">

		<div class="pag-count" id="group-dir-count-bottom">

			<?php bp_groups_pagination_count(); ?>

		</div>

		<div class="pagination-links" id="group-dir-pag-bottom">

			<?php bp_groups_pagination_links(); ?>

		</div>

	</div>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'There were no groups found.', 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

<?php do_action( 'bp_after_groups_loop' ); ?>

<script>
    jQuery(document).ready(function ($) {
        var container = $('#groups-list');

        container.masonry({
            itemSelector: 'li.masonry_item',
            isAnimated: false
        });

        $( 'body' ).on( 'gridloaded', function(){
            $( 'li.masonry_item').removeClass('animated');
            container.masonry({
                itemSelector: 'li.masonry_item',
                isAnimated: false
            });
            $( 'li.masonry_item').yit_waypoint();
        } );
    } );
</script>

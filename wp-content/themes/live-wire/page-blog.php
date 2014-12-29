<?php
/*
Template Name: blog
*/
?>
<?php
/**
 * Index Template
 *
 * This is the default template.  It is used when a more specific template can't be found to display
 * posts.  It is unlikely that this template will ever be used, but there may be rare cases.
 *
 * @package Live Wire
 * @subpackage Template
 * @since 0.1.0
 */

get_header(); // Loads the header.php template. ?>
	<?php do_atomic( 'before_content' ); // live-wire_before_content ?>

	<div id="content">
   
	
	<?php do_atomic( 'open_content' ); // live-wire_open_content ?>
			
		<div class="hfeed">

			<?php get_template_part( 'loop-meta' ); // Loads the loop-meta.php template. ?>

		


<article>

		<?php // Display blog posts on any page @ http://m0n.co/l
		$temp = $wp_query; $wp_query= null;
		$wp_query = new WP_Query(); $wp_query->query('showposts=7' . '&paged='.$paged);
		while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

		<div class="part"><h2><a href="<?php the_permalink(); ?>" title="Читать далее"><?php the_title(); ?></a></h2>
		<div class="th"><?php the_post_thumbnail(array( 200,200 ), array( 'class' => 'alignleft' )); ?></div>		
		<div class="date";><?php the_time('d.m.Y'); ?><?php if ( $post->post_date != $post->post_modified) { ?>, обновлено: <?php the_modified_time('d.m.Y'); } ?></div>		
		<?php the_excerpt(); ?>
</div>
		<?php endwhile; ?>

		<?php if ($paged > 1) { ?>

		

		<?php } ?>

		<?php wp_reset_postdata(); ?>

	</article>



		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // live-wire_close_content ?>
			
		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->
			
	<?php do_atomic( 'after_content' ); // live-wire_after_content ?>
		
<?php get_footer(); // Loads the footer.php template. ?>

<style>
h2 {padding: 10px 0 0 10px;}
a:hover {color: #656464;}
div.date {size: 14px; font-weight:bold;}
div.part:hover {background-color:#ECECEC; height: 300px; }
div.part {height: 300px; }
div.th {padding: 10px 10px 10px 10px;}
</style>

<?php get_footer(); // Loads the footer.php template. ?>





















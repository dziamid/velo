<?php
/*
Template Name: start
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

		
<?php  if  ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>
<p style="text-align: justify;"><strong>Сравнение велосипедов!!!</strong> Теперь на наше сайте вы можете сравнить велосипеды, которые вы хотите купить - это поможет вам определиться и выбрать велосипед, который действительно подходит именно для вас.</p>  
<div class="cathit">Хиты продаж:</div>
<br>
<?php if (function_exists('sergey_anythingslider_show')) sergey_anythingslider_show('cat=1 count=20 width=650 height=180'); ?>
<br>
<div class="cat">Каталог:</div>
  <div class="start">
 <div onClick="window.location='http://veloman.by/vse-tovaryi/velosipedi/detskie'" style="cursor:pointer" class="chi"></div>
<div onClick="window.location='http://veloman.by/vse-tovaryi/velosipedi/podrostkovie'" style="cursor:pointer" class="pod"></div>
<div onClick="window.location='http://veloman.by/vse-tovaryi/velosipedi/skladnie'" style="cursor:pointer" class="skl"></div>
<div onClick="window.location='http://veloman.by/vse-tovaryi/velosipedi/gornie'" style="cursor:pointer" class="gor"></div>
<div onClick="window.location='http://veloman.by/vse-tovaryi/velosipedi/zenskie'" style="cursor:pointer" class="zen"></div>
<div onClick="window.location='http://veloman.by/vse-tovaryi/velosipedi/gibrid'" style="cursor:pointer" class="gib"></div>
<div onClick="window.location='http://veloman.by/vse-tovaryi/velosipedi/gorodskoy'" style="cursor:pointer" class="gorod"></div>
<div onClick="window.location='http://veloman.by/vse-tovaryi/velosipedi/doroznie'" style="cursor:pointer" class="dor"></div>
<div onClick="window.location='http://veloman.by/vse-tovaryi/velosipedi/dvuhpodves'" style="cursor:pointer" class="two"></div>
</div>
<div style="clear: both;"></div>
<div class="cat">О нас:</div>
<p style="text-align: justify;"><strong>Велосипеды Минск.</strong></p>
<p style="text-align: justify;"><span style="text-align: justify;">Приветствуем вас на сайте </span><strong style="text-align: justify;">veloman.by</strong><span style="text-align: justify;">, сайт создан специально для всех любителей велосипедов, активного образа жизни и людей которые не любят сидеть на месте. Здесь вы сможете </span><a style="text-align: justify;" title="Веломагазин" href="http://veloman.by/velomagazin">купить велосипед</a><span style="text-align: justify;">, </span><a style="text-align: justify;" title="Запчасти" href="http://veloman.by/zapchasti">купить запчасти</a><span style="text-align: justify;">, а так же </span><a style="text-align: justify;" title="Аксессуары" href="http://veloman.by/aksessuary">аксессуары</a><span style="text-align: justify;"> для велосипеда. Наш веломагазин предоставляет широкий ассортимент велосипедов различного уровня и комплектации, для разных стилей катания и людей любого возраста. Мы предлагаем велосипеды для детей от 2-х лет. Также в нашем магазине вы сможете подобрать аксессуары и запчасти для вашего велосипеда от камер на любой размер колеса, до систем переключения передач самого высокого уровня.</span></p>
<p style="text-align: justify;">Если ваш велосипед сломался или вам требуется помощь в ремонте велосипеда, вы можете задавать здесь свои вопросы, а если у вас нет времени или желания ремонтировать свой велосипед самостоятельно, наша <a title="Веломастерская" href="http://veloman.by/remont-velosipedov/velomasterskaya">веломастерская</a>, которая производит ремонт велосипедов любой марки и сложности поможет вам с вашей проблемой.</p>
<p style="text-align: justify;">Купить велосипед у нас значит приобрести качественный надежный велосипед по приемлемой цене. На каждый проданный велосипед мы даем гарантию и производим бесплатное техническое обслуживание, регулировку и настройку. Большой ассортимент велоаксессуаров поможет сделать ваш велосипед индивидуальным, а мы в свою очередь прикрутим и настроим выбранные аксессуары на ваш велосипед. При покупке вы можете забрать свой велосипед самостоятельно или мы <strong>доставим его бесплатно по городу Минску</strong>.</p>

					<?php if ( is_singular() ) { ?>
						
						<?php get_sidebar( 'after-singular' ); // Loads the sidebar-after-singular.php template. ?>

						<?php do_atomic( 'after_singular' ); // live-wire_after_singular ?>

						<?php comments_template( '/comments.php', true ); // Loads the comments.php template. ?>

					<?php } ?>

				<?php endwhile; ?>

			<?php else : ?>

			<?php get_template_part( 'loop-error' ); // Loads the loop-error.php template. ?>

			<?php endif; ?>

		</div><!-- .hfeed -->

		<?php do_atomic( 'close_content' ); // live-wire_close_content ?>
			
		<?php get_template_part( 'loop-nav' ); // Loads the loop-nav.php template. ?>

	</div><!-- #content -->
			
	<?php do_atomic( 'after_content' ); // live-wire_after_content ?>
		
<?php get_footer(); // Loads the footer.php template. ?>

			<?php get_sidebar( 'primary' ); // Loads the sidebar-primary.php template. ?>
			<?php do_atomic( 'close_main' ); // live-wire_close_main ?>
		</div><!-- .wrap -->
		</div><!-- #main -->
		<?php do_atomic( 'after_main' ); // live-wire_after_main ?>
		<?php get_sidebar( 'subsidiary' ); // Loads the sidebar-subsidiary.php template. ?>
		<?php do_atomic( 'before_footer' ); // live-wire_before_footer ?>
		<div id="footer">
			<?php do_atomic( 'open_footer' ); // live-wire_open_footer ?>
			<div class="wrap">
				<div id="footer-info">
					<div class="footer-content">
						<?php hybrid_footer_content(); ?>
					</div>
					<?php do_atomic( 'footer' ); // live-wire_footer ?>
				</div><!-- #footer-info -->
			<?php get_template_part( 'menu', 'subsidiary' ); // Loads the menu-subsidiary.php template. ?>
			</div><!-- .wrap -->
			<?php do_atomic( 'close_footer' ); // live-wire_close_footer ?>
		</div><!-- #footer -->
		<?php do_atomic( 'after_footer' ); // live-wire_after_footer ?>
</div><!-- #container -->
<?php do_atomic( 'close_body' ); // live-wire_close_body ?>
<?php wp_footer(); // wp_footer ?>
<div style="width:200px; height:10px; margin-left: auto; margin-right: auto;"><!-- begin of Top100 code -->
<div style="float: left;" class="targ"><script id="top100Counter" type="text/javascript" src="http://counter.rambler.ru/top100.jcn?2812202"></script>
<noscript>
<a href="http://top100.rambler.ru/navi/2812202/">
<img src="http://counter.rambler.ru/top100.cnt?2812202" alt="Rambler's Top100"/>
</a>
</noscript>
<!-- end of Top100 code -->
</div><!-- tar -->
<div style="float: left;" class="targ"><!--counter mail-->
<script type="text/javascript">//<![CDATA[
(function(w,n,d,r,s){d.write('<a href="http://top.mail.ru/jump?from=2287025" target="_top">'+
'<img src="http://d5.ce.b2.a2.top.mail.ru/counter?id=2287025;t=67;js=13'+
((r=d.referrer)?';r='+escape(r):'')+((s=w.screen)?';s='+s.width+'*'+s.height:'')+';_='+Math.random()+
'" border="0" height="31" width="38" alt="Рейтинг@Mail.ru"><\/a>');})(window,navigator,document);//]]>
</script><noscript><a target="_top" href="http://top.mail.ru/jump?from=2287025">
<img src="http://d5.ce.b2.a2.top.mail.ru/counter?id=2287025;t=67;js=na"
height="31" width="38" alt="Рейтинг@Mail.ru"></a></noscript>
</div><!-- //mail counter --></div>
<!--compare -->
<script type="text/javascript">
  window.___gcfg = {lang: 'ru'};

  (function() {
    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
    po.src = 'https://apis.google.com/js/plusone.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
  })();
</script>
<script id="popup-js" type="text/javascript">
var $ = jQuery;
$(document).ready(function () {
   var imgs = $('.field-desc');
   var popup = $("#popup");
   var popupContent = popup.find('.content');
   imgs.live('click', function() {
    var img = $(this);
    var container = img.closest('.title-container');
    var desc = img.attr('title');
    popupContent.html(desc);
    popup.appendTo(container);
    popup.show();
   });
   	
   $('#popup .close').live('click', function() { 
    popup.hide();

    return false;
   });

});
</script>
<div id="popup" style="z-index: 1; background: white; display:none; position: absolute; right: -535px; top: -13px; width: 500px; height: auto; text-align: left;  -moz-box-shadow: 0 0 10px rgba(0,0,0,0.5); 
 box-shadow: 0 0 10px rgba(0,0,0,0.5); padding: 10px;">
<p><a class="close" href="#">Закрыть</a></p>
<div class="content"></div>
<div class="chat-bubble-arrow"></div>
<div class="chat-bubble-arrow-border"></div>
</div>
</body>
</html>

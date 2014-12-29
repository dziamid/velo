<!DOCTYPE html>
<html lang='RU' xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<meta charset="UTF-8">
<title>Продажа и ремонт велосипедов в Минске</title>
<!-- Mobile viewport optimized -->
<meta name="viewport" content="width=device-width,initial-scale=1" />
<!-- My styles -->
<link media="screen" type="text/css" href="http://veloman.by/wp-content/themes/live-wire/style.css" rel="stylesheet">
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link href="http://veloman.by/xmlrpc.php" rel="pingback"/>
<?php wp_head(); // wp_head ?>
<style>
/*startpage category*/
 div.chi {
	background: url(pic/chi.jpg);
	width: 200px;
	height: 150px;
	background-position: top;
	margin: 8px 8px 8px 8px;
	float: left;
	
}
div.chi:hover {
	background-position: bottom;
}

div.pod {
	background: url(pic/pod.jpg);
	width: 200px;
	height: 150px;
	background-position: top;
	margin: 8px 8px 8px 8px;
	float: left;
	
}
div.pod:hover {
	background-position: bottom;
}

div.skl {
	background: url(pic/skl.jpg);
	width: 200px;
	height: 150px;
	background-position: top;
	margin: 8px 8px 8px 8px;
	float: left;
	
}
div.skl:hover {
	background-position: bottom;
}

div.gor {
	background: url(pic/gor.jpg);
	width: 200px;
	height: 150px;
	background-position: top;
	margin: 8px 8px 8px 8px;
	float: left;
	
}

div.gor:hover {
	background-position: bottom;
}
div.zen {
	background: url(pic/zen.jpg);
	width: 200px;
	height: 150px;
	background-position: top;
	margin: 8px 8px 8px 8px;
	float: left;
	
}
div.zen:hover {
	background-position: bottom;
}
div.two {
	background: url(pic/two.jpg);
	width: 200px;
	height: 150px;
	background-position: top;
	margin: 8px 8px 8px 8px;
	float: left;
	
}
div.two:hover {
	background-position: bottom;
}
div.gib {
	background: url(pic/gib.jpg);
	width: 200px;
	height: 150px;
	background-position: top;
	margin: 8px 8px 8px 8px;
	float: left;
	
}
div.gib:hover {
	background-position: bottom;
}
div.gorod {
	background: url(pic/gorod.jpg);
	width: 200px;
	height: 150px;
	background-position: top;
	margin: 8px 8px 8px 8px;
	float: left;
	
}
div.gorod:hover {
	background-position: bottom;
}
div.dor {
	background: url(pic/dor.jpg);
	width: 200px;
	height: 150px;
	background-position: top;
	margin: 8px 8px 8px 8px;
	float: left;
	
}
div.dor:hover {
	background-position: bottom;
}

div.start {
	padding-left: 8%;
	padding-right: 8%;
	padding-bottom: 10px;
	
}
hr.startpagehr {
	
		width: 95%;
	height:3px;
	background: #9C9999;
	border-radius: 4px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	border: none;
	margin-top: 5px;
	margin-bottom: 5px;	
	
}
.cat {
	font-size: 22px;
	background: #DADADA;
	height: 35px;
	border-radius: 4px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	padding-left: 10px;
	
			}
.cathit {
	font-size: 22px;
	background: #DADADA;
	height: 35px;
	border-radius: 4px;
	-webkit-border-radius: 4px;
	-moz-border-radius: 4px;
	padding-left: 10px;
	
	
		}

</style>
<!-- Google analitycs -->
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-35387002-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
</script>
<!-- Put this script tag to the <head> of your page -->
<script type="text/javascript" src="//vk.com/js/api/openapi.js?101"></script><!-- Put this div tag to the place, where the Poll block will be --> 
</head>
<body class="<?php hybrid_body_class(); ?>"> 
	<?php do_atomic( 'open_body' ); // live-wire_open_body ?>
	<div id="container">
		<?php get_template_part( 'menu', 'primary' ); // Loads the menu-primary.php template. ?>
		<?php do_atomic( 'before_header' ); // live-wire_before_header ?>
			<div id="header">
				<?php do_atomic( 'open_header' ); // live-wire_open_header ?>
					<div class="wrap">
					<div id="branding">
						<?php hybrid_site_title(); ?>
						<?php hybrid_site_description(); ?>
					</div><!-- #branding -->

<div class="tel">
8(029) 701-26-54мтс<br>8(044) 726-26-54вел
</div> <!-- class="tel"-->
   		
					<?php get_sidebar( 'header' ); // Loads the sidebar-header.php template. ?>
							
				<?php do_atomic( 'header' ); // live-wire_header ?>
				</div><!-- .wrap -->						
				<?php do_atomic( 'close_header' ); // live-wire_close_header ?>
			</div><!-- #header -->
		<?php do_atomic( 'after_header' ); // live-wire_after_header ?>
		<?php get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template. ?>
		<?php do_atomic( 'before_main' ); // live-wire_before_main ?>
		<div id="main">
		<div class="wrap">
		<?php do_atomic( 'open_main' ); // live-wire_open_main ?>
		<?php if ( current_theme_supports( 'breadcrumb-trail' ) ) breadcrumb_trail( array( 'before' => __( 'Вы здесь:', 'live-wire' ) ) ); ?>


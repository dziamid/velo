<?php
require_once( trailingslashit( TEMPLATEPATH ) . 'library/hybrid.php' );
new Hybrid();

/* Theme setup function using 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'live_wire_theme_setup' );

/**
 * Theme setup function.  This function adds support for theme features and defines the default theme
 * actions and filters.
 *
 * @since 0.1.0
 */
function live_wire_theme_setup() {

	/* Get action/filter hook prefix. */
	$prefix = hybrid_get_prefix();

	/* Add theme support for core framework features. */
	add_theme_support( 'hybrid-core-menus', array( 'primary', 'secondary', 'subsidiary' ) );
	add_theme_support( 'hybrid-core-sidebars', array( 'header', 'primary', 'subsidiary', 'after-singular' ) );
	add_theme_support( 'hybrid-core-widgets' );
	add_theme_support( 'hybrid-core-shortcodes' );
	add_theme_support( 'hybrid-core-theme-settings', array( 'about', 'footer' ) );
	add_theme_support( 'hybrid-core-drop-downs' );
	add_theme_support( 'hybrid-core-seo' );
	add_theme_support( 'hybrid-core-template-hierarchy' );
	
	/* Add theme support for framework extensions. */
	add_theme_support( 'theme-layouts', array( '1c', '2c-l', '2c-r' ) );
	add_theme_support( 'post-stylesheets' );
	add_theme_support( 'dev-stylesheet' );
	add_theme_support( 'loop-pagination' );
	add_theme_support( 'get-the-image' );
	add_theme_support( 'breadcrumb-trail' );
	add_theme_support( 'entry-views' );
	add_theme_support( 'cleaner-gallery' );
	add_theme_support( 'cleaner-caption' );
	
	/* Add theme support for WordPress features. */
	
	/* Add content editor styles. */
	add_editor_style( 'css/editor-style.css' );
	
	/* Add support for auto-feed links. */
	add_theme_support( 'automatic-feed-links' );
	
	/* Add support for post formats. */
	add_theme_support( 'post-formats', array( 'aside', 'audio', 'image', 'gallery', 'link', 'quote', 'status', 'video' ) );
	
	/* Add custom background feature. */
	add_theme_support( 'custom-background' );
	//add_custom_background( 'live_wire_custom_background_callback' );
	
	/* Set content width. */
	hybrid_set_content_width( 600 );
	
	/* Add respond.js for unsupported browsers. */
	add_action( 'wp_head', 'live_wire_respond_mediaqueries' );
	
	/* Disable primary sidebar widgets when layout is one column. */
	add_filter( 'sidebars_widgets', 'live_wire_disable_sidebars' );
	add_action( 'template_redirect', 'live_wire_one_column' );
	
	/* Add custom image sizes. */
	add_action( 'init', 'live_wire_add_image_sizes' );
	
	/* Add <blockquote> around quote posts if user have forgotten about it. */
	add_filter( 'the_content', 'live_wire_quote_content' );
	
	/* Enqueue script. */
	add_action( 'wp_enqueue_scripts', 'live_wire_scripts' );
	
}

/**
 * Function for help to unsupported browsers understand mediaqueries.
  * @since 0.1.0
 */
function live_wire_respond_mediaqueries() {
	?>
	
	<!-- Enables media queries in some unsupported browsers. -->
	<!--[if (lt IE 9) & (!IEMobile)]>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
	<![endif]-->
	
	<?php
}

/**
 * Function for deciding which pages should have a one-column layout.
 *
 * @since 0.1.0
 */
function live_wire_one_column() {

	if ( !is_active_sidebar( 'primary' ) || ( is_attachment() && 'layout-default' == theme_layouts_get_layout() ) )
		add_filter( 'get_theme_layout', 'live_wire_theme_layout_one_column' );

}

/**
 * Filters 'get_theme_layout' by returning 'layout-1c'.
 *
 * @since 0.1.0
 * @param string $layout The layout of the current page.
 * @return string
 */
function live_wire_theme_layout_one_column( $layout ) {
	return 'layout-1c';
}

/**
 * Disables sidebars if viewing a one-column page.
 *
 * @since 0.1.0
 * @param array $sidebars_widgets A multidimensional array of sidebars and widgets.
 * @return array $sidebars_widgets
 */
function live_wire_disable_sidebars( $sidebars_widgets ) {
	global $wp_query;

	if ( current_theme_supports( 'theme-layouts' ) && !is_admin() ) {

		if ( 'layout-1c' == theme_layouts_get_layout() ) {
			$sidebars_widgets['primary'] = false;
		}
	}

	return $sidebars_widgets;
}

/**
 * Adds custom image sizes for thumbnail images. 
 *
 * @since 0.1.0
 */
function live_wire_add_image_sizes() {

	add_image_size( 'live-wire-thumbnail', 194, 120, true );
	
}

/**
 * Wraps the output of the quote post format content in a <blockquote> element if the user hasn't added a 
 * <blockquote> in the post editor.
 *
 * @since 0.1.0
 * @param string $content The post content.
 * @return string $content
 */
function live_wire_quote_content( $content ) {

	if ( has_post_format( 'quote' ) ) {
		preg_match( '/<blockquote.*?>/', $content, $matches );

		if ( empty( $matches ) )
			$content = "<blockquote>{$content}</blockquote>";
	}

	return $content;
}

/**
 * Live Wire uses FitVids for responsive videos and TinyNav for dropdown navigation menu.
 *
 * @since 0.1.0
 * @note These are taken from fitvidsjs.com and tinynav.viljamis.com.
  */
function live_wire_scripts() {
	
	if ( !is_admin() ) {
		
		/* Enqueue FitVids */
		wp_enqueue_script( 'live_wire-fitvids', trailingslashit ( THEME_URI ) . 'js/jquery.fitvids.js', array( 'jquery' ), '20120222', true );
		wp_enqueue_script( 'live_wire-fitvids-settings', trailingslashit ( THEME_URI ) . 'js/fitvids.js', '', '20120222', true );
		
		/* Enqueue TinyNav */
		wp_enqueue_script( 'live_wire-tinynav', trailingslashit ( THEME_URI ) . 'js/tinynav.min.js', array( 'jquery' ), '20120301', true );
		wp_enqueue_script( 'live_wire-tinynav-settings', trailingslashit ( THEME_URI ) . 'js/tinynav.js', '', '20120301', true );
		
	}
}

/**
 * Grabs the first URL from the post content of the current post.  This is meant to be used with the link post 
 * format to easily find the link for the post. 
 *
 * @since 0.1.0
 * @return string The link if found.  Otherwise, the permalink to the post.
 *
 * @note This is a modified version of the twentyeleven_url_grabber() function in the TwentyEleven theme. And this modified version is from MyLife (themehybrid.com) theme.
 * @author wordpressdotorg
 * @copyright Copyright (c) 2011, wordpressdotorg
 */
function live_wire_url_grabber() {
	if ( ! preg_match( '/<a\s[^>]*?href=[\'"](.+?)[\'"]/is', get_the_content(), $matches ) )
		return get_permalink( get_the_ID() );

	return esc_url_raw( $matches[1] );
}

/**
 * This is a fix for when a user sets a custom background color with no custom background image.  What 
 * happens is the theme's background image hides the user-selected background color.  If a user selects a 
 * background image, we'll just use the WordPress custom background callback.
 *
 * @since 0.1.0
 * @deprecated since 0.1.3
  * @note This is taken from My Life theme by Justin Tadlock
 */
function live_wire_custom_background_callback() {

	/* Get the background image. */
	$image = get_background_image();

	/* If there's an image, just call the normal WordPress callback. We won't do anything here. */
	if ( !empty( $image ) ) {
		_custom_background_cb();
		return;
	}

	/* Get the background color. */
	$color = get_background_color();

	/* If no background color, return. */
	if ( empty( $color ) )
		return;

	/* Use 'background' instead of 'background-color'. */
	$style = "background: #{$color};";

?>
<style type="text/css">body.custom-background { <?php echo trim( $style ); ?> }</style>
<?php

}
function sp_scroll_to_top(){
    $speed = 800;               // скорость скролинга страницы
    $at = 350;                  // сколько промотать вниз чтобы кнопка появилась
    $colorFont = '#070D5E';         // цвет шрифта надписи Наверх, необходима когда картинка не установлена
    $hAlign = 'left';           // горизонтальное место расположения стрелки (left, right)
    $vAlign = 'bottom';         // вертикальное выравнивание (bottom, top)
    $color = '#E4E3E3';         // цвет фона при наведении
    $width = '8';              // ширина активизирующейся зоны в процентах от ширины экрана
    $margin = 600;                // количество пикселей для отступа от верха/низа экрана до картинки (надписи)
    $visible = true;            // показать или скрыть активирующуюся зону (true, false)
    $widthContent = 1000;       // ширина контента в px
 
    echo '
    <style type="text/css">
        #topcontrol:hover {
            background:'.$color.';
        }
    </style>
    <script type="text/javascript">
    var scrolltotop={
        setting: {startline:'.$at.', scrollto: 0, scrollduration:'.$speed.', fadeduration:[500, 100]},
        controlHTML: "'.($image?'<img src=\"'.$image.'\" style=\"position: absolute;'.$vAlign.': 0;'.
        $hAlign.': 0;margin:'.$margin.'px 10px;\" />':'<p style=\"'.$vAlign.
        ': 0;'.$hAlign.': 0;margin:'.$margin.'px 10px;font-size: 18px;color: '.$colorFont.';\">Вверх ▲</p>').'",
        anchorkeyword: "#top",
         state: {isvisible:false, shouldvisible:false},
         scrollup:function(){
            if (!this.cssfixedsupport) {
                this.control.css({opacity:0}) //hide control immediately after clicking it
            }
            var dest=isNaN(this.setting.scrollto)? this.setting.scrollto : parseInt(this.setting.scrollto);
            if (typeof dest=="string" && jQuery("#"+dest).length==1)
                dest=jQuery("#"+dest).offset().top;
            else
                dest=0;
            this.body.animate({scrollTop: dest}, this.setting.scrollduration);
        },
            keepfixed:function(){
            var window=jQuery(window);
            var controlx=window.scrollLeft() + window.width() - this.control.width();
            var controly=window.scrollTop() + window.height() - this.control.height();
            this.control.css({left:controlx+"px", top:controly+"px"})
        },
            togglecontrol:function(){
            var scrolltop=jQuery(window).scrollTop();
            if (!this.cssfixedsupport)
                this.keepfixed();
            this.state.shouldvisible=(scrolltop>=this.setting.startline)? true : false;
            if (this.state.shouldvisible && !this.state.isvisible){
                this.control.stop().animate({opacity:1}, this.setting.fadeduration[0]).css("visibility", "visible");
                this.state.isvisible=true;
            }
            else if (this.state.shouldvisible==false && this.state.isvisible){
                this.control.stop().animate({opacity:0}, this.setting.fadeduration[1], function(){
                    $(this).css("visibility", "hidden");
                });
                this.state.isvisible=false;
            }
        },
 
        init:function(){
            jQuery(document).ready(function($){
                var mainobj=scrolltotop;
                var iebrws=document.all;
                mainobj.cssfixedsupport=!iebrws || iebrws && document.compatMode=="CSS1Compat" && window.XMLHttpRequest;
                mainobj.body = (window.opera)? (document.compatMode=="CSS1Compat"? $("html") : $("body")) : $("html,body");'.
                ((!$visible)?
                    'mainobj.control=$(mainobj.controlHTML);'
                :
                    'if ($(document).width() - (($(document).width() * ('.$width.'/ 100)) * 2) > '.$widthContent.') {
                        mainobj.control=$("<div id=\"topcontrol\" style=\"height: 100%;width: '.$width.'%;\">"+mainobj.controlHTML+"</div>");
                    } else {
                        mainobj.control=$(mainobj.controlHTML); }'
                )
                .'mainobj.control
                    .css({position:mainobj.cssfixedsupport? "fixed" : "absolute", bottom:0, '.$hAlign.':0, opacity:0, cursor:"pointer"})
                    .attr({title:"Наверх"})
                    .click(function(){mainobj.scrollup(); return false})
                    .appendTo("body");
                if (document.all && !window.XMLHttpRequest && mainobj.control.text()!="")
                    mainobj.control.css({width:mainobj.control.width()});
                mainobj.togglecontrol();
                $("a[href=\"" + mainobj.anchorkeyword +"\"]").click(function(){
                    mainobj.scrollup();
                    return false;
                });
                $(window).bind("scroll resize", function(e){
                    mainobj.togglecontrol();
                });
            });
        }
    };
    scrolltotop.init()
</script>
';
}
add_action('wp_head', 'sp_scroll_to_top'); ?>
<?/** Последние записи
------------------------------------------------------
$post_num (5) = количество ссылок
$format ('') = {avatar} {author}: {date:j.M.Y} - {a}{title}{/a} ({comments})
$cat ('') = Категории из которых нужно выводить (5,15) или которые нужно исключить (-5,-15), через запятую (одновременно включение и исключение не работает (не имеет смысла) )
$list_tag (li) = Тег списка
*/
function kama_recent_posts ($post_num=5, $format='', $cat='', $list_tag='li', $echo=true){
	global $post, $wpdb;

	$cur_postID = $post->ID;
	
	// исключим посты главного запроса (wp_query)
	foreach( $GLOBALS['wp_query']->posts as $post )
		$IDs .= $post->ID .',';
	$AND_NOT_IN = ' AND p.ID NOT IN ('. rtrim($IDs, ',') .')';

	if ($cat){
		$JOIN = "LEFT JOIN $wpdb->term_relationships rel ON ( p.ID = rel.object_id )
			LEFT JOIN $wpdb->term_taxonomy tax ON ( tax.term_taxonomy_id = rel.term_taxonomy_id  ) ";
		$DISTINCT = "DISTINCT";
		$AND_taxonomy = "AND tax.taxonomy = 'category'";
		$AND_category = "AND tax.term_id IN ($cat)";
		//Проверка на исключение категорий
		if( strpos($cat, '-')!==false )
			$AND_category = 'AND tax.term_id NOT IN ('. str_replace( '-','', $cat ) .')';

	}
	//если нужно показать автора
	if( strpos($format, '{author}')!==false ){
		$JOIN .= " LEFT JOIN $wpdb->users u ON ( p.post_author = u.ID )";
		$SEL = ", u.user_nicename AS author, u.user_email, u.user_url";
		//если нужно показать аватар (gavatar)
		if( strpos($format, '{avatar}')!==false )
			$av = "<img src='http://www.gravatar.com/avatar/%1\$s?s=25' alt='' />";
	}

	$sql = "SELECT $DISTINCT p.ID, post_title, post_date, comment_count, guid $SEL
	FROM $wpdb->posts p $JOIN
	WHERE post_type = 'post' AND post_status = 'publish' $AND_category $AND_taxonomy $AND_NOT_IN
	ORDER BY post_date DESC LIMIT $post_num";
	$results = $wpdb->get_results($sql);

	if (!$results)
		return false;
	preg_match ('@\{date:(.*?)\}@', $format, $date_m);
	foreach ($results as $pst){
		$x == 'li1' ? $x = 'li2' : $x = 'li1';
		if ( $pst->ID == $cur_postID ) $x .= " current-item";
		$Title = $pst->post_title;
		$a = "<a href='". get_permalink($pst->ID) ."' title='{$Title}'>";

		if ($format){
			$avatar = $av ? sprintf( $av, md5($pst->user_email) ) : '';
			$date = apply_filters('the_time', mysql2date($date_m[1], $pst->post_date));
			$Sformat = str_replace ($date_m[0], $date, $format);
			$Sformat = str_replace(
				array('{title}', '{a}', '{/a}', '{author}',   '{comments}',         '{avatar}'),
				array( $Title,    $a,   '</a>',  $pst->author, $pst->comment_count,  $avatar  ),
				$Sformat
			);
		}
		else $Sformat = "$a$Title</a>";
		$out .= "\n<$list_tag class='$x'>{$Sformat}</$list_tag>";
	}
	if ($echo)
		return print $out;
	return $out;
}
function new_excerpt_length($length) {
 return 28;
}
add_filter('excerpt_length', 'new_excerpt_length');
?>
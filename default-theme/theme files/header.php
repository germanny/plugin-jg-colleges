<?php
	$parent_name = $wpdb->get_var("SELECT post_name FROM $wpdb->posts WHERE ID = '$post->post_parent;'");
	$sitename = get_option('blogname');
	$siteurl = get_option('home');
	$thisPage = "$post->post_title";
	$description = get_bloginfo('description');
	$author = $sitename. " | ".$siteurl;
?>
<!doctype html>
<!--[if lt IE 7]> <html <?php language_attributes(); ?> class="no-js ie6 oldie" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml"> <![endif]-->
<!--[if IE 7]>    <html <?php language_attributes(); ?> class="no-js ie7 oldie" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml"> <![endif]-->
<!--[if IE 8]>    <html <?php language_attributes(); ?> class="no-js ie8 oldie" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml"> <![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml"> <!--<![endif]-->

<head>

<!-- META -->
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="title" content="<?php echo page_title(); ?>">
<meta name="description" content="<?php if (have_posts() && is_single() OR is_page()):while(have_posts()):the_post();
jg_excerpt(220,2);
endwhile;
elseif(is_category() OR is_tag()):
	if(is_category()):
		echo "Posts related to Category: ".ucfirst(single_cat_title("", FALSE));
	elseif(is_tag()):
		echo "Posts related to Tag: ".ucfirst(single_tag_title("", FALSE));
	endif;
	else:
		echo $description;
	endif; ?>">
<?php if (defined('KEYWORDS')) { ?><meta name="keywords" content="<?php echo KEYWORDS ?>"><?php } ?>
<meta name="author" content="<?php echo $author; ?>"> 
<meta name="copyright" content="<?php echo date("Y"); echo " | ".$sitename; ?>">

<title><?php echo page_title(); ?></title>

<meta property="og:title" content="<?php echo page_title(); ?>">
<meta property="og:description" content="<?php if (have_posts() && is_single() OR is_page()):while(have_posts()):the_post();
jg_excerpt(220,2);
endwhile;
elseif(is_category() OR is_tag()):
	if(is_category()):
		echo "Posts related to Category: ".ucfirst(single_cat_title("", FALSE));
	elseif(is_tag()):
		echo "Posts related to Tag: ".ucfirst(single_tag_title("", FALSE));
	endif; 
	else:
		echo $description;
	endif; ?>">
<?php if (is_page('home') || is_category() || is_tag()) : $ogtype = "website"; elseif(is_home()) : $ogtype = "blog"; elseif (have_posts() && is_single() OR is_page()):while(have_posts()):the_post(); $ogtype = "article";endwhile; endif; ?><meta property="og:type" content="<?php echo $ogtype; ?>">
<?php if(is_single()) { ?>
<meta property="og:image" content="<?php echo jg_post_thumbnail_src(); ?>">
	<?php } else { ?>
<meta property="og:image" content="<?php echo DEFAULT_PHOTO; ?>"><?php } ?>

<meta property="og:url" content="<?php if (have_posts() && is_single() OR is_page()):while(have_posts()):the_post();the_permalink();endwhile; else: echo get_option('home'); endif;  ?>">
<meta property="og:site_name" content="<?php echo $sitename; ?>">
<meta property="og:locale" content="en_US">
<?php if (defined('FB_PAGE_ID') && ($ogtype == 'website')) { ?><meta property="fb:page_id" content="<?php echo FB_PAGE_ID; ?>"><?php } ?>
<?php if (defined('FB_ADMINS')) { ?><meta property="fb:admins" content="<?php echo FB_ADMINS; ?>"><?php } ?>
<?php if (defined('FB_APP_ID')) { ?><meta property="fb:app_id" content="<?php echo FB_APP_ID; ?>"><?php } ?>

<link rel="canonical" href="<?php if (have_posts() && is_single() OR is_page()):while(have_posts()):the_post();the_permalink();endwhile; else: echo get_option('home'); endif;  ?>" />

<!-- STYLING -->
<link rel="stylesheet" type="text/css" media="screen, projection" href="<?php bloginfo( 'stylesheet_url' ); ?>">

<!-- JS -->
<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.pack.js"></script>
<script type="text/javascript" src="http://use.typekit.com/kcr1rkv.js"></script>
<script type="text/javascript">try{Typekit.load();}catch(e){}</script>
<?php // JavaScript add to pages with the comment form to support sites with threaded comments (when in use).
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );
?>

<!-- MISC -->
<link rel="shortcut icon" href="<?php echo $siteurl; ?>/favicon.ico">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>

</head>

<body id="<?php
if ( is_404() ) {
	echo "fourOfour";
} elseif (is_page('home') || is_front_page()) {
	echo "page-home";
} elseif (is_home() || is_category() || is_archive() || is_search() || is_single() || is_date() ) {
	echo "blog";
}elseif /* If this is a single page */ ( is_page() ){
	echo $post->post_name;
} ?>" <?php body_class(); ?>>

<p id="accessibility" class="screen-reader-text">Skip to: <a href="#menu">Navigation</a> | <a href="#content">Content</a> | <a href="#side_main">Sidebar</a> | <a href="#siteinfo">Footer</a></p>

<a name="top"></a>
<div id="page">
<header id="branding">
	<div class="wrap">
<?php $heading_tag = ( is_page('home') || is_front_page() ) ? 'h1' : 'div'; ?>
	<<?php echo $heading_tag; ?> id="logo"><a href="<?php echo $siteurl; ?>" title="<?php echo $sitename; ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/assets/images/logos/logo.png" alt="<?php echo $sitename; ?>"></a></<?php echo $heading_tag; ?>>
	<nav id="menu" role="navigation">
		<?php wp_nav_menu( array( 'container_class' => 'main_menu', 'theme_location' => 'main nav' ) ); ?>
	</nav><!-- nav#menu -->
	</div>
</header><!-- /header.body -->

<div id="main">
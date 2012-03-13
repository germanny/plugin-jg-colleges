<?php
/* Customize the variables here
****************************************************************************************************************************************/
define('TWITTER_USERNAME', 'USERNAME GOES HERE'); // Replace USERNAME with your actualy username (e.g. EricRasch). Since we're using this as a constant, it needs to be defined in a place that's called by the theme. Once done, it will be available across all the other PHP files.
define('LINKEDIN', 'LI USERNAME GOES HERE');
define('DEFAULT_PHOTO', get_template_directory_uri().'/images/photo-featured-default.jpg');
define('FB_APP_ID', 'YOUR APP ID HERE');

//define('FB_PAGE_ID', '');
//define('FB_ADMINS', '');
//define('KEYWORDS', '');


/* Custom Comments Template & Posted In/On functions
********************************************************************************************************************************/
include_once('functions/fn_comments_posts.php');

/* CUSTOM LOGIN
***************************************************************************************************************************************/
//include_once('functions/fn_custom_login.php');


/*IMAGES
Add Post Thumbnail Images
***************************************************************************************************************************************/
add_theme_support( 'post-thumbnails', array( 'post' ) );
set_post_thumbnail_size( 200, 155, true );

/* ADD SUPPORT FOR VARIOUS THUMBNAIL SIZES
http://codex.wordpress.org/Function_Reference/add_image_size
**************************************************************************************************************************************
if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)
	add_image_size( 'homepage-thumb', 220, 180, true ); //(cropped)
}*/

/* POST THUMBNAIL
***************************************************************************************************************************************/
include_once('functions/fn_post_thumbnail.php');


/* MISC:
NEAT TRIM: Trim length of excerpt to certain # of words
PAGE TITLE: Print the <title> tag based on what is being viewed.
Miscellaneous Theme Support Functions
***************************************************************************************************************************************/
include_once('functions/fn_misc.php');

// This theme styles the visual editor with editor-style.css to match the theme style.
add_editor_style();
add_theme_support( 'automatic-feed-links' );

/* POST CUSTOM FIELDS UI
********************************************************************************************************************************/
include_once('functions/fn_post_custom_fields.php');

/* REGISTER MENUS
********************************************************************************************************************************/
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(array('main nav' => 'Main Navigation', 'footer nav' => 'Footer Navigation'));
}
/* REMOVE CATEGORIES FROM CATEGORY FUNCTION
********************************************************************************************************************************/
include_once('functions/fn_remove_categories.php');

/* DISABLE PLUGIN STYLESHEETS
***************************************************************************************************************************************/
add_action( 'wp_print_styles', 'kill_styles', 100 );

function kill_styles() {
	wp_deregister_style( 'contact-form-7' ); // contact-form-7 plugin
       // deregister as many stylesheets as you need...
}

?>

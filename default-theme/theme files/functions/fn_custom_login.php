<?php 
/**********************************************************************************************************************************************
Custom Login
***********************************************************************************************************************************************/
function custom_login() { 
echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/styles/login-style.css" />'."\n".'<style type="text/css">';
include('styles/login-colors.php');
echo '</style>'; 
}
function custom_headerurl() { 
return get_bloginfo('siteurl');//return the current wp blog url 
}
function custom_headertitle() { 
return 'Powered by '. get_bloginfo('name');//return the current wp blog name; 
}
add_action('login_head', 'custom_login');
add_filter('login_headerurl', 'custom_headerurl');
add_filter('login_headertitle', 'custom_headertitle');
?>
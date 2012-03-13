<?php
function jg_widgets_init() {
	register_sidebar( array('name' => 'Main Sidebar', 'id' => 'sidebar_main', 'description' => 'Main sidebar', 'before_widget' => '', 'after_widget' => '</dd>', 'before_title' => '<dt>', 'after_title' => '</dt><dd>', ));
}
add_action( 'widgets_init', 'jg_widgets_init' );
?>
<?php
/**
 * Template Name: Homepage
 */

get_header();

?>

<?php the_post(); ?>
<section id="intro">
	<h2 class="page-title"><?php the_title(); ?></h2>
	<?php the_content(); ?>
</section><!-- #intro -->
	
<?php include_once('includes/inc_widget_degree_finder.php');?>

<?php include_once('includes/inc_top_programs.php');?>

<?php include_once('includes/inc_latest_posts.php');?>

<?php include_once('includes/inc_twitter.php');?>


<?php get_footer(); ?>

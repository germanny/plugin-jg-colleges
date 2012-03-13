<aside role="complementary" class="sidebar" id="sidebar_main">

<?php
	include_once('includes/inc_widget_degree_finder.php');
	include_once('includes/inc_popular_degrees.php');
	include_once('includes/inc_college_rankings.php');
?>

<section id="latest-posts">
	<h3>Latest Blog Posts</h3>
	<ul>
	<?php 
		$args = array( 'numberposts' => 3, 'orderby' => 'post_date', 'order' => 'DESC' );
		$lastposts = get_posts( $args ); foreach($lastposts as $post) : setup_postdata($post); ?>
		<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
	<?php endforeach; ?>
	</ul>
	<a href="#" title="View More" rel="bookmark" class="btn">View More</a>
<hr class="divider">
</section><!-- #latest-posts -->

<?php
	include_once('includes/inc_twitter.php');
?>

</aside>
<section id="latest-posts">
	<h3>Latest Blog Posts</h3>
	<ul>
	<?php 
		$args = array( 'numberposts' => 3, 'orderby' => 'post_date', 'order' => 'DESC' );
		$lastposts = get_posts( $args ); foreach($lastposts as $post) : setup_postdata($post); ?>
		<li><h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4><?php $excerpt = get_the_excerpt(); echo string_limit_words($excerpt, 33); ?></li>
	<?php endforeach; ?>
	</ul>
	<a href="#" title="View More" rel="bookmark" class="btn">View More</a>
	<hr class="divider">
</section><!-- #latest-posts -->

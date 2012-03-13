<aside role="complementary" class="sidebar" id="side_main">

	<?php /*
	<section id="top-articles" class="side-blog-artices">
		<h3>Top Articles</h3>
		<?php if (function_exists('popular_posts')) popular_posts(); ?>

	</section>
	*/ ?>
	
	<?php
	$category = get_the_category();
	//print_r($category);
	$catName = isset($category[0]->name) ? $category[0]->name : 'Archive';
	$catId = isset($category[0]->cat_ID) ? $category[0]->cat_ID : 1;
	?>
	
	<section id="side-tabs">
		<ul class="tabs">
			<li><a href="#tab1" title="Archive" rel="bookmark"><?php echo($catName); ?></a></li>
			<?php /*<li><a href="#tab2" title="Comments" rel="bookmark">Comments</a></li>*/ ?>
			<?php /*<li><a href="#tab3" title="Categories" rel="bookmark">Categories</a></li>*/ ?>
		</ul>			
			
			<div id="tab1" class="tab-content">
				<ul>
					<?php
					$thePage = "$post->post_name"; 
					global $post; $args = array( 'numberposts' => 10, 'category' => $catId); $myposts = get_posts( $args );
					foreach( $myposts as $post ) : setup_postdata($post); $currentPost = $post->post_name; ?>
					<li<?php if($thePage == $currentPost) echo ' class="current"';?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endforeach;
					//wp_get_archives();
					?>
				</ul>
			</div><!-- /#tab1 -->
			<?php /*
			<div id="tab2" class="tab-content">
				<ul>
					<?php jg_recent_comments(); ?>
				</ul>
			</div><!-- /#tab2 -->
			
			<div id="tab3" class="tab-content">
				<ul>
					<?php wp_list_categories('title_li='); ?>
				</ul>
			</div><!-- /#tab3 -->
			*/ ?>
	</section>

</aside>
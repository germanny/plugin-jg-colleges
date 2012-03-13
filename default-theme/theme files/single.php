<?php
/**
 * The Template for displaying all single posts.
 */

get_header();
?>

		<div id="content" role="main">
			<section id="single-article">


				<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header">
						<h2 class="entry-title"><?php the_title(); ?></h2>
						<div class="entry-meta">
							<?php jg_posted_on(); ?>
						</div><!-- .entry-meta -->
					</header><!-- .entry-header -->
				
					<div class="entry-content">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>Pages:</span>', 'after' => '</div>' ) ); ?>
					</div><!-- .entry-content -->
				
					<footer class="entry-meta">
						<?php
							$categories_list = get_the_category_list(', ');
				
							$tag_list = get_the_tag_list( '', ', ', '' );
							if ( '' != $tag_list ) {
								$utility_text = 'This entry was posted in %1$s and tagged %2$s Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
								//  by <a href="%6$s">%5$s</a>.
							} elseif ( '' != $categories_list ) {
								$utility_text ='This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
								//  by <a href="%6$s">%5$s</a>
							} else {
								$utility_text = 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
								// This entry was posted by <a href="%6$s">%5$s</a>. 
							}
				
							printf(
								$utility_text,
								$categories_list,
								$tag_list,
								esc_url( get_permalink() ),
								the_title_attribute( 'echo=0' ),
								get_the_author(),
								esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) )
							);
						?>
						<?php edit_post_link( 'Edit', '<span class="edit-link">', '</span>' ); ?>
				
					</footer><!-- .entry-meta -->
					
				</article><!-- #post-<?php the_ID(); ?> -->

					<?php include_once( 'includes/inc-facebook-comments.php' ); ?>

				<?php //jg_content_nav('nav-below'); ?>

				<?php endwhile; // end of the loop. ?>

			</section><!-- #single-article -->
		</div><!-- #content -->

<?php get_sidebar('blog'); ?>
<?php get_footer(); ?>
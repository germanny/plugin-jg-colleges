<?php
/**
 * The main template file.
 */

get_header(); ?>

		<div id="content" role="main">
			<section id="main-archive">
<h1 class="page-title">Page Title</h1>
<?php

// Return the main ("sticky") post
$args = array(
	'posts_per_page' => 1,
	'post__in'  => get_option( 'sticky_posts' ),
	'ignore_sticky_posts' => 1
);
$the_query = new WP_Query( $args );
if(!is_paged()) : while ( $the_query->have_posts() ) : $the_query->the_post();
?>
<h2 class="entry-format">Featured Article</h2>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php jg_post_thumbnail(); ?>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ', 'after' => '')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
		<div class="entry-meta">
			<?php jg_posted_on(); ?>
		</div><!-- .entry-meta -->
					<div class="entry-summary">
						<?php jg_excerpt(); ?>
					</div><!-- .entry-summary -->
<hr />
</article><!-- #post-<?php the_ID(); ?> -->
<?php endwhile; endif;

// Reset Post Data
wp_reset_postdata();?>
					<h2 class="entry-format">Recent Articles</h2>

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>
				
				<?php if ( is_sticky() ) : ?>
				<?php else : ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

					<header class="entry-header">
						<?php if ( comments_open() && ! post_password_required() ) : ?>
							<div class="comments-link">
								<?php // comments_popup_link( '0 Comments', '1 Comment','% Comments', '','' ); ?>
								<a href="<?php the_permalink(); ?>/#comments">Post a Comment</a>
							</div>
						<?php endif; ?>
						<h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ', 'after' => '')); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
						<div class="entry-meta">
							<?php jg_posted_on(); ?>
						</div><!-- .entry-meta -->
					</header><!-- .entry-header -->
					
					<div class="entry-summary">
						<?php jg_excerpt(); ?>
					</div><!-- .entry-summary -->

				</article><!-- #post-<?php the_ID(); ?> -->

				<?php endif; ?>

			<?php endwhile;
					jg_content_nav( 'nav-below' );
				else :
					jg_no_posts();
				endif; 
			?>

			</section><!-- #main-archive -->
		</div><!-- #content -->

<?php get_sidebar('blog'); ?>
<?php get_footer(); ?>

<?php
/**
 * The template for displaying all pages.
 */

get_header(); ?>

		<div id="content" role="main">
			<section id="page-content">

				<?php the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="entry-header">
					<h1 class="page-title"><?php the_title(); ?></h1>
				</header><!-- .entry-header -->
			
				<div class="entry-content">
					<?php the_content();?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>Pages:</span>', 'after' => '</div>' ) ); ?>
				</div><!-- .entry-content -->
				<footer class="entry-meta">
					<?php edit_post_link('Edit', '<span class="edit-link">', '</span>' ); ?>
				</footer><!-- .entry-meta -->
			</article><!-- #post-<?php the_ID(); ?> -->

			<?php // comments_template( '', true ); ?>
			<hr />

			</section><!-- #page-content -->
		</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
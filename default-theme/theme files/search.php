<?php
/**
 * The template for displaying Search Results pages.
 */

get_header(); ?>

		<div id="content" role="main">
			<section id="search-archive">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentyeleven' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>

				<?php
					jg_content_nav( 'nav-above' )
					/* Start the Loop */ 
					while ( have_posts() ) : the_post();
					get_template_part( 'archive-content', get_post_format() );
					endwhile;
					jg_content_nav( 'nav-below' );
					else :
					jg_no_posts();
					endif; 
				?>

			</section><!-- #search-archive -->
		</div><!-- #content -->

<?php get_sidebar('blog'); ?>
<?php get_footer(); ?>
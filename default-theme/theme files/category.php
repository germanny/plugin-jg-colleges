<?php
/**
 * The template for displaying Category Archive pages.
 */

get_header(); ?>

		<div id="content" role="main">
			<section id="category-archive">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf('Renter\'s Insurance %s', '<span>' . single_cat_title( '', false ) . '</span>' );?></h1>

					<?php
						$category_description = category_description();
						if ( ! empty( $category_description ) )
							echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' );
					?>
				</header>

				<?php 
					jg_content_nav( 'nav-above' );
					/* Start the Loop */
					while ( have_posts() ) : the_post();
					get_template_part( 'article-content', get_post_format() );
					endwhile;
					jg_content_nav( 'nav-below' );
					else :
					jg_no_posts();
					endif; 
				?>

			</section><!-- #category-archive -->
		</div><!-- #content -->

<?php get_sidebar('blog'); ?>
<?php get_footer(); ?>

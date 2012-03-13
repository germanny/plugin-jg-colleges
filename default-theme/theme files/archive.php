<?php
/**
 * The template for displaying Archive pages.
 */

get_header(); ?>

		<div id="content" role="main">
			<section id="article-arhive">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title">
						<?php if ( is_day() ) : ?>
							<?php printf( 'Daily Archives: %s', '<span>' . get_the_date() . '</span>' ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf('Monthly Archives: %s', '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( 'Yearly Archives: %s', '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
						<?php else : ?>
							Blog Archives
						<?php endif; ?>
					</h1>
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

			</section><!-- #article-arhive -->
		</div><!-- #content -->

<?php get_sidebar('blog'); ?>
<?php get_footer(); ?>
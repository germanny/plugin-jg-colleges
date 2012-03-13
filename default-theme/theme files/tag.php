<?php
/**
 * The template used to display Tag Archive pages
 */

get_header(); ?>

		<div id="content" role="main">
			<section id="tag-archive">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf('Tag Archives: %s'), '<span>' . single_tag_title( '', false ) . '</span>' );?></h1>

					<?php
						$tag_description = tag_description();
						if ( ! empty( $tag_description ) )
							echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
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

			</section><!-- #tag-archive -->
		</div><!-- #content -->

<?php get_sidebar('blog'); ?>
<?php get_footer(); ?>

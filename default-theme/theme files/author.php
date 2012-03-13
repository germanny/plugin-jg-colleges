<?php
/**
 * The template for displaying Author Archive pages.
 */

get_header(); ?>

		<div id="content" role="main">
			<section id="author-archive">

			<?php if ( have_posts() ) : ?>

				<?php the_post(); ?>

				<header class="page-header">
					<h1 class="page-title author"><?php printf( 'Author Archives: %s', '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h1>
				</header>

				<?php 
					rewind_posts();
				
					// If a user has filled out their description, show a bio on their entries.
				if ( get_the_author_meta( 'description' ) ) : ?>
				<div id="author-info">
					<div id="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'twentyeleven_author_bio_avatar_size', 60 ) ); ?>
					</div><!-- #author-avatar -->
					<div id="author-description">
						<h2><?php printf( __( 'About %s', 'twentyeleven' ), get_the_author() ); ?></h2>
						<?php the_author_meta( 'description' ); ?>
					</div><!-- #author-description	-->
				</div><!-- #entry-author-info -->
				<?php endif;
				
					/* Start the Loop */
					while ( have_posts() ) : the_post();
					get_template_part( 'article-content', get_post_format() );
					endwhile;
					jg_content_nav( 'nav-below' );
					else :
					jg_no_posts();
					endif;
				?>

			</section><!-- #author-archive -->
		</div><!-- #content -->

<?php get_sidebar('blog'); ?>
<?php get_footer(); ?>
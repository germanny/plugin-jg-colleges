<?php
/**
 * template for displaying content
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php if ( is_sticky() ) : ?>
				<hgroup>
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ', 'after' => '')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<h3 class="entry-format">Featured Article</h3>
				</hgroup>
			<?php else : ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute( array('before' => 'Permalink to: ', 'after' => '')); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			<?php endif; ?>

			<div class="entry-meta">
			<?php if ( 'post' == get_post_type() ) : ?>
				<?php jg_posted_on(); ?>
			<?php endif; ?>

			<?php if ( comments_open() && ! post_password_required() ) : ?>
			<span class="comments-link">
				<?php // comments_popup_link( '0 Comments', '1 Comment','% Comments', '','' ); ?>
				<a href="<?php the_permalink(); ?>/#comments">Post a Comment</a>
			</span>
			<?php endif; ?>
			
			<?php // edit_post_link( __( 'Edit'), ' <span class="meta-sep">|</span> <span class="edit-link">', '</span>' ); ?>
			</div><!-- .entry-meta -->
		</header><!-- .entry-header -->

		<?php if ( is_search() || is_home() || is_author() || is_category() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php jg_post_thumbnail(); ?>
			<?php jg_excerpt(330); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content('Continue reading <span class="meta-nav">&rarr;</span>'); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>Pages:</span>', 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>
	</article><!-- #post-<?php the_ID(); ?> -->

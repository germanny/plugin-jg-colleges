<?php
/*Custom Comments Template
***************************************************************************************************************************************/
function jg_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
	<hr class="divider" />
		<article id="comment-<?php comment_ID(); ?>" class="comment">
		<span class="avatar"><?php echo get_avatar( $comment, 64 ); ?></span>
		<header class="comment-author vcard">
			<span class="author-name">
				<?php printf(__('<cite class="fn">%s</cite>'), get_comment_author_link()) ?>
				<span class="commentdate"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">	<?php printf( __( '%1$s' ), get_comment_date(),  get_comment_time() ); ?></a></span>

				<?php edit_comment_link( '(Edit)', ' | ' ); ?>
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<?php edit_comment_link('(Edit)','','') ?>
			<em class="comment-awaiting-moderation"><?php _e( ' | Your comment is awaiting moderation.'); ?></em>
		<?php endif; ?>

			</span>
		</header><!-- .comment-author .vcard -->

		<div class="comment-body">

			<?php comment_text(); ?>
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'reply_text' => 'Reply &#187;', 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- /.comment-body -->
	</article><!-- #comment-##  -->
<?php // </li> This trailing div is not needed. WP adds it automatically. ?>

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'ou' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'ou' ), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}


/* Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using Twenty Ten 1.2 in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default Twenty Ten styling.
***************************************************************************************************************************************/
function jg_remove_recent_comments_style() {
	add_filter( 'show_recent_comments_widget_style', '__return_false' );
}
add_action( 'widgets_init', 'jg_remove_recent_comments_style' );


/* Prints HTML with meta information for the current post-date/time and author.
***************************************************************************************************************************************/
function jg_posted_on() {
	printf( '%2$s <span class="meta-sep">Posted</span> ', //%2$s <span class="meta-sep">Posted by</span> %3$s
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( 'View all posts by %s', get_the_author() ),
			get_the_author()
		)
	);
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = ' in %1$s';
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = ' in %1$s';
	} else {
		$posted_in = 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);

}

/* Prints HTML with meta information for the current post (category, tags and permalink).
***************************************************************************************************************************************/
function jg_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	} else {
		$posted_in = 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}

/* Display navigation to next/previous pages when applicable
***************************************************************************************************************************************/
function jg_content_nav( $nav_id ) {
	global $wp_query;
$prev = get_previous_post();
$next = get_next_post();
$paged = $wp_query->get( 'paged' );

	if ( $wp_query->max_num_pages > 1 ) { ?>
		<nav id="<?php echo $nav_id; ?>" class="navigation">
			<h3 class="screen-reader-text">Post navigation</h3>
			<?php if($prev != '') { ?><span class="nav-previous"><?php next_posts_link( 'Older posts'); ?></span><?php } ?>
			<?php if($paged != 0) { ?><span class="nav-next"><?php previous_posts_link( 'Newer posts'); ?></span><?php } ?>
		</nav><!-- #<?php echo $nav_id; ?> -->
	<?php } else {
		if(is_single()){ ?>
		<nav id="nav-single" class="navigation">
			<h3 class="screen-reader-text">Post navigation</h3>
			<?php if($prev != '') { ?><span class="nav-previous"><?php previous_post_link( '%link', 'Older posts'); ?></span><?php } ?>
			<?php if($next != '') { ?><span class="nav-next"><?php next_post_link( '%link', 'Newer posts'); ?></span><?php } ?>
		</nav><!-- #nav-single -->
	<?php }
	}
}
function jg_no_posts(){ ?>
				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h2 class="entry-title">Nothing Found</h2>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p>No results were found for the requested archive. Perhaps searching will help find a related post.</p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

<?php }

/* RECENT COMMENTS
***************************************************************************************************************************************/
function jg_recent_comments(){
$comments = get_comments('status=approve&number=5');

if ($comments) {
    foreach ($comments as $comment) {
//        echo '<li><a href="'. get_permalink($comment->comment_post_ID).'#comment-'.$comment->comment_ID .'" title="'.$comment->comment_author .' | '.get_the_title($comment->comment_post_ID).'">' . get_avatar( $comment->comment_author_email, $img_w);
//        echo '<span class="recent_comment_name">' . $comment->comment_author . ': </span>';
//		$comment_string = $comment->comment_content;
//		$comment_excerpt = substr($comment_string,0,100);

        echo '<li><a href="'. get_permalink($comment->comment_post_ID).'#comment-'.$comment->comment_ID .'" title="'.$comment->comment_author .' | '.get_the_title($comment->comment_post_ID).'"><span class="recent_comment_name">' . $comment->comment_author . ': </span>';
		$comment_string = $comment->comment_content;
		$comment_excerpt = substr($comment_string,0,100);

		echo $comment_excerpt;

		if (strlen($comment_excerpt) > 99){
			echo ' ...';
		}
        echo '</a></li>';
    }
}
else{
	echo '<li>No Comments Yet</li>';
}
}
?>
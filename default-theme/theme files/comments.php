<?php
/**
 * The template for displaying Comments.
 *
 */
?>

			<div id="comments">
<?php if ( post_password_required() ) : ?>
				<p class="nopassword">This post is password protected. Enter the password to view any comments.</p>
			</div><!-- #comments -->
<?php
		return;
	endif;
?>

<?php if ( have_comments() ) : ?>
			<h4 id="comments-title"><?php printf( '<strong>1</strong> comment', '<strong>%1$s</strong> comments', get_comments_number(), number_format_i18n( get_comments_number() ), '"' . get_the_title() . '"' ); ?></h4>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-above">
				<span class="nav-previous"><?php previous_comments_link('<span class="meta-nav">&larr;</span> Older comments' ); ?></span>
				<span class="nav-next"><?php next_comments_link( 'Newer comments <span class="meta-nav">&rarr;</span>' ); ?></span>
			</nav> <!-- .comment-nav-above -->
<?php endif; // check for comment navigation ?>

			<ol class="commentlist">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use ou_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define ou_comment() and that will be used instead.
					 * See ou_comment() in ou/functions.php for more.
					 */
					wp_list_comments('type=comment&callback=jg_comment');
				?>
			</ol>

<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-below">
				<span class="nav-previous"><?php previous_comments_link('<span class="meta-nav">&larr;</span> Older comments' ); ?></span>
				<span class="nav-next"><?php next_comments_link( 'Newer comments <span class="meta-nav">&rarr;</span>' ); ?></span>
			</nav> <!-- .comment-nav-below -->
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	if ( ! comments_open() ) :
?>
	<p class="nocomments">Comments are closed.</p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php if ('open' == $post->comment_status) : ?>

<div id="respond">
<h4 id="respond-title"><?php comment_form_title( 'Leave a comment', 'Leave a comment to %s' ); ?></h4>

<div class="cancel-comment-reply">
	<small><?php cancel_comment_reply_link(); ?></small>
</div>

<?php if ( get_option('comment_registration') && !$user_ID ) : ?>
<p>You must be <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">logged in</a> to post a comment.</p>
<?php else : ?>

<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

<?php if ( $user_ID ) : ?>

<p>Logged in as <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Log out &raquo;</a></p>

<?php else : ?>

<p class="comment-form-author"><label for="author"><span>Name</span></label>
<input id="author" name="author" type="text" placeholder="name" size="22" tabindex="1" <?php echo $aria_req; ?> /><?php echo ( $req ? '<small class="required">*</small>' : '' ); ?></p>

<p class="comment-form-email"><label for="email"><span>Email</span></label>
<input id="email" name="email" type="text" placeholder="email (never published)" size="22" tabindex="2" <?php echo $aria_req; ?> /><?php echo ( $req ? '<small class="required">*</small>' : '' ); ?></p>

<p class="comment-form-url"><label for="url"><span>Website</span></label>
<input id="url" name="url" type="text" placeholder="website" size="22" tabindex="3" /></p>


<?php endif; ?>

<!--<p><small><strong>XHTML:</strong> You can use these tags: <code><?php echo allowed_tags(); ?></code></small></p>-->

<p class="messagebox"><label for="comment">Comment</label>
<textarea name="comment" id="comment" placeholder="comment" tabindex="4"></textarea></p>

<input name="submit" type="submit" id="commentsubmit" class="btn" tabindex="5" value="Submit" />
<?php comment_id_fields(); ?>

<?php do_action('comment_form', $post->ID); ?>

</form>

<?php endif; // If registration required and not logged in ?>
</div>

<?php endif; // if you delete this the sky will fall on your head ?>


</div><!-- #comments -->

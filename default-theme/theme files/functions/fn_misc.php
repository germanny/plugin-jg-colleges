<?php

/* ABSOLUTE ANCESTOR

Returns the absolute ancestor (parent, grandparent, great-grandparent if there is, etc.) of a post. The absolute ancestor is defined as a page that doesnt have further parents, that is, its post parent is '0'
****************************************************************************************************************************************/
function get_absolute_ancestor($post_id){ 
		global $wpdb;		 
		 $parent = $wpdb->get_var("SELECT `post_parent` FROM $wpdb->posts WHERE `ID`= $post_id");		 
		 if($parent == 0) //Return from the recursion with the title of the absolute ancestor post.
			return $wpdb->get_var("SELECT `post_name` FROM $wpdb->posts WHERE `ID`= $post_id");
		 return get_absolute_ancestor($parent);		 	
	}//ends function


/* GET PAGE ID BY PAGE NAME (SLUG)
****************************************************************************************************************************************/
function get_id_by_page_name($page_name)
	{
		global $wpdb;
		$page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
		return $page_name_id;
	}


/* PAGE TITLE: Print the <title> tag based on what is being viewed.
****************************************************************************************************************************************/
function page_title() {
	global $page, $paged;
	wp_title( '|', true, 'right' );
	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
	echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'apa' ), max( $paged, $page ) );
}


/* NEAT TRIM: Trim length of excerpt to certain # of words - LIMITS BY CHARACTERS TO THE NEAREST WORD
used in jg_excerpt()
****************************************************************************************************************************************/
	function neat_trim($str, $n, $delim=' &hellip;') {	
	$len = strlen($str);
	if ($len > $n) {
		preg_match('/(.{' . $n . '}.*?)\b/', $str, $matches);
		return rtrim($matches[1]) . $delim;
	}
	else {
		return $str;
	}
}


/* LIMIT # OF WORDS IN EXCERPT.- LIMITS BY WORDS
****************************************************************************************************************************************/
function string_limit_words($string, $word_limit)
{
  $words = explode(' ', $string, ($word_limit + 1));
  if(count($words) > $word_limit)
  array_pop($words);
  return implode(' ', $words);
}
/*
USE:
$excerpt = get_the_excerpt();
echo string_limit_words($excerpt,16);
*/


/* CUSTOM EXCERPT
****************************************************************************************************************************************/
function jg_excerpt($length = 200, $more = 1){
	$orig = get_the_excerpt();
	$a = html_entity_decode($orig);
	$excerpt = strip_tags($a);
	$excerpt = neat_trim($excerpt,$length);

	if ($more == 1) {
?>
	<p><?php echo $excerpt; ?> <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark" class="more-link">View More</a></p>
<?php } if ($more == 2) {
	echo $excerpt;
	}
}

?>
<?php
$output = preg_match_all("/<blockquote>([^`]*?)<\/blockquote>/", $post->post_content, $matches);
$first_bq = $matches [1] [0];
//echo $first_bq;
	
$split = explode('&mdash;', $first_bq);
$author = substr(end($split), 0, -6);

$quote = str_replace(' &mdash;', "", $split[0]);
$quote = substr($quote,5);

if($quote){ ?>
<blockquote>
	<p><?php echo $quote; ?></p>
	<cite>&mdash; <?php echo $author;?></cite>
</blockquote>
<?php } ?>
<?php

function video_get_the_term_list( $id = 0, $taxonomy, $before = '', $sep = '', $after = '' ) {
	$terms = get_the_terms( $id, $taxonomy );

	if ( is_wp_error( $terms ) )
		return $terms;

	if ( empty( $terms ) )
		return false;

	foreach ( $terms as $term ) {
		$link = get_term_link( $term, $taxonomy );
		if ( is_wp_error( $link ) )
			return $link;
		$term_links[] = $term->name ;
	}

	$term_links = apply_filters( "term_links-$taxonomy", $term_links );

	return $before . join( $sep, $term_links ) . $after;
}

function append($str, $append)
{
	if(strpos($str, $append) > -1)
		return $str;
	else
		$str = $str . $append;
		
	return $str;
}

function upload_file($temp, $uploadfile, $resizewidth)
{
	if(strpos(strtoupper($uploadfile), ".JPG") || strpos(strtoupper($uploadfile), ".GIF") || strpos(strtoupper($uploadfile), ".PNG"))
	{
		$subfolder = "/logos";
	}
		
	if(strpos($_SERVER["REQUEST_URI"],"wp-admin")>0)
		$uploadpath ="../wp-content/uploads";
	else
		$uploadpath ="wp-content/uploads";
	$uploadpath = $uploadpath . $subfolder ."/";
	$uploadfilefull =  $uploadpath . "/" .$uploadfile;

	if (move_uploaded_file($temp, $uploadfilefull)) {
		if($resizewidth>0)
		{
			$thumbnail = $uploadpath.str_replace(".",".", $uploadfile);
			resize($uploadfilefull, $resizewidth, $thumbnail);
	    }
		return true;
	} else {
	    return false;
	}

}

function resize($original,$new_width, $thumbnail='', $height=0) {
		//if(empty($thumbnail))
		//	$thumbnail = $this->get_thumbnail($original); 
		extract(pathinfo($original));
		switch ( strtolower ( $extension ) ):
			case 'jpg':
			case 'jpeg':
				$img  = @imagecreatefromjpeg( $original );
				break;
			case 'gif':
				$img  = @imagecreatefromgif( $original );
				break;
			case 'png':
				$img  = @imagecreatefrompng( $original );
				break;
			default:
				return;
			break;
		endswitch;
		
		$ratio = $new_width / imagesx($img ); // So that the image's height is resized proportionally to the width.
		if($height == 0)
			$new_height = (imagesy($img)) * $ratio;		
		else
			$new_height = $height;		

		$dstim = @imagecreatetruecolor($new_width, $new_height);	
		imagecopyresized($dstim, $img, 0, 0, 0, 0, $new_width, $new_height, imagesx($img), imagesy($img));
				
		switch ( strtolower ( $extension ) ):
			case 'jpg':
			case 'jpeg':
				imagejpeg($dstim, $thumbnail );
				break;
			case 'gif':
				imagegif($dstim, $thumbnail );
				break;
			case 'png':
				imagepng($dstim, $thumbnail );
				break;
			default:
				break;
		endswitch;	
		//chmod( $imgFilenameThumb , 0777 );		
	}
?>
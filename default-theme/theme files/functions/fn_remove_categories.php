<?php 
/**********************************************************************************************************************************************
Remove categories from the_category function
**********************************************************************************************************************************************/
function the_category_filter($thelist,$separator=' ') {  
    if(!defined('WP_ADMIN')) {  
        //Category Names to exclude  
        $exclude = array('sticky');  
  
        $cats = explode($separator,$thelist);  
        $newlist = array();  
        foreach($cats as $cat) {  
            $catname = trim(strip_tags($cat));  
            if(!in_array($catname,$exclude))  
                $newlist[] = $cat;  
        }  
        return implode($separator,$newlist);  
    } else {  
        return $thelist;  
    }  
}  
add_filter('the_category','the_category_filter', 10, 2);
?>
<?php 
/*
Plugin Name: JG Colleges
Plugin URI: 
Description: Colleges Post Type for Wordpress
Version: 1.0
Author: Jen Germann 
Author URI: http://jengermann.com
*/

// Enable post thumbnails
include "includes/functions.php";
class jg_colleges {
	
	//var $meta_fields = array("logo_image","acc_agency","address","city","state","zip","area_code","phone","ext","website","tuition_fees","percent_fin_aid");
	var $meta_fields = array("logo_image","acc_agency","address","state","phone","website","tuition_fees","percent_fin_aid", "school_type", "programs_offered");
	
	
	function jg_colleges()
	{
		// Register custom post types
		register_post_type('jg_colleges', array(
			'label' => __('JG Colleges'),
			'singular_label' => __('JG Colleges'),
			'public' => true,
			'show_ui' => true, // UI in admin panel
			'_builtin' => false, // It's a custom post type, not built in
			'_edit_link' => 'post.php?post=%d',
			'capability_type' => 'post',
			'hierarchical' => false,
			'rewrite' => array("slug" => "college"), // Permalinks
			'query_var' => "jg_colleges", // This goes to the WP_Query schema
			'supports' => array('title', 'editor'/*, 'comments' ,'custom-fields'*/), // Let's use custom fields for debugging purposes only
			// 'taxonomies' => array('category', 'post_tag')
		));
		
		add_filter("manage_edit-jg_colleges_columns", array(&$this, "edit_columns"));
		add_action("manage_posts_custom_column", array(&$this, "custom_columns"));
		
		// Register custom taxonomy
		//register_taxonomy( 'college_programs', 'jg_colleges', array( 'hierarchical' => true, 'label' => __('Programs Offered') ) );  
		//register_taxonomy( 'college_school_type', 'jg_colleges', array('hierarchical' => true,  'label' => __('Type of School')));
	
		// Admin interface init
		add_action("admin_init", array(&$this, "admin_init"));
		add_action("template_redirect", array(&$this, 'template_redirect'));
		
		// Insert post hook
		add_action("wp_insert_post", array(&$this, "wp_insert_post"), 10, 2);
	}
	
	function edit_columns($columns)
	{
		$columns = array(
			"cb" => "<input type=\"checkbox\" />",
			"title" => "Title",
			"state" => "State",
			//"college_programs" => "Programs Offered",
			//"college_school_type" => "Type of School",
		);
		
		return $columns;
	}
	
	function custom_columns($column)
	{
		global $post;
		//echo $post->ID;
		$custom = get_post_custom();
		switch ($column)
		{
			case "state":
				$custom = get_post_custom();
				echo $custom["state"][0];
				break;
			case "college_programs":
				$college_programs = get_the_term_list($post->ID, 'college_programs', '', ', ','');  
				echo $college_programs;
				break;
			case "college_school_type":
				$college_school_type = get_the_term_list($post->ID, 'college_school_type', '', ', ','');  
				echo $college_school_type;
				break;
		}
	}
	
	// Template selection
	function template_redirect()
	{
		global $wp;
		if ($wp->query_vars["post_type"] == "jg_colleges")
		{
			include(TEMPLATEPATH . "/jg_colleges.php");
			die();
		}
	}
	
	// When a post is inserted or updated
	function wp_insert_post($post_id, $post = null)
	{
		if ($post->post_type == "jg_colleges")
		{
			// Loop through the POST data
			foreach ($this->meta_fields as $key)
			{
				$value = @$_POST[$key];
				if($key == 'logo_image')
				{
					$filename = $post_id . "-".$_FILES["logo_image"]["name"];
					$tempfile = $_FILES["logo_image"]["tmp_name"];
					
					if($_FILES["logo_image"]["name"] != "" && $filename != "")
					{
						if(strpos(strtoupper($filename), ".JPG") || strpos(strtoupper($filename), ".GIF") || strpos(strtoupper($filename), ".PNG"))
						{
							upload_file($tempfile, $filename,$resizewidth);
							if (!update_post_meta($post_id, "logo_image", $filename))
							{
								// Or add the meta data
								add_post_meta($post_id, "logo_image", $filename);
							}
						}
					}
					continue;
				}
				
				// If value is a string it should be unique
				if (!is_array($value))
				{
					if($value != "")
					{
						// Update meta
						if (!update_post_meta($post_id, $key, $value))
						{
							// Or add the meta data
							add_post_meta($post_id, $key, $value);
						}
					}
				}
				else
				{
					// If passed along is an array, we should remove all previous data
					delete_post_meta($post_id, $key);
					
					// Loop through the array adding new values to the post meta as different entries with the same name
					foreach ($value as $entry)
					{
						if($entry != "")
							add_post_meta($post_id, $key, $entry);
					}
				}
			}
		}
	}
	
	function admin_init() 
	{
		// Custom meta boxes for the edit jg_colleges screen
		add_meta_box("college-meta", "College Options", array(&$this, "meta_options"), "jg_colleges", "normal", "low");
	}
	
	// Admin post meta contents
	function meta_options()
	{ //"logo_image","acc_agency","address","city","state","zip","area_code","phone","ext","website","tuition_fees","percent_fin_aid"
		global $post;
		$custom = get_post_custom($post->ID);
		$logo_image = $custom["logo_image"][0];
		$imageurl = get_option("siteurl"). "/wp-content/uploads/logos/".$logo_image;

		$acc_agency = $custom["acc_agency"][0];
		$address = $custom["address"][0];
		//$city = $custom["city"][0];
		$state = $custom["state"][0];
		//$zip = $custom["zip"][0];
		//$area_code = $custom["area_code"][0];
		$phone = $custom["phone"][0];
		//$ext = $custom["ext"][0];
		$website = $custom["website"][0];
		$tuition_fees = $custom["tuition_fees"][0];
		$percent_fin_aid = $custom["percent_fin_aid"][0];
		$school_type = $custom["school_type"][0];
		$programs_offered = $custom["programs_offered"][0];
?>
	<script type="text/javascript">
		document.getElementById("post").setAttribute("enctype","multipart/form-data");
		document.getElementById('post').setAttribute('encoding','multipart/form-data');
	</script>

<table>
<?php//<tr>
	//<td><label><strong>Logo Image</strong>:</label></td>
	//<td><input type=text value="<?php echo $imageurl;? >" size="100" readonly /><br /><input type="file" name="logo_image" ></td>
	//<td><img style="border: 1px solid #ccc;margin:10px 0;padding: 3px;" src="<?php echo $imageurl; ? >" alt="Thumbnail preview" width="100" /></td>
//</tr>?>
<tr>
	<td><label><strong>Accrediting Agency</strong>:</label></td>
	<td colspan="2"><input type="text" name="acc_agency" value="<?php echo $acc_agency; ?>" size="50" /></td>
</tr>
<tr>
	<td><label><strong>Address</strong>:</label></td>
	<td colspan="2"><input type="text" name="address" value="<?php echo $address; ?>" size="50" /></td>
</tr>
<tr>
	<td><label><strong>State</strong>:</label></td>
	<td colspan="2">
		<select id="state" name="state">
			<option>Select</option>
			<option <?php if($state == 'Alabama') { echo 'selected';} ?> value="Alabama">Alabama</option>
			<option <?php if($state == 'Alaska') { echo 'selected="selected"';} ?> value="Alaska">Alaska</option>
			<option <?php if($state == 'Arizona') { echo 'selected="selected"';} ?> value="Arizona">Arizona</option>
			<option <?php if($state == 'Arkansas') { echo 'selected="selected"';} ?> value="">Arkansas</option>
			<option <?php if($state == 'California') { echo 'selected="selected"';} ?> value="California">California</option>
			<option <?php if($state == 'Colorado') { echo 'selected="selected"';} ?> value="Colorado">Colorado</option>
			<option <?php if($state == 'Connecticut') { echo 'selected="selected"';} ?> value="Connecticut">Connecticut</option>
			<option <?php if($state == 'Delaware') { echo 'selected="selected"';} ?> value="Delaware">Delaware</option>
			<option <?php if($state == 'District of Columbia') { echo 'selected="selected"';} ?> value="District of Columbia">District of Columbia</option>
			<option <?php if($state == 'Florida') { echo 'selected="selected"';} ?> value="Florida">Florida</option>
			<option <?php if($state == 'Georgia') { echo 'selected="selected"';} ?> value="Georgia">Georgia</option>
			<option <?php if($state == 'Hawaii') { echo 'selected="selected"';} ?> value="Hawaii">Hawaii</option>
			<option <?php if($state == 'Idaho') { echo 'selected="selected"';} ?> value="Idaho">Idaho</option>
			<option <?php if($state == 'Illinois') { echo 'selected="selected"';} ?> value="Illinois">Illinois</option>
			<option <?php if($state == 'Indiana') { echo 'selected="selected"';} ?> value="Indiana">Indiana</option>
			<option <?php if($state == 'Iowa') { echo 'selected="selected"';} ?> value="Iowa">Iowa</option>
			<option <?php if($state == 'Kansas') { echo 'selected="selected"';} ?> value="Kansas">Kansas</option>
			<option <?php if($state == 'Kentucky') { echo 'selected="selected"';} ?> value="Kentucky">Kentucky</option>
			<option <?php if($state == 'Louisiana') { echo 'selected="selected"';} ?> value="Louisiana">Louisiana</option>
			<option <?php if($state == 'Maine') { echo 'selected="selected"';} ?> value="Maine">Maine</option>
			<option <?php if($state == 'Maryland') { echo 'selected="selected"';} ?> value="Maryland">Maryland</option>
			<option <?php if($state == 'Massachusetts') { echo 'selected="selected"';} ?> value="Massachusetts">Massachusetts</option>
			<option <?php if($state == 'Michigan') { echo 'selected="selected"';} ?> value="Michigan">Michigan</option>
			<option <?php if($state == 'Minnesota') { echo 'selected="selected"';} ?> value="Minnesota">Minnesota</option>
			<option <?php if($state == 'Mississippi') { echo 'selected="selected"';} ?> value="Mississippi">Mississippi</option>
			<option <?php if($state == 'Missouri') { echo 'selected="selected"';} ?> value="Missouri">Missouri</option>
			<option <?php if($state == 'Montana') { echo 'selected="selected"';} ?> value="Montana">Montana</option>
			<option <?php if($state == 'Nebraska') { echo 'selected="selected"';} ?> value="Nebraska">Nebraska</option>
			<option <?php if($state == 'Nevada') { echo 'selected="selected"';} ?> value="Nevada">Nevada</option>
			<option <?php if($state == 'New Hampshire') { echo 'selected="selected"';} ?> value="New Hampshire">New Hampshire</option>
			<option <?php if($state == 'New Jersey') { echo 'selected="selected"';} ?> value="New Jersey">New Jersey</option>
			<option <?php if($state == 'New Mexico') { echo 'selected="selected"';} ?> value="New Mexico">New Mexico</option>
			<option <?php if($state == 'New York') { echo 'selected="selected"';} ?> value="New York">New York</option>
			<option <?php if($state == 'North Carolina') { echo 'selected="selected"';} ?> value="North Carolina">North Carolina</option>
			<option <?php if($state == 'North Dakota') { echo 'selected="selected"';} ?> value="North Dakota">North Dakota</option>
			<option <?php if($state == 'Ohio') { echo 'selected="selected"';} ?> value="Ohio">Ohio</option>
			<option <?php if($state == 'Oklahoma') { echo 'selected="selected"';} ?> value="Oklahoma">Oklahoma</option>
			<option <?php if($state == 'Oregon') { echo 'selected="selected"';} ?> value="Oregon">Oregon</option>
			<option <?php if($state == 'Pennsylvania') { echo 'selected="selected"';} ?> value="Pennsylvania">Pennsylvania</option>
			<option <?php if($state == 'Rhode Island') { echo 'selected="selected"';} ?> value="Rhode Island">Rhode Island</option>
			<option <?php if($state == 'South Carolina') { echo 'selected="selected"';} ?> value="South Carolina">South Carolina</option>
			<option <?php if($state == 'South Dakota') { echo 'selected="selected"';} ?> value="South Dakota">South Dakota</option>
			<option <?php if($state == 'Tennessee') { echo 'selected="selected"';} ?> value="Tennessee">Tennessee</option>
			<option <?php if($state == 'Texas') { echo 'selected="selected"';} ?> value="Texas">Texas</option>
			<option <?php if($state == 'Utah') { echo 'selected="selected"';} ?> value="Utah">Utah</option>
			<option <?php if($state == 'Vermont') { echo 'selected="selected"';} ?> value="Vermont">Vermont</option>
			<option <?php if($state == 'Virginia') { echo 'selected="selected"';} ?> value="Virginia">Virginia</option>
			<option <?php if($state == 'Washington') { echo 'selected="selected"';} ?> value="Washington">Washington</option>
			<option <?php if($state == 'West Virginia') { echo 'selected="selected"';} ?> value="West Virginia">West Virginia</option>
			<option <?php if($state == 'Wisconsin') { echo 'selected="selected"';} ?> value="Wisconsin">Wisconsin</option>
			<option <?php if($state == 'Wyoming') { echo 'selected="selected"';} ?> value="Wyoming">Wyoming</option>
		</select>
	</td>
</tr>
<tr>
	<td><label><strong>Contact</strong>:</label></td>
	<td colspan="2"><input type="text" name="phone" value="<?php echo $phone; ?>" size="20" /></td>
</tr>
<tr>
	<td><label><strong>Website</strong>:</label></td>
	<td colspan="2"><input type="text" name="website" value="<?php echo $website; ?>" size="50" /></td>
</tr>
<tr>
	<td><label><strong>Tuition &amp; Fees</strong>:</label></td>
	<td colspan="2">$ <input type="text" name="tuition_fees" value="<?php echo $tuition_fees; ?>" size="10" /></td>
</tr>
<tr>
	<td><label><strong>Percentage of Students Receiving Financial Aid</strong>:</label></td>
	<td colspan="2"><input type="text" name="percent_fin_aid" value="<?php echo $percent_fin_aid; ?>" size="2" />%</td>
</tr>
<tr>
	<td><label><strong>Type of School</strong>:</label></td>
	<td colspan="2"><input type="text" name="school_type" value="<?php echo $school_type; ?>" size="50" /></td>
</tr>
<tr>
	<td><label><strong>Programs Offered</strong>:</label></td>
	<td colspan="2"><input type="text" name="programs_offered" value="<?php echo $programs_offered; ?>" size="50" /></td>
</tr>

</table>

<?php
	}
}

// Initiate the plugin
add_action("init", "jg_collegesInit");
function jg_collegesInit() { global $jgs; $jgs = new jg_colleges(); }
?>
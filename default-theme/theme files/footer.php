<hr>
<?php if(!is_front_page()) {
	include_once('includes/inc_top_programs.php');
}?>
<hr>
	<footer id="siteinfo" role="contentinfo">
			<div class="wrap">
				<a href="<?php echo $siteurl; ?>" title="<?php echo $sitename; ?>" class="url fn org" rel="home"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logos/logo_sm.png" alt="<?php echo $sitename; ?>" /></a>
				<nav id="submenu" role="navigation">
					<?php wp_nav_menu( array( 'container_class' => 'footer_menu', 'theme_location' => 'main nav' ) ); ?>
				</nav><!-- nav#submenu -->
				<div class="copy">&#169;<?php echo date("Y"); echo " " . get_option('blogname'); ?> All Rights Reserved.</div>
			</div>
	</footer><!-- #siteinfo -->
</div><!-- /#main -->

<script type="text/javascript" src="<?php bloginfo( 'stylesheet_directory' ); ?>/js/libs/jquery.formalize.min.js"></script>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/libs/modernizr-2.0.6.min.js"></script>
<script>
$(document).ready(function() {

if(!Modernizr.input.placeholder){
	$("input").each(function(){
		if($(this).val()=="" && $(this).attr("placeholder")!=""){
			$(this).val($(this).attr("placeholder"));
			$(this).focus(function(){
				if($(this).val()==$(this).attr("placeholder")) $(this).val("");
			});
			$(this).blur(function(){
				if($(this).val()=="") $(this).val($(this).attr("placeholder"));
			});
		}
	});
}
});
</script>
<?php wp_footer(); ?>

</body>
</html>
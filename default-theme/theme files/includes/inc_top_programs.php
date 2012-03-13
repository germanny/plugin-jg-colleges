<section id="top-programs">
<h2>Top 3 Online School Picks</h2>
<ul id="degrees-list">
<?php include_once('inc_acc_online_univ.php');
$count = 1;
foreach ($acc_online_univ as $univ) {
?>
	<li id="school<?php echo $count; ?>">
		<div class="univ-logo"><img alt="<?php echo $univ['name']; ?>" title="<?php echo $univ['name']; ?>" src="<?php echo bloginfo('template_url');?>/images/logos/<?php echo $univ['logo']; ?>" /></div>
		<dl>
			<dd><?php echo $univ['content']; ?></dd>
			<dd><a href="#" class="url btn">Get More Info</a></dd>
		</dl>
	</li>

<?php $count++; if($count > 3) break; } ?>
</ul>
<hr>
</section><!-- #top-programs -->

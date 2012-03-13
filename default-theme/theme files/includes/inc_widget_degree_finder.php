<section class="widget_degree_finder">
<form id="widget_acc_degrees_form" action="http://info.onlinecolleges.net/search" method="post"><!-- Always need to ask about this action -->
<h5>Find A Program That Fits Your Career Goals</h5>
<ol class="form_data">
	<li class="li-1">
		<label>Degree Level</label>
		<select class="edudirect-degree_level_id" name="degree_level_id" onchange="eduWidgetChange1();">
		<option value="">Select a Degree Level</option>
		</select>
	</li>
	<li class="li-2 blur">
		<label>Category</label>
		<select class="edudirect-category_id" name="category_id" onchange="eduWidgetChange2();">
		<option value="">Select a Category</option>
		</select>
	</li>
	<li class="li-3 blur">
		<label>Subject</label>
		<select class="edudirect-subject_id" name="subject_id" onchange="eduWidgetChange3();">
		<option value="">Select a Subject</option>
		</select>
	</li>
</ol>
<button class="btn" onclick="$('#widget_acc_degrees_form').submit(); return false;">Find Your Program Now</button>
<input type="hidden" value="onlineuniversities.com" name="publisher_id" />
</form>
<hr class="divider">
</section>
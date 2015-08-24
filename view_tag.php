<!-- This file is used to search for the tags -->

<?php

require 'connect.php';
require 'core.php';
require 'layout.php';

echo '
<form action="/Events@IITJ/index.php" method="post" class="navbar-fixed">
    <div class="input-field">
        <input id="search" name="search" type="search">
        <label for="search"><i class="material-icons">search</i></label>
    </div>
</form>';

if(isset($_GET['tag']) && !empty($_GET['tag'])) {
	$tag=$_GET['tag'];
	$query = "SELECT * FROM `events` WHERE `tags` LIKE '%".$tag."%' ORDER BY `time` ASC";

	if ($query_run = mysql_query($query)) {
		if (mysql_num_rows($query_run)==NULL) {
			echo '<p style="text-align:center;font-weight:bold;font-size:1.4em;">No Upcoming Events...</p><br>';
		} else {
			echo '<div class="container"><ul class="collapsible popout" data-collapsible="accordion">';
			while ($query_row = mysql_fetch_assoc($query_run)) {
				$event_name = $query_row['eventname']; 
				$datetime = $query_row['time'];
				$date_time = new DateTime($datetime);
				$date = $date_time->format('d/m/y');
				$time = $date_time->format('h:i a');
				$description = $query_row['description'];
				$tags = $query_row['tags'];
				$tag_array=explode(",",$tags);
				echo '<li>
						<div class="collapsible-header"><strong><font style="font-size:1.2em;">'.$event_name.'</font></strong> <div style="float:right;">'.$date.' at '.$time.'</div></div><div class="collapsible-body"><p>'.$description.'</p><div style="text-align:right;">Tags: |';
				foreach ($tag_array as $tag) {
					$tag=str_replace(' ', '', $tag);
					$tag_link='/Events@IITJ/view_tag.php/?tag='.$tag;
					echo '<a href="#" class="waves-effect waves-light"  onclick="location.href=\''.$tag_link.'\'">'.$tag.'</a>|';
				}
				echo '</div></div></li>';
			}
			echo '</ul></div>';
		}
	} else {
		echo 'Query failed...<br>';
		echo mysql_error();
	}
} else {
	die('404:Page Not Found.');
}
?>
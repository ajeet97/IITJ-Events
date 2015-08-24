<!-- This file loads and  displays upcoming events -->

<?php
date_default_timezone_set('Asia/Kolkata');
$today = date("Y-m-d H:i:s");
$query = "SELECT * FROM `events` WHERE `approved`='1' AND `time` >= '".$today."' ORDER BY `time` ASC";

if ($query_run = mysql_query($query)) {
	if (mysql_num_rows($query_run)==NULL) {
		echo '<p style="text-align:center;font-weight:bold;font-size:1.4em;">No upcoming events...</p><br>';
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
			echo '	</div></div>
				  </li>';
		}
		echo '</ul></div>';
	}
} else {
	echo 'Query failed...<br>';
	echo mysql_error();
}

?>
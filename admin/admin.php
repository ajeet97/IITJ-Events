<!-- This file displays pending event requests to the ADMINISTRATOR -->
<style>
#events {
	margin-top: 30px;
	position: absolute;
	width: 100%;
	left: 10%;
	right: 10%;
}

input[type="submit"]{
	width: 100px;
	height: 30px;
	margin: 5px;
}

</style>
<?php
require '../connect.php';
if(isset($_POST['submit']))
{
	$query = "SELECT * FROM `events` where `approved`='0'";
	if($query_run = mysql_query($query))
	{
		while($query_row = mysql_fetch_assoc($query_run))
		{
				$ID = $query_row['id'];
				if(isset($_POST[$ID]))
				{
					$permission = $_POST[$ID];
					if($permission == "approve")
					{
						$q = "UPDATE `events` set `approved`='1' WHERE `id`='".$ID."'";
						mysql_query($q);
					}
					else if($permission == "disapprove")
					{
						$q = "DELETE FROM `events` WHERE `id`='".$ID."'";
						mysql_query($q);
					}
				}
		}
		header('Location: admin.php');
	}
}
$query = "SELECT * FROM `events` where `approved`='0'";
if($query_run = mysql_query($query))
{
	$query_no_rows = mysql_num_rows($query_run);
	if($query_no_rows == 0)
		echo "<h1 style='color:red;text-align:center;'>No pending Events.</center>";
	else
	{
		echo "<form action='' method='post'>";
		echo "<div id='events'><table border='1' style='font-size:1.0em;width:100%;' cellpadding='0px' cellspacing='0px'><thead><tr><th>ID</th><th>Event Name</th><th>Time</th><th>Description</th><th>Tags</th><th colspan='3'>Approve/Disapprove</th></tr></thead><tbody>";
		while($query_row = mysql_fetch_assoc($query_run))
		{
			$ID = $query_row['id'];
			$eventname = $query_row['eventname'];
			$time = $query_row['time'];
			$description = $query_row['description'];
			$tags = $query_row['tags'];
			$approved = $query_row['approved'];
			if(!$approved)
				echo "<tr><td>".$ID."</td><td>".$eventname."</td><td>".$time."</td><td>".$description."</td><td>".$tags."</td><td><input type='radio' name='".$ID."' value='approve'>Approve</td><td><input type='radio' name='".$ID."' value='disapprove'>Disapprove(Delete)</td><td><input type='radio' name='".$ID."' value='skip' checked='checked'>Skip</td></tr>";
		}
		echo "<tr><td colspan='8' style='text-align:center;'><input type='submit' name='submit' value='Submit'></td></tr>";
		echo "</tbody></table></div></form>";
	}
}
else
	echo mysql_error();
?>
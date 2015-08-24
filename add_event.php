<!-- This file adds new events to the database -->

<?php
//Requirements
require 'connect.php';
require 'core.php';
require 'layout.php';

if(!loggedIn())
{
	$_SESSION['tried']=true;
	header('Location: /Events@IITJ/login.php');
}
else
{
	if(isset($_POST['event_name']) && isset($_POST['year']) && isset($_POST['month']) && isset($_POST['date']) && isset($_POST['hr']) && isset($_POST['min']) && isset($_POST['description']) && isset($_POST['tags']))
	{
		echo $event_name=$_POST['event_name'];
		echo $year=$_POST['year'];
		echo $month=$_POST['month'];
		echo $date=$_POST['date'];
		echo $hr=$_POST['hr'];
		echo $min=$_POST['min'];
		echo $description=$_POST['description'];
		echo $tags=$_POST['tags'];
		//if(!empty($event_name) && !empty($year) && !empty($month) && !empty($date) && !empty($hr) && !empty($min) && !empty($description) && !empty($tags))
		//{
			$month=strlen($_POST['month'])==1?'0'.$_POST['month']:$_POST['month'];
			$date=strlen($_POST['date'])==1?'0'.$_POST['date']:$_POST['date'];
			$hr=strlen($_POST['hr'])==1?'0'.$_POST['hr']:$_POST['hr'];
			$min=strlen($_POST['min'])==1?'0'.$_POST['min']:$_POST['min'];
			$datetime=$year.'-'.$month.'-'.$date.' '.$hr.':'.$min.':00';
			$query="INSERT INTO `events` VALUES ('','".mysql_real_escape_string($event_name)."','".mysql_real_escape_string($datetime)."','".mysql_real_escape_string($description)."','".mysql_real_escape_string($tags)."','0')";
			if($query_run=mysql_query($query)) {
				$_SESSION['request']=true;
				header('Location: /Events@IITJ/index.php');
			} else {
				echo mysql_error();
			}
		/*}
		else
		{
			echo 'All fields are required.';
		}*/
	}
}

?>

<!-- Form to get details of new event being added -->
<form action="<?php echo $current_file; ?>" method="post">
Event Name: <input type="text" name="event_name" required="required"> <br>
<div class="row">
<div class="col s4 m4 l4">Year: <input type="number" min="2015" max="2050" required="required" name="year" value="2015"></div>
<div class="col s4 m4 l4">Month: <input type="number" min="01" max="12" name="month" required="required" value="08"></div>
<div class="col s4 m4 l4">Date: <input type="number" min="01" max="31" name="date" required="required" value="23"></div>
</div>
Time: <div class="row">
<div class="col s4 m4 l4"><input type="number" min="0" max="23" name="hr" placeholder="hr" required="required"></div>
<div class="col s4 m4 l4"><input type="number" min="0" max="59" name="min" placeholder="min" required="required"></div>
</div>
Description: <textarea type="text" name="description" placeholder="Enter event details..." required="required"></textarea><br>
Tags: <input type="text" name="tags" placeholder="Tags go here. Separate tags by commas(,)..." required="required"> <br>
<button class="btn waves-effect waves-light" type="submit">Add Event<i class="material-icons right">add</i></button>
</form>
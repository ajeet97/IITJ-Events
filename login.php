<!-- This file is used to authenticate the user -->

<?php
//requirements
require 'core.php';
require 'connect.php';
require 'layout.php';

// If user tried adding event without logging in then show warning.
if(isset($_SESSION['tried']) && !empty($_SESSION['tried']) && $_SESSION['tried'] == true)
{
	echo '<p style="text-align:center;font-weight:bold;font-size:1.4em;">Please login to add event.</p><br>';
	$_SESSION['tried'] = false;
}

if(isset($_POST['mobile']) && isset($_POST['password'])) {
	$mobile=$_POST['mobile'];
	$password=$_POST['password'];

	//$password_hash=md5($password);

	// Validating mobile no. and password
	if(!empty($mobile) && !empty($password)) {
		$query="SELECT `id` FROM `users` WHERE `mobile`='$mobile' AND `password`='$password'";
		if($query_run=mysql_query($query)) {
			$query_num_rows=mysql_num_rows($query_run);

			if($query_num_rows==0) {
				echo 'Invalid Mobile No. or Password.';
			} else if($query_num_rows==1) {
				$user_id=mysql_result($query_run,0,'id');
				$_SESSION['user_id']=$user_id;
				header('Location: /Events@IITJ/index.php');
			}
		}
		else {
			echo mysql_error();
		}
	} else {
		echo 'All fields are required.';
	}
}

?>

<form action="<?php echo $current_file; ?>" method="post">
Mobile: <input type="text" name="mobile" required="required"> <br>
Password: <input type="password" name="password" required="required"> <br>
<button class="btn waves-effect waves-light" type="submit">Log In<i class="material-icons">send</i></button>
</form>
<p style="margin-left:20px;">OR</p>
<button class="btn waves-effect waves-light" onclick="/Events@IITJ/signup.php">Sign Up</button>
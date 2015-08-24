<?php

require 'core.php';
require 'connect.php';
require 'layout.php';

if(isset($_POST['name']) && isset($_POST['mobile']) && isset($_POST['password']) && isset($_POST['conf_password'])) {
	$username=$_POST['name'];
	$mobile=$_POST['mobile'];
	$password=$_POST['password'];

	//$password_hash=md5($password);

	if(!empty($username) && !empty($mobile) && !empty($password) && !empty($_POST['conf_password'])) {
		$query="INSERT INTO `users` VALUES ('','".mysql_real_escape_string($username)."','".mysql_real_escape_string($mobile)."','".mysql_real_escape_string($password)."','')";
		if($query_run=mysql_query($query)) {
			$query1="SELECT `id` FROM `users` WHERE `mobile`='$mobile'";
			$query1_run=mysql_query($query1);
			$query1_num_rows=mysql_num_rows($query1_run);

			if($query1_num_rows==0) {
				echo 'Oops! Error Occured. Try Signing In.';
			} else if($query1_num_rows==1) {
				$user_id=mysql_result($query1_run,0,'id');
				$_SESSION['user_id']=$user_id;
				header('Location: /Events@IITJ/index.php');
			}
		}
		else {
			echo mysql_error();
		}
	} else {
		echo 'All Fields are required.';
	}
}

?>

<form action="<?php echo $current_file; ?>" method="post">
Name: <input type="text" name="name" required="required"> <br>
Mobile: <input type="text" name="mobile" required="required"> <br>
Password: <input type="password" id="password" name="password" required="required"> <br>
Confirm Password: <input type="password" id="conf_password" name="conf_password" required="required"> <br>
<button class="btn waves-effect waves-light" type="submit" id="submit1">Sign Up<i class="material-icons">send</i></button>
</form>

<script>
$(document).ready(function(){

    $('#conf_password').keyup(function(){

        if (document.getElementById('password').value==document.getElementById('conf_password').value){

            $('#conf_password').css("background-color","green");
            $('#password').css("background-color","green");
            document.getElementById("submit1").disabled=false;


        }
        
        else{
        $("#submit1").prop("disabled", false);
        $('#conf_password').css("background-color","orange");
            $('#password').css("background-color","orange");
            document.getElementById("submit1").disabled=true;

        }
    });
});
</script>

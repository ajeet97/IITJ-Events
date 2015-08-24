<!-- This file contains the layout of all the pages -->

<?php
//Global variables
$username="Not Signed In";
$additional_side_nav='<li><a href="/Events@IITJ/login.php" class="waves-effect waves-green"><b>Log In</b><i class="material-icons left hide-on-med-and-down">play_arrow</i></a></li>
					    <li><a href="/Events@IITJ/signup.php" class="waves-effect waves-green"><b>SignUp</b><i class="material-icons left hide-on-med-and-down">playlist_add</i></a></li>';
if(loggedIn()) {// If logged in then show logouT
	$user_id=$_SESSION['user_id'];
	$query="SELECT `username` FROM `users` WHERE `id`='$user_id'";
	$query_run=mysql_query($query);
	$username=mysql_result($query_run,0,'username');
	$additional_side_nav='<li><a href="/Events@IITJ/logout.php" class="waves-effect waves-green"><b>Log Out</b><i class="material-icons left hide-on-med-and-down">power_settings_new</i></a></li>';
}

?>

<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no"/>
  <title>Events@IITJ</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="/Events@IITJ/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="/Events@IITJ/css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body>
	<header>
		<div class="navbar-fixed" style="z-index:9999999;">
			<nav class="red">
				<div class="nav-wrapper">
					<a href="/Events@IITJ/index.php" class="brand-logo"><span class="logo-text">Events@IITJ</span></a>
					
					<ul class="right hide-on-med-and-down">
					    <?php if(loggedIn()) echo '<li>Hello! '.$username.'.</li>'; ?>
						<li><a href="/Events@IITJ/index.php" class="waves-effect waves-green"><i class="material-icons left">home</i><b>Home</b></a></li>
			
						<li><a class="dropdown-button waves-effect waves-green" data-activates="dropdown" data-beloworigin="true" data-hover="true"><b>Societies</b><i class="material-icons left">polymer</i></a>
							<!-- Dropdown Structure -->
							<ul id="dropdown" class="dropdown-content">
								<li><a href="/Events@IITJ/view_tag.php/?tag=arma">A.R.M.A.</a></li>
								<li><a href="/Events@IITJ/view_tag.php/?tag=cultural">Cultural</a></li>
								<li><a href="/Events@IITJ/view_tag.php/?tag=mad">M.A.D.</a></li>
								<li><a href="/Events@IITJ/view_tag.php/?tag=sports">Sports</a></li>
								<li><a href="/Events@IITJ/view_tag.php/?tag=technical">Technical</a></li>
							</ul>
						</li>
						
						<?php echo $additional_side_nav; ?>
					</ul>
					
					<a href="#" data-activates="mobile-menu" class="button-collapse waves-effect waves-light"><i class="mdi-navigation-menu"></i></a>
					<ul id="mobile-menu" class="side-nav white">
						<div class="row valign-wrapper" style="background:url(/Events@IITJ/images/user-bg.jpg); height:120px;">
							<div class="col s4 m4 l4">
								<img src="/Events@IITJ/images/unknown.jpg" alt="" class="circle responsive-img valign profile-image">
							</div>
							<p class="col s8 m8 l8"><?php echo $username; ?></p>
						</div>
						<li><a href="/Events@IITJ/index.php" class="waves-effect waves-green"><!--<i class="material-icons left">home</i>--><b>Home</b></a></li>
						<ul class="collapsible collapsible-accordion">
						<li><a class="collapsible-header waves-effect waves-green"><b>Societies</b><!--<i class="material-icons left">polymer</i>--></a>
							<!-- Collapsible Structure -->
							<div class="collapsible-body">
							<ul>
								<li><a href="/Events@IITJ/view_tag.php/?tag=arma">A.R.M.A.</a></li>
								<li><a href="/Events@IITJ/view_tag.php/?tag=cultural">Cultural</a></li>
								<li><a href="/Events@IITJ/view_tag.php/?tag=mad">M.A.D.</a></li>
								<li><a href="/Events@IITJ/view_tag.php/?tag=sports">Sports</a></li>
								<li><a href="/Events@IITJ/view_tag.php/?tag=technical">Technical</a></li>
							</ul>
							</div>
						</li>
						</ul>
						<li class="divider"></li>
						<?php echo $additional_side_nav; ?>
					</ul>
				</div>
			</nav>
		</div>
	</header>
	
	<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
		<a href="/Events@IITJ/add_event.php" class="btn-floating btn-large red">
			<i class="large material-icons">mode_edit</i>
		</a>
	</div>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="/Events@IITJ/js/materialize.js"></script>
  <script src="/Events@IITJ/js/init.js"></script>

  </body>
</html>

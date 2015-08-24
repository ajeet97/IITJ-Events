<!-- This file displays the homepage -->

<?php
//requirements
require 'connect.php';
require 'core.php';
require 'layout.php';

if(isset($_POST['search']) && !empty($_POST['search']))
{
	header('Location: /Events@IITJ/view_tag.php/?tag='.$_POST['search']);		//redirecting for search
}

?>

<!--Search Bar-->
<form action="#" method="post" class="navbar-fixed">
    <div class="input-field">
        <input id="search" name="search" type="search">
        <label for="search"><i class="material-icons">search</i></label>
    </div>
</form>

<?php
//Approval request message display.
if(isset($_SESSION['request']) && !empty($_SESSION['request']) && $_SESSION['request']==true)
{
	echo '<p style="text-align:center;font-weight:bold;font-size:1.2em;">Your Request has been sent to admin for approval. Thanks for updating :)</p><br>';
	$_SESSION['request'] = false;
}
include 'load_all_events.php';	//Show all upcoming events.
?>
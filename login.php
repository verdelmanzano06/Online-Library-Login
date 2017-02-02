<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>

	<header>
		<h1>Online Library - Login</h1>
	</header>
	<nav>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="login.php">Login</a></li>
			<li><a href="#">Contact Us</a></li>
			<li><a href="#">About</a></li>
		</ul>
	</nav>


<?php 
	$c = oci_connect("luckyboy","luckyboy","localhost/xe");
	if (!$c) {
 	 $e= oci_error();
  	trigger_error('Could not connect to the database:'.$e['message'],E_USER_ERROR);
	}

 ?>

	<article>
		<div class="login-box">
			<form method="post" action="#">
				<label style="color: white"><h4>Login</h4></label><br>
				<input type="text" placeholder="Username" name="username" /></br>
				<input type="password" placeholder="Password" name="password" /></br>
				<input type="submit" name="submit" value="Login" />
			</form>
	</div>
	</article>

	<footer></footer>
</body>
</html>

<?php 

		if(isset($_POST['submit'])){
	
		$c_username = addslashes($_POST['username']);
		$c_password =addslashes ($_POST['password']);
		$sel_c = "select * from USERS where password ='".$c_password."' AND username='".$c_username."'";
		$run_c = oci_parse($c, $sel_c);
		$exec = oci_execute($run_c);
		$arr = oci_fetch_array($run_c);
		$check_num = oci_num_rows($run_c);
		echo $check_num;
		while(($row=oci_fetch_array($run_c, OCI_ASSOC + OCI_RETURN_NULLS))!=False){
		
	}
		if($check_num == 0){
			echo "<script>alert('Username or Password is incorrect')</script>";
		}else {
			header("Location: home.php");
		}
	}
 ?>

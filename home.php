<!DOCTYPE html>
<html>
<head>
	<title>Homepage</title>
	<link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body>

	<header>
		<h1>Online Library</h1>
	</header>
	<nav>
		<ul>
			<li><a href="index.php">Home</a></li>
			<li><a href="login.php">Logout</a></li>
			<li><a href="#">Contact Us</a></li>
			<li><a href="#">About</a></li>
		</ul>
	</nav>

	<article>
		<div class="book-table">
			<?php 
	$c = oci_connect("luckyboy", "luckyboy", "localhost/XE");
	if(!$c) {
		$e = oci_error();
		trigger_error('Could not connect to database: '. $e['message'], E_USER_ERROR);
	}

	$s = oci_parse($c, "select * from books");
	if(!$s) {
		$e = oci_error($c);
		trigger_error('Could not parse statement: '. $e['message'], E_USER_ERROR);
	}

	$r = oci_execute($s);
	if(!$r) {
		$e = oci_error($s);
		trigger_error('Could not execute statement: '. $e['message'], E_USER_ERROR);
	}

	echo "<table border='1'>\n";
	$ncols= oci_num_fields($s);
	echo "<tr>\n";

	for ($i = 1; $i <= $ncols; ++$i) {
		$colname = oci_field_name($s, $i);
		echo "<th><b>".htmlentities($colname,ENT_QUOTES) . "</b></th>\n";
	}

	echo "</tr>\n";

	while(($row = oci_fetch_array($s, OCI_ASSOC + OCI_RETURN_NULLS)) != FALSE) {
		echo "<tr>\n";
		foreach ($row as $item) {
			echo "<td>".($item!==null?htmlentities($item,ENT_QUOTES):"&nbsp;"). "</td>\n";
		}

		echo "</tr>\n";

	}

	echo "</table>\n";
 ?>
		</div>
	</article>

	<footer></footer>
</body>
</html>
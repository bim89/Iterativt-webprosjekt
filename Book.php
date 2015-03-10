<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$mysql_db = 'rombook';

	mysql_connect($host, $user, $pass);
	mysql_select_db($mysql_db);

	if (isset ($_POST['sok'])) {
		$sok = $_POST['sok'];
	$sql = "SELECT id, name, plass, status FROM rom where status = 'ledig'";
	$res = mysql_query($sql);
	if (mysql_num_rows($res) > 0){
	while ($row = mysql_fetch_assoc($res)) {
		echo  "Rom nummer :" . $row['id']. "Navn på Rom: " . $row['name'] ."Plass til: ". $row['plass'] ."status: ". $row['status'];
	}
	}
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Auth</title>
<style>
body{
	margin: 0;
	background-color: rgb(20, 20, 20);
	}
	
#tekst {
	position: relative;
	left: 300px;
	top: 100px;
}

#loginfelt {
	
	position: relative;
	left: 300px;
	bottom: 300px;
	margin: auto;
	top: 200px;
	
}	
#wrap{
	width: 960px;
	height: 600px;
	background-color: rgb(150, 200, 250);
	margin: auto;
	position: relative;
	overflow: hidden;
	}
	#wrap *{
	position: absolute;
	}
</style>
</head>
<body>

<div id="wrap">
	<div id="tekst">
	<h1>SØK databasen</h1>
</div>
	<div id="loginfelt">
<form action="Book.php" method="POST">
    Søk: <input type="text" name="sok"/>
    
    <input type="submit" value="Søk"/>
</form>
</div>
</body>
</html>
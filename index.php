<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$mysql_db = 'rombook';

	mysql_connect($host, $user, $pass);
	mysql_select_db($mysql_db);

	if (isset ($_POST['id'])) {
		$id = $_POST['id'];
		$pass = $_POST['pass'];
	$sql = "SELECT * FROM student where studentnr= '".$id."' AND passord = '".$pass."' LIMIT 1";
	$res = mysql_query($sql);
	if (mysql_num_rows($res) == 1) {
		//echo "Du har logget deg inn";
		header('Location: Book.php');
		exit();
	}else {
		echo "DU loka.";
		exit();
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
	<h1>INLOGGING</h1>
</div>
	<div id="loginfelt">
<form action="index.php" method="POST">
    Student Id: <input type="text" name="id"/>
    <br/>
    Password: <input type="password" name="pass"/>
    <br/>
     <br/>
    <input type="submit" value="Log in"/>
</form>
</div>
</div>

</body>
</html>
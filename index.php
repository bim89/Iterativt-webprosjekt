<?php

session_start();
require "load.php";

	$sth = $db->prepare("SELECT * FROM room ORDER BY room_number");
	$sth->execute();
	
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);


    if(isset($_POST["fromHour"]) && !empty($_SESSION['user'])) {
        addBook($_POST['roomId'], $_POST['fromHour'], $_POST['toHour'], $_POST['day'], $_POST['week'], $_SESSION['user']["username"]);
	}
	
    if(isset($_POST["bookId"]) && isset($_POST["cancel"]) && !empty($_SESSION['user'])) {
        deleteBook($_POST["bookId"], $_SESSION["user"]['username']);
	}
	
	
	addToJson($result, "room");

	function addToJson($args, $obj = 0) {

		
		$json = file_get_contents("data.json");
		$data = json_decode($json, true);

		$data[$obj] = array();
		
		foreach($args as $row) {
			$data[$obj][] = $row;
		}

		file_put_contents("data.json", json_encode($data, true));

	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF8">
	<title>Rombooking CK32</title>
	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link rel="stylesheet" type="text/css" href="styles/screen.css">
	<link rel="icon" type="image/png" href="http://www.westerdals.no/content/themes/westerdals/assets/images/favicon.png">
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>
<body>

	<header>
		<div class="content">
			<img id="logo" src="img/WACT_hvit_cmyk.png" alt="logo" />
			
		<div id="headTitle">
			<h1>Westerdals</h1>
			<h3>Rombooking – CK32</h3>
		</div>

        <?php
        if (isset($_SESSION['user'])) {
        ?>
        <div id="loginMessage">
           <h3>
		    <?= "Velkommen " . utf8_encode($_SESSION['user']['firstname']) . " " . utf8_encode($_SESSION['user']['lastname']); ?>
			</h3>
            <form style="float: left;" method="post" action="index.php">
            	<input type="hidden" value="" name="username" />
                <input type="hidden" value="logout" name="logout" />
                <input id="logout" type="submit" value="Logg ut"/>

                <?php
                if(isset($_POST['logout'])) {
                    unset($_SESSION['user']);
                    header("Location: index.php");
                }
                ?>
          	</form>
			</div>
        </div>
		
	
		
        <?php
     } else {
     ?>

        <div id="loginform">
			<form method="post" action="index.php">
				<input type="text" placeholder="Brukernavn" name="username" />
				<input type="password" placeholder="Passord" name="password" />
                <input type="submit" value="Login" />
			</form>

		</div>
    <?php } ?>
		
	</header>
	<div class="clear"></div>
	
<?php 
	if (isset($msg)) {

		echo "<div id='alert'>" . $msg . "</div>";
	}

	?>	 

	<div id="menu">
		<div class="content">
		<div id="checkBooking">
			<form id="findRoom">
			<div id="utstyr">
				<h3>Utstyr:</h3>
				<div class="checkbox">
					<input style="float:left;" type="checkbox" name="prosejktor" value="1"/> <h5 class="checkText">Prosjektor</h5>
				</div>
				<div class="checkbox">
					<input style="float:left;" type="checkbox" name="whiteboard" value="1"/> <h5 class="checkText">Whiteboard</h5>
				</div>
			</div>
			<div id="antPersoner">
				<h3>Antall Personer:</h3>
				<select name="personer">
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select>
			</div>
			</form>
			<div id="romnr">
				<h3>Rom nr:</h3>
				<select name="romnr">
					<option>Velg Rom</option>
					<?php
						foreach ($result as $room) {
							echo "<option value='" . $room["id"] . "'>" . $room["room_number"] . "</option>";
						}
					?>
				</select>
			</div>
		
	
		</div>
		</div>
	</div>	
	
	<div class="clear"></div>

	<section id="calender">
		<div class="content">
			
		<h1 id="week">
			Uke <span class="weeknumber"></span>
		</h1>
		
		<div id="weekbuttons">
			<div id="lastweek"></div>
			<div id="nextweek"></div>
		</div>
		
		<div class="clear"></div>
		<ul id="tid">
			<li id="eight" class="timer">08:00</li>
			<li id="nine"  class="timer">09:00</li>
			<li id="ten"  class="timer">10:00</li>
			<li id="elleven"  class="timer">11:00</li>
			<li id="twelve"  class="timer">12:00</li>
			<li id="thirteen"  class="timer">13:00</li>
			<li id="fourteen"  class="timer">14:00</li>
			<li id="fifteen"  class="timer">15:00</li>
		</ul>
			<table id="cal">
				<tr>
					<th>Mandag</th>
					<th>Tirsdag</th>
					<th>Onsdag</th>
					<th>Torsdag</th>
					<th>Fredag</th>
					<th>Lørdag</th>
					<th>Søndag</th>
				</tr>
				<tr>
					<td style="border-left: none;"></td>	
					<td></td>	
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td style="border-right: none;"></td>
				</tr>
				<tr>
					<td data-room="" data-week="" data-clock="8" data-day="mon" style="border-left: none;">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>	
					<td data-room="" data-week="" data-clock="8" data-day="tue">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>

					</td>
					<td data-room="" data-week="" data-clock="8" data-day="wed">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="8" data-day="thu">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week=""  data-clock="8" data-day="fri">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="8" data-day="sat">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="8" data-day="sun" style="border-right: none;">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
				</tr>
				<tr>
					<td data-room="" data-week="" data-clock="9" data-day="mon" style="border-left: none;">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>	
					<td data-room="" data-week="" data-clock="9" data-day="tue">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="9" data-day="wed">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="9" data-day="thu">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="9" data-day="fri">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="9" data-day="sat">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="9" data-day="sun" style="border-right: none;">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
				</tr>
				<tr>
					<td data-room="" data-week="" data-clock="10" data-day="mon" style="border-left: none;">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>	
					<td data-room="" data-week="" data-clock="10" data-day="tue">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="10" data-day="wed">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="10" data-day="thu">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="10" data-day="fri">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="10" data-day="sat">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="10" data-day="sun" style="border-right: none;">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
				</tr>
				<tr>
					<td data-room="" data-week="" data-clock="11" data-day="mon" style="border-left: none;">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>	
					<td data-room="" data-week="" data-clock="11" data-day="tue">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="11" data-day="wed">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="11" data-day="thu">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="11" data-day="fri">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="11" data-day="sat">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="11" data-day="sun" style="border-right: none;">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
				</tr>
				<tr>
					<td data-room="" data-week="" data-clock="12" data-day="mon" style="border-left: none;">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>	
					<td data-room="" data-week="" data-clock="12" data-day="tue">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="12" data-day="wed">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="12" data-day="thu">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="12" data-day="fri">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="12" data-day="sat">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="12" data-day="sun" style="border-right: none;">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
				</tr>
				<tr>
					<td data-room="" data-week="" data-clock="13" data-day="mon" style="border-left: none;">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>	
					<td data-room="" data-week="" data-clock="13" data-day="tue">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="13" data-day="wed">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="13" data-day="thu">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="13" data-day="fri">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="13" data-day="sat">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room=""  data-week="" data-clock="13" data-day="sun" style="border-right: none;">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
				</tr>
				<tr>
					<td data-room="" data-week="" data-clock="14" data-day="mon" style="border-left: none;">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>	
					<td data-room="" data-week="" data-clock="14" data-day="tue">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="14" data-day="wed">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="14" data-day="thu">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="14" data-day="fri">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="14" data-day="sat">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="" data-week="" data-clock="14" data-day="sun" style="border-right: none;">
						<div class="innhold" data-bookid="">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
				</tr>
				<tr>
					<td class="tdbottom" style="border-left: none;"></td>	
					<td class="tdbottom"></td>
					<td class="tdbottom"></td>
					<td class="tdbottom"></td>
					<td class="tdbottom"></td>
					<td class="tdbottom"></td>
					<td class="tdbottom" style="border-right: none;"></td>
				</tr>
			</table>	
			
		
		</div>
	</section>

	<div id="booking" style="display:none">
		<h1>Reserver Rom</h1>
		<form method="POST" class="reserve">
		<div class="select">	
		Fra: 
		<select name="from">
			<option class="from" value="8">08:00</option>
			<option class="from" value="9">09:00</option>
			<option class="from" value="10">10:00</option>
			<option class="from" value="11">11:00</option>
			<option class="from" value="12">12:00</option>
			<option class="from" value="13">13:00</option>
			<option class="from" value="14">14:00</option>
			<option class="from" value="15">15:00</option>
		</select>

		Til: 
		<select name="to">
			<option class="to" value="8">08:00</option>
			<option class="to" value="9">09:00</option>
			<option class="to" value="10">10:00</option>
			<option class="to" value="11">11:00</option>
			<option class="to" value="12">12:00</option>
			<option class="to" value="13">13:00</option>
			<option class="to" value="14">14:00</option>
			<option class="to" value="15">15:00</option>
		</select>
		</div>	
			<input type="button" class="avbryt" value="Avbryt" />
			<input type="button" class="reserver" value="Reserver" />
		</form>
	</div>
	
	<div id="userBooking" style="display:none">
		<h1>Fjern Booking</h1>
		<form method="POST" class="reserve">
			<input type="button" class="avbrytBook" value="Avbryt" />
			<input type="button" class="cancel" value="Fjern Booking" />
		</form>
	</div>
	
	<script>
	
	var weeknumber = <?= date("W") ?>;
	<?php if (isset($_SESSION["user"])) { ?>
	var	username = "<?= $_SESSION["user"]["username"] ?>";
	<?php } ?>
		console.log(weeknumber + " " + username);
	</script>
	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="js/app.js"></script>
<body>
</html>

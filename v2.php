<?php

session_start();
require "load.php";

	$sth = $db->prepare("SELECT * FROM room ORDER BY room_number");
	$sth->execute();
	
	$result = $sth->fetchAll(PDO::FETCH_ASSOC);


    if(isset($_POST["fromHour"]) && !empty($_SESSION['user'])) {
        addBook($_POST['roomId'], $_POST['fromHour'], $_POST['toHour'], $_POST['day'], $_POST['week'], $_SESSION["user"]["id"]);
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
	<title>Roombooking CK32</title>

	<link rel="stylesheet" type="text/css" href="styles/style.css">
	<link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>
<body>

	<header>
		<div id="headTitle">
			<h1>Westerdals</h1>
			<p>Roombooking – CK32</p>
		</div>

        <?php
        if (isset($_SESSION['user'])) {
		echo "Vellkommen ";
        echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8');
          ?>
            <div id="loginMessage">
                <p>
            <form method="post" action="v2.php">
                <input type="hidden" value="" name="username" />
                <input type="hidden" value="logout" name="logout" />
                <input type="submit" value="Logout"/>
                <?php
                if(isset($_POST['logout'])) {
                    unset($_SESSION['user']);
                    header("Location: v2.php");
                }
                ?>
            </form>
            </p>
        </div>
        <?php
     } else {
     ?>

        <div id="loginform">
			<form method="post" action="v2.php">
				<input type="text" placeholder="Brukernavn" name="username" />
				<input type="password" placeholder="Passord" name="password" />
                <input type="submit" value="Login" />
			</form>

	
    <?php } ?>
	</header>
	<div class="clear"></div>
	<div id="menu">
		<h1>
			Uke <span class="weeknumber"></span>
		</h1>
		
		<div class="checkBooking">
		<form method="POST" id="findRoom">
			<div id="utstyr">
				<h3>Utstyr</h3>
				<input type="checkbox" name="prosejktor" value="true"/> Prosjektor
				<input type="checkbox" name="whiteboard" value="true"/> Whiteboard
			</div>
			<div id="etasje">
				<select name="etasje">
					<option value="1">Etasje 1</option>
					<option value="2">Etasje 2</option>
					<option value="3">Etasje 3</option>
					<option value="4">Etasje 4</option>
					<option value="5">Etasje 5</option>
					<option value="6">Etasje 6</option>
				</select>
			</div>
			<div id="antPersoner">
				<select name="personer">
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
				</select>
			</div>
			<div id="romnr">
			<h3>Rom nr</h3>
				<select name="romnr">
					<option>Velg Rom</option>
					<?
					foreach($result as $row) {
						echo "<option value='" . $row['room_number'] . "'>Rom " . $row['room_number'] . "</option>";
					}
					?>
				</select>
			</div>
			</form>
		</div>
	</div>	
	
	<div class="clear"></div>

	<section id="calender">
		<div id="content">
		
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
					<td data-room="1" data-week="11" data-clock="8" data-day="mon" style="border-left: none;">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>	
					<td data-room="1" data-week="11" data-clock="8" data-day="tue">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>

					</td>
					<td data-room="1" data-week="11" data-clock="8" data-day="wed">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="8" data-day="thu">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11"  data-clock="8" data-day="fri">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="8" data-day="sat">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="8" data-day="sun" style="border-right: none;">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
				</tr>
				<tr>
					<td data-room="1" data-week="11" data-clock="9" data-day="mon" style="border-left: none;">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>	
					<td data-room="1" data-week="11" data-clock="9" data-day="tue">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="9" data-day="wed">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="9" data-day="thu">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="9" data-day="fri">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="9" data-day="sat">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="9" data-day="sun" style="border-right: none;">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
				</tr>
				<tr>
					<td data-room="1" data-week="11" data-clock="10" data-day="mon" style="border-left: none;">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>	
					<td data-room="1" data-week="11" data-clock="10" data-day="tue">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="10" data-day="wed">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="10" data-day="thu">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="10" data-day="fri">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="10" data-day="sat">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="10" data-day="sun" style="border-right: none;">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
				</tr>
				<tr>
					<td data-room="1" data-week="11" data-clock="11" data-day="mon" style="border-left: none;">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>	
					<td data-room="1" data-week="11" data-clock="11" data-day="tue">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="11" data-day="wed">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="11" data-day="thu">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="11" data-day="fri">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="11" data-day="sat">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="11" data-day="sun" style="border-right: none;">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
				</tr>
				<tr>
					<td data-room="1" data-week="11" data-clock="12" data-day="mon" style="border-left: none;">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>	
					<td data-room="1" data-week="11" data-clock="12" data-day="tue">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="12" data-day="wed">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="12" data-day="thu">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="12" data-day="fri">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="12" data-day="sat">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="12" data-day="sun" style="border-right: none;">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
				</tr>
				<tr>
					<td data-room="1" data-week="11" data-clock="13" data-day="mon" style="border-left: none;">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>	
					<td data-room="1" data-week="11" data-clock="13" data-day="tue">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="13" data-day="wed">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="13" data-day="thu">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="13" data-day="fri">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="13" data-day="sat">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<tddata-room="1"  data-week="11" data-clock="13" data-day="sun" style="border-right: none;">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
				</tr>
				<tr>
					<td data-room="1" data-week="11" data-clock="14" data-day="mon" style="border-left: none;">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>	
					<td data-room="1" data-week="11" data-clock="14" data-day="tue">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="14" data-day="wed">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="14" data-day="thu">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="14" data-day="fri">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="14" data-day="sat">
						<div class="innhold">
							<h4></h4>
							<h5></h5>
						</div>
					</td>
					<td data-room="1" data-week="11" data-clock="14" data-day="sun" style="border-right: none;">
						<div class="innhold">
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
			<div id="tid">
					<div style="margin-top: 50px" class="timer">
						<h5>08:00</h5>
					</div>
					<div style="margin-top: 54px" class="timer">
						<h5>09:00</h5>
					</div>
					<div style="margin-top: 55px" class="timer">
						<h5>10:00</h5>
					</div>
					<div style="margin-top: 53px" class="timer">
						<h5>11:00</h5>
					</div>
					<div style="margin-top: 55px" class="timer">
						<h5>12:00</h5>
					</div>
					<div style="margin-top: 54px" class="timer">
						<h5>13:00</h5>
					</div>
					<div style="margin-top: 54px" class="timer">
						<h5>14:00</h5>
					</div>
					<div style="margin-top: 55px" class="timer">
						<h5>15:00</h5>
					</div>
				</div>
			</div>
		</div>
	</section>

	<div id="booking" style="display:none">
		<h1>Rerserver Rom</h1>
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
	<script src="http://code.jquery.com/jquery-1.11.2.min.js"></script>
	<script src="js/app.js"></script>
<body>
</html>

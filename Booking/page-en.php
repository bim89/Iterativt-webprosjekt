
<?php
  $host = "localhost";
  $user = "root";
  $pass = "";
  $mysql_db = 'rombook';

  mysql_connect($host, $user, $pass);
  mysql_select_db($mysql_db);

  if (isset ($_POST['month'])) {
    //$aar = $_POST['aar'];
    $mnd = $_POST['month'];
    $dag = $_POST['dag'];
 
    $timestamp = "2014" . "-" . $mnd . "-" . $dag . " " ."14:38:10";
    echo $timestamp;

    
  $sqlto = "SELECT * FROM bookinger WHERE slutt >= '".$timestamp."'";
  $resu = mysql_query($sqlto);
  if (mysql_num_rows($resu) > 0){
  while ($rows = mysql_fetch_assoc($resu)) {
    echo  "Rom nummer : " . $rows['id']." " ."Studentnr: " . $rows['studentnr']. " ". "Starttid: ". $rows['start']. " " ."Slutttid: ". $rows['slutt']. '<br>';
    }
}
}
?>

<!doctype html>

<html lang="en" class="a">
	<head>
		<meta charset="utf-8">
		<title>Booking</title>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="styles/screen.css" media="screen">
	</head>
	<body>
		<header>
			<nav id="nav">
				<h3><span>Languages</span></h3>
				<p class="lang">
					<select onchange="location = this.options[this.selectedIndex].value;">
						<option value=>Choose</option>
						<option value="page-no.html">Norsk</option>
						<option value="page-en.html">English</option>
					</select>
				</p>
			</nav>
		</header>
		<div>   
			<div id="home">
				<figure class="image"><figcaption>Need a room to study in?<span>book here!</span></figcaption></figure>
				<form action="page-en.php" method="post" class="form">
					<fieldset>
						<legend>Book now!</legend>
						<h3><span>01.</span>What?</h3>
						<ul class="check">
							<li><label><input type="radio" id="fcaa" name="fca">Nothing</label></li>
							<li><label><input type="radio" id="fcab" name="fca">Projector</label></li>
							<li><label><input type="radio" id="fcac" name="fca">Whiteboard</label></li>
							<li><label><input type="radio" id="fcaf" name="fca">Alt</label></li>
						</ul>
						<h3><span>02.</span>Where?</h3>
						<p class="select-a">
							<label for="fcb">Location</label>
							<select id="fcb" name="fcb">
								<option>A Wing</option>
								<option>B Wing</option>
								<option>C Wing</option>
							</select>
						</p>
						<h3><span>03.</span>When?</h3>
						<p class="date">
							<span>
								<label>Month</label>
								<select name = "month">
									<option value = "01">January</option>
									<option value = "02">February</option>
									<option value = "03">Mars</option>
									<option value = "04">April</option>
									<option value = "05">May</option>
									<option value = "06">June</option>
									<option value = "07">July</option>
									<option value = "08">August</option>
									<option value = "09">September</option>
									<option value = "10">October</option>
									<option value = "11">November</option>
									<option value = "12">December</option>
								</select>
							</span>
							<span>
								<label for="fcc">Day</label>
								<select id="fcb" name="dag">
									<option value = "01">1</option>
									<option value = "02">2</option>
									<option value = "03">3</option>
									<option value = "04">4</option>
									<option value = "05">5</option>
									<option value = "06">6</option>
									<option value = "07">7</option>
									<option value = "08">8</option>
									<option value = "09">9</option>
									<option value = "10">10</option>
									<option value = "11">11</option>
									<option value = "12">12</option>
									<option value = "13">13</option>
									<option value = "14">14</option>
									<option value = "15">15</option>
									<option value = "16">16</option>
									<option value = "17">17</option>
									<option value = "18">18</option>
									<option value = "19">19</option>
									<option value = "20">20</option>
									<option value = "21">21</option>
									<option value = "22">22</option>
									<option value = "23">23</option>
									<option value = "24">24</option>
									<option value = "25">25</option>
									<option value = "26">26</option>
									<option value = "27">27</option>
									<option value = "28">28</option>
									<option value = "29">29</option>
									<option value = "30">30</option>
									<option value = "31">31</option>
							</select>
							</span>
							<span>
								<label for="fcd">Time</label>
								<select id="fcb" name="tid">
									<option>08:00-12:00</option>
									<option>12:00-16:00</option>
									<option>16:00-20:00</option>
								</select>
							</span>
						</p>
						<h3><span>04.</span>Whom?</h3>
						<p class="select-b">
							<span>
								<label for="fce">Number of People</label>
								<select id="fce" name="fce">
									<option>02</option>
									<option>03</option>
									<option>04</option>
								</select>
							</span>
						</p>
						<p class="submit"><button type="submit">Find Room</button></p>
					</fieldset>
				</form>
			</div>
		</div>
	</body>
</html>
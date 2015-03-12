<?php

require('dbconnect.php');
include('functions.php');
if(empty($_SESSION['user']))
{
    header("Location: login.php");
}

/*
$query = $db->query("SELECT * FROM room WHERE projector = 1 AND whiteboard = 0");


while($row = $query->fetch(PDO::FETCH_ASSOC)){
    echo 'Room ID = ';
    echo $row['id'], '<br>';
    echo 'Projector, 1=have, 0=dont have = ';
    echo $row['projector'], '<br>';
    echo 'Whiteboard, same as with projector = ';
    echo $row['whiteboard'], '<br>';
    echo 'Roomnumber = ';
    echo $row['room_number'], '<br>';
    echo 'Number of persons = ';
    echo $row['room_size'], '<br>';
    echo '<br>';
}
*/
    if(isset($_POST['set_projector'])) $set_projector = 1; else $set_projector = 0;
    if(isset($_POST['whiteboard'])) $whiteboard = 1; else $whiteboard = 0;

    $query = $db->query("SELECT * FROM room where (projector = $set_projector AND whiteboard = $whiteboard)");

    $query2 = $db->query("SELECT * FROM booking");

    $stmt = $db->prepare("INSERT INTO Booking (book_id, room_id, room_size, start_time, stop_time, user_id)
                         VALUES(:id, :rid, :rsize, :startdate, :stopdate, :uid)");

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':rid', $rid);
    $stmt->bindParam(':rsize', $rsize);
    $stmt->bindParam(':startdate', $datetime_from);
    $stmt->bindParam(':stopdate', $datetime_end);
    $stmt->bindParam(':uid', $uid);

    $id = 0;
    $rid = 1;
    $rsize = 2;
    $uid = 1;

   /* if(isset($_POST['submit'])) {
        $stmt->execute();
    }*/

if(isset($_POST['submit'])) {
    $date_from = $_POST['start_date'];
    $date_end = $_POST['stop_date'];
    $start_time = $_POST['fromtime'];
    $stop_time = $_POST['stoptime'];
    $datetime_from = "$date_from $start_time";
    $datetime_end = "$date_end $stop_time";

    echo "$datetime_from";
    echo "$datetime_end";

    $stmt->execute();
}
    /*$month = $_POST['month'];
    $day = $_POST['day'];
    $year = "2015";*/
    /*$start_time = $_POST['fromtime'];
    $stop_time = $_POST['stoptime'];
    $date_value=;
    $duration = "$start_time - $stop_time";
    echo "Datum : " . $date_value;
    echo "<br>";
    echo "Tid : " . $duration;
}*/
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
    <nav id="nav-a">
        <h3><span>Languages</span></h3>
        <p class="lang">
            <select onchange="location = this.options[this.selectedIndex].value;">
                <option value=>Choose</option>
                <option value="page-no.html">Norsk</option>
                <option value="page-en.html">English</option>
            </select>
        </p>
    </nav>
    <nav id="nav-b">
        <a href="login.php"><img src="img/loggInnTest.png"></a><a href=""><img src="img/loggUtTest.png"></a><a href="registerUser.php">Registrer Bruker</a>
        <p>Logged in as:</p><?php echo htmlentities($_SESSION['user']['username'], ENT_QUOTES, 'UTF-8'); ?>
    </nav>
</header>

<div>
    <div id="home">
        <figure class="image"><figcaption> <!--Info her!<span>rettningslinjer?</span> -->
                <?php
                if(isset($_POST['submit'])) {
                    while ($row = $query->fetch()) {
                        echo 'Room ID = ';
                        echo $row['id'], '<br>';
                        echo 'Roomnumber = ';
                        echo $row['room_number'], '<br>';
                        echo 'Rumnavn = ';
                        echo $row['roomname'], '<br>';

                        echo '<br>';
                    }
                }
             if(isset($_POST['submit']))  {
                    while($r = $query2->fetch()){
                        echo $r['book_id'];
                        echo $r['room_id'];
                        echo $r['room_size'];
                        echo $r['start_time'];
                        echo $r['stop_time'];
                        echo $r['user_id'];
                    }
                }
                ?>
            </figcaption></figure>
        <form action="" method="post" class="form">
            <fieldset>
                <legend>Book her</legend>
                <h3><span>01.</span>Hva?</h3>
                <ul class="check">
                    <li><label><input type="checkbox" id="fcab" name="set_projector" value="<?php if ($row['set_projector'] == 1)?>">Prosjektor</label></li>
                    <li><label><input type="checkbox" id="fcac" name="set_whiteboard" value="<?php if ($row['whiteboard'] == 1)?>">Whiteboard</label></li>
                   <!-- <li><label><input type="checkbox" id="fcaa" name="fca">Ingen</label></li> -->
                </ul>
                <h3><span>02.</span>Hvor?</h3>
                <p class="select-a">
                    <label for="fcb">Lokasjon</label>
                    <select id="fcb" name="fcb">
                        <option>Bygg A</option>
                        <option>Bygg B</option>
                        <option>Bygg C</option>
                    </select>
                </p>
                <h3><span>03.</span>Når?</h3>
                <p class="date">
                    	    <span>
								<label for="fcd">Fra </label>
								<input type="date" name="start_date">
							</span>
                    <br/>
                    <br/>
                    	    <span>
								<label for="fcd">Til </label>
								<input type="date" name="stop_date">
							</span>
                    <!--
							<span>
								<label>Måned</label>
								<select name="month">
                                    <option value="01">Januar</option>
                                    <option value="02">Februar</option>
                                    <option value="03">Mars</option>
                                    <option value="04">April</option>
                                    <option value="05">Mai</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">August</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="11">November</option>
                                    <option value="12">Desember</option>
                                </select>
							</span>
							<span>
								<label for="fcc">Dag</label>
								<select id="fcb" name="day">
                                    <option value="01">1</option>
                                    <option value="02">2</option>
                                    <option value="03">3</option>
                                    <option value="04">4</option>
                                    <option value="05">5</option>
                                    <option value="06">6</option>
                                    <option value="07">7</option>
                                    <option value="08">8</option>
                                    <option value="09">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                    <option value="24">24</option>
                                    <option value="25">25</option>
                                    <option value="26">26</option>
                                    <option value="27">27</option>
                                    <option value="28">28</option>
                                    <option value="29">29</option>
                                    <option value="30">30</option>
                                    <option value="31">31</option>
                                </select>
							</span>
							-->
                            <span>
                                <label for="fcd">Fra tid</label>
                                <select id="fcb" name="fromtime">
                                    <option value="08:00:00">08:00</option>
                                    <option value="09:00:00">09:00</option>
                                    <option value="10:00:00">10:00</option>
                                    <option valye="11:00:00">11:00</option>
                                    <option value="12:00:00">12:00</option>
                                    <option value="13:00:00">13:00</option>
                                    <option value="14:00:00">14:00</option>
                                    <option value="15:00:00">15:00</option>
                                </select>
                            </span>
                             <span>
                                <label for="fcd">Til tid</label>
                                <select id="fcb" name="stoptime">
                                    <option value="09:00:00">09:00</option>
                                    <option value="10:00:00">10:00</option>
                                    <option value="11:00:00">11:00</option>
                                    <option valye="12:00:00">12:00</option>
                                    <option value="13:00:00">13:00</option>
                                    <option value="14:00:00">14:00</option>
                                    <option value="15:00:00">15:00</option>
                                    <option value="16:00:00">16:00</option>
                                    <option value="17:00:00">17:00</option>
                                    <option value="18:00:00">18:00</option>
                                    <option value="19:00:00">19:00</option>
                                    <option value="20:00:00">20:00</option>
                                </select>
                            </span>
                </p>
                <h3><span>04.</span>Hvem?</h3>
                <p class="select-b">
							<span>
								<label for="fce">Antall Personer</label>
								<select id="fce" name="roomsize">
                                    <?php $romsize = $_POST['roomsize']; ?>
                                    <option>02</option>
                                    <option>03</option>
                                    <option>04</option>
                                </select>
							</span>
                </p>
                <img id="logo" src="img/logowesterdalsFarge.png">
                <p class="submit"><button type="submit" name="submit">Finn Rom</button></p>
            </fieldset>
        </form>
    </div>
</div>
</body>
</html>



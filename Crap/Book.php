<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$mysql_db = 'rombook';

	mysql_connect($host, $user, $pass);
	mysql_select_db($mysql_db);

	/*if (isset ($_POST['sok'])) {
		$sok = $_POST['sok'];
	$sql = "SELECT * FROM rom";
	$res = mysql_query($sql);
	if (mysql_num_rows($res) > 0){
	while ($row = mysql_fetch_assoc($res)) {
		echo  "Rom nummer : " . $row['id']." " ."Navn på Rom: " . $row['name']. " ". "Plass til: ". $row['plass']. " " ."status: ". $row['status']. '<br>';
	}
	}
}*/

/*$timestamp = date('Y-m-d G:i:s');*/
if (isset ($_POST['aar'])) {
    $aar = $_POST['aar'];
    $mnd = $_POST['mnd'];
    $dag = $_POST['dag'];
 
    $timestamp = $aar . "-" . $mnd . "-" . $dag . " " ."14:38:10";
    echo $timestamp;

    
  $sqlto = "SELECT * FROM bookinger WHERE slutt >= '".$timestamp."'";
  $resu = mysql_query($sqlto);
  if (mysql_num_rows($resu) > 0){
  while ($rows = mysql_fetch_assoc($resu)) {
    echo  "Rom nummer : " . $rows['id']." " ."Studentnr: " . $rows['studentnr']. " ". "Starttid: ". $rows['start']. " " ."Slutttid: ". $rows['slutt']. '<br>';
    }
  }
}
//$timestamp = date('Y-m-d G:i:s');

//echo $timestamp;


//echo '<br>';
//echo date("h:i a");

$month = date("n");
$year = date("Y");
$firstDay = mktime(0,1,0,$month,1,$year);
$daysInMonth = date("t",$firstDay);
$firstDay = date("w",$firstDay);
echo "<table width='280'  border='1'>\n";
  echo "<tr>\n";
    echo "<td align='center'>" . date("F Y") . "</td>\n";
  echo "</tr>\n";
  echo "<tr>\n";
    echo "<td>\n";
      echo "<table width='280'  border='0' cellspacing='2' cellpadding='2'>\n";
        echo "<tr align='center'>\n";
          echo "<td width='40'>Sun</td>\n";
          echo "<td width='40'>Mon</td>\n";
          echo "<td width='40'>Tue</td>\n";
          echo "<td width='40'>Wed</td>\n";
          echo "<td width='40'>Thu</td>\n";
          echo "<td width='40'>Fri</td>\n";
          echo "<td width='40'>Sat</td>\n";
        echo "</tr>\n";
        # Calculate number of rows
        $totalCells = $firstDay + $daysInMonth;
        if($totalCells < 36){
          $rowNumber = 5;
        } else {
          $rowNumber = 6;
        }
        $dayNumber = 1;
        # Create Rows
        for($currentRow=1; $currentRow <= $rowNumber; $currentRow++){
          if($currentRow == 1){
            # Create First Row
            echo "<tr align='center'>\n";
            for($currentCell  = 0; $currentCell<7; $currentCell++){
              if($currentCell == $firstDay){
                # First Day of the Month
                  echo "<td width='40'>" . $dayNumber . "</td>\n";
                  $dayNumber++;
              } else {
                if($dayNumber > 1){
                  # First Day Passed so output Date
                  echo "<td width='40'>" . $dayNumber . "</td>\n";
                  $dayNumber++;
                } else {
                  # First Day Not Reached so display blank cell
                  echo "<td width='40'>&nbsp;</td>\n";
                }
              }
            }
            echo "</tr>\n";
          } else {
            # Create Remaining Rows
            echo "<tr align='center'>\n";
            for($currentCell = 0; $currentCell < 7; $currentCell++){
              if($dayNumber > $daysInMonth){
                # Days in month exceeded so display blank cell
                  echo "<td width='40'>&nbsp;</td>\n";
              } else {
                  echo "<td width='40'>" . $dayNumber . "</td>\n";
                  $dayNumber++;                            
              }
            }
            echo "</tr>\n";
          }
        }
      echo "</table>\n";
    echo "</td>\n";
  echo "</tr>\n";
echo "</table>\n";

# Calculate number of rows
        $totalCells = $firstDay + $daysInMonth;
        if($totalCells < 36){
          $rowNumber = 5;
        } else {
          $rowNumber = 6;
        }
        $dayNumber = 1;

?>

<!doctype html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    
    <title>Auth</title>
<style>
body{
	margin: 0;
	/*background-color: rgb(20, 20, 20);*/
	}
	
/*#tekst {
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
	}*/
</style>
</head>
<body>



<div id="wrap">

	<h1>SØK databasen</h1>
</div>

  <div id="søketterrom">
<form action="Book.php" method="POST">
    ÅR: <input type="text" name="aar"/>
   <br/>
    MND: <input type="text" name="mnd"/>
    <br/>
    DAG: <input type="text" name="dag"/>
     <br/>
    <input type="submit" value="Søk Etter Rom"/>

    
	 <!--<div id="loginfelt">
<form action="Book.php" method="POST">
    Søk: <input type="text" name="sok"/>
    
    <input type="submit" value="Søk"/>

    <div id="loginfelt2">
    <form action="Book.php" method="POST">
    Søk: <input type="text" name="sokbook"/>
    
    <!--<input type="submit" value="Søk2"/>!-->

</form>
</div>
</body>
</html>
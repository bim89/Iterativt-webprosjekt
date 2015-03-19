<?php

    function addBook($roomid, $fromhour, $tohour, $weekday, $week, $user){

        require("dbconnect.php");
        
            $query = $db->prepare("SELECT * FROM Booking WHERE week = :week && weekday = :weekday && room_id = :roomid &&
                                 (start_time BETWEEN :fromhour AND :hourAfter || stop_time BETWEEN :hourBefore AND :tohour)");

			// $hourBefore = $fromhour + 1;
			$hourAfter = $tohour - 1;
			$hourBefore = $fromhour + 1;
			
            $query->bindParam(':week', $week);
            $query->bindParam(':weekday', $weekday);
            $query->bindParam(':fromhour', $fromhour);
            $query->bindParam(':tohour', $tohour);
            $query->bindParam(':roomid', $roomid);
            $query->bindParam(':hourAfter', $hourAfter);
			$query->bindParam(':hourBefore', $hourBefore);

            $query->execute();

            $count = $query->rowCount();

            var_dump($query->rowCount());

            if($count == 0){

            $stmt = $db->prepare("INSERT INTO Booking (room_id, start_time, stop_time, week, weekday, room_size, username)
                          VALUES(:roomid, :starttime, :stoptime, :week, :weekday, :roomsize, :user)");
            $roomsize = 2;
			var_dump($user);

            $stmt->bindParam(':roomid', $roomid);
            $stmt->bindParam(':starttime', $fromhour);
            $stmt->bindParam(':stoptime', $tohour);
            $stmt->bindParam(':week', $week);
            $stmt->bindParam(':weekday', $weekday);
            $stmt->bindParam(':roomsize', $roomsize);
            $stmt->bindParam(':user', $user);

            $stmt->execute();

            //sendmail();

            $stmt = $db->prepare("SELECT * FROM Booking");
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            addToJson($result, "Booking");

            }else{
                echo 'already booked';
            }

}



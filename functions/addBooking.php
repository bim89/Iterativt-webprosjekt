<?php

    function addBook($roomid, $fromhour, $tohour, $weekday, $week, $userid){

        require("dbconnect.php");
        
            $query = $db->prepare("SELECT * FROM Booking WHERE week = :week && weekday = :weekday && room_id = :roomid &&
                                 (start_time BETWEEN :fromhour AND :tohour || stop_time BETWEEN :fromhour AND :tohour)");

            $query->bindParam(':week', $week);
            $query->bindParam(':weekday', $weekday);
            $query->bindParam(':fromhour', $fromhour);
            $query->bindParam(':tohour', $tohour);
            $query->bindParam(':roomid', $roomid);

            $query->execute();

            $count = $query->rowCount();

            var_dump($query->rowCount());

            if($count == 0){

            $stmt = $db->prepare("INSERT INTO Booking (room_id, start_time, stop_time, week, weekday, room_size, user_id)
                          VALUES(:roomid, :starttime, :stoptime, :week, :weekday, :roomsize, :userid)");
            $roomsize = 2;

            $stmt->bindParam(':roomid', $roomid);
            $stmt->bindParam(':starttime', $fromhour);
            $stmt->bindParam(':stoptime', $tohour);
            $stmt->bindParam(':week', $week);
            $stmt->bindParam(':weekday', $weekday);
            $stmt->bindParam(':roomsize', $roomsize);
            $stmt->bindParam(':userid', $userid);

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



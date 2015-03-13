<?php

    function addBook($roomid, $fromhour, $tohour, $weekday, $week, $userid){

        /*$query = $db->query("SELECT * FROM room WHERE id NOT IN(SELECT * FROM Booking
                             WHERE($fromhour < start_time AND $tohour > stop_time)
                                AND($fromhour = start_time AND $tohour = stop_time)
                                AND($week = week AND $weekday = weekday))");

        if($query){*/

		require("dbconnect.php");

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

		$stmt = $db->prepare("SELECT * FROM Booking");
		$stmt->execute();
		
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		addToJson($result, "Booking");
}

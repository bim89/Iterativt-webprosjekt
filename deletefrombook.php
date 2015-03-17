<?php

    function deleteBook($bookid, $userid){

        /*$query = $db->query("SELECT * FROM room WHERE id NOT IN(SELECT * FROM Booking
                             WHERE($fromhour < start_time AND $tohour > stop_time)
                                AND($fromhour = start_time AND $tohour = stop_time)
                                AND($week = week AND $weekday = weekday))");

        if($query){*/

		require("dbconnect.php");

        $stmt = $db->prepare("DELETE FROM Booking WHERE book_id = $bookid AND user_id = $userid");
        $roomsize = 2;

        $stmt->bindParam(':book_id', $bookid);
        $stmt->bindParam(':user_id', $userid);
        

        $stmt->execute();

		$stmt = $db->prepare("SELECT * FROM Booking");
		$stmt->execute();
		
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		addToJson($result, "Booking");
}
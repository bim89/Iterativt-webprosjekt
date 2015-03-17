<?php

    function sendmail(){

    $to = 'dannemeinecke@gmail.com';
    $subject = 'Reservation';
    $message = 'Hello!';
    $headers = 'From: webmaster@ourcompany.com' . "\r\n" .
        'Reply-To: webmaster@ourcompany.com' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    }



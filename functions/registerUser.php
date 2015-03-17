<?php

require('dbconnect.php');

    if(!empty($_POST)){
        //Sjekker at bruker har skrevet et "ikke-tomt" brukernavn
        if(empty($_POST['username'])) {
            die("Skriv in et brukernavn");
        }
        //Sjekker at bruker har skrevet et "ikke-tomt" passord felt
        if(empty($_POST['password'])) {
            die("Skriv in et passord");
        }
        //Validerer at epost er riktig
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        {
            die("Fyll in en gyldig epost-adresse");
        }
        //Sjekker hvis brukernavn som bruker skrevet finnes i databasen
        $sql_query = "
                SELECT 1
                FROM Users
                WHERE username = :username";

        //lagrer :username variablen til spørringen
        $sql_parameters = array(
            ':username' => $_POST['username']
        );

        //tester at kjøre spørringen, å lagrer resultatet i $result
        try{
            $state = $db->prepare($sql_query);
            $result = $state->execute($sql_parameters);
        }catch(PDOException $e){
            die("Query dident run " . $e->getMessage());
        }

        $row = $state->fetch();

        if($row){
            die("Brukernavnet er reden registrert");
        }

        $sql_query = "
                SELECT 1
                FROM Users
                WHERE email = :email";
        $sql_parameters = array(
            ':email' => $_POST['email']
        );

        try{
            $state = $db->prepare($sql_query);
            $result = $state->execute($sql_parameters);
        }catch(PDOException $e){
            die("Query did not run" . $e->getMessage());
        }
        $row = $state->fetch();

        if($row){
            die("Email er reden registrert");
        }

        //Plats för andre sjekker, ev lengde på passord



        $secureQuery = "
                INSERT INTO Users (
                username,
                password,
                salt,
                email
                ) VALUES (
                :username,
                :password,
                :salt,
                :email
                )
        ";


        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));

        $password = hash('sha256', $_POST['password'] . $salt);

        for($round = 0; $round < 65536; $round++)
        {
            $password = hash('sha256', $password . $salt);
        }

        $sql_parameters= array(
            ':username' => $_POST['username'],
            ':password' => $password,
            ':salt' => $salt,
            ':email' => $_POST['email']
        );
    try{
        $state = $db->prepare($secureQuery);
        $result = $state->execute($sql_parameters);
    }catch(PDOException $e){
        die("Query did not run" . $e->getMessage());
    }

    header("Location: login.php");

    die("Redirecting to login.php");
}

?>

<h1>Registrer Konto</h1>
<form action="registerUser.php" method="post">
    Username:<br />
    <input type="text" name="username" value="" />
    <br /><br />
    E-Mail:<br />
    <input type="text" name="email" value="" />
    <br /><br />
    Password:<br />
    <input type="password" name="password" value="" />
    <br /><br />
    <input type="submit" value="Register" />
</form>
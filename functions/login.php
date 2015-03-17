<?php




if(!empty($_POST["username"]) && !empty($_POST["password"]))
{
    $sqlquery =
        "SELECT
        *
        FROM Users WHERE username = :username
        ";

    $sql_parameters = array(':username' => $_POST['username']);

    try{
        $state = $db->prepare($sqlquery);
        $result = $state->execute($sql_parameters);
    }catch(PDOException $e){
        die("FAIL FAIL FAIL: " . $e->getMessage());
    }

    $login = false;

    $row = $state->fetch();

    if($row){
        $check_pwd = hash('sha256', $_POST['password'] . $row['salt']);
        for($round = 0; $round < 65536; $round++)
        {
            $check_pwd = hash('sha256', $check_pwd . $row['salt']);
        }

        if($check_pwd === $row['password'])
        {
            $login = true;
        }
    }

    if($login){
		
        unset($row['salt']);
        unset($row['password']);



        $_SESSION['user'] = $row;
		


    }else{
        print("Login Failed Big Time!");

    }
}
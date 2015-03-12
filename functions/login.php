	<?php

require('dbconnect.php');

$entred_username = '';

if(!empty($_POST))
{
    $sqlquery =
        "SELECT
        id,
        username,
        password,
        salt,
        email
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
    var_dump($row);
    if($row){
        $check_pwd = hash('sha256', $_POST['password'] . $row['salt']);
        for($round = 0; $round < 65536; $round++)
        {
            $check_pwd = hash('sha256', $check_pwd . $row['salt']);
        }
        var_dump($check_pwd);
        if($check_pwd === $row['password'])
        {
            $login = true;
        }
    }
    var_dump($login);
    if($login){

        unset($row['salt']);
        unset($row['password']);



        $_SESSION['user'] = $row;
        header("Location: index.php");
        die("Redirect failed");
    }else{
        print("Login Failed Big Time!");

        $submitted_username = htmlentities($_POST['username'], END_QUOTES, "UTF-8");
    }
}
?>

<h1>Login</h1>
<form action="login.php" method="post">
    Username:<br />
    <input type="text" name="username" value="" />
    <br /><br />
    Password:<br />
    <input type="password" name="password" value="" />
    <br /><br />
    <input type="submit" value="Login" />
</form>
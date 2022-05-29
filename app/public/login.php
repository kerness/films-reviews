<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        require("log_function_inc.php");
        require('DBconnect.php');
        
        list($check, $data) = check($dbc, $_POST['email'], $_POST['pass']);

        if($check)
        {
            session_start();
            $_SESSION["user_id"] = $data["user_id"];
            $_SESSION["login"] = $data["login"];
            $_SESSION["email"] = $_POST["email"];

            //setcookie("user_id", $data["user_id"], time() + 60);
            //setcookie("first_name", $data["first_name"], time() + 60);
            header('Location: http://51.38.131.114/loggedin.php');
            exit();
        }
        else
        {
            $errors = $data;
        }
        mysqli_close($dbc);
    }
    include("login_inc.php");

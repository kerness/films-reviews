<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        require("admin_log_function_inc.php");
        require('DBconnect.php');
        
        list($check, $data) = check_admin($dbc, $_POST['email'], $_POST['pass']);

        if($check)
        {
            session_start();
            $_SESSION["user_id"] = $data["user_id"];
            $_SESSION["login"] = $data["login"];
            
            header('Location: http://51.38.131.114/admin_loggedin.php');
            exit();
        }
        else
        {
            $errors = $data;
        }
        mysqli_close($dbc);
    }
    include("admin_login_inc.php");

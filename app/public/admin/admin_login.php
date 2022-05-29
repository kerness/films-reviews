<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        ob_start();
        require("admin_log_function_inc.php");
        require('../../private/DBconnect.php');
        
        list($check, $data) = check_admin($dbc, $_POST['email'], $_POST['pass']);

        if($check)
        {
            session_start();
            $_SESSION["user_id"] = $data["user_id"];
            $_SESSION["login"] = $data["login"];
            
            if (headers_sent()) {
                die("Error: headers already sent!");
            }
            else {
                header("Location: admin_loggedin.php", true);
                exit();
            }
        }
        else
        {
            $errors = $data;
        }
        mysqli_close($dbc);
    }
    include("admin_login_inc.php");
?>

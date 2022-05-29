<?php
    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        ob_start();
        require("log_function_inc.php");
        require('../private/DBconnect.php');
        
        list($check, $data) = check($dbc, $_POST['email'], $_POST['pass']);

        if($check)
        {
            session_start();
            $_SESSION["user_id"] = $data["user_id"];
            $_SESSION["login"] = $data["login"];
            $_SESSION["email"] = $_POST["email"];

            //setcookie("user_id", $data["user_id"], time() + 60);
            //setcookie("first_name", $data["first_name"], time() + 60);
            //header('Location: 127.0.0.1/loggedin.php');

            if (headers_sent()) {
                die("Error: headers already sent!");
            }
            else {
                header("Location: loggedin.php", true);
                exit();
            }
            
            exit();
        }
        else
        {
            $errors = $data;
        }
        mysqli_close($dbc);
    }
    include("login_inc.php");

?>
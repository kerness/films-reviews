<?php

    function check($dbc, $email='', $pass='')
    {
        $errors = array();

        if(empty($email))
        {
            $errors[] = "Enter e-mail address.";
        }
        else
        {
            $e = trim($email);
        }
        
        if(empty($pass))
        {
            $errors[] = "Enter password.";
        }
        else
        {
            $p = trim($pass);
        }

        if(empty($errors))
        {
            $q = "SELECT user_id, login FROM user WHERE email = '$e' AND password = '$p'";
            $r = mysqli_query($dbc, $q);
            
            if(mysqli_num_rows($r) == 1)
            {
                $row = mysqli_fetch_array($r, MYSQLI_ASSOC);

                return [true, $row];
            }
            else 
            {
                $errors[] = "Invalid e-mail address or password.";
            }
        }

        return [false, $errors];


    }


?>
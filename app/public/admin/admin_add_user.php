<?php
    session_start();

    if(!isset($_SESSION['user_id']))
    {
        header('Location: http://51.38.131.114/index.php');
    }
    
    $page_title = "Add user";
    include('admin_header_logged.html');
?>

<br>
    <ul class="ul_admin">
        <li><a href="admin_user_manager.php">Manage users</a></li>
        <li  class="active"><a href="admin_add_user.php">Add user</a></li>
    </ul>
<br>
<div class="container_admin">

<?php

    require_once("../../private/DBconnect.php");


    if(isset($_REQUEST["n"]) && $_REQUEST["n"] == 1)
    {
        $log = $_REQUEST['login'];
        $em = $_REQUEST['email'];
        $p = $_REQUEST['pass'];
        $role = $_REQUEST['role'];

        $q = "SELECT user_id FROM user WHERE email = '$em'";
        $r = mysqli_query($dbc, $q);

        if(mysqli_num_rows($r) != 0)
        {
            echo "<p class='err'>Error! E-mail address already exists.</p>";
        }
        else
        {
            $q = "INSERT INTO user (user_id, login, password, email, user_level, registration_date) VALUES (NULL, '$log', SHA1('$p'), '$em', $role, NOW())";
            $r = mysqli_query($dbc, $q);
    
            if(mysqli_affected_rows($dbc) == 1)
            {
                echo "<p>User " . $log . " has been added." . "</p>";
            }
            else
            {
                echo "<p class='err'>Error!</p>";
            }
        }
    }
?>
<form action="admin_add_user.php?n=1" method="post">
    <h1> Add user's personal information </h1>
    <p>Role:
    <input class="role" type="radio" id="r0" name="role" value="0" checked>
    <label for="r0">regular user</label>
    <input class="role" type="radio" id="r1" name="role" value="1">
    <label for="r1">admin</label></p>
    <p>Name: <input type="text" name="login" ></p>
    <p>E-mail address: <input type="text" name="email"></p>
    <p>Password: <input type="text" name="pass"></p>
    <input type="submit" value="Add">
</form>
</div>
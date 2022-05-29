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
<div class="b" >
    <ul >
        <li class="users"><a href="admin_user_manager.php">Zarządzanie użytkownikami</a></li>
        <li class="users"><a href="admin_add_user.php">Dodawanie użytkowników</a></li>
    </ul>
</div>
<br>

<?php

    require_once("DBconnect.php");


    if(isset($_REQUEST["n"]) && $_REQUEST["n"] == 1)
    {
        $log = $_REQUEST['login'];
        $em = $_REQUEST['email'];
        $p = $_REQUEST['pass'];
        $role = $_REQUEST['role'];


        $q = "INSERT INTO user (user_id, login, password, email, user_level, registration_date) VALUES (1002, '$log', '$p', '$em', $role, NOW())";
        $r = mysqli_query($dbc, $q);

        if($r)
        {
            echo "<p>User " . $log . " has been added." . "</p>";
        }
        else{
            echo "<p>Error!</p>";
        }

    }
?>

<h1> Add user's personal information </h1>
<form action="admin_add_user.php?n=1" method="post">
        <p>Role:
        <input type="radio" id="r0" name="role" value="0" checked>
        <label for="r0">regular user</label>
        <input type="radio" id="r1" name="role" value="1">
        <label for="r1">admin</label></p>
        <p>Name: <input type="text" name="login" ></p>
        <p>E-mail address: <input type="text" name="email"></p>
        <p>Password: <input type="text" name="pass"></p>
        <input type="submit" value="Add">
</form>
<?php
    session_start();

    if(!isset($_SESSION['user_id']))
    {
        header('Location: http://51.38.131.114/index.php');
    }
    
    $page_title = "Add film";
    include('admin_header_logged.html');
?>

<br>
<div class="b" >
    <ul >
        <li class="users"><a href="admin_film_manager.php">Delete films</a></li>
        <li class="users" style="background-color:#FF69B4;"><a href="admin_add_film.php">Add film</a></li>
    </ul>
</div>
<br>

<?php

    require_once("../../private/DBconnect.php");


    if(isset($_REQUEST["n"]) && $_REQUEST["n"] == 1)
    {
        $t = $_REQUEST['title'];
        $d = $_REQUEST['director'];
        $rel = $_REQUEST['release'];
        $g = $_REQUEST['genre'];

        $q = "INSERT INTO movie (title, director, release_date, genre) VALUES ('$t', '$d', '$rel', $g)";
        $r = mysqli_query($dbc, $q);

        if($r)
        {
            echo "<p>Film " . $t . " has been added." . "</p>";
        }
        else
        {
            echo "<p>Error!</p>";
        }
        
    }
?>

<h1> Add film </h1>
<form action="admin_add_film.php?n=1" method="post">
        <p>Title: <input type="text" name="title" ></p>
        <p>Director: <input type="text" name="director"></p>
        <p>Release_date: <input type="text" name="release"></p>
        <p>Genre: <input type="text" name="genre" ></p>
        <input type="submit" value="Add">
</form>


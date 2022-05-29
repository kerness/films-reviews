


<?php
    session_start();

    if(!isset($_SESSION['user_id']))
    {
        header('Location: http://51.38.131.114/index.php');
    }
    
    $page_title = "Rate a film";
    include('header_logged.html');
    require_once('../private/DBconnect.php');

    $user_id = $_SESSION['user_id'];
    $movie_id = $_REQUEST["id"];
    $title = $_REQUEST["title"];


    // $q = "SELECT title FROM movie WHERE movie_id = $movie_id";
    // $r = mysqli_query($dbc, $q);
    // $title = mysqli_fetch_array($r, MYSQLI_ASSOC)['title'];
    echo "You are rating a film titled $title";

    //mysqli_free_result($title);

    // echo "</table>";



    $q = "INSERT INTO reviews (user_id, movie_id, rating, text) VALUES ($user_id, $movie_id," . $_REQUEST['rate'] . ", 'keks');";
        
    $r = mysqli_query($dbc, $q);




?>


    <form action="rate_film.php" method="post">
        <label for="rate">Choose a rate:</label>
        <select id="rate" name="rate">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <input type="submit" value="Rate!">
    </form>






<?php include("footer.html")?>
<?php 

session_start();

if(!isset($_SESSION['user_id']))
{
    header('Location: http://51.38.131.114/index.php');
}


$page_title = "Films list";
include('admin_header_logged.html');
?>

<br>
<div class="b" >
    <ul >
        <li class="users" style="background-color:#FF69B4;"><a href="admin_film_manager.php">Delete films</a></li>
        <li class="users"><a href="admin_add_film.php">Add film</a></li>
    </ul>
</div>
<br>

<?php
require_once('../../private/DBconnect.php');

if(isset($_REQUEST['d']) && $_REQUEST['d']==1)
{
    $id = $_GET['id'];
    $q = "DELETE FROM movie WHERE movie_id = $id";
    $r = mysqli_query($dbc, $q);
    echo "<div class='err'>Film has been deleted</div>";
}


$q = "SELECT movie_id as id, title, director, release_date, genre FROM movie ORDER BY movie_id";

$r = mysqli_query($dbc, $q);

$num = mysqli_num_rows($r);

if($num > 0)
{
    echo "<p>Currently there are $num films available.</p>";

    echo '<table> <tr> <th> ID </th><th> Title </th><th> Director </th><th> Release date </th><th> Genre </th></tr>';
    
    while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
    {
        echo "<tr> <td>" . $row['id'] . "</td><td>" . $row['title'] . "</td><td>" . $row['director'] . "</td><td>" . $row["release_date"] . "</td><td>"
        . $row['genre'] . "</td><td> <a href='admin_user_manager.php?d=1&id=" . $row['id'] . "'>Delete</a></td></tr>";
    }
    
    echo "</table>";
    
    mysqli_free_result($r);
}
else{
    echo "<p> No users are currently registered.</p>";
}

mysqli_close($dbc);

include('../footer.html');

?>
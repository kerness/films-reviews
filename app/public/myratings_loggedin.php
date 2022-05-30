<?php 
$page_title = "Movies ranking";


session_start();

if(!isset($_SESSION['user_id']))
{
    header('Location: index.php');
}

# necessary files: page header and DB connection details 
include('header_logged.html');
require_once('../private/DBconnect.php');

#$q = "select email, login, password from user";// WHERE login = 'Pennie';";
#$q = "SELECT * FROM user";# WHERE login ='admin'";

$user = $_SESSION['login'];

$q = "
    SELECT title, rating, movie.movie_id 
    FROM movie 
    JOIN reviews ON movie.movie_id = reviews.movie_id 
    WHERE reviews.user_id = (SELECT user_id FROM user WHERE login = '$user')
    ORDER BY rating DESC;  
";

$r = mysqli_query($dbc, $q);

$num = mysqli_num_rows($r);

echo "{$_SESSION['login']}'s film ranking";
echo "<p>Number of reviewed films: $num </p>";



echo '<table> 
        <tr style="text-align: left;">
            <th>Film title</th>
            <th>Your rating</th>
            <th>Change rating</th>
        </tr>';

while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
{
    echo "<tr> 
            <td>" . $row['title'] . "</td>
            <td>" . $row['rating'] . "</td>
            <td> <a" . " href='rate_film.php?m_id=" . $row['movie_id'] . "&title=" . $row['title'] ."'>Rate</a> </td>
        </tr>";
}

echo "</table>";



// echo '<table> <tr> <th>Nazwisko, Imię</th> <th> Data rejestracji</th> </tr>';

// while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
// {
//     echo "<tr> <td>" . $row['email'] . "</td><td>" . $row['login'] . "</td><td>". $row['user_level'] . "</td><td>" . $row['password'] . "</td></tr>";
// }

// echo "</table>";

mysqli_free_result($r);

mysqli_close($dbc);

include('footer.html');

?>
<link rel="stylesheet" href="CSS/ranking_style.css" type="text/css">
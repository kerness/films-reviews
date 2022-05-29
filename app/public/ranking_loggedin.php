<?php 
$page_title = "Movies ranking";


session_start();

if(!isset($_SESSION['user_id']))
{
    header('Location: http://51.38.131.114/index.php');
}

# necessary files: page header and DB connection details 
include('header.html');
require_once('DBconnect.php');

#$q = "select email, login, password from user";// WHERE login = 'Pennie';";
#$q = "SELECT * FROM user";# WHERE login ='admin'";

$user = $_SESSION['login'];

$q = "
    SELECT title, rating 
    FROM movie 
    JOIN reviews ON movie.movie_id = reviews.movie_id 
    WHERE reviews.user_id = (SELECT user_id FROM user WHERE login = '$user')
    ORDER BY rating DESC;  
";

$r = mysqli_query($dbc, $q);

$num = mysqli_num_rows($r);

echo "<p>Number of reviewed films: $num </p>";
echo "Wyświetlam ranking uzytownika {$_SESSION['login']}";


echo '<table> 
        <tr style="text-align: left;">
            <th>Film title</th>
            <th>Twoja ocena</th>
        </tr>';

while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
{
    echo "<tr> 
            <td>" . $row['title'] . "</td>
            <td>" . $row['rating'] . "</td>
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
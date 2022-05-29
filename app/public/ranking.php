<?php 
$page_title = "Movies ranking";

# necessary files: page header and DB connection details 
include('header.html');
require_once('../private/DBconnect.php');

#$q = "select email, login, password from user";// WHERE login = 'Pennie';";
#$q = "SELECT * FROM user";# WHERE login ='admin'";

$q = " SELECT title, avg_rating
FROM
(
	SELECT m.title,
		   m.movie_id,
		   ROUND(AVG(r.rating),2) AS avg_rating,
		   RANK() OVER(ORDER BY AVG(r.rating) DESC) rating_rank
	FROM movie m
	INNER JOIN reviews r 
		ON m.movie_id = r.movie_id 
	GROUP BY m.title, m.movie_id
) ranked_rating ORDER BY avg_rating DESC;";

$r = mysqli_query($dbc, $q);

$num = mysqli_num_rows($r);

echo "<p>Number of reviewed films: $num </p>";


echo '<table> 
        <tr style="text-align: left;">
            <th>Film title</th>
            <th>Ocena</th>
        </tr>';

while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
{
    echo "<tr> 
            <td>" . $row['title'] . "</td>
            <td>" . $row['avg_rating'] . "</td>
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
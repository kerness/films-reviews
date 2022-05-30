<?php 
    session_start();
$page_title = "Movies ranking";

# necessary files: page header and DB connection details 
include('header_logged.html');
require_once('../private/DBconnect.php');

# TODO: możliwość oceniania filmów

$q = " SELECT title, avg_rating, movie_id
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

echo "<p>Overall number of reviewed films: $num </p>";


echo '<table> 
        <tr>
            <th>Film title</th>
            <th>Overall Rating</th>
            <th>Rate</th>
        </tr>';

while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
{
    echo "<tr> 
            <td>" . $row['title'] . "</td>
            <td>" . $row['avg_rating'] . "</td>
            <td> <a" . " href='rate_film.php?m_id=" . $row['movie_id'] . "&title=" . $row['title'] ."'>Rate</a> </td>
        </tr>";

}



echo "</table>";


mysqli_free_result($r);

mysqli_close($dbc);

include('footer.html');

?>
<link rel="stylesheet" href="CSS/ranking_style.css" type="text/css">
<?php 
$page_title = "Films ranking";

include('header.html');
require_once('../private/DBconnect.php');

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
            <th>Rating</th>
        </tr>';

while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
{
    echo "<tr> 
            <td>" . $row['title'] . "</td>
            <td>" . $row['avg_rating'] . "</td>
        </tr>";
}

echo "</table>";

mysqli_free_result($r);
mysqli_close($dbc);
include('footer.html');

?>
<link rel="stylesheet" href="CSS/ranking_style.css" type="text/css">
<?php 
$page_title = "Zarejestrowani użytkownicy";
include('header.html');

require_once('../private/DBconnect.php');

#$q = "select email, login, password from user";// WHERE login = 'Pennie';";
$q = "SELECT * FROM user";# WHERE login ='admin'";

$r = mysqli_query($dbc, $q);

$num = mysqli_num_rows($r);

echo "<p>Obecnie zarejestrowanych jest $num użytkowników</p>";

echo '<table> <tr> <th>Nazwisko, Imię</th> <th> Data rejestracji</th> </tr>';

while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))
{
    echo "<tr> <td>" . $row['email'] . "</td><td>" . $row['login'] . "</td><td>". $row['user_level'] . "</td><td>" . $row['password'] . "</td></tr>";
}

echo "</table>";

mysqli_free_result($r);

mysqli_close($dbc);

include('footer.html');

?>
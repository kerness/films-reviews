
<?php
DEFINE ('DB_USER', 'Magnesium1756');
DEFINE ('DB_PASSWORD', '2ima6BwPMQn9NV');
DEFINE ('DB_HOST', 'mysql');
DEFINE ('DB_NAME', 'website');

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ("No connection to MySQL Server: " . mysqli_connect_error());
?>


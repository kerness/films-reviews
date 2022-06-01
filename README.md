# films-reviews

A simple php web application where you can login, rate the films and explore overall and personal film ranking.
As an administrator you are able to manage users and films database.


In order to run this project locally those variables must be specified in the env file for docker-compose:
- DB_USER="Magnesium1756"
- DB_USER_PASSWORD="2ima6BwPMQn9NV"
- DB_ROOT_PASSWORD="Kl*#JklOpFTR34!"
- DB_NAME="website"

A file with DB connection details:
- location: app/private/DBconnect.php
- content: $dbc = @mysqli_connect(DB_HOST, DB_USER, DB_USER_PASSWORD, DB_NAME) OR die ("No connection to MySQL Server: " . mysqli_connect_error());

Also, there is necessary to change header reddirections to desired hostname.

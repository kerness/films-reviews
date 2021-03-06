<?php
    session_start();
    if(!isset($_SESSION['user_id'])) {
        header('Location: http://51.38.131.114/index.php');
    }


    $page_title = "Rate a film";
    include('header_logged.html');
    require_once('../private/DBconnect.php');
    if ($dbc == false) {
        die("ERROR: Could not connect to database: " . mysqli_connect_error());
    }
    $u_id = $_SESSION['user_id'];
    $m_id = $_REQUEST['m_id'];
    $title = $_REQUEST["title"];

    echo "<p class='rate1'>You are rating a film titled <b>" . $title. "</b> </p>";

    if(isset($_GET['form_submitted']))
    {    
        $rate = $_GET['rate'];
        $m_id = $_GET['m_id'];

        function is_reviewed($db, $user, $movie) {
            // this query should return onlu one row
            $sql1="SELECT review_id AS user_reviews_number_of_one_film FROM reviews where user_id = $user AND movie_id = $movie;";
            $r = mysqli_query($db, $sql1);
            $num = mysqli_num_rows($r);
            mysqli_free_result($r);
            if ($num >= 1) {
                return TRUE;
            } else {
                return FALSE;
            }
        }

        function rate_film($db, $user, $movie, $user_rating, $movie_title) {
            // first check whether the film was alreadey reviewwd

            
            if (!is_reviewed($db, $user, $movie)) { // if not reviewed insert new
                $sql_insert = "INSERT INTO reviews (user_id, movie_id, rating, text) VALUES ($user, $movie, $user_rating, '');";

                if (mysqli_query($db, $sql_insert)) {
                    echo '<p class="rate2">Your rate for a <b> ' . $movie_title . '</b>' . ' film has been saved!</p>';
                    mysqli_free_result();
                } else {
                    echo "$title Error: " . $sql_insert . ":-" . mysqli_error($db);
                }
            } else { // if reviewed update the rating
                $sql_update = "UPDATE reviews SET rating = $user_rating  WHERE user_id = $user AND movie_id = $movie;";
                $r = mysqli_query($db, $sql_update);
                $num = mysqli_num_rows($r);
                echo '<p class="rate2">Your rate for a <b> ' . $movie_title . '</b>' . ' film has been updated.</p>';
                mysqli_free_result($r);
            }
        }
        
        
        rate_film($dbc, $u_id, $m_id, $rate, $title);

        mysqli_close($dbc);
    } 
?>
    <form action="rate_film.php" method="get">
        <select id="rate" name="rate">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <input type="hidden" name="form_submitted" value="1"/>
        <input type="hidden" name="m_id" value="<?php echo $m_id;?>"/> 
        <input type="hidden" name="title" value="<?php echo $title;?>"/> 
        <input type="submit" name="submit" value="Rate!">
    </form>
<?php include("footer.html")?>
<link rel="stylesheet" href="CSS/rate_film.css" type="text/css">
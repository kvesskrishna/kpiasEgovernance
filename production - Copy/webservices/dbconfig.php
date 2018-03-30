<?php
//Open a new connection to the MySQL serverss
$mysqli = new mysqli('localhost','kpiasdot_egov','kpias123','kpiasdot_egov');
//Output any connection error
if ($mysqli->connect_error) {
    die('Error : ('. $mysqli->connect_errno .') '. $mysqli->connect_error);
}
?>
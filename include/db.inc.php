<?php
$conn_string = "host=localhost port=1234 dbname=your_dbname user=your_user_name password=yoursecretpassword";
$GLOBALS['dbconn'] = pg_connect($conn_string) or die("Could not connect");
?>

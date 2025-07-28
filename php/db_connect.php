<?php
//db_connect.php
//this file contains the database connection configuration

//credentials
//replace these with your actual database credentials
$servername = "localhost"; //or your specific server hostname
$username = "bajwa11j_3340";     //your database username
$password = "Jimkhalsa@1";     //your database password
$dbname = "bajwa11j_3340_project";  //the name of the database

//connection creation
//the @ symbol suppresses default warnings so we can handle them manually
$conn = @new mysqli($servername, $username, $password, $dbname);

// connection check
//if the connection has an error, we stop the script and show an error message
if ($conn->connect_error) {
    die("Error: Could not connect to the database.");
}

//set the character set to utf8mb4 for full Unicode support
$conn->set_charset("utf8mb4");

?>
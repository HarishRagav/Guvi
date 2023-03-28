<?php
include("./register.php");
include("./redis.php");
// Set up the MongoDB client
// $client = new MongoDB\Client("mongodb://localhost:27017");

// Select the database and collection
// $database = $client->profile;
// $collection = $database->data;

$m=new MongoDB\Driver\Manager();
$db=$m->profile;
$profile_Connection=$db->profile;
// echo "connection successfull";
echo "welcome".$_SESSION['email']; 
?>

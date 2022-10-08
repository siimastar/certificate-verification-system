<?php
;
$conn = new mysqli("localhost", "root", "", "certificate");

if(!$conn){
    die("Error: ".$conn->error);
}

?>
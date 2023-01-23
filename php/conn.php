<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "youth360";

$mysqli = new mysqli($servername,$username,$password,$dbname);


if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
}
?>
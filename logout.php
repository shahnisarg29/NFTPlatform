<?php 

session_start();
$_SESSION["userId"] = "";
$_SESSION["manager"] = "";
session_destroy();
header("Location: index.php");

?>
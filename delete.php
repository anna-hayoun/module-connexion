<?php

session_start();

require('sqlconfig.php');

$ide = $_GET['id'];

$request = "DELETE FROM `utilisateurs` WHERE id = '$ide'";
$query = mysqli_query($conn, $request);

header('Location: admin.php');

?>
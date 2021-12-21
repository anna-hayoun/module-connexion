<?php
 
// Connexion à la base de données MySQL 
$conn = mysqli_connect("localhost", "root", "", "moduleconnexion");

// Vérifier la connexion
if($conn === false)
{
    die("ERREUR : Impossible de se connecter. " . mysqli_connect_error());
}

?>
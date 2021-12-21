<?php

require('sqlconfig.php');

if (!empty(isset($_POST['login'], $_POST['prenom'], $_POST['nom'], $_POST['password'], $_POST['password2'])))
{
	$login = $_POST['login'];
 
	$prenom = $_POST['prenom'];
	 
	$nom = $_POST['nom'];
	
	$password = $_POST['password'];
	
	$confirmpassword = $_POST['password2'];

	// requête SQL
    $query = mysqli_query($conn, "SELECT login FROM `utilisateurs` WHERE login = '$login'");
    $result = mysqli_fetch_all($query);
	

	if (count($result) == 0)
	{
        if ($confirmpassword == $password)
		{

			$res = mysqli_query($conn, "INSERT INTO `utilisateurs` (login, prenom, nom, password, role) 
			VALUES ('$login', '$prenom', '$nom', '$password', 'user')");

			if ($res)
			{
				echo "<div class='sucess'>
				<h3>Vous êtes inscrit avec succès.</h3>
				<p>Cliquez ici pour vous <a href='connexion.php'>connecter</a></p>
				</div>";	
			} 
		}
		else
		{
			echo "Les mots de passes doivent être identiques";
		}
	}
	else
	{
		echo "Nom d'utilisateur déjà utilisé";
	}
}
else 
{
	echo "Veuillez remplir tous les champs.";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/index.css" rel="stylesheet" type="text/css"/>
	<title>memer - Inscription</title>
</head>
<body>

<h4>memer</h4>

<form class="box" action="" method="post">

    <h1 class="box-title">Inscrivez-vous !</h1>
    
	<label>Nom d'utilisateur</label> 
	<input type="text" class="box-input" name="login" placeholder="Nom d'utilisateur" required />

	<label>Votre prénom</label> 
    <input type="text" class="box-input" name="prenom" placeholder="Votre prénom" required />
    
	<label>Votre nom</label> 
	<input type="text" class="box-input" name="nom" placeholder="Votre nom" required />
	
	<label>Mot de passe</label> 
	<input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
    
	<label>Confirmez votre mot de passe</label> 
	<input type="password" class="box-input" name="password2" placeholder="Confirmer le mdp" required />
	
	<input type="submit" name="submit" value="S'inscrire" class="box-button" />
    
	<p class="box-register">Déjà inscrit? <a href="connexion.php">Connectez-vous ici</a></p>

</form>

<footer>

<div id="link">© 2021 Copyright:
    <a href="https://github.com/anna-hayoun/module-connexion">github.com/anna-hayoun</a>
</div>

<a href="https://twitter.com/?lang=fr"><p><img src="img/twitt.png" alt="Twitter" class="twi"></p></a>

</footer>

</body>
</html>
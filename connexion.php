<?php

session_start();
require('sqlconfig.php');


if (isset($_POST['login']))
{
	$login = $_POST['login'];
	$login = mysqli_real_escape_string($conn, $login);

	$password = $_POST['password'];
	$password = mysqli_real_escape_string($conn, $password);
	
    $query = "SELECT * FROM `utilisateurs` WHERE login='$login' and password='$password'";
	$result = mysqli_query($conn, $query) or die(mysqli_error());
	$rows = mysqli_num_rows($result); 
		
    if($rows == 1)
	{
	    $_SESSION['login'] = $login;

		$user = mysqli_fetch_assoc($result);

		if ($user['role'] == 'admin')
		{
			$_SESSION['admin'] = $user['id']; 
			$_SESSION['id'] = $user['id'];
	        header("Location: admin.php");
            exit;
		}
		else
		{
			$_SESSION['id'] = $user['id'];
			header("Location: index.php");
			exit;
		}
	}
	else
	{
		$message = "<h2>Le nom d'utilisateur ou le mot de passe est incorrect.</h2>";
	}
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/index.css" rel="stylesheet" type="text/css"/>
    
	<title>memer - Connexion</title>
</head>

<body>

<h4>memer</h4>

<form class="box" action="" method="post" name="login">

<h1 class="box-title">Connexion</h1>

<input type="text" class="box-input" name="login" placeholder="Nom d'utilisateur">

<input type="password" class="box-input" name="password" placeholder="Mot de passe">

<input type="submit" value="Connexion " name="submit" class="box-button">
<p class="box-register">Vous êtes nouveau ici? <a href="inscription.php">S'inscrire</a></p>
<?php if (!empty($message)) { ?>
    <p class="errorMessage"><?php echo $message; ?></p>
<?php }; ?>
</form>

<footer>

<div id="link">© 2021 Copyright:
    <a href="https://github.com/anna-hayoun/module-connexion">github.com/anna-hayoun</a>
</div>

<a href="https://twitter.com/?lang=fr"><p><img src="img/twitt.png" alt="Twitter" class="twi"></p></a>

</footer>

</body>
</html>
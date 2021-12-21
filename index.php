<?php
	
session_start();

require('sqlconfig.php');

// Vérifiez si utilisateur connecté, sinon redirection vers page de connexion

if(!isset($_SESSION["login"]))
{
	header("Location: connexion.php");
	exit();
}
    $id = $_SESSION['id'];
    $request = "SELECT * FROM utilisateurs WHERE id = $id";
    $start = mysqli_query($conn, $request);

    if (isset($start))
    {
        $recup = mysqli_fetch_all($start);
    }


?>

<?php

if (isset($_FILES['screenshot']) && $_FILES['screenshot']['error'] == 0)
{
    if ($_FILES['screenshot']['size'] <= 1000000)
    {
        $fileInfo = pathinfo($_FILES['screenshot']['name']);
        $extension = $fileInfo['extension'];
        $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];

        if (in_array($extension, $allowedExtensions))
        {
            move_uploaded_file($_FILES['screenshot']['tmp_name'], 'uploads/' . basename($_FILES['screenshot']['name']));
            
            echo "<p class='send-img'>L'envoi a bien été effectué !</p>";
        }
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
    <title>memer - Page d'accueil</title>
</head>

<body>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono&display=swap" rel="stylesheet">

 <header>

<nav>

    <ul>
    <h1 class="titre">memer</h1>
        <li><a aria-current="page" href="index.php">Home</a></li>
        
        <li class="droll">
            
                <a>Compte</a>
   
            <ul class="undroll">
        <li><a aria-current='page' href='profil.php'>Profil</a></li>

    <?php if (isset($_SESSION['admin']))
          {
            echo "<li><a aria-current='page' href='admin.php'>Admin</a></li>";
          } ?>

		<li><a aria-current='page' href='deconnexion.php'>Deconnexion</a></li>
            </ul>
        </li> 
    </ul>
</nav>
</header> 

<main>

<video autoplay id="vid">
    <source src="img/hola.mp4" type="video/mp4">
</video>

	<div class="sucess">
	    <h1>Bienvenue <?php echo $recup[0][1]; ?></h1>
	</div>

    <form class="box" action="" method="POST" enctype="multipart/form-data">

            <label for="sreenshot" class="form-label">Soumettez une image</label>
            <input type="file" class="form-control" id="screenshot" name="screenshot"/>
            <div class="form-text">Formats jpg/jpeg/gif/png acceptés, max 100 Mo.</div>
            </div>

            <button type="submit" class="box-button">Envoyer</button>
    </form>
</div>

<p class="intro"><b>
    Partage de memes et photos, tu peux soumettre tes memes preférés ci-dessus !</br>
    Ils seront vus par nos admins et peut-être publiés sur notre compte <a href="https://twitter.com/?lang=fr">Twitter</a>
</b></p>

</main>

<footer>

<div id="link">© 2021 Copyright:
    <a href="https://github.com/anna-hayoun/module-connexion">github.com/anna-hayoun</a>
</div>

<a href="https://twitter.com/?lang=fr"><p><img src="img/twitt.png" alt="Twitter" class="twi"></p></a>

</footer>

</body>
</html>
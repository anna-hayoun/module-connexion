<?php

session_start();

require('sqlconfig.php');

$req = "SELECT * FROM utilisateurs";
$query = mysqli_query($conn, $req);
$result = mysqli_fetch_all($query, MYSQLI_ASSOC);


if (isset($_POST['login'], $_POST['prenom'], $_POST['nom'], $_POST['password'], $_POST['role']))
{
// récupérer nom d'utilisateur 
    $login = $_POST['login'];

// récupérer prenom 
    $prenom = $_POST['prenom'];

// récupérer le nom
    $nom = $_POST['nom'];

// récupérer mot de passe 
    $password = $_POST['password'];
  
// récupérer le role (admin ou user)
    $role = $_POST['role'];

    $res = mysqli_query($conn, "INSERT INTO `utilisateurs` (login, prenom, nom, password, role) 
    VALUES ('$login', '$prenom', '$nom', '$password', 'user')");


    if ($res)
    {
       echo "<div class='sucess'>
             <h3>L'utilisateur a été créée avec succés.</h3>
            </div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/index.css"  rel="stylesheet" nom="text/css"/>
    <title>Admin</title>
</head>
<body>

<header>
<nav>
    <ul>
    <h1 class="titre">memer</h1>

        <li><a aria-current="page" href="index.php">Home</a></li>

        <li class="droll">
            <a>Compte</a>
        
            <ul class="undroll">
        <li><a aria-current='page' href='profil.php'>Profil</a></li>
        <li><a aria-current='page' href='admin.php'>Admin</a></li>
		<li><a aria-current='page' href='deconnexion.php'>Deconnexion</a></li>
            </ul>
        </li>
    </ul>
</nav>
</header>

<main>

<form class="box" action="" method="post">
    
    <h1 class="box-title">Ajouter des utilisateurs</h1>
      
    <input type="text" class="box-input" name="login" placeholder="Nom d'utilisateur" required />
  
    <input type="text" class="box-input" name="prenom" placeholder="prenom" required />

    <input type="text" class="box-input" name="nom" placeholder="nom" required />

    <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
  
  <div>
      <select class="box-input" name="role" id="nom" >
        <option value="" disabled selected>Role</option>
        <option value="admin">Admin</option>
        <option value="user">User</option>
      </select>
  </div>
  
    <input type ="submit" name="submit" value="+ Ajouter" class="box-button" />
</form>

<div class="tab">
<h1>Données utilisateurs</h1>

    <table>
<thead>
    <tr>
        <th scope="col">Login</th>
        <th scope="col">Prenom</th>
        <th scope="col">Nom</th>
        <th scope="col">Password</th>
        <th scope="col">Role</th>
    </tr>
</thead>
<tbody>
    <?php foreach ($result as $st): ?>
        <tr>
            <td> <?= $st['id']; ?> </td>
            <td> <?= $st['login']; ?> </td>
            <td> <?= $st['prenom']; ?> </td>
            <td> <?= $st['nom']; ?> </td>
            <td> <?= $st['password']; ?> </td>
            <td> <?= $st['role']; ?> </td>
            <td> <?php echo '<a href="delete.php?id='.$st['id'] . '">  delete</a>';?></td>
        </tr>
    <?php endforeach; ?>
</tbody>
  </tbody>
</table>
</div>
</main>

<footer>

<div id="link">© 2021 Copyright:
    <a href="https://github.com/anna-hayoun/module-connexion">github.com/anna-hayoun</a>
</div>

<a href="https://twitter.com/?lang=fr"><p><img src="img/twitt.png" alt="Twitter" class="twi"></p></a>

</footer>
</body>
</html>
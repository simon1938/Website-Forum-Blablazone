<!DOCTYPE html>
<html>
<head>
	<title>Profil utilisateur</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="Styles\styles.css">
	</head>
<body>
<?php

include('accesbdd.php');
// appel de la fonction connect_db()
$bdd = connect_db();

// Récupération de l'id de l'utilisateur connecté
session_start();
$id_utilisateur = (int)$_SESSION['id'];


// Requête SQL pour récupérer les informations de l'utilisateur
$sql = "SELECT * FROM utilisateur WHERE id_utilisateur = '$id_utilisateur'";
$result = $bdd->query($sql);
$row = $result->fetch_assoc();

$NomUilisateur=$row['nom_utilisateur'];
$Photo=$row['photo'];
$Age=$row['age'];

// Affichage des informations de l'utilisateur
echo '<h1>Profil de '.$NomUilisateur.'<h1>';

echo '<img src="' .$Photo. '" alt="photo de profil">';

// Requête SQL pour récupérer les dix derniers posts de l'utilisateur
$sql = "SELECT * FROM post WHERE id_utilisateur = $id_utilisateur ORDER BY date_de_creation DESC LIMIT 10 ";
$result = $bdd->query($sql);

// Affichage des derniers posts de l'utilisateur
if ($result->num_rows > 0) {
    echo '<h2>Derniers posts</h2><hr>';	
    while ($row = $result->fetch_assoc()) {
        echo '<p>-- '.$row['contenu'].' --</p><hr>';		
    }
} else {
    echo '<p>Pas de post pour le moment.</p>';
}

// Fermeture de la connexion
$bdd->close();
?>
	<div>		
		<p>Âge : <?php echo $Age; ?> ans</p>
		<p><a href="fils.php">Acceder à son fil</a></p>		
        <p><a href="ajouterpost.php">Ajouter un poste</a></p>
		<p><a href="modifierleprofil.php">Modifier le profil</a></p>
       
	</div>
	
	
</body>
</html>

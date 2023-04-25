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
echo '<p>Âge : <?php $Age ?> ans</p>';

echo '<img src="' .$Photo. '" alt="photo de profil">';?>
<div class ="lien">
        <p><a href="ajouteramis.php">Ajouter des amis</a></p>
		<p><a href="voirlisteamis.php">Voir la liste d'amis</a></p>
        <p><a href="fils.php">Voir votre fil d'actualité</a></p>             
        <p><a href="index.php">Se deconnecter</a></p> 
    </div>
<?php

// Requête SQL pour récupérer les dix derniers posts de l'utilisateur
$sql = "SELECT * FROM post WHERE id_utilisateur = $id_utilisateur ORDER BY date_de_creation DESC LIMIT 10 ";
$result = $bdd->query($sql);

// Affichage des derniers posts de l'utilisateur
if ($result->num_rows > 0) {
    echo '<h2>Derniers posts</h2><hr>';
    while ($row = $result->fetch_assoc()) {
		//script dans le php car je sais pas pourquoi j'arrivais pas à le faire fonctionner sur un fichier à part
		echo '<script>';
		echo 'function supprimer(id_post) {';
		echo '    window.location.href = "supprimer.php?id_post=" + id_post;';
		echo '}';
		echo 'function modifier(id_post) {';
		echo '    window.location.href = "modifier.php?id_post=" + id_post;';
		echo '}';
		echo '</script>';
		
		echo '<div class="post_fil">';
		echo '<p>-- '.$row['contenu'].' --</p>';
		echo '<div class="buttons">';
		echo '<button onclick="supprimer(' . $row['id_post'] . ')">Supprimer</button>';
		echo '<button onclick="modifier(' . $row['id_post'] . ')">Modifier</button>';
		echo '</div>';
		echo '</div><hr>';
		
    }
} else {
    echo '<p>Pas de post pour le moment.</p>';
}

// Fermeture de la connexion
$bdd->close();
?>
    

	
</body>
</html>

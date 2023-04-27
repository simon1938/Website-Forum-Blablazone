<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="Styles\styles.css">
    <title>Profil de <?php $_POST['nomutilisateur'] ?></title>
</head>
<body>
    
</body>
</html>
<?php 
include('accesbdd.php');
// connection bdd
$bdd = connect_db();
// Récupération de l'id de l'utilisateur connecté
session_start();
$id_utilisateur = (int)$_SESSION['id'];
$nomamis=$_POST['nomutilisateur'];

// Requête pour récupérer les informations de l'utilisateur
$sql = "SELECT id_utilisateur FROM utilisateur WHERE nom_utilisateur='$nomamis'";
$result = $bdd->query($sql);
if(isset($result)&&$result->num_rows===1){
    $row = $result->fetch_assoc();
    $id_ami=$row['id_utilisateur'];

    //verifie que l'utilisateur ne s'ajoute pas lui meme
    if($id_ami!=$id_utilisateur){
        // Requête SQL pour récupérer les informations de l'utilisateur
$sql = "SELECT * FROM utilisateur WHERE id_utilisateur = '$id_ami'";
$result = $bdd->query($sql);
$row = $result->fetch_assoc();

$NomUilisateur=$row['nom_utilisateur'];
$Photo=$row['photo'];
$Age=$row['age'];

// Affichage des informations de l'utilisateur
echo '<h1>Profil de '.$NomUilisateur.'<h1>';
echo '<p>Âge : ' . $Age . ' ans</p>';

echo '<img src="' .$Photo. '" alt="photo de profil">';?>

<?php

// Requête pour récupérer les 15 dernier post de l'utilisateur
$sql = "SELECT * FROM post WHERE id_utilisateur = $id_ami ORDER BY date_de_creation DESC LIMIT 15 ";
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
		echo '</div>';
		echo '</div><hr>';
		
    }
} else {
    echo '<p>Pas de post pour le moment.</p>';
}

// Fermeture de la connexion
$bdd->close();
    }
    else
    {
        echo '<h1>Erreur, vous ne pouvez pas vous voir vous meme</h1>';
    }

}
else
{
    echo '<h1>Erreur, utilisateur introuvable</h1>';
}
    
?><div class ="lien">
        
<p><a href="voirprofil_amis.php">Voir le profil d'un autre utilisateur</a></p>
<p><a href="modifierleprofil.php">Retourner sur votre profil</a></p>                    
<p><a href="index.php">Se deconnecter</a></p> 
</div>
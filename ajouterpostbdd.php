<?php
// On inclut la fonction de connexion à la base de données
include("accesbdd.php");

session_start();
$id=$_SESSION['id'];

// On vérifie si le formulaire a été soumis
if($_SERVER["REQUEST_METHOD"] == "POST") {
	// On récupère le contenu du post
	$contenu = $_POST["contenu"];

	// On crée une instance de la base de données
	$bdd = connect_db();

	// On prépare la requête SQL pour insérer le post dans la table "post"
    echo $id;
	$sql = "INSERT INTO post (contenu, date_de_creation, id_utilisateur) VALUES ('$contenu', NOW(), $id)";

	// On exécute la requête SQL
	if ($bdd->query($sql) === TRUE) {
		echo '<script>alert("Le post a été ajouté avec succès !"); window.location.href = "profil.php";</script>';
	} else {
		echo "Erreur lors de l'ajout du post : " . $bdd->error;
	}
	

	// On ferme la connexion à la base de données
	$bdd->close();
}
?>
	<div>	
				<p><a href="profil.php">Revenir au Profil</a></p>
				<p><a href="fils.php">Retourner au fil d'actualité</a></p>
				<p><a href="index.php">Se deconnecter</a></p>       
				
	</div>

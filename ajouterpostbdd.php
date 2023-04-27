<?php
// connection à la bdd
include("accesbdd.php");

session_start();
$id=$_SESSION['id'];

// Verifie si le formulaire a été soumis
if($_SERVER["REQUEST_METHOD"] == "POST") {
	// On récupère le contenu du post
	$contenu = $_POST["contenu"];	

	// connection à la base de donnée (instance de celle ci)
	$bdd = connect_db();
	$contenu = $_POST["contenu"];
	$contenu = mysqli_real_escape_string($bdd, $contenu);
	// SQL pour insérer le post dans la table "post"
	$sql = "INSERT INTO post (contenu, date_de_creation, id_utilisateur) VALUES ('$contenu', NOW(), $id)";

	//  exécute la requête 
	if ($bdd->query($sql) === TRUE) {
		echo '<script>alert("Le post a été ajouté avec succès !"); window.location.href = "profil.php";</script>';
	} else {
		echo "Erreur lors de l'ajout du post : " . $bdd->error;
	}
	

	// fermer bdd
	$bdd->close();
}
?>
	<div>	
				<p><a href="profil.php">Revenir au Profil</a></p>
				<p><a href="fils.php">Retourner au fil d'actualité</a></p>
				<p><a href="index.php">Se deconnecter</a></p>       
				
	</div>

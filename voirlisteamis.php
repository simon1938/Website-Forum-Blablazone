<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">	
	<link rel="stylesheet" href="Styles\style_fils.css">	
	<title>Ma liste d'amis</title>
</head>
<body>
	<h1>Ma liste d'amis</h1>

	<?php
		require_once('accesbdd.php');

		// Récupération de l'id de l'utilisateur connecté
		session_start();
		$id_utilisateur = $_SESSION['id'];

		// Requête SQL pour récupérer la liste d'amis de l'utilisateur
		$sql = "SELECT *
		FROM amis 
		INNER JOIN utilisateur ON (amis.id_ami = utilisateur.id_utilisateur OR amis.id_utilisateur = utilisateur.id_utilisateur) 
		WHERE (amis.id_utilisateur = '$id_utilisateur' OR amis.id_ami = '$id_utilisateur') 
		AND utilisateur.id_utilisateur != '$id_utilisateur'		
		";
		$bdd = connect_db();
		$result = $bdd->query($sql);
		echo "<p>Nombre d'amis : ".$result->num_rows."<br><p>";

		// Affichage des résultats
		if ($result && $result->num_rows > 0) {
			echo "<ul>";
			while ($row = $result->fetch_assoc()) {
				echo "<li>";
				echo "<img src='".$row['photo']."' alt='Photo de profil de ".$row['nom_utilisateur']."' style='width: 3%;'>";
				echo "<p>".$row['nom_utilisateur']."</p>";
				echo "</li>";
			}
			echo "</ul>";
		} else {
			echo "Vous n'avez pas encore d'amis";
		}

		// Fermeture de la connexion
		$bdd->close();

	?>
<div>	
				
				<p><a href="index.php">Retourner à l'acceuil</a></p>       
				
				</div>	

</body>
</html>

<!DOCTYPE html>
<html>
<head>
	<title>Modifier le profil</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<?php
	
		// Connexion à la base de données
		include('accesbdd.php');
		$bdd = connect_db();

		// Récupération des informations de l'utilisateur
        session_start();
		$id_utilisateur = (int)$_SESSION['id'];
		$sql = "SELECT * FROM utilisateur WHERE id_utilisateur = '$id_utilisateur'";
		$result = $bdd->query($sql);
		$row = $result->fetch_assoc();

        $age= $_POST['age'];
        $motdepasse=$_POST['motdepasse'];
        $pseudo=$_POST['pseudo'];
        $photo=$_POST['photo'];
		// Traitement du formulaire
		if(!empty($age)){          
            
				$sql = "UPDATE utilisateur SET age = '$age' WHERE id_utilisateur = '$id_utilisateur'";
				$bdd->query($sql);
				echo '<p>L\'âge a été mis à jour.</p>';
        }
       if(!empty($motdepasse)){

				$sql = "UPDATE utilisateur SET mot_de_passe = '$motdepasse' WHERE id_utilisateur = '$id_utilisateur'";
				$bdd->query($sql);
				echo '<p>L\'motdepasse a été mis à jour.</p>';
        }
        if(!empty($pseudo)){

				$sql = "UPDATE utilisateur SET nom_utilisateur = '$pseudo' WHERE id_utilisateur = '$id_utilisateur'";
				$bdd->query($sql);
				echo '<p>L\'pseudo a été mis à jour.</p>';
        }
        if(!empty($photo)){

				$sql = "UPDATE utilisateur SET photo = '$photo' WHERE id_utilisateur = '$id_utilisateur'";
				$bdd->query($sql);
				echo '<p>L\'photo a été mis à jour.</p>';
        }
?>

				<div>	
				<p><a href="profil.php">Revenir au Profil</a></p>
				<p><a href="fils.php">Retourner au fil d'actualité</a></p>
				<p><a href="index.php">Se deconnecter</a></p>       
				
				</div>				
			

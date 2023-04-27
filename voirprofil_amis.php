<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="Styles\styles.css">
  <title>Voir profil de vous amis</title>
</head>
<body>
  <h1>Ecrivez le pseudo de l'utilisateur dont vous voulez consulter le profil !</h1>
  <form action="voirprofil_amis_bdd.php" method="POST" >
    <label for="nomutilisateur">Nom d'utilisateur:</label>
    <input type="nomutilisateur" id="nom" name="nomutilisateur" required><br>    
	<input type="submit" value="Valider">	
  </form>
</body>

<div>	
				<p><a href="profil.php">Revenir au Profil</a></p>
				<p><a href="fils.php">Retourner au fil d'actualité</a></p>
				<p><a href="index.php">Se deconnecter</a></p>       
				
				</div>	
</html>

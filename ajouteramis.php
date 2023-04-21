<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="Styles\styles.css">
  <title>Ajouter des amis</title>
</head>
<body>
  <h1>Veuillez nous aider à trouver votre amis !</h1>
  <form action="ajouteramisbdd.php" method="POST">
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

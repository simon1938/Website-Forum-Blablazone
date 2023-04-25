<!DOCTYPE html>
<html>
<head>
	<title>Modifier le profil</title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="Styles\styles.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<h1>Modifier le profil</h1>
	<h2>Veuillez remplir uniquement les champs que vous voulez modifier !</h2>
	<form action="modifierleprofilbdd.php" method="post">
		<label for="photo">Photo :</label>
		<input type="photo" id="photo" name="photo"><br>

		<label for="pseudo">Pseudo :</label>
		<input type="text" id="pseudo" name="pseudo"><br>

		<label for="motdepasse">Mot de passe :</label>
		<input type="text" id="motdepasse" name="motdepasse"><br>

		<label for="age">Âge :</label>
		<input type="number" id="age" name="age" min="18"><br>

		<input type="submit" value="Modifier le profil">		
	</form>
	
	<div>	
				<p><a href="profil.php">Revenir au Profil</a></p>
				<p><a href="fils.php">Retourner au fil d'actualité</a></p>
				<p><a href="index.php">Se deconnecter</a></p>       
				
				</div>	
</body>
</html>
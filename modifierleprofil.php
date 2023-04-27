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
		<form action="modifierleprofilbdd.php" method="post" enctype="multipart/form-data">
		<label for="pseudo">Pseudo :</label>
		<input type="text" id="pseudo" name="pseudo" ><br>

		<label for="motdepasse">Mot de passe :</label>
		<input type="password" id="motdepasse" name="motdepasse" ><br>

		<label for="motdepasse2">retaper votre mot de passe :</label>
		<input type="password" id="motdepasse2" name="motdepasse2"><br>

		<label for="age">Âge :</label>
		<input type="number" id="age" name="age" min="18" ><br>

		<label for="photo">Photo (facultatif) :</label>
		<input type="file" id="file" name="file"><br>

		<input type="submit" value="Créer mon compte">		
		</form>
		</div>

				<p><a href="profil.php">Revenir au Profil</a></p>
				<p><a href="fils.php">Retourner au fil d'actualité</a></p>
				<p><a href="index.php">Se deconnecter</a></p>       
				
				</div>	
</body>
</html>
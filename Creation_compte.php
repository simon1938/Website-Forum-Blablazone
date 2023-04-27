<!DOCTYPE html>
<html>
<head>
	<title>Création de compte</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="Styles\styles.css">
</head>
<body>
	<h1>Création de compte</h1>
	<div>
	<form action="Creation_compte_bdd.php" method="post" enctype="multipart/form-data">



	<label for="email">Adresse e-mail :</label>
	<input type="email" id="email" name="email" required><br>

	<label for="pseudo">Pseudo :</label>
	<input type="text" id="pseudo" name="pseudo" required><br>

	<label for="motdepasse">Mot de passe :</label>
	<input type="password" id="motdepasse" name="motdepasse" required><br>

	<label for="motdepasse2">retaper votre mot de passe :</label>
	<input type="password" id="motdepasse2" name="motdepasse2" required><br>

	<label for="age">Âge :</label>
	<input type="number" id="age" name="age" min="18" max ="120" required><br>

	<label for="photo">Photo (facultatif) :</label>
	<input type="file" id="file" name="file"><br>

	<input type="submit" value="Créer mon compte">		
</form>
</div>

</body>
</html>
<!DOCTYPE html>
<html>
<head>
	<title>Création de compte</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<h1>Création de compte</h1>
	<form action="Creation_compte_bdd.php" method="post">
		<label for="email">Adresse e-mail :</label>
		<input type="email" id="email" name="email" required><br>

		<label for="pseudo">Pseudo :</label>
		<input type="text" id="pseudo" name="pseudo" required><br>

		<label for="motdepasse">Mot de passe :</label>
		<input type="text" id="motdepasse" name="motdepasse" required><br>

		<label for="age">Âge :</label>
		<input type="number" id="age" name="age" min="18" required><br>

		<input type="submit" value="Créer mon compte">		
	</form>
</body>
</html>
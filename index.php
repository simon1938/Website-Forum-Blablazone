<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"> 
    <title>Blablazone</title>
	<link rel="stylesheet" href="Styles\styles.css">
</head>
<body>
	<h1>Création ou connexion à un compte</h1>	
	<form action="connection_bdd.php" method="post">

		<label for="email">Adresse e-mail :</label>
		<input type="email" id="email" name="email" required><br>

		<label for="motdepasse">Mot de passe :</label>
		<input type="text" id="motdepasse" name="motdepasse" required><br>	
		
		<input type="submit" value="Se connecter">	
		<p><input type="button" value="Créer un compte" onclick="rediriger_creationC()"></p>
	</form>
	
        <script src="js/fonctions.js"></script>             

	</form>	
</body>
</html>

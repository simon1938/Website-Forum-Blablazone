<!DOCTYPE html>
<html>
<head>
	<title>Ajouter un post</title>
	<link rel="stylesheet" href="Styles\styles.css">
</head>
<body>
	<h1>Ajouter un post</h1>

	<form method="POST" action="ajouterpostbdd.php">
		<label for="contenu">Contenu du post :</label><br>
		<textarea id="contenu" name="contenu"></textarea><br>
		<input type="submit" value="Ajouter le post">             
	</form>

	
	<div>	
				<p><a href="profil.php">Revenir au Profil</a></p>
				<p><a href="fils.php">Retourner au fil d'actualité</a></p>
				<p><a href="index.php">Se deconnecter</a></p>       
				
	</div>	
</body>
</html>

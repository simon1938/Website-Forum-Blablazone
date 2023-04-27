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
	<?php
	
	$testmotdepasse=true;

	// vérifie si le champ file à été rempli
	if(isset($_FILES['file'])){

		// Récupération du chemin temporaire de l'image
		$tmpName = $_FILES['file']['tmp_name'];
		// Récupération du nom de l'image
		$name = $_FILES['file']['name'];
		//si le fichier à bien été upload
		if(is_uploaded_file($tmpName)){
			
			$newName = "Pictures/".$name;
			// Uploader l'image dans le dossier picture du projet
			move_uploaded_file($tmpName, $newName);
			$photo=$newName;
	}else{
		//sinon photo de profil de base par défault
		$photo="Pictures/account_picture.png";
	}
}
else
{
	//sinon photo de profil de base par défault
	$photo="Pictures/account_picture.png";	

}
  
// Vérifier si les mot de passe correspondent
if($_POST['motdepasse']!=$_POST['motdepasse2']){
	$testmotdepasse=false;
}
// Vérifier si les champs sont remplis
if (isset($_POST['email'], $_POST['pseudo'],$_POST['motdepasse'], $_POST['age'])&&$testmotdepasse) {
	
	include('accesbdd.php');
	// appel bdd
	$bdd = connect_db();
	
	// récupérer les données du formulaire
	$email = $_POST['email'];
	$pseudo = $_POST['pseudo'];
	$age = $_POST['age'];
	$motdepasse=md5($_POST['motdepasse']);
	
	// Vérifier si l'email n'existe pas déjà dans la base de données

	$sql_check_email = "SELECT email FROM utilisateur WHERE email = '$email'";
	$result_check_email = $bdd->query($sql_check_email);
	$email_erreur=false;
	if ($result_check_email->num_rows > 0) {
		$email_erreur=TRUE;
	}

									

	// construire la requête SQL pour rentrer les infos dans la bdd
	$sql = "INSERT INTO utilisateur (email,photo, nom_utilisateur,mot_de_passe, age) VALUES ('$email','$photo', '$pseudo','$motdepasse', '$age')";

	// exécuter la requête SQL
	if($email_erreur==false){

		if ($bdd->query($sql) === TRUE) {

			echo "Compte créé avec succès bravo !";
			$verif = "Vous avez bien créer un compte bienvenu chez nous ".$_POST['pseudo'];    
			
			//Afficher le message d'erreur dans un pop-up puis rediriger vers page d'acceuil
			echo "<script>
								alert('" . $verif . "');
								window.location.href='index.php';
    			</script>";
		} 
}else {
	echo "Erreur: un compte existe déjà sur cette adress mail veuillez directement vous connecter " ;
}

	// fermer la connexion
	$bdd->close();
}else
{
  echo "<strong>erreur les deux mot de passe doivent être identiques<strong>";
}
?>
	
</body>
</html>

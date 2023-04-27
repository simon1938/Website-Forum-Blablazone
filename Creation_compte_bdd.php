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
	error_reporting(E_ALL); ini_set('display_errors', 1);
	$testmotdepasse=true;


	// Si le champs de l'image a été remplie (nouveau post ou modification de l'image d'un post existant)
	if(isset($_FILES['file'])){

		// Récupération du chemin temporaire de l'image
		$tmpName = $_FILES['file']['tmp_name'];
		// Récupération du nom de l'image
		$name = $_FILES['file']['name'];

		if(is_uploaded_file($tmpName)){
			
			$newName = "Pictures/".$name;
			// Uploader l'image dans le dossier prévu
			move_uploaded_file($tmpName, $newName);
			$photo=$newName;
	}else{
		echo'azdazd';
		$photo="Pictures/account_picture.png";
	}
}
else
{
	echo'azdazd';
	$photo="Pictures/account_picture.png";	

}
  
 
echo $_POST['motdepasse'].$_POST['motdepasse2'].$_POST['email'].$_POST['pseudo'].$_POST['age'];

// Vérifier si le formulaire a été soumis
if($_POST['motdepasse']!=$_POST['motdepasse2']){
	$testmotdepasse=false;
}
if (isset($_POST['email'], $_POST['pseudo'],$_POST['motdepasse'], $_POST['age'])&&$testmotdepasse) {
	
	include('accesbdd.php');
	// appel de la fonction connect_db()
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

									

	// construire la requête SQL
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

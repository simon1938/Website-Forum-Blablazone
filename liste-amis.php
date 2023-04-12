<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>

</head>
<body>
	<h1>azdazd</h1>

<?php
	require_once('accesbdd.php');

// Récupération de l'id de l'utilisateur connecté
session_start();
$id_utilisateur = $_SESSION['id'];
$bdd = connect_db();
echo"===== utilisateur numero".$id_utilisateur."========";

// Requête SQL pour récupérer la liste d'amis de l'utilisateur
//$sql = "SELECT * FROM amis INNER JOIN utilisateur ON amis.id_ami = utilisateur.id_utilisateur WHERE amis.id_utilisateur = '$id_utilisateur'";
$sql = "SELECT * FROM amis WHERE id_utilisateur = '$id_utilisateur'OR id_ami = '$id_utilisateur'";
$result = $bdd->query($sql);
echo "Nombre de résultats : ".$result->num_rows."<br>";

// Affichage des résultats
if ($result && $result->num_rows > 0) {
    echo "<h2>Liste d'amis:</h2>";
	echo "<ul>";
    while ($row = $result->fetch_assoc()) {		
		echo "<li>";
		echo "<img src='".$row['photo']."' alt='Photo de profil de ".$row['nom_utilisateur']."' style='width: 3%;'>";
		echo "<p>".$row['nom_utilisateur']."</p>";
		echo "</li>";
		if($row['id_ami']==$id_utilisateur){		
        echo "<p>".$row['nom_utilisateur']."</p>";
		}
		else
		{
			echo "<p>".$row['id_ami']."</p>";
		}
		}
	
    
}
else
{
    echo "Vous n'avez pas encore d'amis";
}

// Fermeture de la connexion
$bdd->close();

?>
	
</body>
</html>
<?php


if($row['id_ami']==$id_utilisateur)
    {
     $id_amis[] = $row['id_utilisateur'];
    }
    else
    {
        $id_amis[] = $row['id_amis'];
    }
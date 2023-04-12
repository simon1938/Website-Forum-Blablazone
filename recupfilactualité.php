<?php
// inclure le fichier d'accès à la base de données
require_once('accesbdd.php');

// Récupération de l'id de l'utilisateur connecté
session_start();
$id_utilisateur = $_SESSION['id'];

// Requête SQL pour récupérer la liste d'amis de l'utilisateur
$bdd = connect_db();

$sql = "SELECT * FROM amis WHERE id_utilisateur = '$id_utilisateur'";
$result = $bdd->query($sql);

// Création d'un tableau pour stocker les id des amis
$id_amis = array();

// Parcourir les résultats de la requête pour récupérer les id des amis
while ($row = $result->fetch_assoc()) {
    $id_amis[] = $row['id_ami'];
}

// Requête SQL pour récupérer les posts des amis de l'utilisateur
$sql2 = "SELECT * FROM post WHERE id_utilisateur IN (" . implode(",", $id_amis) . ")";
$result2 = $bdd->query($sql2);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Fils Twitter</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <h1>Fils Twitter</h1>
    <div>
        <p><a href="ajouteramis.php">Ajouter des amis</a></p>
        <p><a href="voirlisteamis.php">Voir la liste d'amis</a></p>


        <?php
		// Requête SQL pour récupérer les informations des amis de l'utilisateur pour chaque posts	
		if($result->num_rows){	
		 while ($row = $result2->fetch_assoc()) { ?>
			<?php
				$sql_amis = "SELECT * FROM utilisateur WHERE id_utilisateur={$row['id_utilisateur']}";
				$result_amis = $bdd->query($sql_amis);
				$row_amis=$result_amis->fetch_assoc();
				?>
            <div>
				

				<p><?php echo $row_amis['nom_utilisateur']; ?></p>
				<p><?php echo $row_amis['id_utilisateur']; ?></p>
				<img src="<?php echo $row_amis['photo']; ?>" alt="Photo de profil" style="width: 3%;">	
                <p><?php echo $row['contenu']; ?></p>
				<p><?php echo $row['date_de_creation']; ?></p>
		 
                <p><a href="commentaire.php">Laisser un commentaire</a></p>

            </div>
        <?php }
		}
		else
		{
			?>
			<p><?php echo "Vous n'avez pas encore d'amis"; ?></p>
			<p><?php echo "ajouter des amis pour pouvoir construire votre propre fils d'actualité !";?></p>
			<?php } ?>
    </div>
	<div>    
    <p><a href="profil.php">Revenir au Profil</a></p>
    <p><a href="fils.php">Retourner au fil d'actualité</a></p>
    <p><a href="index.php">Se deconnecter</a></p>       
</div> 
</body>
</html>
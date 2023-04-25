<?php
// inclure le fichier d'accès à la base de données
require_once('accesbdd.php');

// Récupération de l'id de l'utilisateur connecté
session_start();
//$id_utilisateur = $_SESSION['id'];
$id_utilisateur=$_SESSION['id'];
echo"===== utilisateur numero".$id_utilisateur."========";



//affiche popup d'alerte pour verifier si l'utilisateur à pas deja liker le post 
if(isset($_GET['erreur'])){
$message_erreur = urldecode($_GET['erreur']);
// Afficher le message d'erreur dans un pop-up
echo "<script>alert('" . $message_erreur . "')</script>";
}
    



// Requête SQL pour récupérer la liste d'amis de l'utilisateur
$bdd = connect_db();

$sql = "SELECT * FROM amis WHERE id_utilisateur = '$id_utilisateur'OR id_ami = '$id_utilisateur'";
$result = $bdd->query($sql);
if($result->num_rows==0){
	echo "Vous n'avez pas d'amis";
	$test=false;
}else{
	$test=true;
    
}

// Création d'un tableau pour stocker les id des amis
$id_amis = array();
//debugecho "Nombre de résultats : ".$result->num_rows."<br>";
// Parcourir les résultats de la requête pour récupérer les id des amis
while ($row = $result->fetch_assoc()) {
    if($row['id_ami']==$id_utilisateur)
    {
     $id_amis[] = $row['id_utilisateur'];
    }
    else
    {
        $id_amis[] = $row['id_ami'];
    }
}

//debug
// print_r($id_amis);
// //print("=")
// print_r(implode(",", $id_amis));
// //print("=");

// Requête SQL pour récupérer les posts des amis de l'utilisateur
if($test)
{
 $sql2 = "SELECT * FROM post WHERE id_utilisateur IN (" . implode(",", $id_amis) . ") ORDER BY date_de_creation DESC";

$result2 = $bdd->query($sql2);
echo"test est vrai";
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fils Twitter</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles\style_fils.css">
</head>
<body>
    <h1>Fils Twitter</h1>
    <div class ="lien">
         <p><a href="ajouterpost.php">Ajouter un poste</a></p>
        <p><a href="ajouteramis.php">Ajouter des amis</a></p>
        <p><a href="voirlisteamis.php">Voir la liste d'amis</a></p>
        <p><a href="profil.php">Revenir au Profil</a></p>
        <p class="scroll"><a href="fils.php">Remonter le fil d'actualité</a></p>
        <p><a href="index.php">Se deconnecter</a></p> 
    </div>
        <?php
        // Requête SQL pour récupérer les informations des amis de l'utilisateur pour chaque post
        if($test&&$result2->num_rows){    
            while ($row = $result2->fetch_assoc()) { ?>
                <?php
                $sql_amis = "SELECT * FROM utilisateur WHERE id_utilisateur={$row['id_utilisateur']}";
                $result_amis = $bdd->query($sql_amis);
                $row_amis=$result_amis->fetch_assoc();

 
                // Requête SQL pour récupérer le nombre de likes du post            
                $id_post = $row['id_post'];
                // Requête SQL pour récupérer le nombre de likes du post
                $sql = "SELECT COUNT(*) as nb_likes FROM `post_like` WHERE post_id = $id_post";
                $result = $bdd->query($sql);
                $row_like = $result->fetch_assoc();
                $nb_likes = $row_like['nb_likes'];
                ?>            

                <div class="post-container">
                <img src="<?php echo $row_amis['photo']; ?>" alt="Photo de profil">
                
                    
                    <ul class="post-info">
                        <p>Info :<p>
                        <li>Post de : <?php echo $row_amis['nom_utilisateur']; ?></li>
                        <li><?php echo $row['date_de_creation']; ?></li>
                        <li><?php echo $nb_likes; ?> likes</li>
                    </ul>                    

                    <div class="content">
                        <p>contenu :</p>
                    <p><?php echo $row['contenu']; ?></p>
                    </div>
                    
                    <div class="buttons-container">
                        <form method="post" action="ajouterlike.php">
                        <input type="hidden" name="id_post" value="<?php echo $row['id_post']; ?>">
                        <button type="submit">Like</button>
                        </form>

                        <form method="POST" action="commentaire.php">
                        <input type="hidden" name="id_post" value="<?php echo $row['id_post']; ?>">
                        <button type="submit" name="mon_bouton" value="<?php echo $row['id_post']; ?>">Voir les commentaire/Commenter</button>
                        <?php $_SESSION['nom_utilisateurpost']=$row_amis['nom_utilisateur'];                                            
                        ?>
                        </form>
                    </div>
                  

                </div>




        <?php }
        }
        else
        {
            ?>
            <p><?php echo "Vous n'avez pas encore d'amis"; ?></p>
            <p><?php echo "ajouter des amis pour pouvoir construire votre propre fils d'actualité !";?></p>
            <?php } ?>
    
  

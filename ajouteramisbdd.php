<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="Styles\styles.css">
    <title>Ajouter amis</title>
</head>
<body>
    
</body>
</html>
<?php
include('accesbdd.php');
// Connection base de donnée
$bdd = connect_db();
// Récupération de l'id de l'utilisateur connecté
session_start();
$id_utilisateur = (int)$_SESSION['id'];
$nomamis=$_POST['nomutilisateur'];

//Récupère les informations de l'amis à qui on souhaite voir le profil
$sql = "SELECT id_utilisateur FROM utilisateur WHERE nom_utilisateur='$nomamis'";
$result = $bdd->query($sql);
if(isset($result)&&$result->num_rows===1){
    $row = $result->fetch_assoc();
    $id_ami=$row['id_utilisateur'];

    //verifie que l'utilisateur ne s'ajoute pas lui même
    if($id_ami!=$id_utilisateur){
        // verification que deux amis ne s'ajoutent pas encore si il sont déjà amis 
        
        $sql = "SELECT id_amis FROM amis WHERE (id_utilisateur = $id_utilisateur AND id_ami = $id_ami) OR (id_utilisateur = $id_ami AND id_ami = $id_utilisateur)";
        $result = $bdd->query($sql);
    
        if($result->num_rows===0){
            
            echo '<h1>super</h1>';           

            //ajout de l'amis à notre utilisateur connecté
            $sql = "INSERT INTO amis (id_utilisateur, id_ami) VALUES ($id_utilisateur, $id_ami)";
            $result = $bdd->query($sql);
            
            if ($result === TRUE) {
                echo "L'ami a été ajouté avec succès";
            } else {
                echo "Une erreur s'est produite lors de l'ajout de l'ami : " . $bdd->error;
            }
        }
        else
        {
               echo'<h3>vous etes déja amis ! vous ne pouvez pas etre deux fois !</h3>';
        }
    }
    else
    {
        echo'<h1>Vous pouvez pas etre amis avez vous meme quand meme ! <h1>';
    }


    } else{
    echo'<h1>le nom d utilisateur que vous avez utilisé non reconu <h1>';
}

?>
                <!-- lien de navigation -->
                <div>	
				<p><a href="profil.php">Revenir au Profil</a></p>
				<p><a href="fils.php">Retourner au fil d'actualité</a></p>
				<p><a href="index.php">Se deconnecter</a></p>       
				
				</div>	

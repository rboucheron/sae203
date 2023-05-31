<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style/inscription.css">
</head>
<body>
<a href="login.php" class="back"><i class="fa fa-arrow-left"></i> Retour</a>
<?php     session_start(); ?>
<?php 
if (!isset($_POST['mail']) && !isset($_POST['nom']) && !isset($_POST['prenom']) && !isset($_POST['mp']) && !isset($_POST['datebirth'])){
    echo"<form action='registration.php' method='post'>";
    echo"<div class='formulaire'>";
    echo"<div class='champ'>";
    echo"<label for='email'>Adresse mail ou identifiant</label>";
    echo"<input type='email' name='mail' id='email'>";
    echo"</div>";
    echo"<div class='nom_prenom'>";
    echo"<div class='nom'>";
    echo"<label for='nom'>Nom</label>";
    echo"<input type='text' name='nom' id='nom'>";
    echo"</div>";
    echo"<div class='prenom'>";
    echo"<label for='prnom'>Prenom</label>";
    echo"<input type='text' name='prenom' id='prnom'>";
    echo"</div>";
    echo"</div>"; 
    echo"<div class='champ'>";
    echo"<label for='date'>Date de naissance</label>";
    echo"<input type='date' name='datebirth' id='date'>";
     echo"</div>";
    echo"<div class='champ'>";
    echo"<label for='mp'>Mot de Passe</label>";
    echo"<input type='password' name='mp' id='mp'>";
    echo"</div>";
    echo"<div class='champ'>";
    echo"<label for='cmp'>Confirmer Mot de Passe</label>";
    echo"<input type='password' name='cmp' id='cmp'>";
    echo"</div>";
    echo"</div>";
    echo"<input type='submit' value='S Inscrire' id='btn'>";
    echo"</form>";
}else{
    if ($_POST['mail'] == "" || $_POST['nom'] == "" || $_POST['prenom'] == "" || $_POST['mp'] == "" || $_POST['datebirth'] == ""){
       $a = $_POST['mail']; 
       $b = $_POST['nom']; 
       $c = $_POST['prenom']; 
       $d = $_POST['datebirth']; 
        echo"<form action='registration.php' method='post'>";
        echo"<div class='formulaire'>";
        echo"<div>";
        echo"<label for='email'>Adresse mail ou identifiant</label>";
        echo"<input type='email' name='mail' id='email' value='$a'>";
        echo"</div>";
        echo"<div class='nom_prenom'>";
        echo"<div class='nom'>";
        echo"<label for='nom'>Nom</label>";
        echo"<input type='text' name='nom' id='nom' value='$b'>";
        echo"</div>";
        echo"<div class='prenom'>";
        echo"<label for='prnom'>Prenom</label>";
        echo"<input type='text' name='prenom' id='prnom' value='$c'>";
        echo"</div>";
        echo"</div>";
   
        echo"<div class='champ'>";
        echo"<label for='date'>Date de naissance</label>";
        echo"<input type='date' name='datebirth' id='date' value='$d'>";
         echo"</div>";

        echo"<div class='champ'>";
        echo"<label for='mp'>Mot de Passe</label>";
        echo"<input type='password' name='mp' id='mp'>";
        echo"</div>";
        echo"<div class='champ'>";
        echo"<label for='cmp'>Confirmer Mot de Passe</label>";
        echo"<input type='password' name='cmp' id='cmp'>";
        echo"</div>";
        echo"</div>";
        echo"<input type='submit' value='S Inscrire' id='btn'>";
        echo"</form>";
        echo"<div class='erreur'>";
        echo"<p>Vous avez oublié de renseigner une information obligatoire.</p>";
        echo"</div>";
    }else{
    if ($_POST['mp'] == $_POST['cmp']){
        $kays = password_hash($_POST['mp'], PASSWORD_DEFAULT); 
        try
        {
	    $connect = new PDO('mysql:host=localhost;dbname=sae203;charset=utf8', 'root', 'root');
        }
        catch (Exception $e)
        {
        die('Erreur : ' . $e->getMessage());
        }
        $sqlQuery = 'INSERT INTO utilisateur(mail, nom, prenom, mp, statu, naissance) VALUES (:mail, :nom, :prenom, :mp, :statu, :naissance)';
        $insertuser = $connect->prepare($sqlQuery);
        $insertuser->execute([
        'mail' => $_POST['mail'],
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'mp' => $kays,
        'statu' => "user",
        'naissance' => $_POST['datebirth']
        ]);
        $_SESSION['mail'] = $_POST['mail']; 
        $_SESSION['nom'] = $_POST['nom']; 
        $_SESSION['prenom'] = $_POST['prenom']; 
        $_SESSION['statu'] = "user"; 
        header("Location: home.php");
    }else{
        $a = $_POST['mail']; 
       $b = $_POST['nom']; 
       $c = $_POST['prenom']; 
       $d = $_POST['datebirth']; 
        echo"<form action='registration.php' method='post'>";
        echo"<div class='formulaire'>";
        echo"<div>";
        echo"<label for='email'>Adresse mail ou identifiant</label>";
        echo"<input type='email' name='mail' id='email' value='$a'>";
        echo"</div>";
        echo"<div class='nom_prenom'>";
        echo"<div class='nom'>";
        echo"<label for='nom'>Nom</label>";
        echo"<input type='text' name='nom' id='nom' value='$b'>";
        echo"</div>";
        echo"<div class='prenom'>";
        echo"<label for='prnom'>Prenom</label>";
        echo"<input type='text' name='prenom' id='prnom' value='$c'>";
        echo"</div>";
        echo"</div>";
   
        echo"<div class='champ'>";
        echo"<label for='date'>Date de naissance</label>";
        echo"<input type='date' name='datebirth' id='date' value='$d'>";
         echo"</div>";

        echo"<div class='champ'>";
        echo"<label for='mp'>Mot de Passe</label>";
        echo"<input type='password' name='mp' id='mp'>";
        echo"</div>";
        echo"<div class='champ'>";
        echo"<label for='cmp'>Confirmer Mot de Passe</label>";
        echo"<input type='password' name='cmp' id='cmp'>";
        echo"</div>";
        echo"</div>";
        echo"<input type='submit' value='S Inscrire' id='btn'>";
        echo"</form>";
        echo"<div class='erreur'>";
        echo"<p>Vous avez entré deux mots de passe différents.</p>";
        echo"</div>";
    }
    }}
?>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection</title>
    <link rel="stylesheet" href="style/login.css">
</head>
<body>
<a href="home.php" class="back"><i class="fa fa-arrow-left"></i> Retour</a>

<?php     session_start(); ?>
<?php 
        if(!isset($_POST['mail'])&&!isset($_POST['password'])){
            echo"<form action='login.php' method='post'>";
            echo"<div class='formulaire'>";
            echo"<div>";
            echo"<label for='email'>Adresse mail ou identifiant</label>";
            echo"<input type='email' name='mail' id='email'>";
            echo"</div>";
            echo"<div>";
            echo"<label for='mp'>Mot de Passe</label>";
            echo"<input type='password' name='password' id='mp'>";
            echo"</div>";
    
            echo"<a href='registration.php'>S'Inscrire</a>";
            
            echo"</div>";
            echo"<input type='submit' value='Se Connecter' id='btn'>";
           
            echo"</form>";   
        }else{
                if ($_POST['mail'] == ""||$_POST['password'] == ""){
               
                 $p = $_POST['mail']; 
                 echo"<form action='login.php' method='post'>";
                 echo"<div class='formulaire'>";
                 echo"<div>";
                 echo"<label for='email'>Adresse mail ou identifiant</label>";
                 echo"<input type='email' name='mail' id='email' value='$p'>";
                 echo"</div>";
                 echo"<div>";
                 echo"<label for='mp'>Mot de Passe</label>";
                 echo"<input type='password' name='password' id='mp'>";
                 echo"</div>";
            
                 echo"<a href='registration.php'>S'Inscrire</a>";
                 
                 echo"</div>";
                 echo"<input type='submit' value='Se Connecter' id='btn'>";
                
                 echo"</form>";   
                 
                }else{

    try{
        $db = new PDO(
            'mysql:host=localhost;dbname=sae203;charset=utf8', 'root', 'root'
        );    
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e){
        die(print_r($e));
    }
    $results; 

  
    $getScoresSql = 'SELECT mail, nom, prenom, mp, statu FROM utilisateur WHERE mail=:email';
        $getScores = $db->prepare($getScoresSql);
        $sqlParams = [
            'email' => $_POST['mail']
        ];
    $getScores->execute($sqlParams) or die($db->errorInfo());
    $results = $getScores->fetchAll(PDO::FETCH_ASSOC);

    if ($results[0] && password_verify($_POST['password'], $results[0]['mp'])) {
        $_SESSION['mail'] = $results[0]['mail']; 
        $_SESSION['nom'] = $results[0]['nom']; 
        $_SESSION['prenom'] = $results[0]['prenom'];  
        $_SESSION['statu'] = $results[0] ['statu'];  
        header("Location: home.php");
       
    }else{
        
        $p = $_POST['mail']; 
        echo"<form action='login.php' method='post'>";
        echo"<div class='formulaire'>";
        echo"<div>";
        echo"<label for='email'>Adresse mail ou identifiant</label>";
        echo"<input type='email' name='mail' id='email' value='$p'>";
        echo"</div>";
        echo"<div>";
        echo"<label for='mp'>Mot de Passe</label>";
        echo"<input type='password' name='password' id='mp'>";
        echo"</div>";
     
        echo"<a href='registration.php'>S'Inscrire</a>";
        
        echo"</div>";
        echo"<input type='submit' value='Se Connecter' id='btn'>";
       
        echo"</form>";
        echo"<div class='erreur'>";
        echo"<p>Mot de passe où identifient incorrecte</p>";
        echo"</div>";
    }




                }
            }   
    ?>
</body>
</html>
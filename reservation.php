<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/tableaux.css">
</head>
<body>
<?php 
     session_start();  
     if (!isset($_SESSION['mail'])){
        include('include/disconnect.php'); 
    }else{
    
      
     echo"<header>";
     include('include/navbar.php');
         echo "<div class='all'>"; 
         echo "<div class='profil'>";
         echo "<div class='identiter'>";
         echo "<h3>" . $_SESSION['prenom'] . "&nbsp;" . $_SESSION['nom'] . "</h3>";
         if ($_SESSION['statu']=="admin"){
            echo "<h4>" . $_SESSION['statu'] . "</h4>";
        }else{
            echo "<h4>" . $_SESSION['mail'] . "</h4>";
        }
         echo "</div>";
         echo "<div class='image'>";
         echo "<img src='ressource/profil.svg'>";
         echo "</div>";
         echo "</div>"; 
         echo "<div class='disconnect'>";
         echo"<form action='reservation.php' method='post'>";
         echo"<button type='submit' name='supr' value='1' id='btn2'>"; 
         echo"<img src='ressource/deconnecter.svg'>"; 
         echo"&nbsp;";
         echo"Se déconnecter"; 
         echo"</button>"; 
         echo "</div>";
         echo"</form>";  
         echo "</div>"; 
         echo"</header>";
  
        }
        if ($_SESSION['statu']=="admin"){
            echo"<div class='tablaux'>"; 
            echo"<table>";
            echo"<tr><td colspan='5' class='title'>EN ATTENTE</td></tr>";
            echo"<tr><th>Nom</th><th>Object</th><th>Début</th><th>Fin</th><th>Décision</th></tr>";
           
             try{
                $db = new PDO(
                    'mysql:host=localhost;dbname=sae203;charset=utf8', 'root', 'root'
                );    
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e){
                die(print_r($e));
            }
            $getScoresSql = 'SELECT materiel.name, utilisateur.nom, utilisateur.prenom, reserve.start_date, reserve.end_date, reserve.start_time, reserve.end_time, reserve.reserve_id, reserve.acquittement FROM materiel, reserve, utilisateur WHERE reserve.materiel_id = materiel.materiel_id AND reserve.mail = utilisateur.mail AND reserve.acquittement = :acquittement';
            $getScores = $db->prepare($getScoresSql);
            $sqlParams = [
                'acquittement' => "wait"
                
            ];
            $getScores->execute($sqlParams) or die($db->errorInfo());
            $results = $getScores->fetchAll(PDO::FETCH_ASSOC);
           
            
            foreach ($results as $value){
                echo"<tr>" . "<td>" . $value['nom'] . "&nbsp;" . $value["prenom"] . "</td>" . "<td>" . $value['name'] . "</td>" . "<td>" .$value['start_date'] . "&nbsp;" . $value['start_time'] . "</td>" . "<td>" .$value['end_date'] . "&nbsp;" . $value['end_time'] . "</td>" . "<td>" . "<form action='reservation.php' method='post'>" . "<button type='submit' class='accpter' name='accept' value='{$value['reserve_id']}'>Accepter</button>" . "<button type='submit' class='refuser' name='reject' value='{$value['reserve_id']}'>Rejeter</button>" . "</td>" . "</tr>";  
                
            }
            echo"</table>";
            echo"</div>"; 
            if (isset($_POST['accept'])){
                try{
                    $db = new PDO(
                        'mysql:host=localhost;dbname=sae203;charset=utf8', 'root', 'root'
                    );    
                    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                catch(Exception $e){
                    die(print_r($e));
                }
                $sqlQuery = 'UPDATE `reserve` SET `acquittement`= :acquittement WHERE `reserve_id` = :reserve_id';
                $deleteMateriel = $db->prepare($sqlQuery);
                $deleteMateriel->execute([
                    'acquittement' => "yes",
                    'reserve_id' => $_POST['accept'], 
                ]);
            }
            if (isset($_POST['reject'])){
                try{
                    $db = new PDO(
                        'mysql:host=localhost;dbname=sae203;charset=utf8', 'root', 'root'
                    );    
                    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                }
                catch(Exception $e){
                    die(print_r($e));
                }
                $sqlQuery = 'UPDATE `reserve` SET `acquittement`= :acquittement WHERE `reserve_id` = :reserve_id';
                $deleteMateriel = $db->prepare($sqlQuery);
                $deleteMateriel->execute([
                    'acquittement' => "no",
                    'reserve_id' => $_POST['reject'], 
                ]);
            }
            echo"<div class='tablaux'>";
            echo"<table>";
            echo"<tr><td colspan='5' class='title'>Confirmer</td></tr>";
            echo"<tr><th>Nom</th><th>Object</th><th>Début</th><th>Fin</th><th>Décision</th></tr>";
           
             try{
                $db = new PDO(
                    'mysql:host=localhost;dbname=sae203;charset=utf8', 'root', 'root'
                );    
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e){
                die(print_r($e));
            }
            $getScoresSql = 'SELECT materiel.name, utilisateur.nom, utilisateur.prenom, reserve.start_date, reserve.end_date, reserve.start_time, reserve.end_time, reserve.reserve_id, reserve.acquittement FROM materiel, reserve, utilisateur WHERE reserve.materiel_id = materiel.materiel_id AND reserve.mail = utilisateur.mail AND reserve.acquittement = :acquittement';
            $getScores = $db->prepare($getScoresSql);
            $sqlParams = [
                'acquittement' => "yes"
                
            ];
            $getScores->execute($sqlParams) or die($db->errorInfo());
            $results = $getScores->fetchAll(PDO::FETCH_ASSOC);
           
            
            foreach ($results as $value){
                echo"<tr>" . "<td>" . $value['nom'] . "&nbsp;" . $value["prenom"] . "</td>" . "<td>" . $value['name'] . "</td>" . "<td>" .$value['start_date'] . "&nbsp;" . $value['start_time'] . "</td>" . "<td>" .$value['end_date'] . "&nbsp;" . $value['end_time'] . "</td>" . "<td style='background-color: green;'>" . "accepter" . "</td>" . "</tr>";  
                
            }
            try{
                $db = new PDO(
                    'mysql:host=localhost;dbname=sae203;charset=utf8', 'root', 'root'
                );    
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e){
                die(print_r($e));
            }
            $getScoresSql = 'SELECT materiel.name, utilisateur.nom, utilisateur.prenom, reserve.start_date, reserve.end_date, reserve.start_time, reserve.end_time, reserve.reserve_id, reserve.acquittement FROM materiel, reserve, utilisateur WHERE reserve.materiel_id = materiel.materiel_id AND reserve.mail = utilisateur.mail AND reserve.acquittement = :acquittement';
            $getScores = $db->prepare($getScoresSql);
            $sqlParams = [
                'acquittement' => "no"
                
            ];
            $getScores->execute($sqlParams) or die($db->errorInfo());
            $results = $getScores->fetchAll(PDO::FETCH_ASSOC);
           
            
            foreach ($results as $value){
                echo"<tr>" . "<td>" . $value['nom'] . "&nbsp;" . $value["prenom"] . "</td>" . "<td>" . $value['name'] . "</td>" . "<td>" .$value['start_date'] . "&nbsp;" . $value['start_time'] . "</td>" . "<td>" .$value['end_date'] . "&nbsp;" . $value['end_time'] . "</td>" . "<td style='background-color: red;'>" . "refuser" . "</td>" . "</tr>";  
                
            }
            echo"</table>";
            echo"</div>"; 
        }
        if ($_SESSION['statu']=="user"){
            echo"<div class='tablaux'>";
            echo"<table>";
            echo"<tr><td colspan='4' class='title'>EN ATTENTE</td></tr>";
            echo"<tr><th>Object</th><th>Début</th><th>Fin</th></tr>";
           
             try{
                $db = new PDO(
                    'mysql:host=localhost;dbname=sae203;charset=utf8', 'root', 'root'
                );    
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e){
                die(print_r($e));
            }

         
            $getScoresSql = 'SELECT materiel.name, utilisateur.nom, utilisateur.prenom, reserve.start_date, reserve.end_date, reserve.start_time, reserve.end_time, reserve.reserve_id, reserve.acquittement FROM materiel, reserve, utilisateur WHERE reserve.materiel_id = materiel.materiel_id AND reserve.mail = utilisateur.mail AND reserve.acquittement = :acquittement AND utilisateur.mail = :mail';
           
            $getScores = $db->prepare($getScoresSql);
            $sqlParams = [
                'acquittement' => "wait",
                'mail' => $_SESSION['mail']
            ];
            $getScores->execute($sqlParams) or die($db->errorInfo());
            $results = $getScores->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $value){
                echo"<tr>" . "<td>" . $value['name'] . "</td>" . "<td>" .$value['start_date'] . "&nbsp;" . $value['start_time'] . "</td>" . "<td>" .$value['end_date'] . "&nbsp;" . $value['end_time'] . "</td>" . "</tr>";  
        
            }
           
            echo"</table>";
            echo"</div>"; 
            echo"<div class='tablaux'>";
            echo"<table>";
            echo"<tr><td colspan='4' class='title'>RESERVATIONS CONFIRMER</td></tr>";
            echo"<tr><th>Object</th><th>Début</th><th>Fin</th><th>Décision</th></tr>";
           
             try{
                $db = new PDO(
                    'mysql:host=localhost;dbname=sae203;charset=utf8', 'root', 'root'
                );    
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e){
                die(print_r($e));
            }


            $getScoresSql = 'SELECT materiel.name, utilisateur.nom, utilisateur.prenom, reserve.start_date, reserve.end_date, reserve.start_time, reserve.end_time, reserve.reserve_id, reserve.acquittement FROM materiel, reserve, utilisateur WHERE reserve.materiel_id = materiel.materiel_id AND reserve.mail = utilisateur.mail AND reserve.acquittement = :acquittement AND utilisateur.mail = :mail';
           
            $getScores = $db->prepare($getScoresSql);
            $sqlParams = [
                'acquittement' => "yes",
                'mail' => $_SESSION['mail']
            ];
            $getScores->execute($sqlParams) or die($db->errorInfo());
            $results = $getScores->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $value){
                echo"<tr>" . "<td>" . $value['name'] . "</td>" . "<td>" .$value['start_date'] . "&nbsp;" . $value['start_time'] . "</td>" . "<td>" .$value['end_date'] . "&nbsp;" . $value['end_time'] . "</td>" . "</td>" . "<td style='background-color: green;'>" . "Accepter" . "</td>"  . "</tr>";  
        
            }
              
                
         

           
             try{
                $db = new PDO(
                    'mysql:host=localhost;dbname=sae203;charset=utf8', 'root', 'root'
                );    
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e){
                die(print_r($e));
            }


            $getScoresSql = 'SELECT materiel.name, utilisateur.nom, utilisateur.prenom, reserve.start_date, reserve.end_date, reserve.start_time, reserve.end_time, reserve.reserve_id, reserve.acquittement FROM materiel, reserve, utilisateur WHERE reserve.materiel_id = materiel.materiel_id AND reserve.mail = utilisateur.mail AND reserve.acquittement = :acquittement AND utilisateur.mail = :mail;';
           
            $getScores = $db->prepare($getScoresSql);
            $sqlParams = [
                'acquittement' => "no",
                'mail' => $_SESSION['mail']
            ];
            $getScores->execute($sqlParams) or die($db->errorInfo());
            $results = $getScores->fetchAll(PDO::FETCH_ASSOC);
            foreach ($results as $value){
                echo"<tr>" . "<td>" . $value['name'] . "</td>" . "<td>" .$value['start_date'] . "&nbsp;" . $value['start_time'] . "</td>" . "<td>" .$value['end_date'] . "&nbsp;" . $value['end_time'] . "</td>" . "</td>" . "<td style='background-color: red;'>" . "refuser" . "</td>" . "</tr>";  
        
            }
             
            echo"</table>";
            echo"</div>";
        }
?>
<?php


if (!empty($_POST['supr'])){
    session_unset(); 
    // destroy the session 
    session_destroy();  
 }
 
?>


      <script src="script/index.js"></script>
</body>
</html>

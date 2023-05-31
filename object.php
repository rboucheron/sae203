<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matériel</title>
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/nav_object.css">
    <link rel="stylesheet" href="style/object.css">
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
        echo"<form action='object.php' method='post'>";
        echo"<button type='submit' name='supr' value='1' id='btn2'>"; 
        echo"<img src='ressource/deconnecter.svg'>"; 
        echo"&nbsp;";
        echo"Se déconnecter"; 
        echo"</button>"; 
        echo "</div>";
        echo"</form>";  
        echo "</div>"; 
        echo"</header>"; 
        
        
        include('include/product_nav.php');
       

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

if (!isset($_POST['button'])){
    $getScoresSql = 'SELECT name, type, reference, description, materiel_id, image FROM materiel';
    $getScores = $db->prepare($getScoresSql);
    $getScores->execute();
}else{
    $getScoresSql = 'SELECT name, type, reference, description, materiel_id, image FROM materiel WHERE type = :type';
    $getScores = $db->prepare($getScoresSql);
    $sqlParams = [
        'type' => $_POST[button]
    ];
    $getScores->execute($sqlParams) or die($db->errorInfo());
}

$results = $getScores->fetchAll(PDO::FETCH_ASSOC);
$ligne = 0;
foreach ($results as $value){

    echo"<div class='contener'>";
    echo"<img src='ressource/{$value['image']}'>"; 
    echo"<div class='contenue'>";
    echo" <h2>{$value['name']}</h2>";
    echo"<h3>{$value['type']}</h3>";
    echo"<p>{$value['description']}</p>";
    echo"</div>";

   
if ($_SESSION['statu']=="admin"){
    echo"<form action='object.php' method='post'>";
    echo"<button class='reservation' type='submit' name='delect' value='{$value['materiel_id']}'>Supprimer</button>";
    echo"</form>";
    echo "<div id='{$ligne}' class='lia' onclick='ouvre(this)'>Réservez dès maintenant</div>";
    echo"</div>";

    echo"<div id='box_{$ligne}' class='box'>";
    echo"<form action='object.php' method='post'>";
    echo"<div class='texte'>";
    echo"<div id='{$ligne}' class='ferme' onclick='ferme(this)'><img src='ressource/croits.svg'></div>";
    echo"<div class='champ'>";
    echo"<div class='first'>";
    echo"<label for='debut'>Date de début</label>";
    echo"<input type='date' name='start_date' id='debut'>";
    echo"</div>";
    echo"<div class='second'>";
    echo"<label for='fin'>Date de Fin</label>";
    echo"<input type='date' name='end_date' id='fin'>";
    echo"</div>";
    echo"</div>";
    echo"<div class='champ'>";
    echo"<div class='first'>";
    echo"<label for='tdebut'>Heure de début</label>";
    echo"<input type='time' name='start_time' id='tdebut'>";
    echo"</div>";
    echo"<div class='second'>";
    echo"<label for='tfin'>Heure de Fin</label>";
    echo"<input type='time' name='end_time' id='tfin'>";
    echo"</div>";
    echo"</div>";
    echo"<div class='champ'>";
    echo"<p>" . "Vous reservez objet" . "&nbsp;" . $value['name'] . "</p>"; 

  echo"</div>";
    echo"</div>";
    echo"<button name='materiel_id' value='{$value['materiel_id']}'>Envoyé une Demande</button>";
    echo"</form>";
    echo"</div>";
    $ligne++; 
    
}else{
   
    echo "<div id='{$ligne}' class='lia' onclick='ouvre(this)'>Réservez dès maintenant</div>";


    echo"</div>";
    echo"<div id='box_{$ligne}' class='box'>";
    echo"<form action='object.php' method='post'>";
    echo"<div class='texte'>";
    echo"<div id='{$ligne}' class='ferme' onclick='ferme(this)'><img src='ressource/croits.svg'></div>";
    echo"<div class='champ'>";
    echo"<div class='first'>";
    echo"<label for='debut'>Date de début</label>";
    echo"<input type='date' name='start_date' id='debut'>";
    echo"</div>";
    echo"<div class='second'>";
    echo"<label for='fin'>Date de Fin</label>";
    echo"<input type='date' name='end_date' id='fin'>";
    echo"</div>";
    echo"</div>";
    echo"<div class='champ'>";
    echo"<div class='first'>";
    echo"<label for='tdebut'>Heure de début</label>";
    echo"<input type='time' name='start_time' id='tdebut'>";
    echo"</div>";
    echo"<div class='second'>";
    echo"<label for='tfin'>Heure de Fin</label>";
    echo"<input type='time' name='end_time' id='tfin'>";
    echo"</div>";
    echo"</div>";
    echo"<div class='champ'>";
    echo"<p>" . "Vous reservez objet" . "&nbsp;" . $value['name'] . "</p>"; 
  echo"</div>";
    echo"</div>";
    echo"<button name='materiel_id' value='{$value['materiel_id']}'>Envoyé une Demande</button>";
    echo"</form>";
    echo"</div>";
    $ligne++; 
}

}
if(isset($_POST['delect'])){
    try{
        $db = new PDO(
            'mysql:host=localhost;dbname=sae203;charset=utf8', 'root', 'root'
        );    
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e){
        die(print_r($e));
    }
    $sqlQuery = 'DELETE FROM reserve WHERE materiel_id = :materiel_id';
    $deleteMateriel = $db->prepare($sqlQuery);
    $deleteMateriel->execute([
        'materiel_id' => $_POST['delect']
    ]);
    try{
        $db = new PDO(
            'mysql:host=localhost;dbname=sae203;charset=utf8', 'root', 'root'
        );    
        $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(Exception $e){
        die(print_r($e));
    }
    $sqlQuery = 'DELETE FROM materiel WHERE materiel_id = :materiel_id';
    $deleteMateriel = $db->prepare($sqlQuery);
    $deleteMateriel->execute([
        'materiel_id' => $_POST['delect']
    ]);
}






if(isset($_POST['materiel_id'])){
    if(($_POST['start_date'])<=($_POST['end_date'])){
 
            try{
                $db = new PDO(
                    'mysql:host=localhost;dbname=sae203;charset=utf8', 'root', 'root'
                );    
                $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e){
                die(print_r($e));
            }
            $sqlQuery = 'INSERT INTO reserve(mail, materiel_id, start_date, end_date, start_time, end_time, acquittement) VALUES (:mail, :materiel_id, :start_date, :end_date, :start_time, :end_time, :acquittement)';
            $deleteMateriel = $db->prepare($sqlQuery);
            $deleteMateriel->execute([
                'mail' => $_SESSION['mail'],
                'materiel_id' => $_POST['materiel_id'], 
                'start_date' => $_POST['start_date'], 
                'end_date' => $_POST['end_date'], 
                'start_time' => $_POST['start_time'], 
                'end_time' => $_POST['end_time'],
                'acquittement' => "wait",  
               
        
            ]);

        

       
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
        
      
            $getScoresSql = 'SELECT name, type, reference, description, materiel_id FROM materiel WHERE materiel_id = :materiel_id';
            $getScores = $db->prepare($getScoresSql);
            $sqlParams = [
                'materiel_id' => $_POST['materiel_id']
            ];
            $getScores->execute($sqlParams) or die($db->errorInfo());
        

            $results = $getScores->fetchAll(PDO::FETCH_ASSOC);
            $ligne = 0;
            foreach ($results as $value){
            
        
              
                echo"<div class='box ouvr'>";
                
                echo"<div class='contener'>";
                echo"<div class='contenue'>";
              
                echo"</div>";
            
                echo"<form action='object.php' method='post'>";
                echo"<div class='texte'>";
               
              
                echo"<div class='champ'>";
                echo"<div class='first'>";
                echo"<label for='debut'>Date de début</label>";
                echo"<input type='date' name='start_date' id='debut'>";
                echo"</div>";
                echo"<div class='second'>";
                echo"<label for='fin'>Date de Fin</label>";
                echo"<input type='date' name='end_date' id='fin'>";
                echo"</div>";
                echo"</div>";
                echo"<div class='champ'>";
                echo"<div class='first'>";
                echo"<label for='tdebut'>Heure de début</label>";
                echo"<input type='time' name='start_time' id='tdebut'>";
                echo"</div>";
                echo"<div class='second'>";
                echo"<label for='tfin'>Heure de Fin</label>";
                echo"<input type='time' name='end_time' id='tfin'>";
                echo"</div>";
                echo"</div>";
                echo"<div class='champ'>";
                echo"<p>" . "Vous avez mis une date de début suppérieur à la date de fin pour l'objet" . "&nbsp;" . $value['name'] . "</p>"; 
            
              echo"</div>";
                echo"</div>";
                echo"<button name='materiel_id' value='{$value['materiel_id']}'>Envoyé à nouveau</button>";
                echo"</form>";
                echo"</div>";
    }

    }
}
      }  
      if (!empty($_POST['supr'])){
        session_unset(); 
        // destroy the session 
        session_destroy();  
     }
       ?>


      <script src="script/index.js"></script>
  
</body>
</html>
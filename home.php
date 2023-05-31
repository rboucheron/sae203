<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/navbar.css">
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
        echo"<form action='home.php' method='post'>";
        echo"<button type='submit' name='supr' value='1' id='btn2'>"; 
        echo"<img src='ressource/deconnecter.svg'>"; 
        echo"&nbsp;";
        echo"Se déconnecter"; 
        echo"</button>"; 
        echo "</div>";
        echo"</form>";  
        echo "</div>"; 
        echo"</header>"; 
        include('include/materiel.php');
        
  
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau object</title>
    <link rel="stylesheet" href="style/main.css">
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="stylesheet" href="style/add_object.css">

</head>
<body>
    

<?php     session_start(); ?>
<?php 
 if (!isset($_SESSION['mail'])){
    include('include/disconnect.php'); 
}else{

    if ($_SESSION['statu']=="admin"){

        if (!isset($_POST['ref']) && !isset($_POST['nom']) && !isset($_POST['description'])){
            echo"<header>";
        include('include/navbar.php');
            echo "<div class='all'>"; 
            echo "<div class='profil'>";
            echo "<div class='identiter'>";
            echo "<h3>" . $_SESSION['prenom'] . "&nbsp;" . $_SESSION['nom'] . "</h3>";
            echo "<h4>" . $_SESSION['statu'] . "</h4>";
            echo "</div>";
            echo "<div class='image'>";
            echo "<img src='ressource/profil.svg'>";
            echo "</div>";
            echo "</div>";
            echo "<div class='disconnect'>";
            echo"<form action='add_object.php' method='post'>";
            echo"<button type='submit' name='supr' value='1' id='btn2'>"; 
            echo"<img src='ressource/deconnecter.svg'>"; 
            echo"&nbsp;";
            echo"Se déconnecter"; 
            echo"</button>"; 
            echo "</div>";
            echo"</form>";  
            echo "</div>"; 
            echo"</header>";
            echo"<div class='ajout'>";
            echo"<form class='form' action='add_object.php' method='post' enctype='multipart/form-data'>";
            echo"<h3>Nom matériel</h3>";
            echo"<input type='text' name='nom' class='input' placeholder='ex : Salle 311'>";
            echo"<input id='input' type='file' name='image'>";
            echo"<div class='container'>";
            echo"<h3>Type de matériel </h3>";
            echo"<label><input type='radio' name='radio' value='mobilier'>";
            echo"<span>Mobilier</span></label>";
            echo"<label><input type='radio' name='radio' value='hightech'>";
            echo"<span>High Tech</span></label>";
            echo"<label><input type='radio' name='radio' value='audiovisuel'>";
            echo"<span>Audiovisuel</span></label>";
            echo"</div><h3>Référence </h3>";
            echo"<input type='text' class='input' placeholder='ex : 66453/23' name='ref'>";
            echo"<h3>Description </h3>";
            echo"<textarea id='descri' placeholder='ex : Possède 3 fenetre' name='description'></textarea>";
            echo"<button class='envoie'>Mettre en ligne</button></form></div>";
        }else{
            if ($_POST['ref'] == "" || $_POST['nom'] == "" || $_POST['description'] == ""){
               $a = $_POST['ref']; 
               $b = $_POST['nom']; 
               $c = $_POST['description']; 
               echo "<div class='all'>"; 
               echo "<div class='profil'>";
               echo "<div class='identiter'>";
               echo "<h3>" . $_SESSION['prenom'] . "&nbsp;" . $_SESSION['nom'] . "</h3>";
               echo "<h4>" . $_SESSION['statu'] . "</h4>";
               echo "</div>";
               echo "<div class='image'>";
               echo "<img src='ressource/profil.svg'>";
               echo "</div>";
               echo "</div>";
               echo "<div class='disconnect'>";
               echo"<form action='add_object.php' method='post'>";
               echo"<button type='submit' name='supr' id='btn2'>"; 
               echo"<img src='ressource/deconnecter.svg'>"; 
               echo"&nbsp;";
               echo"Se déconnecter"; 
               echo"</button>"; 
               echo "</div>";
               echo"</form>";  
               echo "</div>"; 
               echo"</header>";
               echo"<div class='ajout'>";
               echo"<form class='form' action='add_object.php' method='post'>";
               echo"<h3>Nom matériel</h3>";
               echo"<input type='text' name='nom' class='input' placeholder='ex : Salle 311' value='$b'>";
               echo"<input id='input' type='file' name='image'>";
               echo"<div class='container'>";
               echo"<h3>Type de matériel </h3>";
               echo"<label><input type='radio' name='radio' value='mobilier'>";
               echo"<span>Mobilier</span></label>";
               echo"<label><input type='radio' name='radio' value='hightech'>";
               echo"<span>High Tech</span></label>";
               echo"<label><input type='radio' name='radio' value='audiovisuel'>";
               echo"<span>Audiovisuel</span></label>";
               echo"</div><h3>Référence </h3>";
               echo"<input type='text' class='input' placeholder='ex : 66453/23' name='ref' value='$a'>";
               echo"<h3>Description </h3>";
               echo"<textarea id='descri' placeholder='ex : Possède 3 fenetre' name='description' value='$c'></textarea>";
               echo"<button class='envoie'>Mettre en ligne</button></form></div>";
        
            }else{
                if (!empty($_FILES['image'])) {
      
                    move_uploaded_file($_FILES['image']['tmp_name'], "ressource/" . $_FILES['image']['name']);
                    $kays = password_hash($_POST['mp'], PASSWORD_DEFAULT); 
                    try
                    {
                    $connect = new PDO('mysql:host=localhost;dbname=sae203;charset=utf8', 'root', 'root');
                    }
                    catch (Exception $e)
                    {
                    die('Erreur : ' . $e->getMessage());
                    }
                    $sqlQuery = 'INSERT INTO materiel(name, type, reference, description, image) VALUES (:name, :type, :reference, :description, :image)';
                    $insertuser = $connect->prepare($sqlQuery);
                    $insertuser->execute([
                    'name' => $_POST['nom'],
                    'type' => $_POST['radio'],
                    'reference' => $_POST['ref'],
                    'description' => $_POST['description'],
                    'image' => $_FILES['image']['name']
                    ]);
                    header("Location: object.php");
            
                }
               
        
            }}
    
    
     }else{
        echo"<header>";
        include('include/navbar.php');
        echo "<div class='all'>"; 
        echo "<div class='profil'>";
        echo "<div class='identiter'>";
        echo "<h3>" . $_SESSION['prenom'] . "&nbsp;" . $_SESSION['nom'] . "</h3>";
        echo "<h4>" . $_SESSION['mail'] . "</h4>";
        echo "</div>";
        echo "<div class='image'>";
        echo "<img src='ressource/profil.svg'>";
        echo "</div>";
        echo "</div>";
        echo "<div class='disconnect'>";
        echo"<form action='add_object.php' method='post'>";
        echo"<button type='submit' name='supr' id='btn2'>"; 
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

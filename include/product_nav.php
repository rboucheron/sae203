
<div class="barre">
    <form action="object.php" method="post">
        <input type="submit" name="button"value="mobilier">
        <input type="submit" name="button"value="hightech">
        <input type="submit" name="button"value="audiovisuel">
    </form>

     
        <div class="animation"></div>
    </div>

<?php
 if ($_SESSION['statu']=="admin"){
    echo"<a href='add_object.php' id='newobject'><img src='ressource/add_circle_FILL0_wght400_GRAD0_opsz48.svg' alt='ajouter un objet'></a>";
}
?>
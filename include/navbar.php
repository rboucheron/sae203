
<nav class='navbar'>
        <a href='object.php'  <?php if(basename($_SERVER['PHP_SELF']) == "object.php"){echo "class='lien-active'";}else{echo "class='nav-lien'";} ?>>Matériel</a>
       <a href='reservation.php' <?php if(basename($_SERVER['PHP_SELF']) == "reservation.php"){echo "class='lien-active'";}else{echo "class='nav-lien'";} ?>>Réservation</a>
    </nav>


    
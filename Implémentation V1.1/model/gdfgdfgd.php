
<?php
/* Exécute une requête préparée en passant un tableau de valeurs */
$sth = $dbh->prepare('SELECT nom, couleur, caloriesFROM fruit WHERE calories < ? AND couleur = ?');
$sth->execute(array(150, 'rouge'));

$red = $sth->fetchAll();
$sth->execute(array(175, 'jaune'));
$yellow = $sth->fetchAll();
?>

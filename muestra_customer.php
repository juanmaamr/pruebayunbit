<?php
// Realizado por Juan Manuel Medina Ruiz
// Este fichero lo he hecho para realizar mas comodamente el apartado c al ponerlo en una tabla y transformando los datos en array
require("conexion.inc.php");
$c = new mysqli($host,$user,$pass,$db);
$c->query("SET NAMES utf8");
$sql = "SELECT name,address,phone,type FROM customer";

echo json_encode($c->query($sql)->fetch_all(MYSQLI_ASSOC));
?>


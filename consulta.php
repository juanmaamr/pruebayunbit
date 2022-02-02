<?php
// Realizado por Juan Manuel Medina Ruiz
// En este fichero se encuetra el apartado E en el cual mediante un id, se muestra todos los datos de la tabla
require("conexion.inc.php");
$c = new mysqli($host,$user,$pass,$db);
$c->query("SET NAMES utf8");
        $id = $_GET['id'];

        $sql = "SELECT * FROM customer WHERE id='$id'";

        $resultado = mysqli_query($c,$sql);

            echo json_encode($c->query($sql)->fetch_all(MYSQLI_ASSOC));
  
?>


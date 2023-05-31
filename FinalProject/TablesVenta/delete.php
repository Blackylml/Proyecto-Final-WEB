<?php
if(isset ($_GET["idVenta"])){
    $idVenta = $_GET ["idVenta"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ropa";
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "UPDATE Venta SET estatus = 0 WHERE idVenta = $idVenta";
    $connection->query($sql);

}
header("location:\web\FinalProject\TablesVenta\pableProveedor.php");
exit;
?>
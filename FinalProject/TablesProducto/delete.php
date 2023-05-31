<?php
if(isset ($_GET["idProducto"])){
    $idProducto = $_GET ["idProducto"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ropa";
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "UPDATE Producto SET estatus = 0 WHERE idProducto = $idProducto";
    $connection->query($sql);

}
header("location:\web\FinalProject\TablesProducto\pableProveedor.php");
exit;
?>
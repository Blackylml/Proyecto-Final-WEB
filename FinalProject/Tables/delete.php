<?php
if (isset($_GET["idProveedor"])) {
    $idProveedor = $_GET["idProveedor"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ropa";
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "UPDATE Proveedor SET estatus = 0 WHERE idProveedor = $idProveedor";
    $connection->query($sql);
}

header("location: \web\FinalProject\Tables\pableProveedor.php");
exit;
?>

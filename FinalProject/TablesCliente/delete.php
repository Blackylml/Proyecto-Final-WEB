<?php
if(isset ($_GET["idCliente"])){
    $idCliente = $_GET ["idCliente"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ropa";
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "UPDATE Cliente SET estatus = 0 WHERE idCliente = $idCliente";
    $connection->query($sql);

}
header("location:\web\FinalProject\TablesCliente\pableProveedor.php");
exit;
?>
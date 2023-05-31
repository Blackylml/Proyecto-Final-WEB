<?php
if(isset ($_GET["idEmpleado"])){
    $idEmpleado = $_GET ["idEmpleado"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ropa";
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "UPDATE Empleado SET estatus = 0 WHERE idEmpleado = $idEmpleado";
    $connection->query($sql);

}
header("location:\web\FinalProject\TablesEmpleado\pableProveedor.php");
exit;
?>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ropa";
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Fallo de conexion: " . $connection->connect_error);
}

$sql = "SELECT * FROM Venta WHERE estatus = 1";
$result = $connection->query($sql);

if (!$result){
    die("Query invalido; " . $connection->error);
}

// Crear un archivo CSV en memoria
$csvData = "ID,totalVenta,MetodoPago,idCliente,idProducto,Estatus\n";

while ($row = $result->fetch_assoc()) {
    $csvData .= $row['idVenta'] . ',' . $row['totalVenta'] . ',' . $row['MetodoPago'] . ',' . $row['idCliente'] . ',' . $row['idProducto'] . ',' . $row['estatus'] . "\n";
}

// Establecer las cabeceras para la descarga del archivo
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="ventas.csv"');

// Enviar el contenido del archivo CSV al navegador
echo $csvData;
exit;
?>

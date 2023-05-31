<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ropa";
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Fallo de conexion: " . $connection->connect_error);
}

$sql = "SELECT * FROM Empleado WHERE estatus = 1";
$result = $connection->query($sql);

if (!$result){
    die("Query invalido; " . $connection->error);
}

// Crear un archivo CSV en memoria
$csvData = "ID,Nombre,Cargo,Fecha de Contratacion,Salario,Estatus\n";

while ($row = $result->fetch_assoc()) {
    $csvData .= $row['idEmpleado'] . ',' . $row['nombre'] . ',' . $row['cargo'] . ',' . $row['fechaContratacion'] . ',' . $row['salario'] . ',' . $row['estatus'] . "\n";
}

// Establecer las cabeceras para la descarga del archivo
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="empleados.csv"');

// Enviar el contenido del archivo CSV al navegador
echo $csvData;
exit;
?>


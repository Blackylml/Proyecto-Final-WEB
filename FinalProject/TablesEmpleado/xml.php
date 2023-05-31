<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ropa";
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Fallo de conexión: " . $connection->connect_error);
}

$sql = "SELECT * FROM Empleado WHERE estatus = 1";
$result = $connection->query($sql);

if (!$result) {
    die("Query inválido: " . $connection->error);
}

$xml = new SimpleXMLElement('<empleados/>');

while ($row = $result->fetch_assoc()) {
    $empleado = $xml->addChild('empleado');
    $empleado->addChild('idEmpleado', $row['idEmpleado']);
    $empleado->addChild('nombre', $row['nombre']);
    $empleado->addChild('cargo', $row['cargo']);
    $empleado->addChild('fechaContratacion', $row['fechaContratacion']);
    $empleado->addChild('salario', $row['salario']);
    $empleado->addChild('estatus', $row['estatus']);
}

$xmlString = $xml->asXML();

// Descargar el archivo XML
header('Content-disposition: attachment; filename=empleados.xml');
header('Content-type: application/xml');

// Mostrar la información en forma de tabla
echo '<table>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Nombre</th>';
echo '<th>Cargo</th>';
echo '<th>Fecha de Contratación</th>';
echo '<th>Salario</th>';
echo '<th>Estatus</th>';
echo '</tr>';

foreach ($xml->empleado as $empleado) {
    echo '<tr>';
    echo '<td>' . $empleado->idEmpleado . '</td>';
    echo '<td>' . $empleado->nombre . '</td>';
    echo '<td>' . $empleado->cargo . '</td>';
    echo '<td>' . $empleado->fechaContratacion . '</td>';
    echo '<td>' . $empleado->salario . '</td>';
    echo '<td>' . $empleado->estatus . '</td>';
    echo '</tr>';
}

echo '</table>';
?>

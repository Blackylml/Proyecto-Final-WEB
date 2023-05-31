<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ropa";
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Fallo de conexión: " . $connection->connect_error);
}

$sql = "SELECT * FROM Proveedor WHERE estatus = 1";
$result = $connection->query($sql);

if (!$result) {
    die("Query inválido: " . $connection->error);
}

$xml = new SimpleXMLElement('<proveedores/>');

while ($row = $result->fetch_assoc()) {
    $proveedor = $xml->addChild('proveedor');
    $proveedor->addChild('idProveedor', $row['idProveedor']);
    $proveedor->addChild('nombre', $row['nombre']);
    $proveedor->addChild('correo', $row['correo']);
    $proveedor->addChild('direccion', $row['direccion']);
    $proveedor->addChild('telefono', $row['telefono']);
    $proveedor->addChild('estatus', $row['estatus']);
}

$xmlString = $xml->asXML();

// Descargar el archivo XML
header('Content-disposition: attachment; filename=proveedores.xml');
header('Content-type: application/xml');

// Mostrar la información en forma de tabla
echo '<table>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Nombre</th>';
echo '<th>Correo</th>';
echo '<th>Dirección</th>';
echo '<th>Teléfono</th>';
echo '<th>Estatus</th>';
echo '</tr>';

foreach ($xml->proveedor as $proveedor) {
    echo '<tr>';
    echo '<td>' . $proveedor->idProveedor . '</td>';
    echo '<td>' . $proveedor->nombre . '</td>';
    echo '<td>' . $proveedor->correo . '</td>';
    echo '<td>' . $proveedor->direccion . '</td>';
    echo '<td>' . $proveedor->telefono . '</td>';
    echo '<td>' . $proveedor->estatus . '</td>';
    echo '</tr>';
}

echo '</table>';
?>

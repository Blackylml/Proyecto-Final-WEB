<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ropa";
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Fallo de conexión: " . $connection->connect_error);
}

$sql = "SELECT * FROM Cliente WHERE estatus = 1";
$result = $connection->query($sql);

if (!$result) {
    die("Query inválido: " . $connection->error);
}

$xml = new SimpleXMLElement('<clientes/>');

while ($row = $result->fetch_assoc()) {
    $cliente = $xml->addChild('cliente');
    $cliente->addChild('idCliente', $row['idCliente']);
    $cliente->addChild('nombre', $row['nombre']);
    $cliente->addChild('correo', $row['correo']);
    $cliente->addChild('direccion', $row['direccion']);
    $cliente->addChild('telefono', $row['telefono']);
    $cliente->addChild('estatus', $row['estatus']);
}

$xmlString = $xml->asXML();

// Descargar el archivo XML
header('Content-disposition: attachment; filename=clientes.xml');
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

foreach ($xml->cliente as $cliente) {
    echo '<tr>';
    echo '<td>' . $cliente->idCliente . '</td>';
    echo '<td>' . $cliente->nombre . '</td>';
    echo '<td>' . $cliente->correo . '</td>';
    echo '<td>' . $cliente->direccion . '</td>';
    echo '<td>' . $cliente->telefono . '</td>';
    echo '<td>' . $cliente->estatus . '</td>';
    echo '</tr>';
}

echo '</table>';
?>

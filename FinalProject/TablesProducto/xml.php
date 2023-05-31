<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ropa";
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Fallo de conexión: " . $connection->connect_error);
}

$sql = "SELECT * FROM Producto WHERE estatus = 1";
$result = $connection->query($sql);

if (!$result) {
    die("Query inválido: " . $connection->error);
}

$xml = new SimpleXMLElement('<productos/>');

while ($row = $result->fetch_assoc()) {
    $producto = $xml->addChild('producto');
    $producto->addChild('idProducto', $row['idProducto']);
    $producto->addChild('nombre', $row['nombre']);
    $producto->addChild('precio', $row['precio']);
    $producto->addChild('talla', $row['talla']);
    $producto->addChild('marca', $row['marca']);
    $producto->addChild('estatus', $row['estatus']);
}

$xmlString = $xml->asXML();

// Descargar el archivo XML
header('Content-disposition: attachment; filename=productos.xml');
header('Content-type: application/xml');

// Mostrar la información en forma de tabla
echo '<table>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Nombre</th>';
echo '<th>Precio</th>';
echo '<th>Talla</th>';
echo '<th>Marca</th>';
echo '<th>Estatus</th>';
echo '</tr>';

foreach ($xml->producto as $producto) {
    echo '<tr>';
    echo '<td>' . $producto->idProducto . '</td>';
    echo '<td>' . $producto->nombre . '</td>';
    echo '<td>' . $producto->precio . '</td>';
    echo '<td>' . $producto->talla . '</td>';
    echo '<td>' . $producto->marca . '</td>';
    echo '<td>' . $producto->estatus . '</td>';
    echo '</tr>';
}

echo '</table>';
?>

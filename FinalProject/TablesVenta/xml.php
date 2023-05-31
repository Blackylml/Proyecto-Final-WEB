<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "ropa";
$connection = new mysqli($servername, $username, $password, $database);
if ($connection->connect_error) {
    die("Fallo de conexión: " . $connection->connect_error);
}

$sql = "SELECT * FROM Venta WHERE estatus = 1";
$result = $connection->query($sql);

if (!$result) {
    die("Query inválido: " . $connection->error);
}

$xml = new SimpleXMLElement('<ventas/>');

while ($row = $result->fetch_assoc()) {
    $venta = $xml->addChild('venta');
    $venta->addChild('idVenta', $row['idVenta']);
    $venta->addChild('totalVenta', $row['totalVenta']);
    $venta->addChild('MetodoPago', $row['MetodoPago']);
    $venta->addChild('idCliente', $row['idCliente']);
    $venta->addChild('idProducto', $row['idProducto']);
    $venta->addChild('estatus', $row['estatus']);
}

$xmlString = $xml->asXML();

// Descargar el archivo XML
header('Content-disposition: attachment; filename=ventas.xml');
header('Content-type: application/xml');

// Mostrar la información en forma de tabla
echo '<table>';
echo '<tr>';
echo '<th>ID</th>';
echo '<th>Total Venta</th>';
echo '<th>Método de Pago</th>';
echo '<th>ID Cliente</th>';
echo '<th>ID Producto</th>';
echo '<th>Estatus</th>';
echo '</tr>';

foreach ($xml->venta as $venta) {
    echo '<tr>';
    echo '<td>' . $venta->idVenta . '</td>';
    echo '<td>' . $venta->totalVenta . '</td>';
    echo '<td>' . $venta->MetodoPago . '</td>';
    echo '<td>' . $venta->idCliente . '</td>';
    echo '<td>' . $venta->idProducto . '</td>';
    echo '<td>' . $venta->estatus . '</td>';
    echo '</tr>';
}

echo '</table>';
?>

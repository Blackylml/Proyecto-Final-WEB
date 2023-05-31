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

$ventas = array();

while ($row = $result->fetch_assoc()) {
    $venta = array(
        'idVenta' => $row['idVenta'],
        'totalVenta' => $row['totalVenta'],
        'MetodoPago' => $row['MetodoPago'],
        'idCliente' => $row['idCliente'],
        'idProducto' => $row['idProducto'],
        'estatus' => $row['estatus']
    );

    $ventas[] = $venta;
}

$json = json_encode($ventas);

// Descargar el archivo JSON
header('Content-disposition: attachment; filename=ventas.json');
header('Content-type: application/json');

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

foreach ($ventas as $venta) {
    echo '<tr>';
    echo '<td>' . $venta['idVenta'] . '</td>';
    echo '<td>' . $venta['totalVenta'] . '</td>';
    echo '<td>' . $venta['MetodoPago'] . '</td>';
    echo '<td>' . $venta['idCliente'] . '</td>';
    echo '<td>' . $venta['idProducto'] . '</td>';
    echo '<td>' . $venta['estatus'] . '</td>';
    echo '</tr>';
}

echo '</table>';
?>

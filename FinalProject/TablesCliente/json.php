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

$clientes = array();

while ($row = $result->fetch_assoc()) {
    $cliente = array(
        'idCliente' => $row['idCliente'],
        'nombre' => $row['nombre'],
        'correo' => $row['correo'],
        'direccion' => $row['direccion'],
        'telefono' => $row['telefono'],
        'estatus' => $row['estatus']
    );

    $clientes[] = $cliente;
}

$json = json_encode($clientes);

// Descargar el archivo JSON
header('Content-disposition: attachment; filename=clientes.json');
header('Content-type: application/json');

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

foreach ($clientes as $cliente) {
    echo '<tr>';
    echo '<td>' . $cliente['idCliente'] . '</td>';
    echo '<td>' . $cliente['nombre'] . '</td>';
    echo '<td>' . $cliente['correo'] . '</td>';
    echo '<td>' . $cliente['direccion'] . '</td>';
    echo '<td>' . $cliente['telefono'] . '</td>';
    echo '<td>' . $cliente['estatus'] . '</td>';
    echo '</tr>';
}

echo '</table>';
?>

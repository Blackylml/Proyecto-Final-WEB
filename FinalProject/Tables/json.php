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

$proveedores = array();

while ($row = $result->fetch_assoc()) {
    $proveedor = array(
        'idProveedor' => $row['idProveedor'],
        'nombre' => $row['nombre'],
        'correo' => $row['correo'],
        'direccion' => $row['direccion'],
        'telefono' => $row['telefono'],
        'estatus' => $row['estatus']
    );

    $proveedores[] = $proveedor;
}

$json = json_encode($proveedores);

// Descargar el archivo JSON
header('Content-disposition: attachment; filename=proveedores.json');
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

foreach ($proveedores as $proveedor) {
    echo '<tr>';
    echo '<td>' . $proveedor['idProveedor'] . '</td>';
    echo '<td>' . $proveedor['nombre'] . '</td>';
    echo '<td>' . $proveedor['correo'] . '</td>';
    echo '<td>' . $proveedor['direccion'] . '</td>';
    echo '<td>' . $proveedor['telefono'] . '</td>';
    echo '<td>' . $proveedor['estatus'] . '</td>';
    echo '</tr>';
}

echo '</table>';
?>

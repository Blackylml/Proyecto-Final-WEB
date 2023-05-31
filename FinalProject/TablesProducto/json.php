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

$productos = array();

while ($row = $result->fetch_assoc()) {
    $producto = array(
        'idProducto' => $row['idProducto'],
        'nombre' => $row['nombre'],
        'precio' => $row['precio'],
        'talla' => $row['talla'],
        'marca' => $row['marca'],
        'estatus' => $row['estatus']
    );

    $productos[] = $producto;
}

$json = json_encode($productos);

// Descargar el archivo JSON
header('Content-disposition: attachment; filename=productos.json');
header('Content-type: application/json');

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

foreach ($productos as $producto) {
    echo '<tr>';
    echo '<td>' . $producto['idProducto'] . '</td>';
    echo '<td>' . $producto['nombre'] . '</td>';
    echo '<td>' . $producto['precio'] . '</td>';
    echo '<td>' . $producto['talla'] . '</td>';
    echo '<td>' . $producto['marca'] . '</td>';
    echo '<td>' . $producto['estatus'] . '</td>';
    echo '</tr>';
}

echo '</table>';
?>

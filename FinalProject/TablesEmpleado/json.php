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

$empleados = array();

while ($row = $result->fetch_assoc()) {
    $empleado = array(
        'idEmpleado' => $row['idEmpleado'],
        'nombre' => $row['nombre'],
        'cargo' => $row['cargo'],
        'fechaContratacion' => $row['fechaContratacion'],
        'salario' => $row['salario'],
        'estatus' => $row['estatus']
    );

    $empleados[] = $empleado;
}

$json = json_encode($empleados);

// Descargar el archivo JSON
header('Content-disposition: attachment; filename=empleados.json');
header('Content-type: application/json');

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

foreach ($empleados as $empleado) {
    echo '<tr>';
    echo '<td>' . $empleado['idEmpleado'] . '</td>';
    echo '<td>' . $empleado['nombre'] . '</td>';
    echo '<td>' . $empleado['cargo'] . '</td>';
    echo '<td>' . $empleado['fechaContratacion'] . '</td>';
    echo '<td>' . $empleado['salario'] . '</td>';
    echo '<td>' . $empleado['estatus'] . '</td>';
    echo '</tr>';
}

echo '</table>';
?>

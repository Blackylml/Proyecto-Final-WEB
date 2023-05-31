<?php
require_once('tcpdf/tcpdf.php');

if (isset($_GET["idEmpleado"])) {
    $idEmpleado = $_GET["idEmpleado"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ropa";
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "UPDATE Empleado SET estatus = 0 WHERE idEmpleado = $idEmpleado";
    $connection->query($sql);
}

// Crear el objeto TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Nombre');
$pdf->SetTitle('Tabla de Empleados');
$pdf->SetSubject('Tabla de Empleados');
$pdf->SetKeywords('Empleados, Tabla, PDF');
$servername = "localhost";
$username = "root";
$password = "";
$database = "ropa";
$connection = new mysqli($servername, $username, $password, $database);

// Agregar una página
$pdf->AddPage();

// Contenido de la tabla
$html = '
<h2>Lista De Empleados</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Cargo</th>
            <th>Fecha de Contratación</th>
            <th>Salario</th>
            <th>Estatus</th>
        </tr>
    </thead>
    <tbody>';

$sql = "SELECT * FROM Empleado WHERE estatus = 1";
$result = $connection->query($sql);

if (!$result) {
    die("Query inválido: " . $connection->error);
}

while ($row = $result->fetch_assoc()) {
    $html .= '
        <tr>
            <td>' . $row["idEmpleado"] . '</td>
            <td>' . $row["nombre"] . '</td>
            <td>' . $row["cargo"] . '</td>
            <td>' . $row["fechaContratacion"] . '</td>
            <td>' . $row["salario"] . '</td>
            <td>' . $row["estatus"] . '</td>
        </tr>';
}

$html .= '
    </tbody>
</table>';

// Generar el contenido HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Cerrar y generar el PDF
$pdf->Output('tabla_empleados.pdf', 'D');
?>

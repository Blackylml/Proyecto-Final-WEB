<?php
require_once('tcpdf/tcpdf.php');

if (isset($_GET["idCliente"])) {
    $idCliente = $_GET["idCliente"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ropa";
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "UPDATE Cliente SET estatus = 0 WHERE idCliente = $idCliente";
    $connection->query($sql);
}

// Crear el objeto TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Nombre');
$pdf->SetTitle('Tabla de Clientes');
$pdf->SetSubject('Tabla de Clientes');
$pdf->SetKeywords('Clientes, Tabla, PDF');
$servername = "localhost";
$username = "root";
$password = "";
$database = "ropa";
$connection = new mysqli($servername, $username, $password, $database);

// Agregar una página
$pdf->AddPage();

// Contenido de la tabla
$html = '
<h2>Lista De Clientes</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Estatus</th>
        </tr>
    </thead>
    <tbody>';

$sql = "SELECT * FROM Cliente WHERE estatus = 1";
$result = $connection->query($sql);

if (!$result) {
    die("Query inválido: " . $connection->error);
}

while ($row = $result->fetch_assoc()) {
    $html .= '
        <tr>
            <td>' . $row["idCliente"] . '</td>
            <td>' . $row["nombre"] . '</td>
            <td>' . $row["correo"] . '</td>
            <td>' . $row["direccion"] . '</td>
            <td>' . $row["telefono"] . '</td>
            <td>' . $row["estatus"] . '</td>
        </tr>';
}

$html .= '
    </tbody>
</table>';

// Generar el contenido HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Cerrar y generar el PDF
$pdf->Output('tabla_clientes.pdf', 'D');
?>

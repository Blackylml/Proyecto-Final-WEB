<?php
require_once('tcpdf/tcpdf.php');

if (isset($_GET["idVenta"])) {
    $idVenta = $_GET["idVenta"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ropa";
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "UPDATE Venta SET estatus = 0 WHERE idVenta = $idVenta";
    $connection->query($sql);
}

// Crear el objeto TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Nombre');
$pdf->SetTitle('Tabla de Ventas');
$pdf->SetSubject('Tabla de Ventas');
$pdf->SetKeywords('Ventas, Tabla, PDF');
$servername = "localhost";
$username = "root";
$password = "";
$database = "ropa";
$connection = new mysqli($servername, $username, $password, $database);

// Agregar una página
$pdf->AddPage();

// Contenido de la tabla
$html = '
<h2>Lista De Ventas</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Total Venta</th>
            <th>Método de Pago</th>
            <th>ID Cliente</th>
            <th>ID Producto</th>
            <th>Estatus</th>
        </tr>
    </thead>
    <tbody>';

$sql = "SELECT * FROM Venta WHERE estatus = 1";
$result = $connection->query($sql);

if (!$result) {
    die("Query inválido: " . $connection->error);
}

while ($row = $result->fetch_assoc()) {
    $html .= '
        <tr>
            <td>' . $row["idVenta"] . '</td>
            <td>' . $row["totalVenta"] . '</td>
            <td>' . $row["MetodoPago"] . '</td>
            <td>' . $row["idCliente"] . '</td>
            <td>' . $row["idProducto"] . '</td>
            <td>' . $row["estatus"] . '</td>
        </tr>';
}

$html .= '
    </tbody>
</table>';

// Generar el contenido HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Cerrar y generar el PDF
$pdf->Output('tabla_ventas.pdf', 'D');
?>

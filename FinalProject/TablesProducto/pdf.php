<?php
require_once('tcpdf/tcpdf.php');

if (isset($_GET["idProducto"])) {
    $idProducto = $_GET["idProducto"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "ropa";
    $connection = new mysqli($servername, $username, $password, $database);

    $sql = "UPDATE Producto SET estatus = 0 WHERE idProducto = $idProducto";
    $connection->query($sql);
}

// Crear el objeto TCPDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Establecer información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Tu Nombre');
$pdf->SetTitle('Tabla de Productos');
$pdf->SetSubject('Tabla de Productos');
$pdf->SetKeywords('Productos, Tabla, PDF');
$servername = "localhost";
$username = "root";
$password = "";
$database = "ropa";
$connection = new mysqli($servername, $username, $password, $database);

// Agregar una página
$pdf->AddPage();

// Contenido de la tabla
$html = '
<h2>Lista De Productos</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Talla</th>
            <th>Marca</th>
            <th>Estatus</th>
        </tr>
    </thead>
    <tbody>';

$sql = "SELECT * FROM Producto WHERE estatus = 1";
$result = $connection->query($sql);

if (!$result) {
    die("Query inválido: " . $connection->error);
}

while ($row = $result->fetch_assoc()) {
    $html .= '
        <tr>
            <td>' . $row["idProducto"] . '</td>
            <td>' . $row["nombre"] . '</td>
            <td>' . $row["precio"] . '</td>
            <td>' . $row["talla"] . '</td>
            <td>' . $row["marca"] . '</td>
            <td>' . $row["estatus"] . '</td>
        </tr>';
}

$html .= '
    </tbody>
</table>';

// Generar el contenido HTML en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Cerrar y generar el PDF
$pdf->Output('tabla_productos.pdf', 'D');
?>

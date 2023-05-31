<?php
require 'PhpSpreadsheet/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

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

// Crear un nuevo objeto Spreadsheet
$spreadsheet = new Spreadsheet();

// Obtener la hoja de cálculo activa
$sheet = $spreadsheet->getActiveSheet();

// Establecer los encabezados de columna
$sheet->setCellValue('A1', 'ID')
      ->setCellValue('B1', 'Nombre')
      ->setCellValue('C1', 'Precio')
      ->setCellValue('D1', 'Talla')
      ->setCellValue('E1', 'Marca')
      ->setCellValue('F1', 'Estatus');

// Rellenar la tabla con los datos de los productos
$row = 2;
while ($row_data = $result->fetch_assoc()) {
    $sheet->setCellValue('A' . $row, $row_data['idProducto'])
          ->setCellValue('B' . $row, $row_data['nombre'])
          ->setCellValue('C' . $row, $row_data['precio'])
          ->setCellValue('D' . $row, $row_data['talla'])
          ->setCellValue('E' . $row, $row_data['marca'])
          ->setCellValue('F' . $row, $row_data['estatus']);
    $row++;
}

// Establecer el ancho de las columnas automáticamente
foreach (range('A', 'F') as $column) {
    $sheet->getColumnDimension($column)->setAutoSize(true);
}

// Crear un escritor para guardar el archivo
$writer = new Xls($spreadsheet);

// Descargar el archivo XLS
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="productos.xls"');
header('Cache-Control: max-age=0');
$writer->save('php://output');
exit;
?>

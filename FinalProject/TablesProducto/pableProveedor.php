<!DOCTYPE html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Lucy</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
  <header class="header">
		<div class="container">
		<div class="btn-menu">
			<label for="btn-menu">☰</label>
	</header>
	<div class="capa"></div>
<!--	--------------->
<input type="checkbox" id="btn-menu">
<div class="container-menu">
	<div class="cont-menu">
		<nav>
        <a href="\web\FinalProject\Tables\pableProveedor.php">Proveedor</a>
			<a href="\web\FinalProject\TablesCliente\pableProveedor.php">Cliente</a>
			<a href="\web\FinalProject\TablesProducto\pableProveedor.php">Producto</a>
			<a href="\web\FinalProject\TablesVenta\pableProveedor.php">Venta</a>
			<a href="\web\FinalProject\TablesEmpleado\pableProveedor.php">Empleado</a>
		</nav>
		<label for="btn-menu">✖️</label>
	</div>
</div>
    <div class = "container my-5">
        <h2>Lista De Productos</h2>
        <a class= "btn btn btn btn-light" href="\web\FinalProject\TablesProducto\create.php" role="button"><i class="bi bi-database-fill-add"></i></a>
        <br>
    <table class="table">
        <thead>
                    <tr> <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Talla</ th>
                    <th>Marca</th>
                    <th>Estatus</th>
                    
                </tr>
            </thead>
        <tbody>
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "ropa";
            $connection = new mysqli($servername, $username, $password, $database);
            if ($connection->connect_error) {
                die("Fallo de conexion: " . $connection->connect_error);
            }

            $sql = "SELECT * FROM Producto WHERE estatus = 1";
            $result = $connection->query($sql);
            
            if (!$result){
                die("Query invalido; " . $connection->error);

            }

            while($row = $result -> fetch_assoc()) {
                echo "
                    <tr>
                        <td>$row[idProducto]</td>
                        <td>$row[nombre]</td>
                        <td>$row[precio]</td>
                        <td>$row[talla]</td>
                        <td>$row[marca]</td>
                        <td>$row[estatus]</td>
                        <td>
                        <a class='btn btn btn-light btn-sm' href='\web\FinalProject\TablesProducto\update.php?idProducto=$row[idProducto]'>Modificar</a>
                        <a class='btn btn btn-light btn-sm' href='\web\FinalProject\TablesProducto\delete.php?idProducto=$row[idProducto]'>Delete</a>
                        </td>
                    </tr>

                ";
            }
            ?>
        <a href="\web\FinalProject\TablesProducto\pdf.php" class="btn btn btn-light"><i class="bi bi-file-earmark-pdf-fill"></i></a>
<a href="\web\FinalProject\TablesProducto\csv.php" class="btn btn btn-light ms-2"><i class="bi bi-filetype-csv"></i></a>
<a href="\web\FinalProject\TablesProducto\xml.php" class="btn btn btn-light ms-2"><i class="bi bi-filetype-xml"></i></a>
<a href="\web\FinalProject\TablesProducto\json.php" class="btn btn btn-light ms-2"><i class="bi bi-filetype-json"></i></a>
<a href="\web\FinalProject\TablesProducto\xls.php" class="btn btn btn-light ms-2"><i class="bi bi-filetype-xls"></i></a>
            

        </tbody>
        </table>
    </div> 
    
</body>
</html>
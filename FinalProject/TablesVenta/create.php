<?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "ropa";
            $connection = new mysqli($servername, $username, $password, $database);

$totalVenta = "";
$MetodoPago = "";
$idCliente = "";
$idProducto = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $totalVenta = $_POST["totalVenta"];
    $MetodoPago = $_POST["MetodoPago"];
    $idCliente = $_POST["idCliente"];
    $idProducto = $_POST["idProducto"];

    do{
        if (empty($totalVenta) || empty($MetodoPago)|| empty($idCliente) || empty($idProducto)) {
            $errorMessage = "llena el resto de campos";
            break;
        }

        $sql = "INSERT INTO Venta (totalVenta, MetodoPago, idCliente, idProducto)" .
                "VALUES ('$totalVenta', '$MetodoPago', '$idCliente', '$idProducto')";
                $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }


        $totalVenta = "";
        $MetodoPago = "";
        $idCliente = "";
        $idProducto = "";
        $successMessage = "Se añadio la venta";
        


    } while(false);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>finalproject</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Nueva Venta</h2>
        <?php
        if (!empty($errorMessage)){
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMessage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            "; 
        }
        ?>
        <form method="post">
            <div class="col-sm-6">
                <label class = "col-sm-3 col-form-label">totalVenta</label>
                <div class="col-sm-6">
                <input type="text" class="from-control" name="totalVenta" value = "<?php echo $totalVenta; ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <label class = "col-sm-3 col-form-label">MetodoPago</label>
                <div class="col-sm-6">
                <input type="text" class="from-control" name="MetodoPago" value = "<?php echo $MetodoPago; ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <label class = "col-sm-3 col-form-label">idCliente</label>
                <div class="col-sm-6">
                <input type="text" class="from-control" name="idCliente" value = "<?php echo $idCliente; ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <label class = "col-sm-3 col-form-label">idProducto</label>
                <div class="col-sm-6">
                <input type="text" class="from-control" name="idProducto" value = "<?php echo $idProducto; ?>">
                </div>
            </div>
            <?php
            if (!empty($successMessage)){
                echo "
                <div class ='row mb-3'>
                <div class='offset-sm-3 col-sm-6'>
                <div class = 'alert alert-success alert-dismissible fade show' role 'alert'>
                <strong>Registro Correcto</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert'>/<button>
                </div>
                </div>
                </div>
                ";

            

            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid" >
                    <button type="submit" class = "btn btn btn-light btn-sm">Agregar</button>
                </div>
                <div class="col-sm-3 d-grid" >
                    <a class="btn btn btn-light btn-sm" href = "\web\FinalProject\TablesVenta\pableProveedor.php" role="button">Regresar</a>
                </div>



        </from>

</div>
    
</body>
</html>
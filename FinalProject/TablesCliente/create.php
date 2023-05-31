<?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "ropa";
            $connection = new mysqli($servername, $username, $password, $database);

$nombre = "";
$correo = "";
$direccion = "";
$telefono = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $direccion = $_POST["direccion"];
    $telefono = $_POST["telefono"];

    do{
        if (empty($nombre) || empty($correo)|| empty($direccion) || empty($telefono)) {
            $errorMessage = "llena el resto de campos";
            break;
        }

        $sql = "INSERT INTO Cliente (nombre, correo, direccion, telefono)" .
                "VALUES ('$nombre', '$correo', '$direccion', '$telefono')";
                $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }


        $nombre = "";
        $correo = "";
        $direccion = "";
        $telefono = "";
        $successMessage = "Se añadio el Cliente";
        


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
        <h2>Nuevo Cliente</h2>
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
                <label class = "col-sm-3 col-form-label">Nombre</label>
                <div class="col-sm-6">
                <input type="text" class="from-control" name="nombre" value = "<?php echo $nombre; ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <label class = "col-sm-3 col-form-label">Correo</label>
                <div class="col-sm-6">
                <input type="text" class="from-control" name="correo" value = "<?php echo $correo; ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <label class = "col-sm-3 col-form-label">Dirrecion</label>
                <div class="col-sm-6">
                <input type="text" class="from-control" name="direccion" value = "<?php echo $direccion; ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <label class = "col-sm-3 col-form-label">Telefono</label>
                <div class="col-sm-6">
                <input type="text" class="from-control" name="telefono" value = "<?php echo $telefono; ?>">
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
                    <a class="btn btn btn-light btn-sm" href = "\web\FinalProject\TablesCliente\pableProveedor.php" role="button">Regresar</a>
                </div>



        </from>

</div>
    
</body>
</html>
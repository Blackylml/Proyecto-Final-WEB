<?php 

$servername = "localhost";
$username = "root";
$password = "";
$database = "ropa";
$connection = new mysqli($servername, $username, $password, $database);
$idEmpleado = "";
$nombre = "";
$cargo = "";
$fechaContratacion = "";
$salario = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER ['REQUEST_METHOD'] == 'GET' ){
    if(!isset ($_GET["idEmpleado"])){
        header("location: TablesEmpleado\pableProveedor.php ");
        exit;
    }
    $idEmpleado = $_GET["idEmpleado"];
    $sql = "SELECT * FROM Empleado WHERE idEmpleado=$idEmpleado";
    $result = $connection ->query($sql);
    $row = $result ->fetch_assoc();
    if (!$row){
        header("location: TablesEmpleado\pableProveedor.php");
        exit;
    }
    $nombre = $row["nombre"];
    $cargo = $row["cargo"];
    $fechaContratacion = $row["fechaContratacion"];
    $salario = $row["salario"];
}
else {
    $idEmpleado = $_POST["idEmpleado"];
    $nombre = $_POST["nombre"];
    $cargo = $_POST["cargo"];
    $fechaContratacion = $_POST["fechaContratacion"];
    $salario = $_POST["salario"];

    do {
        if(empty($idEmpleado) || empty($nombre) || empty($cargo) ||empty($fechaContratacion) || empty($salario) ){
            $errorMessage = "Llena todos los campos";
            break;
        }
        $sql = "UPDATE Empleado " . 
       "SET nombre = '$nombre', cargo = '$cargo', fechaContratacion = '$fechaContratacion', salario = '$salario' " . 
       "WHERE idEmpleado = $idEmpleado";


         $result = $connection->query($sql);
         if(!$result){
            $errorMessage = "query invalido: " . $connection->error;
            break;
         }

    }while(false);
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
        <h2>Nuevo Empleado</h2>
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
            <input type= "hidden" name = "idEmpleado" value="<?php echo $idEmpleado; ?>">
            <div class="col-sm-6">
                <label class = "col-sm-3 col-form-label">Nombre</label>
                <div class="col-sm-6">
                <input type="text" class="from-control" name="nombre" value = "<?php echo $nombre; ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <label class = "col-sm-3 col-form-label">Cargo</label>
                <div class="col-sm-6">
                <input type="text" class="from-control" name="cargo" value = "<?php echo $cargo; ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <label class = "col-sm-3 col-form-label">Fecha De Contratacion</label>
                <div class="col-sm-6">
                <input type="text" class="from-control" name="fechaContratacion" value = "<?php echo $fechaContratacion; ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <label class = "col-sm-3 col-form-label">Salario</label>
                <div class="col-sm-6">
                <input type="text" class="from-control" name="salario" value = "<?php echo $salario; ?>">
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
                    <button type="submit" class = "btn btn btn-light btn-sm">Modificar</button>
                </div>
                <div class="col-sm-3 d-grid" >
                    <a class="btn btn btn-light btn-sm" href = "\web\FinalProject\TablesEmpleado\pableProveedor.php" role="button">Regresar</a>
                </div>



        </from>

</div>
    
</body>
</html>
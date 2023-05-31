<?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "ropa";
            $connection = new mysqli($servername, $username, $password, $database);

$user_name = "";
$password = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $user_name = $_POST["user_name"];
    $password = $_POST["password"];

    do{
        if (empty($user_name) || empty($password)) {
            $errorMessage = "llena el resto de campos";
            break;
        }

        $sql = "INSERT INTO users (user_name, password)" .
                "VALUES ('$user_name', '$password')";
                $result = $connection->query($sql);

        if(!$result){
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }


        $user_name = "";
        $password = "";
        $successMessage = "Se añadio el proveedor";
        


    } while(false);
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="login.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>finalproject</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Nuevo Usuario</h2>
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
                <label class = "col-sm-3 col-form-label">Nombre De Usuario</label>
                <div class="col-sm-6">
                <input type="text" class="from-control" name="user_name" value = "<?php echo $user_name; ?>">
                </div>
            </div>
            <div class="col-sm-6">
                <label class = "col-sm-3 col-form-label">Cotraseña<label>
                <div class="col-sm-6">
                <input type="text" class="from-control" name="password" value = "<?php echo $password; ?>">
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
                    <button type="submit" class = "btn btn btn-light btn-sm" href = "\web\FinalProject\login\" >Agregar</button>
                </div>
                <div class="col-sm-3 d-grid" >
                    <a class="btn btn btn-light btn-sm" href = "\web\FinalProject\login\" role="button">Regresar</a>
                </div>



        </from>

</div>
    
</body>
</html>

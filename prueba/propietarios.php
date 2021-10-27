<?php 
include("db.php");
include("Includes/header.php");
?>
<script src="js/propietario.js"></script>
<div class="container p-4">

    <div class="row">

        <div class="col-md-4"><div class="titulo">
<center><h2>PROPIETARIOS</h2></center></div>
        
            <?php if(isset($_SESSION['message'])){?>
                <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php session_unset();} ?>

            <div class="card card-body">
                <form action="save_register.php" method = "POST">
                    <div class="form-group">
                        <label>Identidad:</label>
                        <input type="number" name = "Identidad_Prop" required class = "form-control" min = "1"
                        placeholder = "Ingrese su Identidad" autofocus>
                    </div>
                    <div class="form-group">
                        
                        <label>Nombre del Propietario:</label>
                        <input type = "text" name="Nombre_Propietario" required pattern = "[a-z A-Z á-ú-ñ Á-Ú-Ñ]+" class = "form-control" minlength = "2"
                        placeholder = "Ingrese su Nombre">
                    </div>
                    <input type="submit" class = "btn btn-dark btn-block"
                    name = "Guardar_Propietario" value = "Guardar">
                </form>
            </div>

        </div> 
        
        <div class="col-md-8">
            <form action="buscar_propietarios.php" method= 'POST' class= "form_search">
            <input type="submit" value= "Buscar" class="btn_search">
        <input type="text" name = "busqueda" id= "busqueda" pattern = "[a-z A-Z Á-Ú 0-9 á-ú Ñ-ñ]+"placeholder = "Buscar">
            </form>

        <div id="tabla_propietario">

        </div>  
        
        </div>

    </div>
    
<div class="TotalRegistro">

    </div>
  
   
    
</div>



<?php include("Includes/footer.php")?>


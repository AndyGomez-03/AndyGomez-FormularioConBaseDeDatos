<?php 
include("db.php");
include("Includes/header.php");
?>
<script src="js/tecnico.js"></script>
<div class="container p-4">

    <div class="row">

        <div class="col-md-4">
 <div class="titulo">
        <center><h2>T&Eacute;CNICOS</h2></center></div>
            <?php if(isset($_SESSION['message'])){?>
                <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php session_unset();} ?>

            <div class="card card-body">
                <form action="save_register.php" method = "POST">
                    
                    <div class="form-group">
                        <label>Nombre del T&eacute;cnico</label>
                        <input type = "text" name="Nombre_Tecnico" required pattern="[a-z A-Z á-ú-ñ Á-Ú-Ñ]+" class = "form-control"
                        placeholder = "Ingrese el nombre del T&eacute;cnico">
                    </div>
                    <input type="submit" class = "btn btn-dark btn-block"
                    name = "Guardar_Tecnico" value = "Guardar">
                </form>
            </div>

        </div> 
        
        <div class="col-md-8">
<form action="buscar_tecnico.php" method="POST" class="form_search">
<input type="submit" value= "Buscar" class="btn_search">
        <input type="text" name = "busqueda" id= "busqueda" pattern = "[a-z A-Z Á-Ú á-ú Ñ-ñ]+"placeholder = "Buscar">
        </form>

                <div id="tabla_tecnico">
                    
                </div>
        </div>
    </div>
    <div class="TotalRegistro">

    </div>

    <div class="paginador">
        <ul class = "paginador">

        </ul>
    </div>

</div>


<?php include("Includes/footer.php")?>
<?php include("db.php");
include("Includes/header.php");?>

<script src="js/revision.js"></script>
<div class="container p-4">

    <div class="row">

        <div class="col-md-4">
<div class="titulo">
        <center><h2>TIPOS DE REVISI&Oacute;N</h2></center></div>
            <?php if(isset($_SESSION['message'])){?>
                <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php session_unset();} ?>

            <div class="card card-body">
                <form action="save_register.php" method = "POST">
                    
                    <div class="form-group">
                        <label>Tipo de Revisi&oacute;n</label>
                        <input type = "text" name="Tipo_Revision" required pattern="[a-z A-Z á-ú-ñ Á-Ú-Ñ]+" class = "form-control" minlength = "2"
                        placeholder = "Ingrese el Tipo de Revisi&oacute;n" autofocus>
                    </div>
                    <input type="submit" class = "btn btn-dark btn-block"
                    name = "Guardar_Revision" value = "Guardar">
                </form>
            </div>

        </div> 
        
        <div class="col-md-8">
        <form action="buscar_TipoRevision.php" method= "POST" class="form_search">
        <input type="submit" value= "Buscar" class="btn_search">
        <input type="text" name = "busqueda" id= "busqueda" pattern = "[a-z A-Z Á-Ú á-ú Ñ-ñ]+" placeholder = "Buscar">
        </form>
           
            <div id="tabla_revision">

            </div>

        </div>
    </div>
    <div class="TotalRegistro">

    </div>
    <div class="paginador">
        <ul class= "paginador"></ul>
    </div>
</div>




<?php include("Includes/footer.php")?>
<?php include("db.php")?>

<?php include("Includes/header.php")?>
<script src="js/mantenimiento.js"></script>
<div class="container p-4">

<div class="row">

        <div class="col-md-4"><div class="titulo">
        <CENTER><H2>TALLER MECANICO</H2></CENTER></div>
            <?php if(isset($_SESSION['message'])){?>
                <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php session_unset();} ?>

            <div class="card card-body">
                <form action="save_register.php" method = "POST">
                    
                    <div class="form-group">
                        <label>Id del Auto:</label>
                        <select name = 'IdAuto_Index' class = "form-control">
                        <option value="0">Ingrese el Id de su Auto/Identidad:</option>
                        <?php 
                         $conId= "SELECT * FROM automoviles";
                         $Concatenar = mysqli_query($conn,$conId);
                         while($obtenId = mysqli_fetch_array($Concatenar)){?>
                        <option value="<?php echo $obtenId['IdAuto']?>"><?php echo $obtenId['Identidad'], "  ",$obtenId['Marca'], "  " ,$obtenId['Modelo']?></option>
                        
                        <?php }?>
                         </select>
                       
                    </div>
                    
                    <div class="form-group">
                        <label>Fecha de Revision:</label>
                        <input type = "date" name="Fecha_Revision" class = "form-control"
                        placeholder = "Ingrese una fecha">
                    </div>
                   
                    <div class="form-group">
                        <label>Tipo de Revision:</label><br>
                        <select name="Lista_Revision" class = "form-control">
                            <option value="0" Selected>Selecciona una revisi&oacute;n...</option>
                            <?php  
                            $conListaRev = "SELECT * FROM tipo_revision";
                            $EnvConListaRev = mysqli_query($conn,$conListaRev);
                            while($ObtenLista = mysqli_fetch_array($EnvConListaRev)){?>
                            <option value="<?php echo $ObtenLista['IdTipo_Revision']?>"><?php echo $ObtenLista['Tipo_Revision']?></option>
                            <?php }?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        
                        <label>Tecnicos:</label><br>
                        <select name="Lista_Tecnicos" required class = "form-control">
                            <option value="0" Selected>Selecciona un t&eacute;cnico...</option>
                            <?php
                            $conListaTec = "SELECT * FROM tecnicos";
                            $EnvConListaTec = mysqli_query($conn,$conListaTec);
                            while($ObtenListaTec = mysqli_fetch_array($EnvConListaTec)){?>
                            <option value="<?php echo $ObtenListaTec['IdTecnico']?>"><?php echo $ObtenListaTec['Nombre_Tecnico']?></option>
                            <?php }?>
                        </select>
                    </div>
                    <div class="d-grid">
                    <input type="submit" class = "btn btn-dark btn-block"
                    name = "save_register" value = "Enviar">
                    </div>
                    
                </form>
            </div>

        </div>  
                          
        <div class="col-md-8">
        
        <form action="buscar_index.php" method = "get" class= "form_search">
        <input type="submit" value = "Buscar" class= "btn_search" id = "boton">
        <input type="text" name = "busqueda" id="busqueda" pattern = "[a-z A-Z Á-Ú 0-9 á-ú Ñ-ñ]+" placeholder = "Buscar">
        </form>
        
            <div id="Filtro_Tabla">

            </div>
                <?php 

                $sql_registe = mysqli_query($conn,"SELECT COUNT( * )  as total_registro FROM mantenimiento");
                $result_register = mysqli_fetch_array($sql_registe);
                $total_registro = $result_register['total_registro'];

                $por_Pagina = 10;

                if(empty($_GET['pagina'])){
                    $pagina = 1;
                }else{
                    $pagina = $_GET['pagina'];
                }

                $desde = ($pagina-1) * $por_Pagina;
                $total_paginas = ceil($total_registro / $por_Pagina);
                
                ?>
                
                
        </div>
       
    </div>
        
</div>

<?php include("Includes/footer.php");?>
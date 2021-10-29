<?php   include("db.php");
include("Includes/header.php");

?>

<div class="container p-4">

    <div class="row">

        <div class="col-md-4">
            <div class="titulo">
<center><h2>AUTOM&Oacute;VILES</h2></center></div>
        
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
                        <select name="Identidad_Auto" required class = "form-control">
                            <option value="0">Ingrese su Identidad...</option>
                            <?php 
                            $conProp= "SELECT * FROM propietarios";
                            $ConcIDProp = mysqli_query($conn,$conProp);
                            while($obtenIdProp = mysqli_fetch_array($ConcIDProp)){?>
                            <option value=<?php echo $obtenIdProp['Identidad']?>><?php echo $obtenIdProp['Identidad']?></option>
                            <?php }?>
                         </select>
                    </div>
                    <div class="form-group">
                        <label>Marca:</label>
                        <input type = "text" name="Marca" required pattern="[a-z A-Z á-ú-ñ Á-Ú-Ñ]+" class = "form-control" minlength = "3"
                        placeholder = "Ingrese la Marca del Auto">
                    </div>
                    <div class="form-group">
                        <label>Modelo:</label>
                        <input type = "text" name="Modelo" required pattern = "[A-Z a-z0-9 á-ú-ñ Á-Ú-Ñ]+" class = "form-control" minlength = "1"
                        placeholder = "Ingrese el Modelo del Auto">
                    </div>
                    <div class="form-group">
                        <label>Año:</label>
                        <input type = "number" name="Anio" required class = "form-control" min = "1"
                        placeholder = "Ingrese el Año del Auto">
                    </div>
                    <input type="submit" class = "btn btn-dark btn-block"
                    name = "Guardar_Auto" value = "Guardar">
                </form>
            </div>

        </div> 
        
        <div class="col-md-8">
            
            <table id = "tabla" class = "table table-bordered row-border ">
                <thead class = "btn-dark">
                    <tr>
                        <th>Id del Auto</th>
                        <th>Identidad</th>
                        <th>Marca</th>
                        <th>Modelo</th>
                        <th>Año</th>
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    $query = "SELECT * FROM taller_mecanico.automoviles";
                    $result_taller = mysqli_query($conn,$query);
                    
                    while($row = mysqli_fetch_array($result_taller)){?>
                        <tr>
                        <td><?php echo $row['IdAuto'] ?></td>
                        <td><?php echo $row['Identidad'] ?></td>
                        <td><?php echo $row['Marca'] ?></td> 
                        <td><?php echo $row['Modelo'] ?></td> 
                        <td><?php echo $row['Anio'] ?></td> 

                            <td>
                                <a href="edit.php?id_Edit_Auto=<?php echo $row['IdAuto']?>" class = "btn btn-secondary">
                                    <i class = "fas fa-marker"></i>
                                </a>
                                <a href="delete_register.php?id_Del_Auto=<?php echo $row['IdAuto']?>" class = "btn btn-danger">
                                    <i class = "far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                   <?php }?>
                </tbody>
            </table>
        </div>
    </div>
    
</div>


<?php include("Includes/footer.php")?>

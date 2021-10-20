<?php 
include("db.php");
include("Includes/header.php");
?>

<div class="container p-4">

    <div class="row">

        <div class="col-md-4">

        
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
                        <input type = "text" name="Nombre_Propietario" required pattern="[a-z A-Z á-ú-ñ Á-Ú-Ñ]+" class = "form-control" minlength = "2"
                        placeholder = "Ingrese su Nombre">
                    </div>
                    <input type="submit" class = "btn btn-dark btn-block"
                    name = "Guardar_Propietario" value = "Guardar">
                </form>
            </div>

        </div> 
        
        <div class="col-md-8">
            <table class = "table table-bordered">
                <thead>
                    <tr>
                        <th>Identidad</th>
                        <th>Nombre del Propietario</th>
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM propietarios";
                    $result_taller = mysqli_query($conn,$query);
                    
                    while($row = mysqli_fetch_array($result_taller)){?>
                        <tr>
                        <td><?php echo $row['Identidad'] ?></td>
                        <td><?php echo $row['Nombre_Propietario'] ?></td> 
                        
                            <td>
                                <a href="edit.php?id_Edit_Prop=<?php echo $row['Identidad']?>" class = "btn btn-secondary">
                                    <i class = "fas fa-marker"></i>
                                </a>
                                <a href="delete_register.php?id_Del_Prop=<?php echo $row['Identidad']?>" class = "btn btn-danger">
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


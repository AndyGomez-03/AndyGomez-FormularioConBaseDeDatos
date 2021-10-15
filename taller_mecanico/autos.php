<?php   include("db.php");
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
                        <label>Id del Auto:</label>
                        <input type="number" name = "IdAuto" class = "form-control" min = "0"
                        placeholder = "Ingrese Id del Auto" autofocus>
                    </div>
                    <div class="form-group">
                        <label>Identidad:</label>
                        <input type = "text" name="Identidad_Auto" class = "form-control"
                        placeholder = "Ingrese su Identidad">
                    </div>
                    <div class="form-group">
                        <label>Marca:</label>
                        <input type = "text" name="Marca" class = "form-control"
                        placeholder = "Ingrese la Marca del Auto">
                    </div>
                    <div class="form-group">
                        <label>Modelo:</label>
                        <input type = "text" name="Modelo" class = "form-control"
                        placeholder = "Ingrese el Modelo del Auto">
                    </div>
                    <div class="form-group">
                        <label>Año:</label>
                        <input type = "number" name="Anio" class = "form-control" min = "0"
                        placeholder = "Ingrese el Año del Auto">
                    </div>
                    <input type="submit" class = "btn btn-dark btn-block"
                    name = "Guardar_Auto" value = "Guardar">
                </form>
            </div>

        </div> 
        
        <div class="col-md-8">
            <table class = "table table-bordered">
                <thead>
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

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
                        <label>Id del T&eacute;cnico</label>
                        <input type="number" name = "IdTecnico" class = "form-control" min = "0"
                        placeholder = "Ingrese Id del T&eacute;cnico" autofocus>
                    </div>
                    <div class="form-group">
                        <label>Nombre del T&eacute;cnico</label>
                        <input type = "text" name="Nombre_Tecnico"  rows="2" class = "form-control"
                        placeholder = "Ingrese el nombre del T&eacute;cnico">
                    </div>
                    <input type="submit" class = "btn btn-dark btn-block"
                    name = "Guardar_Tecnico" value = "Guardar">
                </form>
            </div>

        </div> 
        
        <div class="col-md-8">
            <table class = "table table-bordered">
                <thead>
                    <tr>
                        <th>Id T&eacute;cnico</th>
                        <th>Nombre del T&eacute;cnico</th>
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM taller_mecanico.tecnicos";
                    $result_taller = mysqli_query($conn,$query);
                    
                    while($row = mysqli_fetch_array($result_taller)){?>
                        <tr>
                        <td><?php echo $row['IdTecnico'] ?></td>
                        <td><?php echo $row['Nombre_Tecnico'] ?></td> 
                        
                            <td>
                                <a href="edit.php?id_Edit_Tecnico=<?php echo $row['IdTecnico']?>" class = "btn btn-secondary">
                                    <i class = "fas fa-marker"></i>
                                </a>
                                <a href="delete_register.php?id_Del_Tecnico=<?php echo $row['IdTecnico']?>" class = "btn btn-danger">
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
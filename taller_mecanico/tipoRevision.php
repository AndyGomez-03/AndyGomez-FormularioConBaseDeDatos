<?php include("db.php");
include("Includes/header.php");?>


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
                        <label>Tipo de Revisi&oacute;n</label>
                        <input type = "text" name="Tipo_Revision" required pattern = "[A-Za-Za]+" class = "form-control" minlength = "2"
                        placeholder = "Ingrese el Tipo de Revisi&oacute;n">
                    </div>
                    <input type="submit" class = "btn btn-dark btn-block"
                    name = "Guardar_Revision" value = "Guardar">
                </form>
            </div>

        </div> 
        
        <div class="col-md-8">
            <table class = "table table-bordered">
                <thead>
                    <tr>
                        <th>Id Tipo de Revisi&oacute;n</th>
                        <th>Tipo de Revisi&oacute;n</th>
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM taller_mecanico.tipo_revision";
                    $result_taller = mysqli_query($conn,$query);
                    
                    while($row = mysqli_fetch_array($result_taller)){?>
                        <tr>
                        <td><?php echo $row['IdTipo_Revision'] ?></td>
                        <td><?php echo $row['Tipo_Revision'] ?></td> 
                        
                            <td>
                                <a href="edit.php?id_Edit_Rev=<?php echo $row['IdTipo_Revision']?>" class = "btn btn-secondary">
                                    <i class = "fas fa-marker"></i>
                                </a>
                                <a href="delete_register.php?id_Del_Rev=<?php echo $row['IdTipo_Revision']?>" class = "btn btn-danger">
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
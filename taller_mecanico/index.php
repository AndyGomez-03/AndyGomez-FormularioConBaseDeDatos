<?php include("db.php")?>

<?php include("Includes/header.php")?>

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
                        <input type="number" name = "IdAuto_Index" class = "form-control" min = "0"
                        placeholder = "Ingrese el Id de su Auto" autofocus>
                    </div>
                    <div class="form-group">
                        <label>Fecha de Revision:</label>
                        <input type = "date" name="Fecha_Revision" class = "form-control"
                        placeholder = "Ingrese una fecha">
                    </div>
                    <div class="form-group">
                        <label>Tipo de Revision:</label><br>
                        <select name="Lista_Revision" class = "form-control" min = "1" max = "15">
                            <option value="0" Selected>Selecciona una revisi&oacute;n...</option>
                            <option value="1">1) Cambio de Aceite</option>
                            <option value="2">2) Cambio de Llantas</option>
                            <option value="3">3) Luces</option>
                            <option value="4">4) Frenos</option>
                            <option value="5">5) Aceite</option>
                            <option value="6">6) Bater&iacute;a</option>
                            <option value="7">7) Filtros</option>
                            <option value="8">8) Amortiguadores</option>
                            <option value="9">9) Correa de Distribuci&oacute;n</option>
                            <option value="10">10) Sistema de Escape y Catalizadores</option>
                            <option value="11">11) Alineaci&oacute;n y Balanceo</option>
                            <option value="12">12) Limpiaparabrisas</option>
                            <option value="13">13) Sistema de Enfriamiento</option>
                            <option value="14">14) Motor</option>
                            <option value="15">15) Cajas de Cambio</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label>Tecnicos:</label><br>
                        <select name="Lista_Tecnicos" class = "form-control" min = "1" max = "8">
                            <option value="0" Selected>Selecciona una t&eacute;cnico...</option>
                            <option value="1">1) Julio</option>
                            <option value="2">2) Raul</option>
                            <option value="3">3) Marco</option>
                            <option value="4">4) Esteban</option>
                            <option value="5">5) Joseph</option>
                            <option value="6">6) Alejandro</option>
                            <option value="7">7) Carlos</option>
                            <option value="8">8) Maria</option>
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
            
            <table class = "table table-bordered">
                <thead>
                    <tr>
                        <th>Id Mantenimiento</th>
                        <th>Id Auto</th>
                        <th>Fecha de Revisi&oacute;n</th>
                        <th>Id Tipo de Revisi&oacute;n</th>
                        <th>Id T&eacute;cnico</th>
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM taller_mecanico.mantenimiento";
                    $result_taller = mysqli_query($conn,$query);
                    
                    while($row = mysqli_fetch_array($result_taller)){?>
                        <tr>
                            <td><?php echo $row['IdMantenimiento'] ?></td>
                            <td><?php echo $row['IdAuto'] ?></td>
                            <td><?php echo $row['Fecha_Revision'] ?></td>
                            <td><?php echo $row['IdTipo_Revision'] ?></td>
                            <td><?php echo $row['IdTecnico'] ?></td>
                            <td>
                                <a href="edit.php?id_Edit_Index=<?php echo $row['IdMantenimiento']?>" class = "btn btn-secondary">
                                    <i class = "fas fa-marker"></i>
                                </a>
                                <a href="delete_register.php?id_Del_Index=<?php echo $row['IdMantenimiento']?>" class = "btn btn-danger">
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











<?php include("Includes/footer.php");?>
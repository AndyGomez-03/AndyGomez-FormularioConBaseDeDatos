<?php include("db.php")?>

<?php include("Includes/header.php")?>

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
                        <label>Identidad / Auto:</label>
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
        
            <table id = "tabla" class = "table table-bordered row-border">
                <thead class = "btn-dark">
                    <tr>
                        <th>Id Mantenimiento</th>
                        <th>Dueño</th>
                        <th>Auto</th>
                        <th>Fecha de Revisi&oacute;n</th>
                        <th>Tipo de Revisi&oacute;n</th>
                        <th>T&eacute;cnico</th>
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>
            
                <tbody>
                    
                    <?php
                    $query = "SELECT * FROM mantenimiento";
                    $result_taller = mysqli_query($conn,$query);
                    while($row = mysqli_fetch_array($result_taller)){
                        #IMPRIMIR NOMBRE DE TECNICOS
                        $idMante = $row['IdTecnico'];
                        $conTec = "SELECT * FROM tecnicos where IdTecnico = $idMante";
                        $EnvConTec = mysqli_query($conn,$conTec);
                        $Tec = mysqli_fetch_array($EnvConTec);
                        #IMPRIMIR NOMBRE DE TIPO DE REVISION
                        $idTipRev = $row['IdTipo_Revision'];
                        $conTipRev = "SELECT * FROM tipo_revision where IdTipo_Revision = $idTipRev";
                        $EnvConTipRev = mysqli_query($conn,$conTipRev);
                        $Nom = mysqli_fetch_array($EnvConTipRev);
                        #IMPRIMIR NOMBRE DE DUEÑO
                        $idTipAuto = $row['IdAuto'];
                        $conIdAuto = "SELECT * from automoviles where IdAuto = $idTipAuto";
                        $EnvConIdAuto = mysqli_query($conn,$conIdAuto);
                        $IdProp = mysqli_fetch_array($EnvConIdAuto);
                        $identidad = $IdProp['Identidad'];
                        $conProp = "SELECT * FROM propietarios where Identidad = $identidad";
                        $EnvConProp = mysqli_query($conn,$conProp);
                        $NomProp = mysqli_fetch_array($EnvConProp);
                        #IMPRIMIR MARCA Y MODELO
                        $IdAuto = $row['IdAuto'];
                        $conAuto = "SELECT * from automoviles where IdAuto = $idTipAuto";
                        $EnvConAuto = mysqli_query($conn,$conAuto);
                        $conMarcaModelo = mysqli_fetch_array($EnvConAuto);
                        #FORMATO DE FECHA
                        $Mante = $row['IdMantenimiento'];
                        $CONSULTA = "SELECT * From mantenimiento where IdMantenimiento = $Mante";
                        $conFecha = mysqli_query($conn,$CONSULTA);
                        $Fecha = mysqli_fetch_array($conFecha);
                        $ConsulFecha = "SELECT DATE_FORMAT(Fecha_Revision,'%d/%m/%Y') as Fecha from mantenimiento where IdMantenimiento = $Mante";
                        $EnvConFecha = mysqli_query($conn,$ConsulFecha);
                        $convertida = mysqli_fetch_array($EnvConFecha);
                        ?>
                        <div class="alinear">
                        <tr>
                            <td><?php echo $row['IdMantenimiento'] ?></td>
                            <td><?php echo $NomProp['Nombre_Propietario']?></td>
                            <td><?php echo $conMarcaModelo['Marca'], " ",$conMarcaModelo['Modelo']?></td>
                            <td><?php echo $convertida['Fecha'] ?></td>
                            <td><?php echo $Nom['Tipo_Revision'] ?></td>
                            <td><?php echo $Tec['Nombre_Tecnico'] ?></td>
                            <td><div class="enlace">
                                <a href="edit.php?id_Edit_Index=<?php echo $row['IdMantenimiento']?>" class = "btn btn-secondary">
                                    <i class = "fas fa-marker"></i>
                                </a></div>
                                <a href="delete_register.php?id_Del_Index=<?php echo $row['IdMantenimiento']?>" class = "btn btn-danger">
                                    <i class = "far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        </div>
                   <?php }?>
                </tbody>
                
            </table>
           
        </div>
       
    </div>
        

</div>










<?php include("Includes/footer.php");?>
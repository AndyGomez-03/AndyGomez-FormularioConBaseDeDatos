<?php include("db.php")?>

<?php include("Includes/header.php")?>

<div class="container p-4">

<div class="row">

        <div class="col-md-4"><div class="titulo">
        <CENTER><H2 class = "letras">TALLER MECANICO</H2></CENTER></div>
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
        <!---------------------------BUSCADOR---------------------------------->
        <?php $busqueda = strtolower($_REQUEST['busqueda']);
        if(empty($busqueda)){
            header("Location: index.php");
        }
        ?>

            <form action="buscar_index.php" method = "get" class= "form_search">
        <input type="submit" value= "Buscar" class="btn_search">

        <input type="text" name = "busqueda" id= "busqueda" pattern = "[a-z A-Z Á-Ú 0-9 á-ú Ñ-ñ]+" placeholder = "Buscar" value="<?php echo $busqueda;?>">
            </form>

<!---------------------------------------------------------------------------------------->
<?php 
                $sql_registe = mysqli_query($conn,"SELECT COUNT( * ) AS total_registro
                FROM mantenimiento
                INNER JOIN automoviles ON mantenimiento.IdAuto = automoviles.IdAuto
                INNER JOIN tecnicos ON mantenimiento.IdTecnico = tecnicos.IdTecnico
                INNER JOIN tipo_revision ON mantenimiento.IdTipo_Revision = tipo_revision.IdTipo_Revision
                INNER JOIN propietarios ON automoviles.Identidad = propietarios.Identidad
                    Where(
                        Nombre_Propietario Like '%$busqueda%' OR
                        Marca Like '%$busqueda%' OR
                        Tipo_Revision Like '%$busqueda%' OR
                        Nombre_Tecnico Like '%$busqueda%' OR 
                        Fecha_Revision Like '%$busqueda%' Or
                        automoviles.Identidad Like '%$busqueda%'
                    )");
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
            <table class = "table table-bordered">
                <?php if($total_registro !=0){?>
            <div class="TotalRegistro">
        Mostrando <?php echo $desde+1;?> a <?php if($desde+$por_Pagina <= $total_registro){
    echo $desde + $por_Pagina;}else{ echo $total_registro;}?> de <?php echo $total_registro;?> registro (s)</div><?php }?>
                <thead>
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
                    $query = "SELECT *
                    FROM mantenimiento
                    INNER JOIN automoviles ON mantenimiento.IdAuto = automoviles.IdAuto
                    INNER JOIN tecnicos ON mantenimiento.IdTecnico = tecnicos.IdTecnico
                    INNER JOIN tipo_revision ON mantenimiento.IdTipo_Revision = tipo_revision.IdTipo_Revision
                    INNER JOIN propietarios ON automoviles.Identidad = propietarios.Identidad
                    Where(
                        Nombre_Propietario Like '%$busqueda%' OR
                        Marca Like '%$busqueda%' OR
                        Tipo_Revision Like '%$busqueda%' OR
                        Nombre_Tecnico Like '%$busqueda%' OR 
                        Fecha_Revision Like '%$busqueda%'Or
                        automoviles.Identidad Like '%$busqueda%'
                    )ORDER BY IdMantenimiento ASC
                    LIMIT $desde,$por_Pagina";
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
    <?php 
$primera = $pagina -($pagina % 5) +1;
if($primera > $pagina){
    $primera = $primera-5;
}
$ultima = $primera +4 > $total_paginas ? $total_paginas : $primera + 4;
?>
<?php if($total_registro != 0){?>
    <div class="TotalRegistro">
        Mostrando <?php echo $desde+1;?> a <?php if($desde+$por_Pagina <= $total_registro){
    echo $desde + $por_Pagina;}else{ echo $total_registro;}?> de <?php echo $total_registro;?> registro (s)</div>
<div class="paginador">
            <ul>
            
                <?php 
                
                if($pagina != 1){?>
                <li class= "anterior"> <a href="?pagina=<?php echo $pagina-1;?>&busqueda=<?php echo $busqueda;?>">Anterior </a> </li>
                <li> <a href="?pagina=<?php echo 1;?>&busqueda=<?php echo $busqueda;?>"> 1 </a> </li>
                <li><a href="?pagina=<?php if($primera-1 == 0){echo 1;} else{
                    echo $primera-1;}
                    ?>&busqueda=<?php echo $busqueda;?>">...</a></li>
                <?php 
                }
                
                   
                for($i = $primera; $i <= $ultima; $i++){
                    if($i <= -1){ 
                        $i = 1;
                    }
                    if($i == $pagina){
                        echo '<li class= "PageSelected">'.$i.'</li>';  
                    }else{
                        echo '<li> <a href = "?pagina='.$i.'&busqueda='.$busqueda.'">'.$i.'</a></li>';
                    }  
                }
            
                if($pagina != $total_paginas){
                ?>
                <li> <a href="?pagina=<?php if($ultima+1 >$total_paginas){echo $total_paginas;}else{
                echo $ultima+1;}
                    ?>&busqueda=<?php echo $busqueda;?>"> ... </a> </li>
                <li> <a href="?pagina=<?php echo $total_paginas;?>&busqueda=<?php echo $busqueda;?>"> <?php echo $total_paginas?> </a> </li>
                <div class="siguiente">
                <li> <a href="?pagina=<?php echo $pagina+1;?>&busqueda=<?php echo $busqueda;?>">Siguiente</a></li></div>
                <?php }?>
                
                
            </ul>
        </div>
        <?php }?>
</div>

<?php include("Includes/footer.php");?>
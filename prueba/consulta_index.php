<?php include("db.php");

$tabla="";
if(empty($_POST['consulta'])){
$sql_registe = mysqli_query($conn,"SELECT COUNT(IdMantenimiento)  as total_registro FROM mantenimiento");
                $result_register = mysqli_fetch_array($sql_registe);
                $total_registro = $result_register['total_registro'];

                $por_Pagina = 10;
                
                if(empty($_GET['pagina'])){
                    $pagina=1;
                }else{
                    $pagina = $_GET['pagina'];
                }   
                
                $desde = ($pagina-1) * $por_Pagina;
                $total_paginas = ceil($total_registro / $por_Pagina);
                ?>
                <div class="TotalRegistro">
                Mostrando <?php echo $desde+1;?> a <?php if($desde+$por_Pagina <= $total_registro){
            echo $desde + $por_Pagina;}else{ echo $total_registro;}?> de <?php echo $total_registro;?> registro (s)</div>
<?php $query="SELECT * FROM mantenimiento ORDER BY IdMantenimiento LIMIT $desde,$por_Pagina"; }

if(isset($_POST['consulta'])){?>

     <?php
    $q=$conn->real_escape_string($_REQUEST['consulta']);
    $sql_registe = mysqli_query($conn,"SELECT COUNT( * )  as total_registro FROM mantenimiento
    INNER JOIN automoviles ON mantenimiento.IdAuto = automoviles.IdAuto
                INNER JOIN tecnicos ON mantenimiento.IdTecnico = tecnicos.IdTecnico
                INNER JOIN tipo_revision ON mantenimiento.IdTipo_Revision = tipo_revision.IdTipo_Revision
                INNER JOIN propietarios ON automoviles.Identidad = propietarios.Identidad
                Where
                (
                    Nombre_Propietario Like '%".$q."%' OR
                        Marca Like '%".$q."%' OR
                        Tipo_Revision Like '%".$q."%' OR
                        Nombre_Tecnico Like '%".$q."%' OR 
                        Fecha_Revision Like '%".$q."%' Or
                        automoviles.Identidad Like '%".$q."%'
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
               
       
    $query="SELECT * FROM mantenimiento
    INNER JOIN automoviles ON mantenimiento.IdAuto = automoviles.IdAuto
                INNER JOIN tecnicos ON mantenimiento.IdTecnico = tecnicos.IdTecnico
                INNER JOIN tipo_revision ON mantenimiento.IdTipo_Revision = tipo_revision.IdTipo_Revision
                INNER JOIN propietarios ON automoviles.Identidad = propietarios.Identidad
                Where
                (
                    Nombre_Propietario Like '%".$q."%' OR
                        Marca Like '%".$q."%' OR
                        Tipo_Revision Like '%".$q."%' OR
                        Nombre_Tecnico Like '%".$q."%' OR 
                        Fecha_Revision Like '%".$q."%' Or
                        automoviles.Identidad Like '%".$q."%'
                ) ORDER BY IdMantenimiento";
     
$primera = $pagina -($pagina % 5) +1;
if($primera > $pagina){
    $primera = $primera-5;
}
$ultima = $primera +4 > $total_paginas ? $total_paginas : $primera + 4;
?>
<?php if($total_registro != 0){?>
    

        <div class="TotalRegistro">
        Mostrando <?php echo $total_registro;?> registro (s)</div>
        <?php }?>
   <?php 
}

$buscarRegistro = $conn->query($query);
if($buscarRegistro->num_rows > 0){
   
    $tabla.='<div id ="Filtro_Tabla">
    <table id = "Filtro_Tabla" class = "table table-bordered">
        <tr>
            <th>Id del Mantenimiento</th>
            <th>Dueño</th>
            <th>Marca</th>
            <th>Fecha de Revision</th>
            <th>Tipo de Revision</th>
            <th>Tecnico</th>
            <th>Accion</th>
        </tr>';
      
    while($Fila = mysqli_fetch_array($buscarRegistro)){
        #IMPRIMIR NOMBRE DE TECNICOS
        $idMante = $Fila['IdTecnico'];
        $conTec = "SELECT * FROM tecnicos where IdTecnico = $idMante";
        $EnvConTec = mysqli_query($conn,$conTec);
        $Tec = mysqli_fetch_array($EnvConTec);
        #IMPRIMIR NOMBRE DE TIPO DE REVISION
        $idTipRev = $Fila['IdTipo_Revision'];
        $conTipRev = "SELECT * FROM tipo_revision where IdTipo_Revision = $idTipRev";
        $EnvConTipRev = mysqli_query($conn,$conTipRev);
        $Nom = mysqli_fetch_array($EnvConTipRev);
        #IMPRIMIR NOMBRE DE DUEÑO
        $idTipAuto = $Fila['IdAuto'];
        $conIdAuto = "SELECT * from automoviles where IdAuto = $idTipAuto";
        $EnvConIdAuto = mysqli_query($conn,$conIdAuto);
        $IdProp = mysqli_fetch_array($EnvConIdAuto);
        $identidad = $IdProp['Identidad'];
        $conProp = "SELECT * FROM propietarios where Identidad = $identidad";
        $EnvConProp = mysqli_query($conn,$conProp);
        $NomProp = mysqli_fetch_array($EnvConProp);
        #IMPRIMIR MARCA Y MODELO
        $IdAuto = $Fila['IdAuto'];
        $conAuto = "SELECT * from automoviles where IdAuto = $idTipAuto";
        $EnvConAuto = mysqli_query($conn,$conAuto);
        $conMarcaModelo = mysqli_fetch_array($EnvConAuto);
        #FORMATO DE FECHA
        $Mante = $Fila['IdMantenimiento'];
        $CONSULTA = "SELECT * From mantenimiento where IdMantenimiento = $Mante";
        $conFecha = mysqli_query($conn,$CONSULTA);
        $Fecha = mysqli_fetch_array($conFecha);
        $ConsulFecha = "SELECT DATE_FORMAT(Fecha_Revision,'%d/%m/%Y') as Fecha from mantenimiento where IdMantenimiento = $Mante";
        $EnvConFecha = mysqli_query($conn,$ConsulFecha);
        $convertida = mysqli_fetch_array($EnvConFecha);
        $tabla.='
            <tr>
            <td>'.$Fila['IdMantenimiento'].'</td>
            <td>'.$NomProp['Nombre_Propietario'].'</td>
            <td>'.$conMarcaModelo['Marca'].'</td> 
            <td>'.$convertida['Fecha'].'</td> 
            <td>'.$Nom['Tipo_Revision'].'</td>
            <td>'.$Tec['Nombre_Tecnico'].'</td>
            <td>
            <a href="edit.php?id_Edit_Index='.$Fila["IdMantenimiento"].'" class = "btn btn-secondary">
                <i class = "fas fa-marker"></i>
            </a>
            <a href="delete_register.php?id_Del_Index='.$Fila["IdMantenimiento"].'" class = "btn btn-danger">
                <i class = "far fa-trash-alt"></i>
            </a>
            </td> 
            </tr>';
    }
    $tabla.='</tabla>';
    
}else{
    $tabla="NO SE ENCONTRO NADA";
}
echo $tabla;
?>



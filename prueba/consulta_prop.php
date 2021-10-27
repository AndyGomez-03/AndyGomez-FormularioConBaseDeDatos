<?php 
include("db.php");

$tabla="";
if(empty($_POST['consulta'])){
$sql_registe = mysqli_query($conn,"SELECT COUNT(Identidad)  as total_registro FROM propietarios");
                $result_register = mysqli_fetch_array($sql_registe);
                $total_registro = $result_register['total_registro'];

                $por_Pagina = 10;
                
                if(empty($_GET['pag'])){
                    $pagina=1;
                }else{
                    $pagina = $_GET['pag'];
                }   
                
                $desde = ($pagina-1) * $por_Pagina;
                $total_paginas = ceil($total_registro / $por_Pagina);
                ?>
                <div class="TotalRegistro">
                Mostrando <?php echo $desde+1;?> a <?php if($desde+$por_Pagina <= $total_registro){
            echo $desde + $por_Pagina;}else{ echo $total_registro;}?> de <?php echo $total_registro;?> registro (s)</div>
<?php $query="SELECT * FROM propietarios ORDER BY Identidad LIMIT $desde,$por_Pagina"; }


if(isset($_POST['consulta'])){?>

     <?php
    $q=$conn->real_escape_string($_REQUEST['consulta']);
    $sql_registe = mysqli_query($conn,"SELECT COUNT( * )  as total_registro FROM propietarios
                Where
                (
                    Nombre_Propietario Like '%".$q."%' OR
                    Identidad Like '%".$q."%'
                )");
                $result_register = mysqli_fetch_array($sql_registe);
                $total_registro = $result_register['total_registro'];

                $por_Pagina = 10;

                if(empty($_GET['pag'])){
                   $pagina = 1;
                }else{
                    $pagina = $_GET['pag'];
                } 
                $desde = ($pagina-1) * $por_Pagina;
                $total_paginas = ceil($total_registro / $por_Pagina);
               
                
    $query="SELECT * FROM propietarios WHERE
    Nombre_Propietario Like '%".$q."%' OR
    Identidad Like '%".$q."%' LIMIT $desde,$por_Pagina";
    
    if($total_registro !=0){
    ?>
    <div class="TotalRegistro">
        Mostrando <?php echo $desde+1;?> a <?php if($desde+$por_Pagina <= $total_registro){
    echo $desde + $por_Pagina;}else{ echo $total_registro;}?> de <?php echo $total_registro;?> registro (s)</div>
        
   <?php }
}

$buscarRegistro = $conn->query($query);
if($buscarRegistro->num_rows > 0){
   
    $tabla.='<div id ="tabla_propietario">
    <table id = "tabla_propietario" class = "table table-bordered">
        <tr>
            <th>Identidad</th>
            <th>Propietario</th>
            <th>Accion</th>
        </tr>';
      
    while($Fila = mysqli_fetch_array($buscarRegistro)){
        
        $tabla.='
            <tr>
            <td>'.$Fila['Identidad'].'</td>
            <td>'.$Fila['Nombre_Propietario'].'</td>
            <td>
            <a href="edit.php?id_Edit_Prop='.$Fila["Identidad"].'" class = "btn btn-secondary">
                <i class = "fas fa-marker"></i>
            </a>
            <a href="delete_register.php?id_Del_Prop='.$Fila["Identidad"].'" class = "btn btn-danger">
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



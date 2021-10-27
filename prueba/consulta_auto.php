<?php include("db.php");

$tabla="";
if(empty($_POST['consulta'])){
$sql_registe = mysqli_query($conn,"SELECT COUNT(IdAuto)  as total_registro FROM automoviles");
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
<?php $query="SELECT * FROM automoviles ORDER BY IdAuto LIMIT $desde,$por_Pagina"; }

if(isset($_POST['consulta'])){?>

     <?php
    $q=$conn->real_escape_string($_REQUEST['consulta']);
    $sql_registe = mysqli_query($conn,"SELECT COUNT( * )  as total_registro FROM automoviles
                Where
                (
                    Identidad Like '%".$q."%' OR
                    Marca Like '%".$q."%'
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
               
       
    $query="SELECT * FROM automoviles WHERE
    Identidad Like '%".$q."%' OR
    Marca Like '%".$q."%' ";
     
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
   
    $tabla.='<div id ="tabla_resultado">
    <table id = "tabla_resultado" class = "table table-bordered">
        <tr>
            <th>Id del Auto</th>
            <th>Identidad</th>
            <th>Marca</th>
            <th>Modelo</th>
            <th>Año</th>
            <th>Accion</th>
        </tr>';
      
    while($Fila = mysqli_fetch_array($buscarRegistro)){
        
        $tabla.='
            <tr>
            <td>'.$Fila['IdAuto'].'</td>
            <td>'.$Fila['Identidad'].'</td>
            <td>'.$Fila['Marca'].'</td> 
            <td>'.$Fila['Modelo'].'</td> 
            <td>'.$Fila['Anio'].'</td>
            <td>
            <a href="edit.php?id_Edit_Auto='.$Fila["IdAuto"].'" class = "btn btn-secondary">
                <i class = "fas fa-marker"></i>
            </a>
            <a href="delete_register.php?id_Del_Auto='.$Fila["IdAuto"].'" class = "btn btn-danger">
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



<?php 
include("db.php");

$tabla="";

$sql_registe = mysqli_query($conn,"SELECT COUNT(IdTecnico)  as total_registro FROM tecnicos");
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

$query="SELECT * FROM tecnicos ORDER BY IdTecnico LIMIT $desde,$por_Pagina"; 

if(isset($_POST['consulta'])){?>

     <?php
    $q=$conn->real_escape_string($_REQUEST['consulta']);
    $sql_registe = mysqli_query($conn,"SELECT COUNT( * )  as total_registro FROM tecnicos
                Where
                (
                    Nombre_Tecnico Like '%".$q."%'
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
               
       
    $query="SELECT * FROM tecnicos WHERE
    Nombre_Tecnico Like '%".$q."%'";
     
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
</div>


   <?php 
}

$buscarRegistro = $conn->query($query);
if($buscarRegistro->num_rows > 0){
   
    $tabla.='<div id ="tabla_tecnico">
    <table id = "tabla_tecnico" class = "table table-bordered">
        <tr>
            <th>IdTecnico</th>
            <th>Nombre_Tecnico</th>
            <th>Accion</th>
        </tr>';
      
    while($Fila = mysqli_fetch_array($buscarRegistro)){
        
        $tabla.='
            <tr>
            <td>'.$Fila['IdTecnico'].'</td>
            <td>'.$Fila['Nombre_Tecnico'].'</td>
            <td>
            <a href="edit.php?id_Edit_Tecnico='.$Fila["IdTecnico"].'" class = "btn btn-secondary">
                <i class = "fas fa-marker"></i>
            </a>
            <a href="delete_register.php?id_Del_Tecnico='.$Fila["IdTecnico"].'" class = "btn btn-danger">
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



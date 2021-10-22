<?php 
include("db.php");
include("Includes/header.php");
?>

<div class="container p-4">

    <div class="row">

        <div class="col-md-4"><div class="titulo">
<center><h2>PROPIETARIOS</h2></center></div>
        
            <?php if(isset($_SESSION['message'])){?>
                <div class="alert alert-<?= $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                <?= $_SESSION['message'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php session_unset();} ?>

            <div class="card card-body">
                <form action="save_register.php" method = "POST">
                    <div class="form-group">
                        <label>Identidad:</label>
                        <input type="number" name = "Identidad_Prop" required class = "form-control" min = "1"
                        placeholder = "Ingrese su Identidad" autofocus>
                    </div>
                    <div class="form-group">
                        
                        <label>Nombre del Propietario:</label>
                        <input type = "text" name="Nombre_Propietario" required pattern="[a-z A-Z á-ú-ñ Á-Ú-Ñ]+" class = "form-control" minlength = "2"
                        placeholder = "Ingrese su Nombre">
                    </div>
                    <input type="submit" class = "btn btn-dark btn-block"
                    name = "Guardar_Propietario" value = "Guardar">
                </form>
            </div>

        </div> 
        
        <div class="col-md-8">
            <!---------------------------BUSCADOR---------------------------------->
        <?php $busqueda = strtolower($_REQUEST['busqueda']);
        if(empty($busqueda)){
            header("Location: propietarios.php");
        }
        ?>

            <form action="buscar_propietarios.php" method = "get" class= "form_search">
            <input type="submit" value= "Buscar" class="btn_search">
        <input type="text" name = "busqueda" id= "busqueda" pattern = "[a-z A-Z Á-Ú á-ú Ñ-ñ 0-9]+"placeholder = "Buscar" value="<?php echo $busqueda;?>">
        
            </form>
<!---------------------------------------------------------------------------------------->
            <table class = "table table-bordered">
                <thead>
                    <tr>
                        <th>Identidad</th>
                        <th>Nombre del Propietario</th>
                        <th>Acci&oacute;n</th>
                    </tr>
                </thead>

                <?php 
                $sql_registe = mysqli_query($conn,"SELECT COUNT( * )  as total_registro FROM propietarios
                Where
                (
                    Identidad Like '%$busqueda%' OR
                    Nombre_Propietario Like '%$busqueda%'
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

                <tbody>
                    <?php
                    $query = "SELECT * FROM propietarios 
                    Where
                    (
                        Identidad Like '%$busqueda%' OR
                        Nombre_Propietario Like '%$busqueda%'
                    )
                    LIMIT $desde,$por_Pagina";
                    $result_taller = mysqli_query($conn,$query);
                    
                    while($row = mysqli_fetch_array($result_taller)){?>
                        <tr>
                        <td><?php echo $row['Identidad'] ?></td>
                        <td><?php echo $row['Nombre_Propietario'] ?></td> 
                        
                            <td>
                                <a href="edit.php?id_Edit_Prop=<?php echo $row['Identidad']?>" class = "btn btn-secondary">
                                    <i class = "fas fa-marker"></i>
                                </a>
                                <a href="delete_register.php?id_Del_Prop=<?php echo $row['Identidad']?>" class = "btn btn-danger">
                                    <i class = "far fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
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


<?php include("Includes/footer.php")?>

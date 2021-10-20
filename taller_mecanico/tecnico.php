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
                        <label>Nombre del T&eacute;cnico</label>
                        <input type = "text" name="Nombre_Tecnico" required pattern="[a-z A-Z á-ú-ñ Á-Ú-Ñ]+" class = "form-control"
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

                <?php 
                $sql_registe = mysqli_query($conn,"SELECT COUNT(IdTecnico)  as total_registro FROM tecnicos");
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
                    $query = "SELECT * FROM taller_mecanico.tecnicos LIMIT $desde,$por_Pagina";
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

<?php 
$primera = $pagina -($pagina % 5) +1;
if($primera > $pagina){
    $primera = $primera-5;
}
$ultima = $primera +4 > $total_paginas ? $total_paginas : $primera + 4;
?>
        <div class="paginador">
            <ul>
            
                <?php 
                
                if($primera != 1){?>
                <li> <a href="?pagina=<?php echo 1;?>"> |< </a> </li>
                <li> <a href="?pagina=<?php echo $pagina-1;?>"> << </a> </li>

                <?php 
                }
                
                   
                for($i = $primera; $i <= $ultima; $i++){
                    if($i <= -1){ 
                        $i = 1;
                    }
                    if($i == $pagina){
                        echo '<li class= "PageSelected">'.$i.'</li>';  
                    }else{
                        echo '<li> <a href = "?pagina='.$i.'">'.$i.'</a></li>';
                    }  
                }
            
                if($pagina != $total_paginas){
                ?>
                <li> <a href="?pagina=<?php echo $pagina+1;?>"> >> </a> </li>
                <li> <a href="?pagina=<?php echo $total_paginas;?>"> >| </a> </li>
                <?php }?>
                
                
            </ul>
        </div>

<?php include("Includes/footer.php")?>
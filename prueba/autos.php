<?php   include("db.php");
include("Includes/header.php");
?>
 <script src="js/auto.js"></script>
<div class="container p-4">

    <div class="row">

        <div class="col-md-4">
            <div class="titulo">
<center><h2>AUTOM&Oacute;VILES</h2></center></div>
        
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
                        <select name="Identidad_Auto" required class = "form-control">
                            <option value="0">Ingrese su Identidad...</option>
                            <?php 
                            $conProp= "SELECT * FROM propietarios";
                            $ConcIDProp = mysqli_query($conn,$conProp);
                            while($obtenIdProp = mysqli_fetch_array($ConcIDProp)){?>
                            <option value=<?php echo $obtenIdProp['Identidad']?>><?php echo $obtenIdProp['Identidad']?></option>
                            <?php }?>
                         </select>
                    </div>
                    <div class="form-group">
                        <label>Marca:</label>
                        <input type = "text" name="Marca" required pattern="[a-z A-Z á-ú-ñ Á-Ú-Ñ]+" class = "form-control" minlength = "3"
                        placeholder = "Ingrese la Marca del Auto">
                    </div>
                    <div class="form-group">
                        <label>Modelo:</label>
                        <input type = "text" name="Modelo" required pattern = "[A-Z a-z0-9 á-ú-ñ Á-Ú-Ñ]+" class = "form-control" minlength = "1"
                        placeholder = "Ingrese el Modelo del Auto">
                    </div>
                    <div class="form-group">
                        <label>Año:</label>
                        <input type = "number" name="Anio" required class = "form-control" min = "1"
                        placeholder = "Ingrese el Año del Auto">
                    </div>
                    <input type="submit" class = "btn btn-dark btn-block"
                    name = "Guardar_Auto" value = "Guardar">
                </form>
            </div>

        </div> 
        
        <div class="col-md-8">
        <form action="buscar_auto.php" method= "POST" class="form_search">
        <input type="submit" value= "Buscar" class="btn_search">
            <input type="text" name = "busqueda" id= "busqueda" pattern = "[a-z A-Z Á-Ú 0-9 á-ú Ñ-ñ]+" placeholder = "Buscar">
            </form>
            
            <?php
            
            $sql_registe = mysqli_query($conn,"SELECT COUNT( * )  as total_registro FROM automoviles");
                $result_register = mysqli_fetch_array($sql_registe);
                $total_registro = $result_register['total_registro'];?>
                <div id="maxRows">
                <?php $por_Pagina = 10; ?></div><?php

                if(empty($_GET['pagina'])){
                    $pagina = 1;
                }else{
                    $pagina = $_GET['pagina'];
                }
                
                
                $desde = ($pagina-1) * $por_Pagina;
                $total_paginas = ceil($total_registro / $por_Pagina);?>
            <div id ="tabla_resultado">
                <!--IMPRIME LOS DATOS CONSULTA.PHP-->
            </div>
        </div>
    </div>

    <div class="TotalRegistro">

    </div>
   <!---?php
    $primera = $pagina -($pagina % 5) +1;
if($primera > $pagina){
    $primera = $primera-5;
}
$ultima = $primera +4 > $total_paginas ? $total_paginas : $primera + 4;
?>
<#?php if($total_registro != 0){?>
    <div class="TotalRegistro">
        Mostrando <#?php echo $desde+1;?> a <#?php if($desde+$por_Pagina <= $total_registro){
    echo $desde + $por_Pagina;}else{ echo $total_registro;}?> de <#?php echo $total_registro;?> registro (s)</div>
<div class="paginador">
            <ul>
            
                <#?php 
                
                if($pagina != 1){?>
                <li class= "anterior"> <a href="?pagina=<#?php echo $pagina-1;?>">Anterior </a> </li>
                <li> <a href="?pagina=<#?php echo 1;?>"> 1 </a> </li>
                <li><a href="?pagina=<#?php if($primera-1 == 0){echo 1;} else{
                    echo $primera-1;}
                    ?>">...</a></li>
                <#?php 
                }
                
                   
                for($i = $primera; $i <= $ultima; $i++){
                    if($i <= -1){ 
                        $i = 1;
                    }
                    if($i == $pagina){
                        echo '<li class= "PageSelected">'.$i.'</li>';  
                    }else{
                        echo '<li> <a href = "?pagina='.$i.'&busqueda='.$i.'">'.$i.'</a></li>';
                    }  
                }
            
                if(#$pagina != $total_paginas){
                ?>
                <li> <a href="?pagina=<#?php if($ultima+1 >$total_paginas){echo $total_paginas;}else{
                echo $ultima+1;}
                    ?>"> ... </a> </li>
                <li> <a href="?pagina=<#?php echo $total_paginas;?>"> <#?php echo $total_paginas?> </a> </li>
                <div class="siguiente">
                <li> <a href="?pagina=<#?php echo $pagina+1;?>">Siguiente</a></li></div>
                <#?php }?>
                
                
            </ul>
        </div>
        
        <#?php }?>--->
</div>


<?php include("Includes/footer.php")?>

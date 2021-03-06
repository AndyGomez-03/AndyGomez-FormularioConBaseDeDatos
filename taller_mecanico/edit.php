<?php if(isset($_GET['id_Edit_Prop'])){?>
<?php include("db.php");

#OBTENER DATOS DE PROPIETARIO
    if(isset($_GET['id_Edit_Prop'])){
        $id = $_GET['id_Edit_Prop'];
        $query = "SELECT * FROM propietarios WHERE Identidad = $id";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $identidad= $row['Identidad'];
            $Nombre_Propietario = $row['Nombre_Propietario'];
       
        } 
    }

    #ACTUALIZAR REGISTRO DE PROPIETARIOS
    if(isset($_POST['Actualizar_Propietario'])){
        $id = $_GET['id_Edit_Prop'];
        $identidad_Actu= $_POST['Identidad_Actu'];
        $Nombre_Propietario_Actu = $_POST['Nombre_Propietario_Actu'];

        $query = "UPDATE propietarios SET Identidad = '$identidad_Actu', Nombre_Propietario = '$Nombre_Propietario_Actu' WHERE Identidad = $id";
        $result = mysqli_query($conn,$query);
   
        $_SESSION['message'] = "Registro Actualizado Satisfactoriamente";
        $_SESSION['message_type'] = 'warning';
        header("Location: propietarios.php");
    }
?> 

<?php include("Includes/header.php")?>
<!-------------------------FORMULARIO DE EDICION PROPIETARIOS------------------------->
<div class="formulario">
<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit.php?id_Edit_Prop=<?php echo $_GET['id_Edit_Prop'];?>" method = "POST">
                    <div class="form-group">
                        <label>Identidad:</label>
                        <input type="number" name= "Identidad_Actu" required value = "<?php echo $identidad?>" class = "form-control" placeholder = "Actualice su Identidad" min = "1">
                    </div>
                    <div class="form-group">
                        <label>Nombre del Propietario:</label>
                        <input type = "text" name="Nombre_Propietario_Actu" required pattern="[a-z A-Z ??-??-?? ??-??-??]+" value = "<?php echo $Nombre_Propietario?>" class= "form-control" placeholder = "Actualice su Nombre">
                    </div>
                    <button class ="btn btn-success btn-block" name = "Actualizar_Propietario">
                    Actualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include("Includes/footer.php")?>
<?php }?>

<!---------------------------------------AUTOMOVILES--------------------------------------->
<?php if(isset($_GET['id_Edit_Auto'])){?>
<?php include("db.php");

#OBTENER DATOS DE AUTOMOVILES
    if(isset($_GET['id_Edit_Auto'])){
        $id = $_GET['id_Edit_Auto'];
        $query = "SELECT * FROM automoviles WHERE IdAuto = $id";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $IdAuto= $row['IdAuto'];
            $Identidad = $row['Identidad'];
            $Marca = $row['Marca'];
            $Modelo = $row['Modelo'];
            $Anio = $row['Anio'];
        } 
    }

    #ACTUALIZAR REGISTRO DE AUTOMOVILES
    if(isset($_POST['Actualizar_Auto'])){
        $id_auto = $_GET['id_Edit_Auto'];
        $IdAuto_Actu= $_POST['IdAuto_Actu'];
        $identidad_Actu= $_POST['Identidad_Actu'];
        $Marca_Actu= $_POST['Marca_Actu'];
        $Modelo_Actu= $_POST['Modelo_Actu'];
        $Anio_Actu= $_POST['Anio_Actu'];
    
        $query = "UPDATE automoviles SET IdAuto = '$IdAuto_Actu', Identidad = '$identidad_Actu', Marca = '$Marca_Actu', Modelo = '$Modelo_Actu', Anio = '$Anio_Actu' WHERE IdAuto = $id_auto";
        $result = mysqli_query($conn,$query);

        $_SESSION['message'] = "Registro Actualizado Satisfactoriamente";
        $_SESSION['message_type'] = 'warning';
        header("Location: autos.php");
    }
?> 

<?php include("Includes/header.php")?>
<!----------------------FORMULARIO DE EDICION AUTOMOVILES------------------------->
<div class="formulario">
<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit.php?id_Edit_Auto=<?php echo $_GET['id_Edit_Auto'];?>" method = "POST">
                    <div class="form-group">
                        <label hidden   >Id del Auto:</label>
                        <input type="number" name= "IdAuto_Actu" hidden required value = "<?php echo $IdAuto?>" class = "form-control" placeholder = "Actualice el Id del Auto" min="1">
                    </div>
                    <div class="form-group">
                        <label>Identidad:</label>
                        <input type = "number" name="Identidad_Actu" required value = "<?php echo $Identidad?>" class= "form-control" placeholder = "Actualice su Identidad" min = "1">
                    </div>
                    <div class="form-group">
                        <label>Marca:</label>
                        <input type = "text" name="Marca_Actu" required pattern = "[A-Z a-z ??-??-?? ??-??-?? 0-9]+" value = "<?php echo $Marca?>" class= "form-control" placeholder = "Actualice la Marca del Auto">
                    </div>
                    <div class="form-group">
                        <label>Modelo:</label>
                        <input type = "text" name="Modelo_Actu" required pattern = "[A-Z a-z ??-??-?? ??-??-?? 0-9]+" value = "<?php echo $Modelo?>" class= "form-control" placeholder = "Actualice el Modelo del Auto">
                    </div>
                    <div class="form-group">
                        <label>A??o:</label>
                        <input type = "number" name="Anio_Actu" required value = "<?php echo $Anio?>" class= "form-control" placeholder = "Actualice el A??o del Auto" min = "1">
                    </div>
                    <button class ="btn btn-success btn-block" name = "Actualizar_Auto">
                    Actualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include("Includes/footer.php")?>
<?php }?>

<!-------------------TIPOS DE REVISION------------------->
<?php if(isset($_GET['id_Edit_Rev'])){?>
<?php include("db.php");

#OBTENER DATOS DE TIPO DE REVISION
    if(isset($_GET['id_Edit_Rev'])){
        $id = $_GET['id_Edit_Rev'];
        $query = "SELECT * FROM tipo_revision WHERE IdTipo_Revision = $id";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $idTipoRevision= $row['IdTipo_Revision'];
            $TipoRevision = $row['Tipo_Revision'];
       
        } 
    }

    #ACTUALIZAR REGISTRO DE TIPO DE REVISION
    if(isset($_POST['Actualizar_Revision'])){
        $id = $_GET['id_Edit_Rev'];
        $idTipoRevision_Actu= $_POST['IdTipoRevision_Actu'];
        $TipoRevision_Actu = $_POST['TipoRevision_Actu'];

        $query = "UPDATE tipo_revision SET IdTipo_Revision = '$idTipoRevision_Actu', Tipo_Revision = '$TipoRevision_Actu' WHERE IdTipo_Revision = $id";
        $result = mysqli_query($conn,$query);
   
        $_SESSION['message'] = "Registro Actualizado Satisfactoriamente";
        $_SESSION['message_type'] = 'warning';
        header("Location: tipoRevision.php");
    }
?> 

<?php include("Includes/header.php")?>
<!-------------------------FORMULARIO DE EDICION TIPOS DE REVISION------------------------->
<div class="formulario">
<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit.php?id_Edit_Rev=<?php echo $_GET['id_Edit_Rev'];?>" method = "POST">
                    <div class="form-group">
                        <label hidden>Id Tipo de Revisi&oacute;n:</label>
                        <input type="number" name= "IdTipoRevision_Actu" hidden required value = "<?php echo $idTipoRevision?>" class = "form-control" placeholder = "Actualice el Id del Tipo de Revisi&oacute;n" min = "1">
                    </div>
                    <div class="form-group">
                        <label>Tipo de Revisi&oacute;n:</label>
                        <input type = "text" name="TipoRevision_Actu" required pattern = "[A-Z a-z ??-??-?? ??-??-??]+" value = "<?php echo $TipoRevision?>" class= "form-control" placeholder = "Actualice el Tipo de Revisi&oacute;n">
                    </div>
                    <button class ="btn btn-success btn-block" name = "Actualizar_Revision">
                    Actualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include("Includes/footer.php")?>
<?php }?>

<!-------------------TIPOS DE TECNICOS------------------->
<?php if(isset($_GET['id_Edit_Tecnico'])){?>
<?php include("db.php");

#OBTENER DATOS DE TIPO DE TECNICOS
    if(isset($_GET['id_Edit_Tecnico'])){
        $id = $_GET['id_Edit_Tecnico'];
        $query = "SELECT * FROM tecnicos WHERE IdTecnico = $id";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $idTecnico= $row['IdTecnico'];
            $NombreTecnico = $row['Nombre_Tecnico'];
       
        } 
    }

    #ACTUALIZAR REGISTRO DE TIPO DE TECNICOS
    if(isset($_POST['Actualizar_Tecnico'])){
        $id = $_GET['id_Edit_Tecnico'];
        $idTecnico_Actu= $_POST['IdTecnico_Actu'];
        $NombreTecnico_Actu = $_POST['NombreTecnico_Actu'];

        $query = "UPDATE tecnicos SET IdTecnico = '$idTecnico_Actu', Nombre_Tecnico = '$NombreTecnico_Actu' WHERE IdTecnico = $id";
        $result = mysqli_query($conn,$query);
   
        $_SESSION['message'] = "Registro Actualizado Satisfactoriamente";
        $_SESSION['message_type'] = 'warning';
        header("Location: tecnico.php");
    }
?> 

<?php include("Includes/header.php")?>
<!-------------------------FORMULARIO DE EDICION TECNICOS------------------------->
<div class="formulario">
<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit.php?id_Edit_Tecnico=<?php echo $_GET['id_Edit_Tecnico'];?>" method = "POST">
                    <div class="form-group">
                    
                        <label hidden>Id del T&eacute;cnico:</label>
                        <input type="number" name= "IdTecnico_Actu" hidden required value = "<?php echo $idTecnico?>" class = "form-control" placeholder = "Actualice el Id del T&eacute;cnico" min = "1">
                    </div>
                    <div class="form-group">
                        <label>Nombre del T&eacute;cnico:</label>
                        <input type = "text" name="NombreTecnico_Actu" required pattern = "[A-Z a-z ??-??-?? ??-??-??]+" value = "<?php echo $NombreTecnico?>" class= "form-control" placeholder = "Actualice el Nombre del T&eacute;cnico">
                    </div>
                    <button class ="btn btn-success btn-block" name = "Actualizar_Tecnico">
                    Actualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include("Includes/footer.php")?>
<?php }?>

<!---------------------------------------MANTENIMIENTO (INDEX)--------------------------------------->
<?php if(isset($_GET['id_Edit_Index'])){?>
<?php include("db.php");

#OBTENER DATOS DE Mantenimiento
    if(isset($_GET['id_Edit_Index'])){
        $id = $_GET['id_Edit_Index'];
        $query = "SELECT * FROM mantenimiento WHERE IdMantenimiento = $id";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) == 1){
            $row = mysqli_fetch_array($result);
            $IdAuto= $row['IdAuto'];
            $conIdAuto = "SELECT * FROM automoviles where IdAuto = $IdAuto";
            $EnvConIdAuto = mysqli_query($conn,$conIdAuto);
            $Auto = mysqli_fetch_array($EnvConIdAuto);
            $FechaRevision = $row['Fecha_Revision'];
            $IdTipo_Revision = $row['IdTipo_Revision'];
            $conTip = "SELECT * FROM tipo_revision where IdTipo_Revision = $IdTipo_Revision";
            $EnvConTip = mysqli_query($conn,$conTip);
            $Tipo = mysqli_fetch_array($EnvConTip);
            $IdTecnico = $row['IdTecnico'];
            $conTec = "SELECT * FROM tecnicos where IdTecnico = $IdTecnico";
            $EnvConTec = mysqli_query($conn,$conTec);
            $Tec = mysqli_fetch_array($EnvConTec);
            
            
        } 
    }

    #ACTUALIZAR REGISTRO DE MANTENIMIENTO
    if(isset($_POST['Actualizar_Index'])){
        $id_index = $_GET['id_Edit_Index'];
        $IdAuto_Actu= $_POST['IdAuto_ActuIndex'];
        $FechaRevision_Actu= $_POST['FechaRevision_Actu'];
        $IdTipoRevision_Actu= $_POST['IdTipoRevision_Actu'];
        $IdTecnico_Actu= $_POST['IdTecnico_Actu'];
    
        $query = "UPDATE mantenimiento SET IdAuto = '$IdAuto_Actu', Fecha_Revision = '$FechaRevision_Actu', IdTipo_Revision = '$IdTipoRevision_Actu', IdTecnico = '$IdTecnico_Actu' WHERE IdMantenimiento = $id_index";
        $result = mysqli_query($conn,$query);

        $_SESSION['message'] = "Registro Actualizado Satisfactoriamente";
        $_SESSION['message_type'] = 'warning';
        header("Location: index.php");
    }
?> 

<?php include("Includes/header.php")?>
<!----------------------FORMULARIO DE EDICION MANTENIMIENTO------------------------->
<div class="formulario">
<div class="container">
    <div class="row">
        <div class="col-md-4 mx-auto">
            <div class="card card-body">
                <form action="edit.php?id_Edit_Index=<?php echo $_GET['id_Edit_Index'];?>" method = "POST">
                    <div class="form-group">
                        <label>Id del Auto:</label>
                        <select name= "IdAuto_ActuIndex" required  class = "form-control">
                        <option value="<?php echo $Auto['IdAuto']?>"><?php echo $Auto['Identidad'], " ",$Auto['Marca']," ",$Auto['Modelo']?></option>
                       <?php $GenAuto = "SELECT * FROM automoviles";
                       $EnvGenAuto = mysqli_query($conn,$GenAuto);
                       while($AutoGen = mysqli_fetch_array($EnvGenAuto)){?>
                       <option value="<?php echo $AutoGen['IdAuto']?>"><?php echo $AutoGen['Identidad']," ",$AutoGen['Marca'], " ",$AutoGen['Modelo']?></option>
                       <?php }?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label>Fecha de Revisi&oacute;n:</label>
                        <input type = "date" name="FechaRevision_Actu" required value = "<?php echo $FechaRevision?>" class= "form-control" placeholder = "Actualice la Fecha de Revisi&oacute;n">
                    </div>
                    <div class="form-group">
                        <label>Tipo de Revisi&oacute;n:</label>
                        <select name="IdTipoRevision_Actu" required class= "form-control">
                        <option value="<?php echo $Tipo['IdTipo_Revision']?>"><?php echo $Tipo['Tipo_Revision']?></option>
                        <?php $GenTipo= "SELECT * FROM tipo_revision";
                        $EnvGenTipo = mysqli_query($conn,$GenTipo);
                        while($TipoRevGen = mysqli_fetch_array($EnvGenTipo)){?>
                        <option value="<?php echo $TipoRevGen['IdTipo_Revision']?>"><?php echo $TipoRevGen['Tipo_Revision']?></option>
                        <?php }?>
                    </select>
                    </div>
                    <div class="form-group">
                        <label>T&eacute;cnico:</label>
                        <select name="IdTecnico_Actu" required class= "form-control">
                        <option value="<?php echo $Tec['IdTecnico']?>"><?php echo $Tec['Nombre_Tecnico']?></option>
                        <?php $Gen= "SELECT * FROM tecnicos";
                        $EnvGen = mysqli_query($conn,$Gen);
                        while($TecGen = mysqli_fetch_array($EnvGen)){?>

                        <option value="<?php echo $TecGen['IdTecnico']?>"><?php echo $TecGen['Nombre_Tecnico']?></option>
                        <?php }?> 
                    </select>
                    </div>
                
                    <button class ="btn btn-success btn-block" name = "Actualizar_Index">
                    Actualizar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<?php include("Includes/footer.php")?>
<?php }?>
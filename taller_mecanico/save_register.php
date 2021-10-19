<?php

include("db.php");
#GUARDAR REGISTRO DE MANTENIMIENTO
if (isset($_POST['save_register'])){
    
    
    $idAuto = $_POST['IdAuto_Index'];
    $IdTipo_Revision = $_POST['Lista_Revision'];
    $fechaRevision = $_POST['Fecha_Revision'];
    $IdTecnico = $_POST['Lista_Tecnicos'];
    
    
    $query = "INSERT INTO mantenimiento (IdAuto, Fecha_Revision, IdTipo_Revision, IdTecnico) VALUES ('$idAuto','$fechaRevision', '$IdTipo_Revision', '$IdTecnico')";
    $result = mysqli_query($conn,$query);
    if (!$result){
        die("Query Failed");
    }

    $_SESSION['message'] = 'Registro Guardado Satisfactoriamente';
    $_SESSION['message_type'] = 'success';
    header("Location: index.php"); 
}
#GUARDAR REGISTRO DE TECNICOS
if (isset($_POST['Guardar_Tecnico'])){
    
    $idTecnico = $_POST['IdTecnico'];
    $NombreTecnico = $_POST['Nombre_Tecnico'];

    
    $query = "INSERT INTO tecnicos (IdTecnico, Nombre_Tecnico) VALUES ('$idTecnico','$NombreTecnico')";
    $result = mysqli_query($conn,$query);
    if (!$result){
        die("Query Failed");
    }

    $_SESSION['message'] = 'Registro Guardado Satisfactoriamente';
    $_SESSION['message_type'] = 'success';
    header("Location: tecnico.php"); 
}
#GUARDAR REGISTRO DE AUTOMOVILES
if (isset($_POST['Guardar_Auto'])){
    
    $idAuto = $_POST['IdAuto'];
    $Identidad = $_POST['Identidad_Auto'];
    $Marca = $_POST['Marca'];
    $Modelo = $_POST['Modelo'];
    $Anio = $_POST['Anio'];

    $query = "INSERT INTO automoviles (IdAuto,Identidad,Marca,Modelo,Anio) VALUES ('$idAuto','$Identidad','$Marca','$Modelo','$Anio')";
    $result = mysqli_query($conn,$query);
    if (!$result){
        die("Query Failed");
    }

    $_SESSION['message'] = 'Registro Guardado Satisfactoriamente';
    $_SESSION['message_type'] = 'success';
    header("Location: autos.php"); 
}
#GUARDAR REGISTRO PROPIETARIO
if (isset($_POST['Guardar_Propietario'])){
    
    $Identidad_Prop = $_POST['Identidad_Prop'];
    $NombrePropietario = $_POST['Nombre_Propietario'];

    
    $query = "INSERT INTO propietarios (Identidad, Nombre_Propietario) VALUES ('$Identidad_Prop','$NombrePropietario')";
    $result = mysqli_query($conn,$query);
    if (!$result){
        die("Query Failed");
    }

    $_SESSION['message'] = 'Registro Guardado Satisfactoriamente';
    $_SESSION['message_type'] = 'success';
    header("Location: propietarios.php"); 
}
#GUARDAR REGISTRO TIPO DE REVISION
if (isset($_POST['Guardar_Revision'])){
    
    $IdTipoRevision = $_POST['IdTipoRevision'];
    $Tipo_Revision = $_POST['Tipo_Revision'];

    
    $query = "INSERT INTO tipo_revision (IdTipo_Revision, Tipo_Revision) VALUES ('$IdTipoRevision','$Tipo_Revision')";
    $result = mysqli_query($conn,$query);
    if (!$result){
        die("Query Failed");
    }
    

    $_SESSION['message'] = 'Registro Guardado Satisfactoriamente';
    $_SESSION['message_type'] = 'success';
    header("Location: tipoRevision.php"); 
}
?>
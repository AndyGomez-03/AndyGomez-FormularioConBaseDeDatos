<?php

    include("db.php");
#BORRAR REGISTRO PROPIETARIO
    if (isset($_GET['id_Del_Prop'])){
        $id = $_GET['id_Del_Prop'];
        $query  = "DELETE FROM propietarios WHERE Identidad = $id";
        $result = mysqli_query($conn,$query);
        if(!$result){
            die("QUERY FAILED");
        }

        $_SESSION['message'] = "Registro Removido Satisfactoriamente";
        $_SESSION['message_type'] = 'danger';
        header("Location: propietarios.php");
    }
#BORRAR REGISTROS TECNICOS
    if (isset($_GET['id_Del_Tecnico'])){
        $id = $_GET['id_Del_Tecnico'];
        $query  = "DELETE FROM tecnicos WHERE IdTecnico = $id";
        $result = mysqli_query($conn,$query);
        if(!$result){
            die("QUERY FAILED");
        }

        $_SESSION['message'] = "Registro Removido Satisfactoriamente";
        $_SESSION['message_type'] = 'danger';
        header("Location: tecnico.php");
    }
#BORRAR REGISTROS INDEX
    if (isset($_GET['id_Del_Index'])){
        $id = $_GET['id_Del_Index'];
        $query  = "DELETE FROM mantenimiento WHERE IdMantenimiento = $id";
        $result = mysqli_query($conn,$query);
        if(!$result){
            die("QUERY FAILED");
        }

        $_SESSION['message'] = "Registro Removido Satisfactoriamente";
        $_SESSION['message_type'] = 'danger';
        header("Location: index.php");
    }
#BORRAR REGISTROS AUTOS
    if (isset($_GET['id_Del_Auto'])){
        $id = $_GET['id_Del_Auto'];
        $query  = "DELETE FROM automoviles WHERE IdAuto = $id";
        $result = mysqli_query($conn,$query);
        if(!$result){
            die("QUERY FAILED");
        }

        $_SESSION['message'] = "Registro Removido Satisfactoriamente";
        $_SESSION['message_type'] = 'danger';
        header("Location: autos.php");
    }

    #BORRAR REGISTROS TIPO DE REVISION
    if (isset($_GET['id_Del_Rev'])){
        $id = $_GET['id_Del_Rev'];
        $query  = "DELETE FROM tipo_revision WHERE IdTipo_Revision = $id";
        $result = mysqli_query($conn,$query);
        if(!$result){
            die("QUERY FAILED");
        }

        $_SESSION['message'] = "Registro Removido Satisfactoriamente";
        $_SESSION['message_type'] = 'danger';
        header("Location: tipoRevision.php");
    }

?>
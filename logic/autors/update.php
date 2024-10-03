<?php
if ($_POST) {
    require_once "../conexion.php";
    if (!isset($_POST["sltNacionalidad"])) {
        $result = array(
            "status" => false,
            "title" => "Ocurrio un error inesperado",
            "text" => "No has seleccionado una nacionalidad",
            "date" => date("Y-m-d H:i:s"),
            "type" => "danger"
        );
        echo json_encode($result);
        die();
    }
    $txtIdAutor = $_POST["idAutor"];
    $txtName = $_POST["txtName"];
    $sltNacionalidad = $_POST["sltNacionalidad"];
    if ($txtName == "" || $txtIdAutor == "") {
        $result = array(
            "status" => false,
            "title" => "Ocurrio un error inesperado",
            "text" => "No se permite el ingreso de nombre vacio",
            "date" => date("Y-m-d H:i:s"),
            "type" => "danger"
        );
        echo json_encode($result);
        die();
    }
    /*
 *Update a autors 
 */
    if ($conexion) {
        try {
            $sql = "UPDATE tb_autors SET a_name=:txtName, a_nacionalidad=:txtNacionalidad WHERE autorId=:txtAutorId;";
            $name = $txtName;
            $nacionalidad = $sltNacionalidad;
            $autorId = $txtIdAutor;
            $prepared = $conexion->prepare($sql);
            $prepared->bindParam(":txtName", $name);
            $prepared->bindParam(":txtNacionalidad", $nacionalidad);
            $prepared->bindParam(":txtAutorId", $autorId);
            $excute = $prepared->execute();
            if ($excute) {
                $result = array(
                    "status" => true,
                    "title" => "Satisfactorio",
                    "text" => "Se actualizo de manera correcta el registro",
                    "date" => date("Y-m-d H:i:s"),
                    "type" => "success"
                );
                echo json_encode($result);
                die();
            }
        } catch (PDOException $errors) {
            $result = array(
                "status" => false,
                "title" => "Ocurrio un error inesperado",
                "text" => "Ah sucedido un error : " . $errors->getMessage() . "!",
                "date" => date("Y-m-d H:i:s"),
                "type" => "danger"
            );
            echo json_encode($result);
            die();
        }
    }
}

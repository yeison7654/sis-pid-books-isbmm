<?php
if ($_POST) {
    require_once "../conexion.php";
    $txtName = $_POST["txtName"];
    $sltNacionalidad = $_POST["sltNacionalidad"];
    /*
 * Insert a autors
 */
    if ($conexion) {
        try {
            $sql = "INSERT INTO tb_autors (a_name,a_nacionalidad) VALUES (:txtName,:txtNacionalidad);";
            $name = $txtName;
            $nacionalidad = $sltNacionalidad;
            $prepared = $conexion->prepare($sql);
            $prepared->bindParam(':txtName', $name);
            $prepared->bindParam(':txtNacionalidad', $nacionalidad);
            $excute = $prepared->execute();
            if ($excute) {
                echo ("Registro completado");
            }
        } catch (PDOException $errors) {
            echo "Ah sucedido un error : " . $errors->getMessage() . "!";
        }
    }
}

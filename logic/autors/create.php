<?php
/*
 * Insert a autors
 */
if ($conexion) {
    try {
        $sql = "INSERT INTO tb_autors (a_name,a_nacionalidad) VALUES (:txtName,:txtNacionalidad);";
        $name = "David";
        $nacionalidad = "Peruano";
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

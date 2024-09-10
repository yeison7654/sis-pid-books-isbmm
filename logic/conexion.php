<?php
/*
 *Variables de administracion 
 */
$server = "localhost";
$user = "root";
$password = "";
$bd = "db_storeBooks";
$charset = "utf8";
$host = "mysql:host=$server;dbname=$bd;charset=$charset";
try {
    //creamos la conexion a la bd
    $conexion = new PDO($host, $user, $password);
    //Se establece el modo de errores a excepcion
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //Forzamos el uso de consultas con UTF8
    $conexion->exec("SET NAMES 'utf8'");
    echo "Conexion correcta";
} catch (PDOException $errors) {
    echo "Ah sucedido un error : " . $errors->getMessage() . "!";
}
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
/*
 *Update a autors 
 */
if ($conexion) {
    try {
        $sql = "UPDATE tb_autors SET a_name=:txtName, a_nacionalidad=:txtNacionalidad WHERE autorId=:txtAutorId;";
        $name = "Yeison Danner Carhuapoma Dett";
        $nacionalidad = "Peruano";
        $autorId = 4;
        $prepared = $conexion->prepare($sql);
        $prepared->bindParam(":txtName", $name);
        $prepared->bindParam(":txtNacionalidad", $nacionalidad);
        $prepared->bindParam(":txtAutorId", $autorId);
        $excute = $prepared->execute();
        if ($excute) {
            echo ("Registro atualizado");
        }
    } catch (PDOException $errors) {
        echo "Ah sucedido un error : " . $errors->getMessage() . "!";
    }
}
/*
 *delete a autors
 */
if ($conexion) {
    try {
        $sql = "DELETE FROM tb_autors WHERE autorId=:txtAutorId;";
        $autorId = 8;
        $prepared = $conexion->prepare($sql);
        $prepared->bindParam(":txtAutorId", $autorId);
        $excute = $prepared->execute();
        if ($excute) {
            echo ("Registro eliminado");
        }
    } catch (PDOException $errors) {
        echo "Ah sucedido un error : " . $errors->getMessage() . "!";
    }
}
/*
*select a autors
*/
if ($conexion) {
    try {
        $sql = "SELECT*FROM tb_autors;";
        $prepared = $conexion->prepare($sql);
        $prepared->execute();
        $result = $prepared->fetchAll(PDO::FETCH_ASSOC);
        print_r($result);
    } catch (PDOException $errors) {
        echo "Ah sucedido un error : " . $errors->getMessage() . "!";
    }
}

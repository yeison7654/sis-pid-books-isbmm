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
select a autors
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

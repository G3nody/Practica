<?php
$host = "localhost";
$bd = "cine";
$usuario = "root";
$password = ""; // en XAMPP normalmente va vacío

try {
    $conexion = new PDO(
        "mysql:host=$host;dbname=$bd;charset=utf8",
        $usuario,
        $password
    );
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conexión exitosa con MySQL";
} catch (PDOException $error) {
    echo "Error de conexión: " . $error->getMessage();
}
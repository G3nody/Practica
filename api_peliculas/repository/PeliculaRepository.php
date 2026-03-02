<?php
require_once __DIR__ . "/../config/conexion.php";

class PeliculaRepository {

    // CREAR PELÍCULA
    public function crear($pelicula) {
        global $conexion;

        $sql = "INSERT INTO peliculas (nombre, fecha_publicacion, sala_cine)
                VALUES (?, ?, ?)";

        $stmt = $conexion->prepare($sql);

        return $stmt->execute([
            $pelicula->nombre,
            $pelicula->fecha_publicacion,
            $pelicula->sala_cine
        ]);
    }

    // LISTAR PELÍCULAS (solo activas)
    public function listar() {
        global $conexion;

        $sql = "SELECT * FROM peliculas WHERE estado = 1";
        $resultado = $conexion->query($sql);

        return $resultado->fetchAll(PDO::FETCH_ASSOC);
    }

    // ELIMINACIÓN LÓGICA
    public function eliminarLogico($id) {
        global $conexion;

        $sql = "UPDATE peliculas SET estado = 0 WHERE id = ?";
        $stmt = $conexion->prepare($sql);

        return $stmt->execute([$id]);
    }

    // BUSCAR POR NOMBRE
    public function buscarPorNombre($nombre) {
        global $conexion;

        $sql = "SELECT * FROM peliculas
                WHERE nombre LIKE ? AND estado = 1";

        $stmt = $conexion->prepare($sql);
        $stmt->execute(["%$nombre%"]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // BUSCAR POR FECHA
    public function buscarPorFecha($fecha) {
        global $conexion;

        $sql = "SELECT * FROM peliculas
                WHERE fecha_publicacion = ? AND estado = 1";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([$fecha]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // CONTAR PELÍCULAS POR SALA
    public function contarPorSala($sala) {
        global $conexion;

        $sql = "SELECT COUNT(*) FROM peliculas
                WHERE sala_cine = ? AND estado = 1";

        $stmt = $conexion->prepare($sql);
        $stmt->execute([$sala]);

        return $stmt->fetchColumn();
    }
}
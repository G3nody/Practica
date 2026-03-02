<?php
require_once __DIR__ . "/../models/Pelicula.php";
require_once __DIR__ . "/../repository/PeliculaRepository.php";

class PeliculaService {

    private $repositorio;

    public function __construct() {
        $this->repositorio = new PeliculaRepository();
    }

    // CREAR PELÍCULA
    public function crearPelicula($datos) {
        $pelicula = new Pelicula();
        $pelicula->nombre = $datos['nombre'];
        $pelicula->fecha_publicacion = $datos['fecha_publicacion'];
        $pelicula->sala_cine = $datos['sala_cine'];

        return $this->repositorio->crear($pelicula);
    }

    // REGLA DE NEGOCIO: ESTADO DE LA SALA
    public function estadoSala($sala) {
        $cantidad = $this->repositorio->contarPorSala($sala);

        if ($cantidad < 3) {
            return "Sala disponible";
        } elseif ($cantidad <= 5) {
            return "Sala con $cantidad películas asignadas";
        } else {
            return "Sala no disponible";
        }
    }
}
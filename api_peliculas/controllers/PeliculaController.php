<?php
require_once __DIR__ . "/../services/PeliculaService.php";
require_once __DIR__ . "/../repository/PeliculaRepository.php";

header("Content-Type: application/json");

$servicio = new PeliculaService();
$repositorio = new PeliculaRepository();

$accion = $_GET['accion'] ?? '';

switch ($accion) {

    case "crear":
        echo json_encode(
            $servicio->crearPelicula($_POST)
        );
        break;

    case "listar":
        echo json_encode(
            $repositorio->listar()
        );
        break;

    case "buscar_nombre":
        echo json_encode(
            $repositorio->buscarPorNombre($_GET['nombre'])
        );
        break;

    case "buscar_fecha":
        echo json_encode(
            $repositorio->buscarPorFecha($_GET['fecha'])
        );
        break;

    case "estado_sala":
        echo json_encode(
            $servicio->estadoSala($_GET['sala'])
        );
        break;

    default:
        echo json_encode(["mensaje" => "Acción no válida"]);
        break;
}
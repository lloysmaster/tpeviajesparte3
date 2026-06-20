<?php
require_once __DIR__ . '/../models/viajes.model.php';

class ViajesApiController {
    private $model;

    public function  __construct() {
        $this->model = new ViajesModel();
    }

    public function getViajes($req, $res) {
    // Capturar parámetros de query
    $sort = $req->query->sort ?? null;
    $order = $req->query->order ?? 'ASC';

    // Llamar al modelo con los parámetros
    $viajes = $this->model->getViajes($sort, $order);

    // Responder con los datos ordenados
    return $res->json($viajes, 200);
}

    public function getViajeById($req, $res) {
        // obtengo el ID que viene como parámetro del endpoint
        $id_viaje = $req->params->id;

        $viaje = $this->model->getViaje($id_viaje);

        if (!$viaje) {
            return $res->json("El viaje con el id=$id_viaje no existe", 404);
        }

        return $res->json($viaje, 200);
    }

    public function insertViaje($req, $res) {
        //[$nombre_ciudad, $pais, $descripcion, $precio, $id]
        $nombre_ciudad = $req->body->nombre_ciudad ?? null;
        $pais          = $req->body->pais ?? null;
        $descripcion   = $req->body->descripcion ?? null;
        $precio        = $req->body->precio ?? null;

        // Valida que vengan todos los datos necesarios en el body
        // Si falta alguno, devolvemos un error 400 (Bad Request)
        if (empty($nombre_ciudad) || empty($pais) || empty($descripcion) || empty($precio)) {
            return $res->json('Falta completar datos', 400);
        }

        $idNuevo = $this->model->insertViaje($nombre_ciudad, $pais, $descripcion, $precio);

        // si el modelo devuelve false, algo falló al guardar (por ejemplo, error en la base de datos)
        if (!$idNuevo) {
            return $res->json('Error al insertar', 500);
        }

        // se considera una buena práctica devolver la entidad creada que contiene
        // todos los datos que el modelo agregó automaticamente
        $viaje = $this->model->getViaje($idNuevo);
        return $res->json($viaje, 201);
    }

    public function removeViaje($req, $res) {
        $id_viaje = $req->params->id;
        $viaje = $this->model->getViaje($id_viaje);

        if (!$viaje) {
            return $res->json("El viaje con el id=$id_viaje no existe", 404);
        }

        $this->model->deleteViaje($id_viaje);
        return $res->json("El viaje con el id=$id_viaje se eliminó", 200);
    }

    public function updateViaje($req, $res) {
        $id_viaje = $req->params->id;
        $viaje = $this->model->getViaje($id_viaje);

        if (!$viaje) {
            return $res->json("El viaje con el id=$id_viaje no existe", 404);
        }
        //[$nombre_ciudad, $pais, $descripcion, $precio, $id]
        $nombre_ciudad = $req->body->nombre_ciudad ?? null;
        $pais = $req->body->pais ?? null;
        $descripcion = $req->body->descripcion ?? null;
        $precio = $req->body->precio ?? null;

        // Valida que vengan todos los datos necesarios en el body
        // Si falta alguno, devolvemos un error 400 (Bad Request)
        if (empty($nombre_ciudad) || empty($pais) || empty($descripcion) || empty($precio)) {
            return $res->json('Falta completar datos', 400);
        }

        $this->model->updateViaje($id_viaje, $nombre_ciudad, $pais, $descripcion, $precio);
        
        $viaje = $this->model->getViaje($id_viaje);
        return $res->json($viaje, 200);
    }

    public function patchViaje($req, $res) {
        // TODO: este lo hacen ustedes ;)

        /* la diferencia entre un PUT y PATCH es que el PUT reemplaza el 
        recurso entero, mientras que el PATCH permite actualizaciones parciales */
    }
}



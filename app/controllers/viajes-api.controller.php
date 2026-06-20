<?php
require_once __DIR__ . '/../models/viajes.model.php';

class ViajesApiController {
    private $model;

    public function  __construct() {
        $this->model = new ViajesModel();
    }

    public function getViajes($req, $res) {
        $status = $req->query->status ?? null;

        if ($status) {
            // verificar que el estado sea válido -> sino Bad Request 400
            $issues = $this->model->getAllByStatus($status);
        } else {
            $issues = $this->model->getViajes();
        }

        // respondo issues con 200 OK
        return $res->json($issues, 200);
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
        $nombre_ciudad = $req->body->title ?? null;
        $pais = $req->body->pais ?? null;
        $descripcion = $req->body->description ?? null;
        $precio = $req->body->precio ?? null;
        $id = $req->body->id ?? null;

        // Valida que vengan todos los datos necesarios en el body
        // Si falta alguno, devolvemos un error 400 (Bad Request)
        if (empty($nombre_ciudad) || empty($pais) || empty($descripcion) || empty($precio)) {
            return $res->json('Falta completar datos', 400);
        }

        $id = $this->model->insertViaje($nombre_ciudad, $pais, $descripcion, $precio, $id);

        // si el modelo devuelve false, algo falló al guardar (por ejemplo, error en la base de datos)
        if (!$id) {
            return $res->json('Error al insertar', 500);
        }

        // se considera una buena práctica devolver la entidad creada que contiene
        // todos los datos que el modelo agregó automaticamente
        $viaje = $this->model->getViaje($id);
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
        $nombre_ciudad = $req->body->title ?? null;
        $pais = $req->body->pais ?? null;
        $descripcion = $req->body->description ?? null;
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



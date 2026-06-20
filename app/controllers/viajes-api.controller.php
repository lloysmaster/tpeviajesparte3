<?php
require_once __DIR__ . '/../models/viajes.model.php';

class ViajesApiController {
    private $model;

    public function  __construct() {
        $this->model = new ViajesModel();

        // no hay vista en la API REST
    }

    public function getViajes($req, $res) {
        $status = $req->query->status ?? null;

        if ($status) {
            // TODO: verificar que el estado sea válido -> sino Bad Request 400
            
            $issues = $this->model->getAllByStatus($status);
        } else {
            $issues = $this->model->getAll();
        }

        // respondo issues con 200 OK
        return $res->json($issues, 200);
    }

    public function getViajeById($req, $res) {
        // obtengo el ID que viene como parámetro del endpoint
        $id_viaje = $req->params->id;

        $viaje = $this->model->get($id_viaje);

        if (!$viaje) {
            return $res->json("El viaje con el id=$id_viaje no existe", 404);
        }

        return $res->json($viaje, 200);
    }

    public function insertViaje($req, $res) {
        $title = $req->body->title ?? null;
        $description = $req->body->description ?? null;
        $assigned = $req->body->assigned ?? null;
        $type = $req->body->type ?? null;
        $status = $req->body->status ?? 'TODO';

        // Valida que vengan todos los datos necesarios en el body
        // Si falta alguno, devolvemos un error 400 (Bad Request)
        if (empty($title) || empty($description) || empty($type)) {
            return $res->json('Falta completar datos', 400);
        }

        $id = $this->model->insert($title, $description, $assigned, $type, $status);

        // si el modelo devuelve false, algo falló al guardar (por ejemplo, error en la base de datos)
        if (!$id) {
            return $res->json('Error al insertar', 500);
        }

        // se considera una buena práctica devolver la entidad creada que contiene
        // todos los datos que el modelo agregó automaticamente
        $viaje = $this->model->get($id);
        return $res->json($viaje, 201);
    }

    public function removeViaje($req, $res) {
        $id_viaje = $req->params->id;
        $viaje = $this->model->get($id_viaje);

        if (!$viaje) {
            return $res->json("El viaje con el id=$id_viaje no existe", 404);
        }

        $this->model->delete($id_viaje);
        return $res->json("El viaje con el id=$id_viaje se eliminó", 200);
    }

    public function updateViaje($req, $res) {
        $id_viaje = $req->params->id;
        $viaje = $this->model->get($id_viaje);

        if (!$viaje) {
            return $res->json("El viaje con el id=$id_viaje no existe", 404);
        }

        $title = $req->body->title ?? null;
        $description = $req->body->description ?? null;
        $assigned = $req->body->assigned ?? null;
        $type = $req->body->type ?? null;
        $status = $req->body->status ?? 'TODO';

        // Valida que vengan todos los datos necesarios en el body
        // Si falta alguno, devolvemos un error 400 (Bad Request)
        if (empty($title) || empty($description) || empty($type)) {
            return $res->json('Falta completar datos', 400);
        }

        $this->model->update($id_viaje, $title, $description, $assigned, $type, $status);
        
        $viaje = $this->model->get($id_viaje);
        return $res->json($viaje, 200);
    }

    public function patchViaje($req, $res) {
        // TODO: este lo hacen ustedes ;)

        /* la diferencia entre un PUT y PATCH es que el PUT reemplaza el 
        recurso entero, mientras que el PATCH permite actualizaciones parciales */
    }
}



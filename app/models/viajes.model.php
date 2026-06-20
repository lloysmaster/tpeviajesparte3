<?php
require_once 'app/models/model.php';

class ViajesModel extends Model {
    
    private $columnasPermitidas = ['id', 'nombre_ciudad', 'pais', 'descripcion', 'precio'];
    // Obtener todas las categorías (viajes)
    public function getViajes($sort = null, $order = 'ASC') {
    $sql = "SELECT * FROM viaje";
    $sql .= $this->buildOrderBy($sort, $order);
    
    // Cambia $this->db->select($sql) por esto:
    $query = $this->db->query($sql);
    return $query->fetchAll(PDO::FETCH_OBJ);
}

public function getViajesByDestino($destino, $sort = null, $order = 'ASC') {
    $sql = "SELECT * FROM viaje WHERE nombre_ciudad = ?";
    $sql .= $this->buildOrderBy($sort, $order);
    
    // Cambia esto:
    // return $this->db->select($sql, [$destino]);
    
    // Por esto:
    $query = $this->db->prepare($sql);
    $query->execute([$destino]);
    return $query->fetchAll(PDO::FETCH_OBJ);
}

    // Obtener un viaje específico
    public function getViaje($id) {
        $query = $this->db->prepare("SELECT * FROM viaje WHERE id = ?");
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    public function insertViaje($nombre_ciudad, $pais, $descripcion, $precio) {
    $query = $this->db->prepare("INSERT INTO viaje (nombre_ciudad, pais, descripcion, precio) VALUES (?, ?, ?, ?)");
    $query->execute([$nombre_ciudad, $pais, $descripcion, $precio]);
    return $this->db->lastInsertId(); // <-- Agrega esto para devolver el nuevo ID
}

    // Modificar un viaje existente
    public function updateViaje($id, $nombre_ciudad, $pais, $descripcion, $precio) {
        $query = $this->db->prepare("UPDATE viaje SET nombre_ciudad = ?, pais = ?, descripcion = ?, precio = ? WHERE id = ?");
        $query->execute([$nombre_ciudad, $pais, $descripcion, $precio, $id]);
    }

    // Eliminar un viaje
    public function deleteViaje($id) {
        $query = $this->db->prepare("DELETE FROM viaje WHERE id = ?");
        $query->execute([$id]);
    }

    private function buildOrderBy($sort, $order) {
    // 1. Validar columna contra lista blanca
    if (!in_array($sort, $this->columnasPermitidas)) {
        return ""; // Si no es válida, no ordenamos o ponemos un default
    }

    // 2. Validar orden (solo puede ser ASC o DESC)
    $order = (strtoupper($order) === 'DESC') ? 'DESC' : 'ASC';

    return " ORDER BY $sort $order";
}
}
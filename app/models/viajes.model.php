<?php
require_once 'app/models/model.php';

class ViajesModel extends Model {
    
    // Obtener todas las categorías (viajes)
    public function getViajes($sort = null, $order = 'ASC') {
    // Validar columnas permitidas para evitar SQL Injection
    $allowedSortColumns = ['nombre_ciudad', 'pais', 'precio'];
    $sort = in_array($sort, $allowedSortColumns) ? $sort : 'id'; // Default: id
    
    // Validar orden
    $order = (strtoupper($order) === 'DESC') ? 'DESC' : 'ASC';

    $sql = "SELECT * FROM viaje ORDER BY $sort $order";
    
    $query = $this->db->prepare($sql);
    $query->execute();
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
    }
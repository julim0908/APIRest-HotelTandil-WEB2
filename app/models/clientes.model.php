<?php
require_once 'app/models/model.php';
class ClientModel extends Model {

  public function GetAllClientes($apellido = null, $nombre = null, $email = null, $telefono = null, $orderByColumn = null, $orderBy = null) {
    $sql = 'SELECT * FROM clientes';
    $params = [];
    $conditions = [];  // Almacenaremos todas las condiciones WHERE.

    // Filtrar por apellido si está especificado
    if ($apellido != null) {
        $conditions[] = "apellido LIKE ?";
        $params[] = "%$apellido%";
    }

    // Filtrar por nombre si está especificado
    if ($nombre != null) {
        $conditions[] = "nombre LIKE ?";
        $params[] = "%$nombre%";
    }

    // Filtrar por email si está especificado
    if ($email != null) {
        $conditions[] = "email LIKE ?";
        $params[] = "%$email%";
    }

    // Filtrar por teléfono si está especificado
    if ($telefono != null) {
        $conditions[] = "telefono LIKE ?";
        $params[] = "%$telefono%";
    }

    // Si hay condiciones, agregarlas a la consulta con AND
    if (count($conditions) > 0) {
        $sql .= ' WHERE ' . implode(' AND ', $conditions);
    }

    // Ordenar si se especifica un criterio de orden
    if ($orderByColumn && $orderBy) {
        $sql .= ' ORDER BY ' . $orderByColumn . ' ' . $orderBy; // Aquí solo debes concatenar una vez 'ASC' o 'DESC'
    }

    // Ejecutar la consulta preparada
    $query = $this->db->prepare($sql);
    $query->execute($params);

    // Retornar los resultados como un arreglo de objetos
    return $query->fetchAll(PDO::FETCH_OBJ);
}




public function getClientesById($id){
  $query = $this->db->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
  $query->execute([$id]);  // Asegúrate de pasar el parámetro correcto
  $cliente = $query->fetch(PDO::FETCH_OBJ);  
  return $cliente;
}

function insertClient($nombre, $apellido, $email, $telefono){
  $query = $this->db->prepare("INSERT INTO clientes (nombre, apellido, email, telefono) VALUES (?, ?, ?, ?)");
  $query->execute([$nombre, $apellido, $email, $telefono]);
  return $this->db->lastInsertId();
}

function EditClient($nombre, $apellido, $email, $telefono, $id){
  $query = $this->db->prepare("UPDATE clientes SET nombre = ?, apellido = ?, email = ?, telefono = ? WHERE id_cliente = ?");
  $query->execute([$nombre, $apellido, $email, $telefono, $id]);
  return $query;
}

}
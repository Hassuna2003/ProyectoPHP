<?php
include_once ('db/db.php');

class UsuarioDAO {
    public $db_con;

    public function __construct() {
        $this->db_con = Database::open_connection();
    }
    
    public function loginUser($nombre, $password) {
        $stmt = $this->db_con->prepare("SELECT * FROM Usuarios WHERE nombre = :nombre");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->execute();
        
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Verificar si existe el usuario y la contraseña coincide (texto plano)
        if ($usuario && $usuario['password'] === $password) {
            return $usuario;
        }
        
        return false;
    }

    public function registerUser($nombre, $password) {
        $stmt = $this->db_con->prepare("INSERT INTO Usuarios (nombre, password) VALUES (:nombre, :password)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':password', $password);
        
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
?>
<?php
include_once ('db/db.php');
/**
 * Clase de acceso a datos para la tabla productos. IMplementa todos los métodos que necesiten atacar
 * la tabla productos de la base de datos.
 */
class ProductoDAO {

    //Atributo con la conexión a la BBDD.
    public $db_con;

    //Constructor que inicializa la conexión a la BBDD.
    public function __construct (){
        $this->db_con = Database::open_connection();
    }

    //Método que devuelve un array con todos los productos existentes en la base de datos.
    public function getAllProducts(){
        $stmt= $this->db_con->prepare("SELECT * FROM Productos");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $stmt->execute();
        
        return $stmt->fetchAll();
    }

    //Método que devuelve toda la información de un producto dado su id.
    public function getProductById($id){
        $stmt= $this->db_con->prepare("SELECT * FROM Productos WHERE id_producto = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $stmt->execute();

        return $stmt->fetch();        
    }

    //Insertar un producto en la base de datos.
    /**
     * Parámetros: 
     *  $nombre, nombre del producto.
     *  $descrip, descripción del producto.
     *  $precio, precio del producto.
     *  $imagen, imagen del producto (opcional).
     * 
     *  Retorna true si la inserción fue exitosa y false en caso contrario.
     */
    public function insertProduct($nombre, $descrip, $precio, $imagen = 'hp1.jpg'){
        $stmt= $this->db_con->prepare("INSERT INTO Productos (nombre, descripcion, precio, imagen) VALUES (:nombre, :descripcion, :precio, :imagen)");      
        
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descrip);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':imagen', $imagen);

        try{
            return $stmt->execute();
        } catch (PDOException $e){
            echo $e->getMessage();
            return false;
        }
    }
    
    public function updateProduct($id, $nombre, $descrip, $precio, $imagen = null) {
        // Si no se proporciona imagen, no la actualizamos
        if ($imagen) {
            $stmt = $this->db_con->prepare("UPDATE Productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio, imagen = :imagen WHERE id_producto = :id");
            $stmt->bindParam(':imagen', $imagen);
        } else {
            $stmt = $this->db_con->prepare("UPDATE Productos SET nombre = :nombre, descripcion = :descripcion, precio = :precio WHERE id_producto = :id");
        }
        
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descrip);
        $stmt->bindParam(':precio', $precio);
        
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
}
?>
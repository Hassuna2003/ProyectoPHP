<?php
/**
 * Controlador de Usuarios. Implementará todas las acciones relacionadas con la autenticación
 * y gestión de usuarios.
 */
include_once ("views/View.php");
class UserController {
    
    /**
     * Método que muestra el formulario de inicio de sesión.
     */
    public function loginForm() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        // Si ya está autenticado, redirigir a la página principal
        if (isset($_SESSION['usuario'])) {
            header("Location: index.php");
            exit;
        }
        
        View::show("loginForm", isset($_GET['error']) ? ['error' => 'Credenciales inválidas'] : null);
    }
    
    /**
     * Método que procesa el inicio de sesión.
     */
    public function login() {
        if (isset($_POST['nombre']) && isset($_POST['password'])) {
            require_once ("models/usuarios.php");
            $uDAO = new UsuarioDAO();
            $usuario = $uDAO->loginUser($_POST['nombre'], $_POST['password']);
            
            if ($usuario) {
                // Iniciar sesión
                session_start();
                $_SESSION['id_usuario'] = $usuario['id_usuario'];
                $_SESSION['usuario'] = $usuario['nombre'];
                $_SESSION['rol'] = $usuario['rol'];
                
                header("Location: index.php");
            } else {
                // Credenciales inválidas
                header("Location: index.php?controller=UserController&action=loginForm&error=1");
            }
        } else {
            // Datos no proporcionados
            header("Location: index.php?controller=UserController&action=loginForm");
        }
    }
    
    /**
     * Método que cierra la sesión.
     */
    public function logout() {
        session_start();
        session_destroy();
        
        header("Location: index.php");
    }
}
?>
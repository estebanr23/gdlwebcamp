<?php 

/* Verificar Conexion a la Base de Datos

if($conn->ping()) {
    echo "Conectado";
} else{
    echo "NO!";
}
*/
include_once 'funciones/funciones.php';
$usuario = $_POST['usuario'];
$nombre = $_POST['nombre'];
$password = $_POST['password'];
$id_registro = $_POST['id_registro'];
$nivel = 1;

if ($_POST['registro'] == 'nuevo') {
    // die(json_encode($_POST)); Detiene la ejecucion (como un break) y muestra por consola los datos de _POST.
    // $usuario = $_POST['usuario'];
    // $nombre = $_POST['nombre'];
    // $password = $_POST['password'];
    
    $opciones = array(
        'cost' => 12
    );

    $password_hashed = password_hash($password, PASSWORD_BCRYPT, $opciones);

    try {
        $stmt = $conn->prepare("INSERT INTO admins (usuario, nombre, password, nivel) VALUES (?,?,?,?)");
        $stmt->bind_param("sssi", $usuario, $nombre, $password_hashed, $nivel);
        $stmt->execute();
        $id_registro = $stmt->insert_id; // Obtener el ID generado en la operación INSERT anterior.
        // affected_row Devuelve el número total de filas cambiadas, borradas, o insertadas por la última sentencia ejecutada.
        // if($stmt->affected_rows) { // Si se inserto algo en la base de datos quiero esta respuesta.
        if($id_registro > 0) { // El id de un registro es mayor a 0 siempre.
            $respuesta = array(
                'respuesta' => 'exito',
                'id_admin' => $id_registro
            ); 
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
            // die(json_encode($respuesta));
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }

    die(json_encode($respuesta)); // Esta linea me devuelve como respuesta un array asociativo de php (por consola) al que puedo acceder con js como si fuera un objeto.
}

// Editar admin
if ($_POST['registro'] == 'actualizar') {
    
    try {
        // empty() cheque si una variable esta vacia.
        if(empty($_POST['password'])) {
            $stmt = $conn->prepare("UPDATE admins SET usuario = ?, nombre = ?, editado = NOW() WHERE id_admin = ?");
            $stmt->bind_param("ssi", $usuario, $nombre, $id_registro);
        } else {
            $opciones = array(
                'cost' => 12
            );
    
            $hash_password = password_hash($password, PASSWORD_BCRYPT, $opciones);
            $stmt = $conn->prepare('UPDATE admins SET usuario = ?, nombre = ?, password = ?, editado = NOW() WHERE id_admin = ?');
            $stmt->bind_param("sssi", $usuario, $nombre, $hash_password, $id_registro);
        }
        
        $stmt->execute();
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_actualizado' => $stmt->insert_id
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }
    
    die(json_encode($respuesta));
}

// Eliminar admin
if ($_POST['registro'] == 'eliminar') { 
    $id_borrar = $_POST['id'];

    try {
        $stmt = $conn->prepare('DELETE FROM admins WHERE id_admin = ? ');
        $stmt->bind_param('i', $id_borrar);
        $stmt->execute();
        if($stmt->affected_rows){
            $respuesta = array(
                'respuesta' => 'exito',
                'id_eliminado' => $id_borrar
            );
        } else {
            $respuesta = array(
                'respuesta' => 'error'
            );
        }
    } catch (Exception $e) {
        $respuesta = array(
            'respuesta' => $e->getMessage()
        );
    }

    die(json_encode($respuesta));
}

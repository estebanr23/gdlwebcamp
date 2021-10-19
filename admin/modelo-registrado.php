<?php 
include_once 'funciones/funciones.php';

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$email = $_POST['email'];

$boletos_adquiridos = $_POST['boletos'];

$camisas = $_POST['pedido_camisas'];
$etiquetas = $_POST['pedido_etiquetas'];
$pedido_json = productos_json($boletos_adquiridos, $camisas, $etiquetas);

// Eliminar elementos nulos
$pedido_array = json_decode($pedido_json, true); // conierte el json a un array.
$array_modificado = array_filter($pedido_array); // elimina valores nulos o vacios del array.

$pedido = json_encode($array_modificado); // convierte el array modificado en json.

$total = $_POST['total_pedido'];
$regalo = $_POST['regalo'];

$eventos = $_POST['registro_evento'];
$registro_eventos = eventos_json($eventos);

$fecha_registro = $_POST['fecha_registro'];
$id_registro = $_POST['id_registro'];

// Agregar Registro
if ($_POST['registro'] == 'nuevo') {

    try {
        $stmt = $conn->prepare('INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado, pagado) VALUES (?, ?, ?, NOW(), ?, ?, ?, ?, 1) ');
        $stmt->bind_param("sssssis", $nombre, $apellido, $email, $pedido, $registro_eventos, $regalo, $total);
        $stmt->execute();
        $id_insertado = $stmt->insert_id;
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_insertado' => $id_insertado
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

// Editar Registro
if ($_POST['registro'] == 'actualizar') {

    try {
        $stmt = $conn->prepare("UPDATE registrados SET nombre_registrado = ?, apellido_registrado = ?, email_registrado = ?, fecha_registro = ?, pases_articulos = ?, talleres_registrados = ?, regalo = ?, total_pagado = ?, pagado = 1 WHERE id_registrados = ? ");
        $stmt->bind_param('ssssssisi', $nombre, $apellido, $email, $fecha_registro, $pedido, $registro_eventos, $regalo, $total, $id_registro);
        $stmt->execute();
        $id_insertado = $stmt->insert_id;
        if($stmt->affected_rows) {
            $respuesta = array(
                'respuesta' => 'exito',
                'id_actualizado' => $id_registro
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

// Eliminar Registro
if ($_POST['registro'] == 'eliminar') { 
    $id_borrar = $_POST['id'];

    try {
        $stmt = $conn->prepare('DELETE FROM registrados WHERE id_registrados = ? ');
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

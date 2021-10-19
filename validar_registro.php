<?php if(isset($_POST['submit'])): ?>
        <?php   
            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $email = $_POST['email'];
            $regalo = $_POST['regalo'];
            $total = $_POST['total_pedido'];
            $fecha = date('Y-m-d H:i:s');

            // Pago
            $pagado = 0;

            // Pedidos
            $boletos = $_POST['boletos'];
            $camisas = $_POST['pedido_camisas'];
            $etiquetas = $_POST['pedido_etiquetas'];
            include_once 'includes/funciones/funciones.php';
            $pedido_json = productos_json($boletos, $camisas, $etiquetas);

            // Eliminar elementos nulos
            $pedido_array = json_decode($pedido_json, true); // convierte el json a un array.
            $array_modificado = array_filter($pedido_array); // elimina valores nulos o vacios del array.

            $pedido = json_encode($array_modificado); // convierte el array modificado en json.

            // Eventos
            $eventos = $_POST['registro'];
            $registro = eventos_json($eventos);
            try {
                require_once('includes/funciones/bd_conexion.php'); 
                $stmt = $conn->prepare("INSERT INTO registrados (nombre_registrado, apellido_registrado, email_registrado, fecha_registro, pases_articulos, talleres_registrados, regalo, total_pagado, pagado) VALUES (?,?,?,?,?,?,?,?,?) "); // Preparar consulta
                $stmt->bind_param("ssssssisi", $nombre, $apellido, $email, $fecha, $pedido, $registro, $regalo, $total, $pagado); // Pasarle los datos a la consulta
                $stmt->execute();
                $stmt->close();
                $conn->close();
                header('Location: validar_registro.php?exitoso=1'); // Agregamos parametros a la url para que al actualizar no se redireccione de nuevo al archivo validar_registro.php y vuelva a ejecutar la consulta.
            } catch (\Exception $e) {
                echo $e->getMessage();
            }      
        ?>
<?php endif; ?>

<?php include_once 'includes/templates/header.php'; ?>
    <section class="seccion contenedor">
        <h2>Resumen Registro</h2>
        
        <?php if(isset($_GET['exitoso'])): 
                if($_GET['exitoso'] == "1"): 
                    echo "Registro exitoso";
                endif;
        endif; ?>

    </section>
<?php include_once 'includes/templates/footer.php'; ?>
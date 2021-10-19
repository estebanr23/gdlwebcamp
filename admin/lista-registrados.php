<?php include_once 'funciones/sesiones.php';
      
      include_once 'templates/header.php'; 

      include_once 'templates/barra.php'; 

      include_once 'templates/navegacion.php'; 

      include_once 'funciones/funciones.php';
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Listado de Personas registradas
        <small></small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Maneja los visitantes registrados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="registros" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Fecha Registro</th>
                  <th>Articulos</th>
                  <th>Talleres</th>
                  <th>Regalo</th>
                  <th>Compra</th>
                  <th>Acciones</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                    try {
                      $sql = "SELECT registrados.*, regalos.nombre_regalo FROM registrados ";
                      $sql .= " JOIN regalos ";
                      $sql .= " ON registrados.regalo = regalos.id_regalo ";
                      $resultado = $conn->query($sql);
                      // Verificar sintaxis en la consulta
                      // echo $sql;
                    } catch(Exception $e) {
                      $error = $e->getMessage();
                      echo $error;
                    }

                    while($registrado = $resultado->fetch_assoc()) { ?>
                      <tr>
                        <td><?php echo $registrado['nombre_registrado'] . " " . $registrado['apellido_registrado']; 
                            $pagado = $registrado['pagado'];
                            if($pagado) {
                                echo '<span class="badge bg-green">Pagado</span>';
                            } else {
                                echo '<span class="badge bg-red">No Pagado</span>';
                            }
                            ?>
                        </td>
                        <td><?php echo $registrado['email_registrado']; ?></td>
                        <td><?php echo $registrado['fecha_registro']; ?></td>
                        <td><?php 
                              // Para pasar un json a un array se usa json_decode(). Si no agregamos el parametro "true" convierte el json a un objeto.
                              // El array se accede con array_nombre['propiedad'] y a un objeto se accede usando objeto_nombre->propiedad.
                              $articulos = json_decode($registrado['pases_articulos'], true); 
                              $arreglo_articulos = array(
                                'un_dia' => 'Pase 1 dia',
                                'pase_2dias' => 'Pase 2 dias',
                                'pase_completo' => 'Pase completo',
                                'camisas' => 'Camisas',
                                'etiquetas' => 'Etiquetas'
                              );

                              foreach($articulos as $llave => $articulo) {
                                // La variable $llave conecta el array "articulos" con "arreglo_articulos".
                                echo $articulo . " " . $arreglo_articulos[$llave] ."<br>";
                              }

                          ?>
                        </td>
                        <td>
                          <?php $eventos_resultado = $registrado['talleres_registrados'];
                                $talleres = json_decode($eventos_resultado, true);

                                // implode() coloa todos los alores de un array en forma de cadena.
                                $talleres = implode("', '", $talleres['eventos']);
                                $sql_talleres = "SELECT nombre_evento, fecha_evento, hora_evento FROM eventos WHERE clave IN ('$talleres') OR evento_id IN ('$talleres') ";
                                
                                $resultado_talleres = $conn->query($sql_talleres);
    
                                while($eventos = $resultado_talleres->fetch_assoc()) {
                                  echo $eventos['nombre_evento'] . " " . $eventos['fecha_evento'] . " " . $eventos['hora_evento'] . "<br>";
                                }

                          ?>
                        </td>
                        <td><?php echo $registrado['nombre_regalo']; ?></td>
                        <td>$ <?php echo (float) $registrado['total_pagado']; ?></td>
                        <td>
                          <a href="editar-registro.php?id=<?php echo $registrado['id_registrados']; ?>" class="btn bg-orange btn-flat margin">
                            <i class="fa fa-pencil"></i>
                          </a>
                          <a href="#" data-id="<?php echo $registrado['id_registrados']; ?>" data-tipo="registrado" class="btn bg-maroon bnt-flat margin borrar_registro">
                            <i class="fa fa-trash"></i>
                          </a>
                        </td>
                      </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>Nombre</th>
                  <th>Email</th>
                  <th>Fecha Registro</th>
                  <th>Articulos</th>
                  <th>Talleres</th>
                  <th>Regalo</th>
                  <th>Compra</th>
                  <th>Acciones</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php include_once 'templates/footer.php'; ?>
  

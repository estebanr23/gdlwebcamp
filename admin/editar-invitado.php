<?php include_once 'funciones/sesiones.php';

      include_once 'funciones/funciones.php';

      include_once 'templates/header.php'; 
      $id = $_GET['id'];
      if(!filter_var($id, FILTER_VALIDATE_INT)) { // La funcion comprueba que id sea un entero.
        die("Error!");
      }

      include_once 'templates/barra.php'; 

      include_once 'templates/navegacion.php'; 
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Editar Invitado
        <small>Puedes editar los datos de los invitados aqui</small>
      </h1>
    </section>
      
    <div class="row">
      <div class="col-md-8">
        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Invitado</h3>
            </div>
            <?php
              $sql = "SELECT * FROM `invitados` WHERE `invitado_id` = $id ";
              $resultado = $conn->query($sql);
              $invitado = $resultado->fetch_assoc();

            ?>
            <!-- form start -->
            <form role="form" name="guardar_registro" id="guardar-registro-archivo" method="POST" action="modelo-invitado.php" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre_invitado">Nombre:</label>
                  <input type="text" class="form-control" id="nombre_invitado" name="nombre_invitado" placeholder="Nombre" value="<?php echo $invitado['nombre_invitado']; ?>">
                </div>
                <div class="form-group">
                  <label for="apellido_invitado">Apellido:</label>
                  <input type="text" class="form-control" id="apellido_invitado" name="apellido_invitado" placeholder="Apellido" value="<?php echo $invitado['apellido_invitado']; ?>">
                </div>
                <div class="form-group">
                  <label for="biografia_invitado">Biografia:</label>
                  <textarea class="form-control" name="biografia_invitado" id="biografia_invitado" rows="8" placeholder="Biografia"><?php echo $invitado['descripcion']; ?></textarea>
                </div>
                <div class="form-group">
                  <label for="imagen_actual">Imagen Actual:</label>
                  <br>
                  <img src="../img/invitado/<?php echo $invitado['url_imagen']; ?>" width="200">
                </div>
                <div class="form-group">
                  <label for="imagen_invitado">File input</label>
                  <input type="file" class="form-control" id="imagen_invitado" name="archivo_imagen">

                  <p class="help-block">Añada la imagen aqui</p>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <input type="hidden" name="registro" value="actualizar">
                <input type="hidden" name="id_registro" value="<?php echo $invitado['invitado_id']; ?>">
                <button type="submit" class="btn btn-primary" id="crear_registro">Añadir</button>
              </div>
            </form>
          </div>
          <!-- /.box -->
        </section>
        <!-- /.content -->
      </div>
    </div>
  </div>
  <!-- /.content-wrapper -->

<?php include_once 'templates/footer.php'; ?>
  

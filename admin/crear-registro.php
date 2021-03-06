<?php include_once 'funciones/sesiones.php';

      include_once 'funciones/funciones.php';

      include_once 'templates/header.php'; 

      include_once 'templates/barra.php'; 

      include_once 'templates/navegacion.php'; 
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Crear Registro de Usuarios Manual
        <small>Llena el formulario para crear un registro</small>
      </h1>
    </section>
      
    <div class="row">
      <div class="col-md-8">
        <!-- Main content -->
        <section class="content">
          <!-- Default box -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Crear Usuario</h3>
            </div>
            <!-- form start -->
            <form role="form" name="guardar_registro" id="guardar_registro" method="POST" action="modelo-registrado.php">
              <div class="box-body">
                <div class="form-group">
                  <label for="nombre_registrado">Nombre:</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre">
                </div>
                <div class="form-group">
                  <label for="apellido_registrado">Apellido:</label>
                  <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido">
                </div>
                <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                </div>
                <div class="form-group">
                    <div id="paquetes" class="paquetes">
                        <div class="box-header with-border">
                            <h3 class="box-title">Elige el numero de boletos</h3>
                        </div>
                        <ul class="lista-precios row">
                            <li class="card-precios col-md-4">
                                <div class="tabla-precios text-center">
                                    <h3>Pase por d??a (viernes) </h3>
                                    <p class="numero"> $30</p>
                                    <ul>
                                        <li>Bocadillos gratis</li>
                                        <li>Todas las conferencias</li>
                                        <li>Todos los talleres</li>
                                    </ul>
                                    <div class="orden">
                                        <label for="pase_dia">Boletos deseados</label>
                                        <input type="number" class="form-control" min="0" id="pase_dia" size="3" name="boletos[]" placeholder="0">
                                    </div>
                                </div>
                            </li>
                            <li class="card-precios col-md-4">
                                <div class="tabla-precios text-center">
                                    <h3>Pase por d??a</h3>
                                    <p class="numero"> $50</p>
                                    <ul>
                                        <li>Bocadillos gratis</li>
                                        <li>Todas las conferencias</li>
                                        <li>Todos los talleres</li>
                                    </ul>
                                    <div class="orden">
                                        <label for="pase_completo">Boletos deseados</label>
                                        <input type="number" class="form-control" min="0" id="pase_completo" size="3" name="boletos[]" placeholder="0">
                                    </div>
                                </div>
                            </li>
                            <li class="card-precios col-md-4">
                                <div class="tabla-precios text-center">
                                    <h3>Pase por d??a(viernes y s??bados)</h3>
                                    <p class="numero"> $45</p>
                                    <ul>
                                        <li>Bocadillos gratis</li>
                                        <li>Todas las conferencias</li>
                                        <li>Todos los talleres</li>
                                    </ul>
                                    <div class="orden">
                                        <label for="pase_dosdias">Boletos deseados</label>
                                        <input type="number" class="form-control" min="0" id="pase_dosdias" size="3" name="boletos[]" placeholder="0">
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div><!--.paquetes-->
                </div><!--.form-group-->

                <div class="form-group">
                    <div class="box-header with-border">
                        <h3 class="box-title">Elige los talleres</h3>
                    </div>
                    <div class="caja">
                        <?php
                            try {
                                $sql = "SELECT eventos.*, categoria_evento.cat_evento, invitados.nombre_invitado, invitados.apellido_invitado ";
                                $sql .= "FROM eventos ";
                                $sql .= "JOIN categoria_evento ";
                                $sql .= "ON eventos.id_cat_evento = categoria_evento.id_categoria ";
                                $sql .= "JOIN invitados ";
                                $sql .= "ON eventos.id_inv = invitados.invitado_id ";
                                $sql .= "ORDER BY eventos.fecha_evento, eventos.id_cat_evento, eventos.hora_evento ";
                                $resultado = $conn->query($sql);

                            } catch (Exception $e) {
                                echo $e->getMessage();
                            }

                            $eventos_dias = array();
                            while($eventos = $resultado->fetch_assoc()) {
                                $fecha = $eventos['fecha_evento'];
                                // Cambiar la configuracion del servidor para que muestre los nombre de los dias en espa??ol.
                                //setlocale(LC_ALL, 'es_ES');
                                // Toma una fecha y devuelve el dia de la semana
                                $dia_semana = strftime("%A", strtotime($fecha));
                                $categoria = $eventos['cat_evento'];

                                $dia_es = array(
                                    'Friday' => 'viernes',
                                    'Saturday' => 'sabado',
                                    'Sunday' => 'domingo'
                                );
                                $dia_traducido = $dia_es[$dia_semana];

                                $dia = array(
                                    'nombre_evento' => $eventos['nombre_evento'],
                                    'hora' => $eventos['hora_evento'],
                                    'id' => $eventos['evento_id'],
                                    'nombre_invitado' => $eventos['nombre_invitado'],
                                    'apellido_invitado' => $eventos['apellido_invitado']
                                );
                                // Agrupar datos del array por dia de la semana. 
                                //$eventos_dias[$dia_semana]['eventos'][$categoria][] = $dia;
                                $eventos_dias[$dia_traducido]['eventos'][$categoria][] = $dia;
                            }
                        ?>

                        <?php foreach($eventos_dias as $dia => $eventos) { ?>
                            <!--str_replace(valor a remplazar, nuevo valor, donde buscar el valor a reemplazar)-->
                            <div id="<?php echo str_replace('??', 'a', $dia); ?>" class="contenido-dia clearfix row">
                            <h4 class="text-center nombre-dia"><?php echo $dia; ?></h4>

                            <?php foreach($eventos['eventos'] as $tipo => $evento_dia): ?>
                                <div class="col-md-4">
                                    <p><?php echo $tipo; ?></p>

                                    <?php foreach($evento_dia as $evento) { ?>
                                        <label>
                                            <input type="checkbox" class="minimal" name="registro_evento[]" id="<?php echo $evento['id']; ?>" value="<?php echo $evento['id']; ?>">
                                            <time><?php echo $evento['hora']; ?></time> "<?php echo $evento['nombre_evento']; ?>
                                            <br>
                                            <span class="autor"><?php echo $evento['nombre_invitado'] . " " . $evento['apellido_invitado']; ?></span>
                                        </label>
                                    <?php } //foreach ?>
                                </div>
                            <?php endforeach; ?>
                            </div> <!--.contenido-dia -->
                        <?php } ?>
                    </div> <!--.caja-->

            <div id="resumen" class="resumen clearfix">
                <div class="box-header with-border">
                    <h3 class="box-title">Pagos y Extras</h3>
                </div>
                <br>
                <div class="caja clearfix row">
                    <div class="extras col-md-6">
                        <div class="orden">
                            <label for="camisa_evento">Camisa del evento $10 <small>(promoci??n 7% de dto.)</small> </label>
                            <input type="number" class="form-control" min="0" id="camisa_evento" name="pedido_camisas" size="3" placeholder="0">
                        </div>
                        <!--orden-->

                        <div class="orden">
                            <label for="etiquetas">Paquete de 10 etiquetas $2 <small>(HTML5, CSS3, JavaScript, Chrome)</small> </label>
                            <input type="number" class="form-control" min="0" id="etiquetas" name="pedido_etiquetas" size="3" placeholder="0">
                        </div>
                        <!--orden-->
                        <div class="orden">
                            <label for="regalo">Seleccione un regalo</label> 
                            <select id="regalo" name="regalo" required class="form-control seleccionar">
                                <option value="">Seleccione un regalo</option>
                                <option value="2">Etiquetas</option>
                                <option value="1">Pulseras</option>
                                <option value="3"> Plumas</option>
                            </select>
                        </div>
                        <br>
                        <input type="button" id="calcular" class="btn btn-success" value="Calcular">
                    </div>

                    <div class="total col-md-6">
                        <p>Resumen</p>
                        <div id="lista-productos"></div>
                        <p>Total:</p>
                        <div id="suma-total"></div>
                        <input type="hidden" name="total_pedido" id="total_pedido">
                    </div>
                    <!---total-->
                </div>
                <!--caja-->
            </div>
            <!--resumen-->

              </div><!-- /.box-body -->
              <div class="box-footer">
                <input type="hidden" name="registro" value="nuevo">
                <button type="submit" class="btn btn-primary" id="btnRegistro">A??adir</button>
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
  

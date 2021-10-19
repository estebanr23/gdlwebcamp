<?php include_once 'includes/templates/header.php'; ?>

    <section class="seccion contenedor">
        <h2>Registro de usuarios</h2>

        <form action="validar_registro.php" method="POST" id="registro" class="registro">
            <div id="datos_usuario" class="registro caja clearfix">
                <div class="campo">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="tu nombre">
                </div>
                <div class="campo">
                    <label for="apellido">Apellido:</label>
                    <input type="text" id="apellido" name="apellido" placeholder="tu apellido">
                </div>
                <div class="campo">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" placeholder="tu email">
                </div>
                <div id="error"> </div>

            </div>
            <!--fin datos usuarios-->
            <div id="paquetes" class="paquetes">
                <h3>Elige el número de boletos</h3>
                <ul class="lista-precios ">
                    <li class="card-precios ">
                        <div class="tabla-precios ">
                            <h3>Pase por día (viernes) </h3>
                            <p class="numero"> $30</p>
                            <ul>
                                <li>Bocadillos gratis</li>
                                <li>Todas las conferencias</li>
                                <li>Todos los talleres</li>
                            </ul>
                            <div class="orden">
                                <label for="pase_dia">Boletos deseados</label>
                                <input type="number" min="0" id="pase_dia" size="3" name="boletos[]" placeholder="0">
                            </div>
                        </div>
                    </li>
                    <li class="card-precios ">
                        <div class="tabla-precios ">
                            <h3>Pase por día</h3>
                            <p class="numero"> $50</p>
                            <ul>
                                <li>Bocadillos gratis</li>
                                <li>Todas las conferencias</li>
                                <li>Todos los talleres</li>
                            </ul>
                            <div class="orden">
                                <label for="pase_completo">Boletos deseados</label>
                                <input type="number" min="0" id="pase_completo" size="3" name="boletos[]" placeholder="0">
                            </div>
                        </div>
                    </li>
                    <li class="card-precios ">
                        <div class="tabla-precios ">
                            <h3>Pase por día(viernes y sábados)</h3>
                            <p class="numero"> $45</p>
                            <ul>
                                <li>Bocadillos gratis</li>
                                <li>Todas las conferencias</li>
                                <li>Todos los talleres</li>
                            </ul>
                            <div class="orden">
                                <label for="pase_dosdias">Boletos deseados</label>
                                <input type="number" min="0" id="pase_dosdias" size="3" name="boletos[]" placeholder="0">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <!--fin paquetes-->
            <div id="eventos" class="eventos clearfix">
                <h3>Elige tus talleres</h3>
                <div class="caja">
                    <?php
                        try {
                            require_once('includes/funciones/bd_conexion.php');
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
                            $eventos_dias[$dia_traducido]['eventos'][$categoria][] = $dia;

                        }

                    ?>

                    <?php foreach($eventos_dias as $dia => $eventos) { ?>

                        <div id="<?php echo str_replace('á', 'a', $dia); ?>" class="contenido-dia clearfix">
                        <h4><?php echo $dia; ?></h4>

                        <?php foreach($eventos['eventos'] as $tipo => $evento_dia): ?>
                            <div>
                                <p><?php echo $tipo; ?></p>

                                <?php foreach($evento_dia as $evento) { ?>
                                    <label>
                                        <input type="checkbox" name="registro[]" id="<?php echo $evento['id']; ?>" value="<?php echo $evento['id']; ?>">
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
            </div>
            <!--#eventos-->

            <div id="resumen" class="resumen clearfix">
                <h3>Pago y Extras</h3>
                <div class="caja clearfix">
                    <div class="extras">
                        <div class="orden">
                            <label for="camisa_evento">Camisa del evento $10 <small>(promoción 7% de dto.)</small> </label>
                            <input type="number" min="0" id="camisa_evento" name="pedido_camisas" size="3" placeholder="0">
                        </div>
                        <!--orden-->

                        <div class="orden">
                            <label for="etiquetas">Paquete de 10 etiquetas $2 <small>(HTML5, CSS3, JavaScript, Chrome)</small> </label>
                            <input type="number" min="0" id="etiquetas" name="pedido_etiquetas" size="3" placeholder="0">
                        </div>
                        <!--orden-->
                        <div class="orden">
                            <label for="regalo">Seleccione un regalo</label>
                            <select id="regalo" name="regalo" required>
                                <option value="">Seleccione un regalo</option>
                                <option value="2">Etiquetas</option>
                                <option value="1">Pulseras</option>
                                <option value="3"> Plumas</option>
                            </select>
                        </div>
                        <input type="button" id="calcular" class="button" value="Calcular">
                    </div>

                    <div class="total">
                        <p>Resumen</p>
                        <div id="lista-productos"></div>
                        <p>Total:</p>
                        <div id="suma-total"></div>

                        <input type="hidden" name="total_pedido" id="total_pedido">
                        <input id="btnRegistro" type="submit" name="submit" class="button" value="Pagar">
                    </div>
                    <!---total-->
                </div>
                <!--caja-->
            </div>
            <!--resumen-->
        </form>

    </section>




    <?php include_once 'includes/templates/footer.php'; ?>
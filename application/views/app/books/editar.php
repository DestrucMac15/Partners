<div class="container">
    <div class="row my-5">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>opportunities">Opportunities</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>books/?opp=<?= $id_opp; ?>">Books</a></li>
                <li class="breadcrumb-item active">Editar Presupuesto</li>
            </ul>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-md-12">
            <h5>Información Presupuesto</h5>
            <hr>
            <form id="formEstimatesEdit" action="" class="was-validated">
                <div class="row my-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Estimate</label>
                            <input type="text" id="estimate_id" class="form-control" value="<?= $id_estimate; ?>" name="estimate" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Propietario de presupuesto</label>
                            <input type="text" class="form-control" value="Nacir Coronado" name="propietarioPresupuesto" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Cuenta nombre</label>
                            <input type="text" class="form-control" name="cuentaNombre" value="<?= $estimate['customer_name']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">  
                                <p>DIRECCIÓN DE FACTURACIÓN </p>
                                <p>
                                    <?= $estimate['billing_address']['address']; ?><br>
                                    <?= $estimate['billing_address']['city']; ?><br>
                                    <?= $estimate['billing_address']['state']; ?><br>
                                    <?= $estimate['billing_address']['country']; ?><br>
                                    <?= $estimate['billing_address']['zip']; ?><br>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p>DIRECCIÓN DE ENVÍO </p>
                                <p>
                                    <?= $estimate['shipping_address']['address']; ?><br>
                                    <?= $estimate['shipping_address']['city']; ?><br>
                                    <?= $estimate['shipping_address']['street2']; ?><br>
                                    <?= $estimate['shipping_address']['country']; ?><br>
                                    <?= $estimate['shipping_address']['zip']; ?><br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Oportunidad nombre</label>
                            <input type="text" class="form-control" name="oportunidadNombre" value="<?= $estimate['zcrm_potential_name']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Número del presupuesto</label>
                            <input type="text" name="numeroPresupuesto" value="<?= $estimate['estimate_number']; ?>" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">No. de referencia</label>
                            <input type="text" name="numeroReferencia" class="form-control" value="<?= $estimate['reference_number']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Fecha del presupuesto</label>
                            <input type="date" name="fechaPresupuesto" class="form-control" value="<?= $estimate['date']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Fecha de vencimiento</label>
                            <input type="date" name="fechaVencimiento" class="form-control" value="<?= $estimate['expiry_date']; ?>">
                        </div>
                    </div>
                    <div class="col-md-6" hidden>
                        <div class="form-group">
                            <label for="">Nombre del proyecto</label>
                            <input type="text" name="nombreProyecto" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6" hidden>
                        <div class="form-group">
                            <label for="">Lista de precios</label>
                            <input type="text" name="listaPrecios" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Descripción del proyecto</label>
                            <input type="text" name="descripcionProyecto" class="form-control" value="<?= isset($estimate['custom_fields'][0]['value'])?$estimate['custom_fields'][0]['value']:'' ?>">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Asunto</label>
                            <textarea class="form-control" name="asunto" rows="3"><?= $estimate['subject_content']; ?></textarea>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12">
                    <form class="form-inline" id="form_buscador">
                        <label for="" class="mx-2">Buscar producto</label>
                        <select class="form-control mx-2" id="buscador" name="item_book">
                            <?php foreach(getItems() as $item){ ?>
                                <option value="<?= $item['item_id']; ?>"><?= $item['name']; ?></option>
                            <?php } ?>
                        </select>
                        <button class="btn btn-success btn-sm mx-2">Agregar</button>
                    </form>
                </div>
                <div class="col-md-12 my-3">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Detalle del artículo</th>
                                <th>Código SAT</th>
                                <th>Nombre Sat</th>
                                <th>Clave de Producto o Servicio</th>
                                <th>Cantidad</th>
                                <th>Tarifa</th>
                                <th>Descuento</th>
                                <th>Impuesto</th>
                                <th>Importe</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="contenidoEdit">

                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-success" id="btn_agregarCabecera">Agregar Cabecera</button>
                </div>
                <div class="col-md-4 offset-md-8">
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group" id="tabuladorEdit">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <form id="footerForm">
                <div class="card my-5">
                    <div class="card-body row">
                        <div class="col-md-6">
                            <div class="form-group form-check">
                                <label class="form-check-label">
                                    <input class="form-check-input" type="checkbox" name="create"> Create a retainer invioce for this estimación automaticaly
                                </label>
                            </div> 
                            <p class="font-weight-bold">Enviar por correo eletrónico</p>
                            <?php 
                                foreach($estimate['contact_persons_details'] as $data){ 
                            ?>
                                <div class="form-group form-check">
                                    <label class="form-check-label">
                                            <input class="form-check-input" type="checkbox" value="<?= $data['contact_person_id']; ?>" name="emailContactoPerson[]"> <?= $data['email']; ?>
                                    </label>
                                </div>
                            <?php 
                                } 
                            ?>    
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="">Notas del cliente</label>
                                <textarea class="form-control" name="notasCliente"><?= $estimate['notes']; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label class="">Términos y condiciones</label>
                                <textarea class="form-control" name="terminosCondiciones" placeholder="Mencione los términos y condiciones de la empresa."><?= $estimate['terms']; ?></textarea>
                            </div>      
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-success" type="submit" form="formEstimateEdit">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->template->javascript->add(base_url().'assets/js/booksEdit.js'); ?> 


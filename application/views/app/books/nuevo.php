<div class="container">
    <div class="row my-5">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>opportunities">Oportunidades</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>books/?opp=<?= $id; ?>">Books</a></li>
                <li class="breadcrumb-item active">Nuevo Presupuesto</li>
            </ul>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-md-12">
            <h5>Crear Presupuesto</h5>
            <hr>
            <form id="formEstimates" action="" class="was-validated">
                <div class="row my-5">
                    <div class="col-md-6" hidden>
                        <div class="form-group">
                            <label for="">Oportunidad</label>
                            <input type="text" id="opp_id" class="form-control" value="<?= $id; ?>" name="oportunidad" readonly>
                        </div>
                    </div>
                    <div class="col-md-6" hidden>
                        <div class="form-group">
                            <label for="">Customer_id</label>
                            <input type="text" class="form-control" value="<?= $zcrm_account_id; ?>" name="customer_id" readonly>
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
                            <input type="text" class="form-control" name="cuentaNombre" value="<?= $opportunitie['Account_Name']['name']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">  
                                <p>DIRECCIÓN DE FACTURACIÓN <a href="" class="showModalBillingAddress">CAMBIAR</a></p>
                                <p>
                                    <?= $contactPersons['billing_address']['attention']; ?><br>
                                    <?= $contactPersons['billing_address']['address']; ?><br>
                                    <?= $contactPersons['billing_address']['street2']; ?><br>
                                    <?= $contactPersons['billing_address']['city']; ?><br>
                                    <?= $contactPersons['billing_address']['state'].' '.$contactPersons['billing_address']['zip']; ?><br>
                                    <?= $contactPersons['billing_address']['country'].' '.$contactPersons['billing_address']['country_code']; ?><br>
                                    <?= 'Fax: '.$contactPersons['billing_address']['fax']; ?><br>
                                    <?= 'Telefono: '.$contactPersons['billing_address']['phone']; ?><br>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p>DIRECCIÓN DE ENVÍO <a href="" class="showModalShippingAddress">CAMBIAR</a></p>
                                <p>
                                    <?= $contactPersons['shipping_address']['attention']; ?><br>
                                    <?= $contactPersons['shipping_address']['address']; ?><br>
                                    <?= $contactPersons['shipping_address']['street2']; ?><br>
                                    <?= $contactPersons['shipping_address']['city']; ?><br>
                                    <?= $contactPersons['shipping_address']['state'].' '.$contactPersons['shipping_address']['zip']; ?><br>
                                    <?= $contactPersons['shipping_address']['country']; ?><br>
                                    <?= 'Fax: '.$contactPersons['shipping_address']['fax']; ?><br>
                                    <?= 'Telefono: '.$contactPersons['shipping_address']['phone']; ?><br>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p>
                                    OBSERVACIONES <br>
                                    <?= $contactPersons['notes']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Oportunidad nombre</label>
                            <input type="text" class="form-control" name="oportunidadNombre" value="<?= $opportunitie['Deal_Name']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6" hidden>
                        <div class="form-group">
                            <label for="">Número del presupuesto</label>
                            <input type="text" name="numeroPresupuesto" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">No. de referencia</label>
                            <input type="text" name="numeroReferencia" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Fecha del presupuesto</label>
                            <input type="date" name="fechaPresupuesto" class="form-control" readonly value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Fecha de vencimiento</label>
                            <input type="date" name="fechaVencimiento" class="form-control">
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
                            <input type="text" name="descripcionProyecto" class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Asunto</label>
                            <textarea class="form-control" name="asunto" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="alert alert-warning alert-dismissible w-100">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Antención!</strong>
                    <p>
                        Cada partner y sus usuarios son responsables por los descuentos y precios que coticen. 
                        Si aplicas un precio por debajo de los de lista, debes tener autorización escrita desde ventas@vozmia.com.mx
                    </p>
                </div>
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
                                <!--<th>Descuento</th>-->
                                <th>Impuesto</th>
                                <th>Importe</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="contenido">
                            
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-success" id="btn_agregarCabecera">Agregar Cabecera</button>
                </div>
                <div class="col-md-4 offset-md-8">
                    <div class="card">
                        <div class="card-body">
                            <ul class="list-group" id="tabulador">
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
                                foreach($contactPersons['contact_persons'] as $data){ 
                                    if(!empty($data['email'])){
                            ?>

                                <div class="form-group form-check">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="checkbox" value="<?= $data['contact_person_id']; ?>" name="emailContactoPerson[]"> <?= $data['email']; ?>
                                    </label>
                                </div>     
                            <?php 
                                    }
                                }
                            ?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="">Notas del cliente</label>
                                <textarea class="form-control" name="notasCliente"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="">Términos y condiciones</label>
                                <textarea class="form-control" name="terminosCondiciones" placeholder="Mencione los términos y condiciones de la empresa."></textarea>
                            </div>      
                        </div>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-success mx-2" type="submit" form="formEstimates">Guardar</button>
                    <a href="<?php echo base_url(); ?>books/?opp=<?= $id; ?>" class="btn btn-outline-secondary">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- The Modal UPD DIRECCION DE FACTURACION -->
<div class="modal fade" id="modalUPDBillingAddress" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Dirección de facturación</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
        <div class="modal-body">
            <form action="" id="formBillingAddress" >
                               
                <div class="col-md-12">
                    
                    <div class="form-group" hidden>
                        <label class="form-check-label">Id-BillingAddress</label>
                        <input type="text" class="form-control" name="address_id" value="<?= $contactPersons['billing_address']['address_id']; ?>">
                    </div>
                    <div class="form-group" hidden>
                        <label class="form-check-label">Id-Contact</label>
                        <input type="text" class="form-control" name="contact_id" value="<?= $contactPersons['contact_id']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label">Atención</label>
                        <input type="text" class="form-control" name="attention" value="<?= $contactPersons['billing_address']['attention']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label">País / Región</label>
                        <input type="text" class="form-control" name="country" value="<?= $contactPersons['billing_address']['country']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label">Dirección</label>
                        <input type="text" class="form-control" name="address" value="<?= $contactPersons['billing_address']['address']; ?>">
                        <br/>
                        <input type="text" class="form-control" name="street2" value="<?= $contactPersons['billing_address']['street2']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label">Ciudad</label>
                        <input type="text" class="form-control" name="city" value="<?= $contactPersons['billing_address']['city']; ?>">
                    </div>

                </div>
                <div class="col-md-12">                
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-check-label">Estado / Provincia</label>
                                <input type="text" class="form-control" name="state" value="<?= $contactPersons['billing_address']['state']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">Teléfono</label>
                                <input type="text" class="form-control" name="phone" value="<?= $contactPersons['billing_address']['phone']; ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-check-label">Codigo postal</label>
                                <input type="text" class="form-control" name="zip" value="<?= $contactPersons['billing_address']['zip']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">Fax</label>
                                <input type="text" class="form-control" name="fax" value="<?= $contactPersons['billing_address']['fax']; ?>">
                            </div>
                        </div>

                    </div>
                </div>
                
            </form>
        </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-outline-success" id="billing_boton" form="formBillingAddress">Actualizar</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal UPD DIRECCION DE ENVIO -->
<div class="modal fade" id="modalUPDShippingAddress" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Dirección de envío</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
        <div class="modal-body">
            <form action="" id="formShippingAddress" >
                               
                <div class="col-md-12">

                    <div class="form-group" hidden>
                        <label class="form-check-label">Id-shippingAddress</label>
                        <input type="text" class="form-control" name="address_id" value="<?= $contactPersons['shipping_address']['address_id']; ?>">
                    </div>
                    <div class="form-group" hidden>
                        <label class="form-check-label">Id-Contact</label>
                        <input type="text" class="form-control" name="contact_id" value="<?= $contactPersons['contact_id']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label">Atención</label>
                        <input type="text" class="form-control" name="attention" value="<?= $contactPersons['shipping_address']['attention']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label">País / Región</label>
                        <input type="text" class="form-control" name="country" value="<?= $contactPersons['shipping_address']['country']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label">Dirección</label>
                        <input type="text" class="form-control" name="address" value="<?= $contactPersons['shipping_address']['address']; ?>">
                        <br/>
                        <input type="text" class="form-control" name="street2" value="<?= $contactPersons['shipping_address']['street2']; ?>">
                    </div>
                    <div class="form-group">
                        <label class="form-check-label">Ciudad</label>
                        <input type="text" class="form-control" name="city" value="<?= $contactPersons['shipping_address']['city']; ?>">
                    </div>

                </div>
                <div class="col-md-12">                
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-check-label">Estado / Provincia</label>
                                <input type="text" class="form-control" name="state" value="<?= $contactPersons['shipping_address']['state']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">Teléfono</label>
                                <input type="text" class="form-control" name="phone" value="<?= $contactPersons['shipping_address']['phone']; ?>">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-check-label">Codigo postal</label>
                                <input type="text" class="form-control" name="zip" value="<?= $contactPersons['shipping_address']['zip']; ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-check-label">Fax</label>
                                <input type="text" class="form-control" name="fax" value="<?= $contactPersons['shipping_address']['fax']; ?>">
                            </div>
                        </div>

                    </div>
                </div>
                
            </form>
        </div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-outline-success" id="shipping_boton" form="formShippingAddress">Actualizar</button>
      </div>

    </div>
  </div>
</div>

<?= $this->template->javascript->add(base_url().'assets/js/books.js'); ?> 


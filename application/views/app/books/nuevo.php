<div class="container">
    <div class="row my-5">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>opportunities">Opportunities</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>books">Books</a></li>
                <li class="breadcrumb-item active">Nuevo Presupuesto</li>
            </ul>
        </div>
    </div>
    <div class="row my-5">
        <div class="col-md-12">
            <h5>Crear Presupuesto</h5>
            <hr>
            <form id="formLeads" action="" class="was-validated">
                <div class="row my-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Propietario de presupuesto</label>
                            <input type="text" class="form-control" value="Nacir Coronado" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Cuenta nombre</label>
                            <input type="text" class="form-control" value="<?= $opportunitie['Account_Name']['name']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-6">  
                                <p>DIRECCIÓN DE FACTURACIÓN <a href="<?= base_url(); ?>accounts/editar/<?= $account['id']; ?>">CAMBIAR</a></p>
                                <p>
                                    <?= $account['Billing_Street']; ?><br>
                                    <?= $account['Billing_City']; ?><br>
                                    <?= $account['Billing_State']; ?><br>
                                    <?= $account['Billing_Country']; ?><br>
                                    <?= $account['Billing_Code']; ?><br>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p>DIRECCIÓN DE ENVÍO <a href="<?= base_url(); ?>accounts/editar/<?= $account['id']; ?>">CAMBIAR</a></p>
                                <p>
                                    <?= $account['Shipping_Street']; ?><br>
                                    <?= $account['Shipping_City']; ?><br>
                                    <?= $account['Shipping_State']; ?><br>
                                    <?= $account['Shipping_Country']; ?><br>
                                    <?= $account['Shipping_Code']; ?><br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Oportunidad nombre</label>
                            <input type="text" class="form-control" value="<?= $opportunitie['Deal_Name']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Número del presupuesto</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">No. de referencia</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Fecha del presupuesto</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Fecha de vencimiento</label>
                            <input type="date" class="form-control" readonly value="<?php echo date('Y-m-d'); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nombre del proyecto</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Lista de precios</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Descripción del proyecto</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Asunto</label>
                            <textarea class="form-control" rows="3"></textarea>
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
            <div class="row my-5">
                <div class="col-md-6">
                    <div class="form-group form-check">
                        <label class="form-check-label">
                        <input class="form-check-input" type="checkbox"> Create a retainer invioce for this estimación automaticaly
                        </label>
                    </div> 
                    <p class="font-weight-bold">Enviar por correo eletrónico</p>
                    <div class="form-group form-check">
                        <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="<?= $contact['id']; ?>"> <?= $contact['Email']; ?>
                        </label>
                    </div> 
                    <div class="form-group form-check">
                        <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="<?= $this->session->userdata('email'); ?>"> <?= $this->session->userdata('email'); ?>
                        </label>
                    </div>      
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="">Notas del cliente</label>
                        <textarea class="form-control"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="">Términos y condiciones</label>
                        <textarea class="form-control" placeholder="Mencione los términos y condiciones de la empresa."></textarea>
                    </div>      
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button class="btn btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->template->javascript->add(base_url().'assets/js/books.js'); ?> 


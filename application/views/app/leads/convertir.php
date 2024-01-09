<div class="container">
    <div class="row my-5">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <!--<li class="breadcrumb-item"><a href="">Dashboard</a></li>-->
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>leads">Leads</a></li>
                <li class="breadcrumb-item active">Convertir Lead</li>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="row my-5">
        <div class="col-md-12">
            <form id="formConvert" class="was-validated">
            <?php 
                //Cuando tiene una o más cuentas
                if($type == "both" OR $type == "email" ){
            ?>
            <h4>Convertir Lead <span class="small text-secondary">(<?= $lead['Full_Name'].' - '.$lead['Company']; ?> )</span></h4>
            <hr>
            <p>
                Ya existe un Contacto con detalles similares en <b>Correo electrónico</b>
            </p>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" id="optAddContacts" name="optConvertContactsByID">Agregar a Contacto existente <a href="" class="showAddContact">Ver</a>
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" id="optCreateContactoNew" name="optConvertContactNew" disabled>Crear nuevo Contacto: <span class="badge badge-secondary"><?= $lead['Full_Name']; ?></span>(Deshabilitado. Su organización he elegido no crear duplicados.)
                </label>
            </div>
            <br/>
            <div class="form-check d-none contactOpt">
                <label class="form-check-label" hidden>
                    <input type="checkbox" class="form-check-input" id="optNewContactsCompani" name="optNewContactsCompani">Sobrescribir Nombre de Cuenta con el nombre de la empresa de Lead <span class="badge badge-secondary"><?= $lead['Company']; ?></span>
                </label>
                <br/>
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="optCreateContactOportunidad" name="contactoCrearOportunidad">Cree una nueva Oportunidad para esta Cuenta.
                </label>
            </div>
            <?php 
                //Cuando tiene una o más cuentas
                }elseif($type == "company"){
            ?>
            <h4>Convertir Lead <span class="small text-secondary">(<?= $lead['Full_Name'].' - '.$lead['Company']; ?> )</span></h4>
            <hr>
            <p>
                Ya existe una cuenta con detalles similares en <b>Nombre de Cuenta</b>
            </p>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" id="optAddAccount" name="cuentaExistente" >Agregar a Cuenta existente <a href="" class="showAddAccount">Ver</a>
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" id="optCreateAccountNew" name="cuentaNueva">Crear nueva Cuenta: <span class="badge badge-secondary"><?= $lead['Company']; ?></span>
                </label>
            </div>
            <br/>
            <div class="form-check d-none accountOpt">
                <label class="form-check-label">
                    Se creará un nuevo Contacto <span class="badge badge-secondary"><?= $lead['Full_Name']; ?></span> para el Cuenta.
                </label>
                <br/>
                <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" id="optCreateAccountOportunidad" name="cuentaCrearOportunidad">Cree una nueva Oportunidad para esta Cuenta.
                </label>
            </div>
            <?php
                }else{
                //Cuando no tiene cuenta 
            ?>
                <h4>Convertir Posible Cliente <span class="small text-secondary">(<?= $lead['Full_Name'].' - '.$lead['Company']; ?> )</span></h4>
                <hr>
                <p>Crear nueva Cuenta <span class="badge badge-secondary"><?= $lead['Company']; ?></span></p>
                <p>Crear nuevo Contacto <span class="badge badge-secondary"><?= $lead['Full_Name']; ?></span></p>
            <?php 
                }
            ?>
                <!--<form id="formConvert" class="was-validated">-->
                    <div class="formioConvertLead <?= ($type == "nuevo") ? '' : 'd-none'; ?>" ><!--class="infomation"-->
                        <div class="form-group" hidden><!-- d-none -->
                            <label for="">Id</label>
                            <input type="text" class="form-control" name="id" value="<?= $lead['id']; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Importe</label>
                            <input type="text" class="form-control" required name="importe">
                            <div class="invalid-feedback">Campo obligatorio.</div>
                        </div>
                        <div class="form-group">
                            <label for="">Producto</label>
                            <select class="form-control" multiple required name="producto[]" readonly>
                                    <option <?= ($lead['Producto'] == '') ? 'selected' : '';?> value="">Ninguno</option>
                                    <option <?= (array_search('KontUX', $lead['Producto']) === false) ? '' : 'selected';?> value="KontUX">KontUX</option>
                                    <option <?= (array_search('Vocom Call Center', $lead['Producto']) === false) ? '' : 'selected';?> value="Vocom Call Center">Vocom Call Center</option>
                                    <option <?= (array_search('Vocom Teams', $lead['Producto']) === false) ? '' : 'selected';?> value="Vocom Teams">Vocom Teams</option> 
                                    <option <?= (array_search('Vocom UC', $lead['Producto']) === false) ? '' : 'selected';?> value="Vocom UC">Vocom UC</option>
                                    <option <?= (array_search('Zoho', $lead['Producto']) === false) ? '' : 'selected';?> value="Zoho">Zoho</option>
                            </select>
                            <div class="invalid-feedback">Campo obligatorio.</div>
                        </div>
                        <div class="form-group">
                            <label for="">Tiempo de Implementación</label>
                            <input type="text" class="form-control" readonly required name="tiempo" value="<?= $lead['Tiempo_de_Implementaci_n']; ?>">
                            <div class="invalid-feedback">Campo obligatorio.</div>
                        </div>
                        <div class="form-group">
                            <label for="">Presupuesto</label>
                            <input type="text" class="form-control" required name="presupuesto" value="<?= $lead['Presupuesto']; ?>" readonly>
                            <div class="invalid-feedback">Campo obligatorio.</div>
                        </div>
                        <div class="form-group">
                            <label for="">Autoridad</label>
                            <input type="text" class="form-control" required name="autoridad" value="<?= $lead['Autoridad']; ?>" readonly>
                            <div class="invalid-feedback">Campo obligatorio.</div>
                        </div>
                        <div class="form-group">
                            <label for="">Necesidad</label>
                            <input type="text" class="form-control" required name="necesidad" value="<?= $lead['Necesidad']; ?>" readonly>
                            <div class="invalid-feedback">Campo obligatorio.</div>
                        </div>
                        <div class="form-group">
                            <label for="">Nombre de Oportunidad</label>
                            <input type="text" class="form-control" required name="nombreOportunidad" value="<?= $lead['Company']; ?>" readonly>
                            <div class="invalid-feedback">Campo obligatorio.</div>
                        </div>
                        <div class="form-group">
                            <label for="">Fecha Cierre</label>
                            <input type="date" class="form-control" required name="fecha">
                            <div class="invalid-feedback">Campo obligatorio.</div>
                        </div>
                        <div class="form-group">
                            <label for="">Fase</label>
                            <select name="fase" id="" class="form-control" required>
                                <option value="Descubrimiento">Descubrimiento</option>
                                <option value="Calificación">Calificación</option>
                                <option value="Propuesta">Propuesta</option>
                                <option value="Decisión">Decisión</option>
                                <option value="Ganada">Ganada</option>
                                <option value="Cerrada Perdida">Cerrada Perdida</option>
                                <option value="Perdida a la competencia">Perdida a la competencia</option>
                            </select>
                            <div class="invalid-feedback">Campo obligatorio.</div>
                        </div>
                        <div class="form-group">
                            <label for="">Descripción</label>
                            <textarea class="form-control" required name="descripcion" readonly><?= $lead['Description']; ?></textarea>
                            <div class="invalid-feedback">Campo obligatorio.</div>
                        </div>
                        <div class="form-group">
                            <label for="">Moneda</label>
                            <select class="form-control" name="moneda" required readonly>
                                <option <?= ($lead['Currency'] == 'MXN') ? 'selected' : '';?> value="MXN">MXN</option>
                                <option <?= ($lead['Currency'] == 'USD') ? 'selected' : '';?> value="USD">USD</option>
                            </select>
                            <div class="invalid-feedback">Campo obligatorio.</div>
                        </div>
                        <div class="form-group" hidden>
                            <label for="">Canal</label>
                            <select name="canal" id="" class="form-control" required>
                                <option value="Standard">Standard</option>
                                <option value="Ciclo de Venta">Ciclo de Venta</option>
                            </select>
                            <div class="invalid-feedback">Campo obligatorio.</div>
                        </div>
                        <div class="form-group" hidden>
                            <label for="">Ingeniero Preventa</label>
                            <select name="ingeniero" id="" class="form-control" required readonly>
                                <option selected value="Nacir Coronado">Nacir Coronado</option>
                            </select>
                            <div class="invalid-feedback">Campo obligatorio.</div>
                        </div>
                        <div class="form-group">
                            <label for="">Número de Empleados</label>
                            <input type="text" class="form-control" required name="empleados" value="<?= $lead['No_of_Employees']; ?>" readonly>
                            <div class="invalid-feedback">Campo obligatorio.</div>
                        </div>
                    </div>
                    <div class="form-check my-3">
                        <label class="form-check-label">
                            <input type="checkbox" checked class="form-check-input" name="notificacion">Notifique al propietario del registro (Cuenta y Contacto).
                        </label>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-outline-success">Convertir</button>
                    <a href="<?php echo base_url(); ?>leads" class="btn btn-outline-secondary">Regresar</a>
                </form>
        </div>
    </div>
</div>

<!-- The Modal Cuenta -->
<div class="modal fade" id="modalAddAccount" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Registros coincidentes de Cuenta</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
        <div class="modal-body">
            <!--<div class="form-check">-->
                <table class="table table-bordered table-striped display responsive " id="tabla" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">Nombre de cuenta</th>
                            <th class="text-center">Telefono</th>
                            <th class="text-center">Sitio Web</th>
                            <th class="text-center">Tipo de cuenta</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(!empty($accounts)){
                                foreach($accounts['data'] as $account){ 
                        ?>
                                    <tr>
                                        <td><input type="checkbox" class="account_id" data-id="<?= $account['id']; ?>"></td>
                                        <td><?= $account['Account_Name']; ?></td>
                                        <td><?= $account['Phone']; ?></td>
                                        <td><?= $account['Website']; ?></td>
                                        <td><?= $account['Account_Type']; ?></td>
                                    </tr>
                        <?php 
                                } 
                            } 
                        ?>
                    </tbody>
                </table>
            <!--</div>-->
        </div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-outline-info btnSaveModalAccount" data-dismiss="modal">Guardar</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal Contacto -->
<div class="modal fade" id="modalAddContact" >
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Registros coincidentes de Cuenta</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
        <div class="modal-body">
            <!--<div class="form-check">-->
                <table class="table table-bordered table-striped display responsive " id="tabla" width="100%">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">Nombre De Contacto</th>
                            <th class="text-center">Nombre De Cuenta</th>
                            <th class="text-center">Correo Electrónico</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            if(!empty($contacts)){
                                foreach($contacts['data'] as $contact){ 
                        ?>
                                    <tr>
                                        <td><input type="checkbox" class="account_id" data-id="<?= $contact['id']; ?>"></td>
                                        <td><?= $contact['Full_Name']; ?></td>
                                        <td><?= $contact['Account_Name']['name']; ?></td>
                                        <td><?= $contact['Email']; ?></td>
                                    </tr>
                        <?php 
                                } 
                            } 
                        ?>
                    </tbody>
                </table>
            <!--</div>-->
        </div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-outline-info btnSaveModalContact" data-dismiss="modal">Guardar</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal Eliminar-->
<div class="modal" id="modalCreateAccount">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Crear nueva Cuenta</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <p class="modal-title">Se creará un nuevo Contacto <span class="badge badge-secondary"><?= $lead['Full_Name'] ?></span> para la Cuenta</p>
        <div class="form-check my-3">
            <label class="form-check-label">
                <input type="checkbox" class="optCreateAccount form-check-input">Cree una nueva Oportunidad para esta Cuenta
            </label>
        </div>
        <div class="infomation d-none">
            <div class="form-group">
                <label for="">Importe</label>
                <input type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Producto</label>
                <select class="form-control" multiple required name="producto[]">
                        <option <?= ($lead['Producto'] == '') ? 'selected' : '';?> value="">Ninguno</option>
                        <option <?= (array_search('KontUX', $lead['Producto']) === false) ? '' : 'selected';?> value="KontUX">KontUX</option>
                        <option <?= (array_search('Vocom Call Center', $lead['Producto']) === false) ? '' : 'selected';?> value="Vocom Call Center">Vocom Call Center</option>
                        <option <?= (array_search('Vocom Teams', $lead['Producto']) === false) ? '' : 'selected';?> value="Vocom Teams">Vocom Teams</option> 
                        <option <?= (array_search('Vocom UC', $lead['Producto']) === false) ? '' : 'selected';?> value="Vocom UC">Vocom UC</option>
                        <option <?= (array_search('Zoho', $lead['Producto']) === false) ? '' : 'selected';?> value="Zoho">Zoho</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Tiempo de Implementación</label>
                <input type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Presupuesto</label>
                <input type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Autoridad</label>
                <input type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Necesidad</label>
                <input type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Nombre de Oportunidad</label>
                <input type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Fecha Cierre</label>
                <input type="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Importe</label>
                <input type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Descripción</label>
                <textarea class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="">Moneda</label>
                <select class="form-control" name="moneda">
                    <option <?= ($lead['Currency'] == 'MXN') ? 'selected' : '';?> value="MXN">MXN</option>
                    <option <?= ($lead['Currency'] == 'USD') ? 'selected' : '';?> value="USD">USD</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Número de Empleados</label>
                <input type="text" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Fuente de Campaña</label>
                <input type="text" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="">Contacto Rol</label>
                <select name="" id="" class="form-control">
                    <option value="">Ninguno</option>
                    <option value="Developer/Evaluator">Developer/Evaluator</option>
                    <option value="Decision Maker">Decision Maker</option>
                    <option value="Purchasing">Purchasing</option>
                    <option value="Executive Sponsor">Executive Sponsor</option>
                    <option value="Engineering Lead">Engineering Lead</option>
                    <option value="Economic Decision Maker">Economic Decision Maker</option>
                    <option value="Product Management">Product Management</option>
                </select>
            </div>
        </div>
        <div class="form-check my-3">
            <label class="form-check-label">
                <input type="checkbox" checked class="form-check-input" value="">Notifique al propietario del registro (Cuenta y Contacto).
            </label>
        </div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-outline-info" data-dismiss="modal">Fin</button>
      </div>

    </div>
  </div>
</div>

<?= $this->template->javascript->add(base_url().'assets/js/leads.js'); ?> 
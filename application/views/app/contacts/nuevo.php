<div class="container">
    <div class="row my-5">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>contacts">Contactos</a></li>
                <li class="breadcrumb-item active">Nuevo Contacto</li>
            </ul>
        </div>
    </div>
</div>
<form id="formContactEdit" action="" class="was-validated">
    <div class="container">
        <h5>Crear Contacto</h5>
        <hr>
        <div class="row my-5">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Nombre de Contacto</label>
                    <input type="text" name="nombreContacto" class="form-control"  required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Nombre de Cuenta</label><!--Cuenta-->
                    <!--<input type="text" name="nombreCuenta" class="form-control">-->
                    <select name="nombreCuenta" class="form-control">
                        <option value="">-None-</option>
                        <?php foreach($accounts['data'] as $account){ ?>
                            <option value="<?= $account['id']; ?>"><?= $account['Account_Name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Correo electrónico</label>
                    <input type="email" name="correo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Empresa a la que pertenece</label><!--Cuenta-->
                    <!--<input type="text" name="empresaPertenece" class="form-control" readonly>-->
                    <select name="empresaPertenece" class="form-control">
                        <option value="">-None-</option>
                        <?php foreach($accounts['data'] as $account){ ?>
                            <option value="<?= $account['id']; ?>"><?= $account['Account_Name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Teléfono</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Otro teléfono</label>
                    <input type="text" name="other_phone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Móvil</label>
                    <input type="text" name="mobile" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Asistente</label>
                    <input type="text" name="asistente" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Moneda</label>
                    <select name="moneda" class="form-control">
                        <option value="MXN">MXN</option>
                        <option value="USD">USD</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Fuente de Lead</label>
                    <select class="form-control" name="fuenteLead">
                        <option value="">-None-</option>
                        <option value="Advertisement">Advertisement</option>
                        <option value="Base de Datos">Base de Datos</option>
                        <option value="Chat">Chat</option>
                        <option value="Cold Call">Cold Call</option>
                        <option value="Employee Referral">Employee Referral</option>
                        <option value="External Referral">External Referral</option>
                        <option value="Facebook">Facebook</option>
                        <option value="Google AdWords">Google AdWords</option>
                        <option value="Google+">Google+</option>
                        <option value="Internal Seminar">Internal Seminar</option>
                        <option value="Networking">Networking</option>
                        <option value="Online Store">Online Store</option>
                        <option value="Partner">Partner</option>
                        <option value="Public Relations">Public Relations</option>
                        <option value="Sales Email Alias">Sales Email Alias</option>
                        <option value="Seminar Partner">Seminar Partner</option>
                        <option value="Trade Show">Trade Show</option>
                        <option value="Twitter">Twitter</option>
                        <option value="Web Download">Web Download</option>
                        <option value="Web Research">Web Research</option> 
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Apellido de contacto</label>
                    <input type="text" name="apellidoContacto" class="form-control" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Nombre de Proveedor</label><!--Proveedor-->
                    <!--<input type="text" name="nombreProveedor" class="form-control">-->
                    <select name="nombreProveedor" class="form-control">
                        <option value="">-None-</option>
                        <?php foreach($vendors['data'] as $vendor){ ?>
                            <option value="<?= $vendor['id']; ?>"><?= $vendor['Vendor_Name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Título</label>
                    <input type="text" name="titulo" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Departamento</label>
                    <input type="text" name="departamento" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Teléfono particular</label>
                    <input type="text" name="home_phone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Fax</label>
                    <input type="text" name="fax" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Fecha de nacimiento</label>
                    <input type="date" name="date_birth" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">N.º de teléfono del asistente</label>
                    <input type="text" name="asst_phone" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">No participación del correo electrónico</label>
                    <input type="text" name="email_opt_out" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">ID de Skype</label>
                    <input type="text" name="dkype_id" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Correo electrónico secundario</label>
                    <input type="text" name="secondary_email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Twitter</label>
                    <input type="text" name="twitter" class="form-control">
                </div>
                <div class="form-group" hidden>
                    <label for="">Subordinado de</label>
                    <input type="text" name="reporting_to" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Tasa de cambio</label>
                    <input type="text" name="exchange_rate" class="form-control" value="1" readonly>
                </div>
                <div class="form-group" hidden>
                    <label for="">Contacto Partner</label>
                    <input type="text" class="form-control" name="contactoPartner" value="<?= $this->session->userdata('name'); ?>" readonly>
                </div>
                <div class="form-group" hidden>
                    <label for="">Partner</label>
                    <input type="text" class="form-control" name="partner" value="<?= $this->session->userdata('company'); ?>" readonly>
                </div>
            </div>
        </div>
        <h5>Información de la dirección</h5>
        <hr>
        <div class="row my-5">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Domicilio para correspondencia</label>
                    <input type="text" name="domicilioCorrespondencia" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Ciudad para correspondencia</label>
                    <input type="text" name="ciudadCorrespondencia" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Estado para correspondencia</label>
                    <input type="text" name="estadoCorrespondencia" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Código postal para correspondencia</label>
                    <input type="text" name="codigoCorrespondencia" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">País para correspondencia</label>
                    <input type="text" name="paisCorrespondencia" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Otro domicilio</label>
                    <input type="text" name="domicilioOtro" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Otra ciudad</label>
                    <input type="text" name="ciudadOtro" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Otro estado</label>
                    <input type="text" name="estadoOtro" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Otro código postal</label>
                    <input type="text" name="codigoOtro" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Otro país</label>
                    <input type="text" name="paisOtro" class="form-control">
                </div>
            </div>
        </div>
        <h5>Información de la descripción</h5>
        <hr>
        <div class="row my-5">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea class="form-control" name="descripcion" rows="5"></textarea>
                </div>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-outline-success mx-2">Guardar</button>
                <a href="<?php echo base_url(); ?>contacts" class="btn btn-outline-secondary">Regresar</a>
            </div>
        </div>
    </div>
</form>

<?= $this->template->javascript->add(base_url().'assets/js/contacts.js'); ?> 

<div class="container">
    <div class="row my-5">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <!--<li class="breadcrumb-item"><a href="">Dashboard</a></li>-->
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>contacts">Contactos</a></li>
                <li class="breadcrumb-item active">Editar Contacto</li>
            </ul>
        </div>
    </div>
</div>
<form id="formContactEdit" action="" class="was-validated">
    <div class="container">
        <h5>Información de Contacto</h5>
        <hr>
        <div class="row my-5">
            <div class="col-md-6">
                <div class="form-group" hidden>
                    <label for="">id</label>
                    <input type="number" class="form-control" name="id" value="<?= $contact['id']; ?>" readonly> 
                </div>
                <div class="form-group" hidden>
                    <label for="">Propietario de Contacto</label>
                    <input type="text" name="propietarioCuenta" class="form-control" value="<?= $contact['Owner']['name']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Nombre de contacto</label>
                    <input type="text" name="nombreContacto" class="form-control"  required value="<?= $contact['First_Name']; ?>">
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Nombre de Cuenta</label>
                    <!--<input type="text" name="nombreCuenta" class="form-control" value="<$contact['Account_Name']['name']; ?>">-->
                    <select name="nombreCuenta" class="form-control">
                            <option value="">-None-</option>
                        <?php foreach($accounts['data'] as $account){ ?>
                            <option <?= (!empty($contact['Account_Name']['id']) && $contact['Account_Name']['id'] == $account['id']) ? 'selected' : '' ;?> value="<?= $account['id']; ?>"><?= $account['Account_Name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Correo electrónico</label>
                    <input type="email" name="correo" class="form-control" value="<?= $contact['Email']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Empresa a la que pertenece</label>
                    <!--<input type="text" name="empresaPertenece" class="form-control" value="<$contact['Empresa_a_la_que_pertenece']['name']; ?>">-->
                    <select name="empresaPertenece" class="form-control">
                            <option value="">-None-</option>
                        <?php foreach($accounts['data'] as $account){ ?>
                            <option <?= (!empty($contact['Empresa_a_la_que_pertenece']['id']) && $contact['Empresa_a_la_que_pertenece']['id'] == $account['id']) ? 'selected' : '' ;?> value="<?= $account['id']; ?>"><?= $account['Account_Name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Teléfono</label>
                    <input type="text" name="phone" class="form-control" value="<?= $contact['Phone']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Otro teléfono</label>
                    <input type="text" name="other_phone" class="form-control" value="<?= $contact['Other_Phone']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Móvil</label>
                    <input type="text" name="mobile" class="form-control" value="<?= $contact['Mobile']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Asistente</label>
                    <input type="text" name="asistente" class="form-control" value="<?= $contact['Assistant']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Moneda</label>
                    <select name="moneda" id="" class="form-control">
                        <option <?= ($contact['Currency'] == 'MXN') ? 'selected' : '';?> value="MXN">MXN</option>
                        <option <?= ($contact['Currency'] == 'USD') ? 'selected' : '';?> value="USD">USD</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Fuente de Lead</label>
                    <select class="form-control" name="fuenteLead">
                        <option <?= ($contact['Lead_Source'] == '') ? 'selected' : '';?> value="">-None-</option>
                        <option <?= ($contact['Lead_Source'] == 'Advertisement') ? 'selected' : '';?> value="Advertisement">Advertisement</option>
                        <option <?= ($contact['Lead_Source'] == 'Base de Datos') ? 'selected' : '';?> value="Base de Datos">Base de Datos</option>
                        <option <?= ($contact['Lead_Source'] == 'Chat') ? 'selected' : '';?> value="Chat">Chat</option>
                        <option <?= ($contact['Lead_Source'] == 'Cold Call') ? 'selected' : '';?> value="Cold Call">Cold Call</option>
                        <option <?= ($contact['Lead_Source'] == 'Employee Referral') ? 'selected' : '';?> value="Employee Referral">Employee Referral</option>
                        <option <?= ($contact['Lead_Source'] == 'External Referral') ? 'selected' : '';?> value="External Referral">External Referral</option>
                        <option <?= ($contact['Lead_Source'] == 'Facebook') ? 'selected' : '';?> value="Facebook">Facebook</option>
                        <option <?= ($contact['Lead_Source'] == 'Google AdWords') ? 'selected' : '';?> value="Google AdWords">Google AdWords</option>
                        <option <?= ($contact['Lead_Source'] == 'Google+') ? 'selected' : '';?> value="Google+">Google+</option>
                        <option <?= ($contact['Lead_Source'] == 'Internal Seminar') ? 'selected' : '';?> value="Internal Seminar">Internal Seminar</option>
                        <option <?= ($contact['Lead_Source'] == 'Networking') ? 'selected' : '';?> value="Networking">Networking</option>
                        <option <?= ($contact['Lead_Source'] == 'Online Store') ? 'selected' : '';?> value="Online Store">Online Store</option>
                        <option <?= ($contact['Lead_Source'] == 'Partner') ? 'selected' : '';?> value="Partner">Partner</option>
                        <option <?= ($contact['Lead_Source'] == 'Public Relations') ? 'selected' : '';?> value="Public Relations">Public Relations</option>
                        <option <?= ($contact['Lead_Source'] == 'Sales Email Alias') ? 'selected' : '';?> value="Sales Email Alias">Sales Email Alias</option>
                        <option <?= ($contact['Lead_Source'] == 'Seminar Partner') ? 'selected' : '';?> value="Seminar Partner">Seminar Partner</option>
                        <option <?= ($contact['Lead_Source'] == 'Trade Show') ? 'selected' : '';?> value="Trade Show">Trade Show</option>
                        <option <?= ($contact['Lead_Source'] == 'Twitter') ? 'selected' : '';?> value="Twitter">Twitter</option>
                        <option <?= ($contact['Lead_Source'] == 'Web Download') ? 'selected' : '';?> value="Web Download">Web Download</option>
                        <option <?= ($contact['Lead_Source'] == 'Web Research') ? 'selected' : '';?> value="Web Research">Web Research</option> 
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Apellido de contacto</label>
                    <input type="text" name="apellidoContacto" class="form-control" required value="<?= $contact['Last_Name']; ?>">
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Nombre de Proveedor</label>
                    <!--<input type="text" name="nombreProveedor" class="form-control"  value="<$contact['Vendor_Name']['name']; ?>" readonly>-->
                    <select name="nombreProveedor" class="form-control">
                            <option value="">-None-</option>
                        <?php foreach($vendors['data'] as $vendor){ ?>
                            <option <?= (!empty($contact['Vendor_Name']['id']) && $contact['Vendor_Name']['id'] == $vendor['id']) ? 'selected' : '' ;?> value="<?= $vendor['id']; ?>"><?= $vendor['Vendor_Name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Título</label>
                    <input type="text" name="titulo" class="form-control"  value="<?= $contact['Title']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Departamento</label>
                    <input type="text" name="departamento" class="form-control"  value="<?= $contact['Department']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Teléfono particular</label>
                    <input type="text" name="home_phone" class="form-control"  value="<?= $contact['Home_Phone']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Fax</label>
                    <input type="text" name="fax" class="form-control"  value="<?= $contact['Fax']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Fecha de nacimiento</label>
                    <input type="date" name="date_birth" class="form-control"  value="<?= $contact['Date_of_Birth']; ?>">
                </div>
                <div class="form-group">
                    <label for="">N.º de teléfono del asistente</label>
                    <input type="text" name="asst_phone" class="form-control"  value="<?= $contact['Asst_Phone']; ?>">
                </div>
                <div class="form-group">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="email_opt_out" value="true" <?= ($contact['Email_Opt_Out']) ? 'checked' : '';?>>No participación del correo electrónico
                    </label>
                </div>
                <div class="form-group">
                    <label for="">ID de Skype</label>
                    <input type="text" name="dkype_id" class="form-control"  value="<?= $contact['Skype_ID']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Correo electrónico secundario</label>
                    <input type="text" name="secondary_email" class="form-control"  value="<?= $contact['Secondary_Email']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Twitter</label>
                    <input type="text" name="twitter" class="form-control"  value="<?= $contact['Twitter']; ?>">
                </div>
                <div class="form-group" hidden>
                    <label for="">Subordinado de</label>
                    <input type="text" name="reporting_to" class="form-control"  value="<?= $contact['Reporting_To']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Tasa de cambio</label>
                    <input type="text" name="exchange_rate" class="form-control"  value="<?= $contact['Exchange_Rate']; ?>" readonly>
                </div>
            </div>
        </div>
        <h5>Información de la dirección</h5>
        <hr>
        <div class="row my-5">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Domicilio para correspondencia</label>
                    <input type="text" name="domicilioCorrespondencia" class="form-control" value="<?= $contact['Mailing_Street']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Ciudad para correspondencia</label>
                    <input type="text" name="ciudadCorrespondencia" class="form-control" value="<?= $contact['Mailing_City']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Estado para correspondencia</label>
                    <input type="text" name="estadoCorrespondencia" class="form-control" value="<?= $contact['Mailing_State']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Código postal para correspondencia</label>
                    <input type="text" name="codigoCorrespondencia" class="form-control" value="<?= $contact['Mailing_Zip']; ?>">
                </div>
                <div class="form-group">
                    <label for="">País para correspondencia</label>
                    <input type="text" name="paisCorrespondencia" class="form-control" value="<?= $contact['Mailing_Country']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Otro domicilio</label>
                    <input type="text" name="domicilioOtro" class="form-control" value="<?= $contact['Other_Street']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Otra ciudad</label>
                    <input type="text" name="ciudadOtro" class="form-control" value="<?= $contact['Other_City']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Otro estado</label>
                    <input type="text" name="estadoOtro" class="form-control" value="<?= $contact['Other_State']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Otro código postal</label>
                    <input type="text" name="codigoOtro" class="form-control" value="<?= $contact['Other_Zip']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Otro país</label>
                    <input type="text" name="paisOtro" class="form-control" value="<?= $contact['Other_Country']; ?>">
                </div>
            </div>
        </div>
        <h5>Información de la descripción</h5>
        <hr>
        <div class="row my-5">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea class="form-control" name="descripcion" rows="5"><?= $contact['Description']; ?></textarea>
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

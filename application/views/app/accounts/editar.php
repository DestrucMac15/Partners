<div class="container">
    <div class="row my-5">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <!--<li class="breadcrumb-item"><a href="">Dashboard</a></li>-->
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>accounts">Cuentas</a></li>
                <li class="breadcrumb-item active">Editar Cuenta</li>
            </ul>
        </div>
    </div>
</div>
<form id="formAccountEdit" action="" class="was-validated">
<div class="container">
        <h5>Información de Cuenta</h5>
        <hr>
        <div class="row my-5">
            <div class="col-md-6">
                <div class="form-group" hidden>
                    <label for="">id</label>
                    <input type="number" class="form-control" name="id" value="<?= $account['id']; ?>" readonly> 
                </div>
                <div class="form-group">
                    <label for="">Propietario de Cuenta</label>
                    <input type="text" name="propietarioCuenta" class="form-control" value="<?= $account['Owner']['name']; ?>" >
                </div>
                <div class="form-group">
                    <label for="">Nombre de Cuenta</label>
                    <input type="text" name="nombreCuenta" class="form-control" required value="<?= $account['Account_Name']; ?>">
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Sitio de Cuenta</label>
                    <input type="text" name="sitioCuenta" class="form-control" value="<?= $account['Account_Site']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Cuenta Principal</label>
                    <input type="text" name="cuentaPrincipal" class="form-control" value="<?= empty($account['Parent_Account']) ? '' : $account['Parent_Account']['name']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Tipo de Cuenta</label>
                    <select name="tipoCuenta" id="" class="form-control">
                        <option <?= ($account['Account_Type'] == '') ? 'selected' : '';?> value="">-None-</option>
                        <option <?= ($account['Account_Type'] == 'Analyst') ? 'selected' : '';?> value="Analyst">Analyst</option>
                        <option <?= ($account['Account_Type'] == 'Competitor') ? 'selected' : '';?> value="Competitor">Competitor</option>
                        <option <?= ($account['Account_Type'] == 'Customer') ? 'selected' : '';?> value="Customer">Customer</option>
                        <option <?= ($account['Account_Type'] == 'Distributor') ? 'selected' : '';?> value="Distributor">Distributor</option>
                        <option <?= ($account['Account_Type'] == 'Integrator') ? 'selected' : '';?> value="Integrator">Integrator</option>
                        <option <?= ($account['Account_Type'] == 'Investor') ? 'selected' : '';?> value="Investor">Investor</option>
                        <option <?= ($account['Account_Type'] == 'Other') ? 'selected' : '';?> value="Other">Other</option>
                        <option <?= ($account['Account_Type'] == 'Partner') ? 'selected' : '';?> value="Partner">Partner</option>
                        <option <?= ($account['Account_Type'] == 'Press') ? 'selected' : '';?> value="Press">Press</option>
                        <option <?= ($account['Account_Type'] == 'Prospect') ? 'selected' : '';?> value="Prospect">Prospect</option>
                        <option <?= ($account['Account_Type'] == 'Reseller') ? 'selected' : '';?> value="Reseller">Reseller</option>
                        <option <?= ($account['Account_Type'] == 'Supplier') ? 'selected' : '';?> value="Supplier">Supplier</option>
                        <option <?= ($account['Account_Type'] == 'Vendor') ? 'selected' : '';?> value="Vendor">Vendor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Sector</label>
                    <select name="sector" id="" class="form-control">
                        <option <?= ($account['Industry'] == '') ? 'selected' : '';?> value="">-None-</option>
                        <option <?= ($account['Industry'] == 'ASP (Application Service Provider)') ? 'selected' : '';?> value="ASP (Application Service Provider)">ASP (Application Service Provider)</option>
                        <option <?= ($account['Industry'] == 'Data/Telecom OEM') ? 'selected' : '';?> value="Data/Telecom OEM">Data/Telecom OEM</option>
                        <option <?= ($account['Industry'] == 'ERP (Enterprise Resource Planning)') ? 'selected' : '';?> value="ERP (Enterprise Resource Planning)">ERP (Enterprise Resource Planning)</option>
                        <option <?= ($account['Industry'] == 'Government/Military') ? 'selected' : '';?> value="Government/Military">Government/Military</option>
                        <option <?= ($account['Industry'] == 'Large Enterprise') ? 'selected' : '';?> value="Large Enterprise">Large Enterprise</option>
                        <option <?= ($account['Industry'] == 'ManagementISV') ? 'selected' : '';?> value="ManagementISV">ManagementISV</option>
                        <option <?= ($account['Industry'] == 'MSP (Management Service Provider)') ? 'selected' : '';?> value="MSP (Management Service Provider)">MSP (Management Service Provider)</option>
                        <option <?= ($account['Industry'] == 'Network Equipment Enterprise') ? 'selected' : '';?> value="Network Equipment Enterprise">Network Equipment Enterprise</option>
                        <option <?= ($account['Industry'] == 'Non-management ISV') ? 'selected' : '';?> value="Non-management ISV">Non-management ISV</option>
                        <option <?= ($account['Industry'] == 'Optical Networking') ? 'selected' : '';?> value="Optical Networking">Optical Networking</option>
                        <option <?= ($account['Industry'] == 'Service Provider') ? 'selected' : '';?> value="Service Provider">Service Provider</option>
                        <option <?= ($account['Industry'] == 'Small/Medium Enterprise') ? 'selected' : 'Small/Medium Enterprise';?> value="">Small/Medium Enterprise</option>
                        <option <?= ($account['Industry'] == 'Storage Equipment') ? 'selected' : '';?> value="Storage Equipment">Storage Equipment</option>
                        <option <?= ($account['Industry'] == 'Storage Service Provider') ? 'selected' : '';?> value="Storage Service Provider">Storage Service Provider</option>
                        <option <?= ($account['Industry'] == 'Systems Integrator') ? 'selected' : '';?> value="Systems Integrator">Systems Integrator</option>
                        <option <?= ($account['Industry'] == 'Wireless Industry') ? 'selected' : '';?> value="Wireless Industry">Wireless Industry</option>
                        <option <?= ($account['Industry'] == 'Communications') ? 'selected' : '';?> value="Communications">Communications</option>
                        <option <?= ($account['Industry'] == 'Consulting') ? 'selected' : '';?> value="Consulting">Consulting</option>
                        <option <?= ($account['Industry'] == 'Education') ? 'selected' : '';?> value="Education">Education</option>
                        <option <?= ($account['Industry'] == 'Financial Services') ? 'selected' : '';?> value="Financial Services">Financial Services</option>
                        <option <?= ($account['Industry'] == 'Manufacturing') ? 'selected' : '';?> value="Manufacturing">Manufacturing</option>
                        <option <?= ($account['Industry'] == 'Real Estate') ? 'selected' : '';?> value="Real Estate">Real Estate</option>
                        <option <?= ($account['Industry'] == 'Technology') ? 'selected' : '';?> value="Technology">Technology</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Ingresos anuales</label>
                    <input type="text" name="IngresosAnuales" class="form-control" value="<?= $account['Annual_Revenue']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Moneda</label>
                    <select name="moneda" id="" class="form-control">
                        <option <?= ($account['Currency'] == '') ? 'selected' : '';?> value="MXN">MXN</option>
                        <option <?= ($account['Currency'] == '') ? 'selected' : '';?> value="USD">USD</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Calificación</label>
                    <select name="calificacion" id="" class="form-control">
                        <option <?= ($account['Rating'] == '') ? 'selected' : '';?> value="">-None-</option>
                        <option <?= ($account['Rating'] == 'Acquired') ? 'selected' : '';?> value="Acquired">Acquired</option>
                        <option <?= ($account['Rating'] == 'Active') ? 'selected' : '';?> value="Active">Active</option>
                        <option <?= ($account['Rating'] == 'Market Failed') ? 'selected' : '';?> value="Market Failed">Market Failed</option>
                        <option <?= ($account['Rating'] == 'Project Cancelled') ? 'selected' : '';?> value="Project Cancelled">Project Cancelled</option>
                        <option <?= ($account['Rating'] == 'Shut Down') ? 'selected' : '';?> value="Shut Down">Shut Down</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Teléfono</label>
                    <input type="text" name="telefono" class="form-control" value="<?= $account['Phone']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Sitio Web</label>
                    <input type="text" name="website" class="form-control" value="<?= $account['Website']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Símbolo del valor</label>
                    <input type="text" name="simboloValor" class="form-control" value="<?= $account['Ticker_Symbol']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Propietario</label>
                    <select name="propietario" id="" class="form-control">
                        <option <?= ($account['Ownership'] == '') ? 'selected' : '';?> value="">-None-</option>
                        <option <?= ($account['Ownership'] == 'Other') ? 'selected' : '';?> value="Other">Other</option>
                        <option <?= ($account['Ownership'] == 'Private') ? 'selected' : '';?> value="Private">Private</option>
                        <option <?= ($account['Ownership'] == 'Public') ? 'selected' : 'Public';?> value="">Public</option>
                        <option <?= ($account['Ownership'] == 'Subsidiary') ? 'selected' : '';?> value="Subsidiary">Subsidiary</option>
                        <option <?= ($account['Ownership'] == 'Government') ? 'selected' : '';?> value="Government">Government</option>
                        <option <?= ($account['Ownership'] == 'Partnership') ? 'selected' : '';?> value="Partnership">Partnership</option>
                        <option <?= ($account['Ownership'] == 'Privately Held') ? 'selected' : '';?> value="Privately Held">Privately Held</option>
                        <option <?= ($account['Ownership'] == 'Public Company') ? 'selected' : '';?> value="Public Company">Public Company</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Empleados</label>
                    <input type="text" name="empleados" class="form-control" value="<?= $account['Employees']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Código SIC</label>
                    <input type="text" name="codigoSic" class="form-control" value="<?= $account['SIC_Code']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Tasa de Cambio</label>
                    <input type="text" name="tasaCambio" class="form-control" value="1" readonly>
                </div>
            </div>
        </div>
        <h5>Información de la dirección</h5>
        <hr>
        <div class="row my-5">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Domicilio de facturación</label>
                    <input type="text" name="domicilioFacturacion" class="form-control" value="<?= $account['Billing_Street']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Ciudad de facturación</label>
                    <input type="text" name="ciudadFacturacion" class="form-control" value="<?= $account['Billing_City']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Estado de facturación</label>
                    <input type="text" name="estadoFacturacion" class="form-control" value="<?= $account['Billing_State']; ?>">
                </div>
                <div class="form-group">
                    <label for="">País de facturación</label>
                    <input type="text" name="paisFacturacion" class="form-control" value="<?= $account['Billing_Country']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Código de facturación</label>
                    <input type="text" name="codigoFacturacion" class="form-control" value="<?= $account['Billing_Code']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Domicilio de Envío</label>
                    <input type="text" name="domicilioEnvio" class="form-control" value="<?= $account['Shipping_Street']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Ciudad de Envío</label>
                    <input type="text" name="ciudadEnvio" class="form-control" value="<?= $account['Shipping_City']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Estado de Envío</label>
                    <input type="text" name="estadoEnvio" class="form-control" value="<?= $account['Shipping_State']; ?>">
                </div>
                <div class="form-group">
                    <label for="">País de Envío</label>
                    <input type="text" name="paisEnvio" class="form-control" value="<?= $account['Shipping_Country']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Código de Envío</label>
                    <input type="text" name="codigoEnvio" class="form-control" value="<?= $account['Shipping_Code']; ?>">
                </div>
            </div>
        </div>
        <h5>Información de la necesidad</h5>
        <hr>
        <div class="row my-5">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea class="form-control" name="descripcion" rows="5"><?= $account['Description']; ?></textarea>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-outline-success mx-2">Actualizar</button>
                <a href="<?php echo base_url(); ?>accounts" class="btn btn-outline-secondary">Regresar</a>
            </div>
        </div>
    </div>
</form>


<?= $this->template->javascript->add(base_url().'assets/js/accounts.js'); ?> 

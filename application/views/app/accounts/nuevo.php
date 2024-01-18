<div class="container">
    <div class="row my-5">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>accounts">Cuentas</a></li>
                <li class="breadcrumb-item active">Nueva Cuenta</li>
            </ul>
        </div>
    </div>
</div>
<form id="formAccountEdit" action="" class="was-validated">
<div class="container">
        <h5>Crear Cuenta</h5>
        <hr>
        <div class="row my-5">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Nombre de Cuenta</label>
                    <input type="text" name="nombreCuenta" class="form-control" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Sitio de Cuenta</label>
                    <input type="text" name="sitioCuenta" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Cuenta Principal</label>
                    <!--<input type="text" name="cuentaPrincipal" class="form-control">-->
                    <select name="cuentaPrincipal" class="form-control" required>
                        <option value="">-None-</option>
                        <?php foreach($accounts['data'] as $account){ ?>
                            <option value="<?= $account['id']; ?>"><?= $account['Account_Name']; ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Tipo de Cuenta</label>
                    <select name="tipoCuenta" id="" class="form-control">
                        <option value="">-None-</option>
                        <option value="Analyst">Analyst</option>
                        <option value="Competitor">Competitor</option>
                        <option value="Customer">Customer</option>
                        <option value="Distributor">Distributor</option>
                        <option value="Integrator">Integrator</option>
                        <option value="Investor">Investor</option>
                        <option value="Other">Other</option>
                        <option value="Partner">Partner</option>
                        <option value="Press">Press</option>
                        <option value="Prospect">Prospect</option>
                        <option value="Reseller">Reseller</option>
                        <option value="Supplier">Supplier</option>
                        <option value="Vendor">Vendor</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Sector</label>
                    <select name="sector" id="" class="form-control">
                        <option value="">-None-</option>
                        <option value="ASP (Application Service Provider)">ASP (Application Service Provider)</option>
                        <option value="Data/Telecom OEM">Data/Telecom OEM</option>
                        <option value="ERP (Enterprise Resource Planning)">ERP (Enterprise Resource Planning)</option>
                        <option value="Government/Military">Government/Military</option>
                        <option value="Large Enterprise">Large Enterprise</option>
                        <option value="ManagementISV">ManagementISV</option>
                        <option value="MSP (Management Service Provider)">MSP (Management Service Provider)</option>
                        <option value="Network Equipment Enterprise">Network Equipment Enterprise</option>
                        <option value="Non-management ISV">Non-management ISV</option>
                        <option value="Optical Networking">Optical Networking</option>
                        <option value="Service Provider">Service Provider</option>
                        <option value="Small/Medium Enterprise">Small/Medium Enterprise</option>
                        <option value="Storage Equipment">Storage Equipment</option>
                        <option value="Storage Service Provider">Storage Service Provider</option>
                        <option value="Systems Integrator">Systems Integrator</option>
                        <option value="Wireless Industry">Wireless Industry</option>
                        <option value="Communications">Communications</option>
                        <option value="Consulting">Consulting</option>
                        <option value="Education">Education</option>
                        <option value="Financial Services">Financial Services</option>
                        <option value="Manufacturing">Manufacturing</option>
                        <option value="Real Estate">Real Estate</option>
                        <option value="Technology">Technology</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Ingresos anuales</label>
                    <input type="text" name="IngresosAnuales" class="form-control" placeholder="MX$">
                </div>
                <div class="form-group">
                    <label for="">Moneda</label>
                    <select name="moneda" class="form-control" required>
                        <option value="MXN">MXN</option>
                        <option value="USD">USD</option>
                    </select>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Calificación</label>
                    <select name="calificacion" id="" class="form-control">
                        <option value="">-None-</option>
                        <option value="Acquired">Acquired</option>
                        <option value="Active">Active</option>
                        <option value="Market Failed">Market Failed</option>
                        <option value="Project Cancelled">Project Cancelled</option>
                        <option value="Shut Down">Shut Down</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Teléfono</label>
                    <input type="text" name="telefono" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Sitio Web</label>
                    <input type="text" name="website" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Símbolo del valor</label>
                    <input type="text" name="simboloValor" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Propietario</label>
                    <select name="propietario" id="" class="form-control">
                        <option value="">-None-</option>
                        <option value="Other">Other</option>
                        <option value="Private">Private</option>
                        <option value="Public">Public</option>
                        <option value="Subsidiary">Subsidiary</option>
                        <option value="Government">Government</option>
                        <option value="Partnership">Partnership</option>
                        <option value="Privately Held">Privately Held</option>
                        <option value="Public Company">Public Company</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Empleados</label>
                    <input type="text" name="empleados" class="form-control" min="0">
                </div>
                <div class="form-group">
                    <label for="">Código SIC</label>
                    <input type="text" name="codigoSic" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Tasa de Cambio</label>
                    <input type="text" name="tasaCambio" class="form-control" value="1" readonly>
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
                    <label for="">Domicilio de facturación</label>
                    <input type="text" name="domicilioFacturacion" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Ciudad de facturación</label>
                    <input type="text" name="ciudadFacturacion" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Estado de facturación</label>
                    <input type="text" name="estadoFacturacion" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">País de facturación</label>
                    <input type="text" name="paisFacturacion" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Código de facturación</label>
                    <input type="text" name="codigoFacturacion" class="form-control">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Domicilio de Envío</label>
                    <input type="text" name="domicilioEnvio" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Ciudad de Envío</label>
                    <input type="text" name="ciudadEnvio" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Estado de Envío</label>
                    <input type="text" name="estadoEnvio" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">País de Envío</label>
                    <input type="text" name="paisEnvio" class="form-control">
                </div>
                <div class="form-group">
                    <label for="">Código de Envío</label>
                    <input type="text" name="codigoEnvio" class="form-control">
                </div>
            </div>
        </div>
        <h5>Información de la necesidad</h5>
        <hr>
        <div class="row my-5">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea class="form-control" name="descripcion" rows="5" required></textarea>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-outline-success mx-2">Guardar</button>
                <a href="<?php echo base_url(); ?>accounts" class="btn btn-outline-secondary">Regresar</a>
            </div>
        </div>
    </div>
</form>


<?= $this->template->javascript->add(base_url().'assets/js/accounts.js'); ?> 

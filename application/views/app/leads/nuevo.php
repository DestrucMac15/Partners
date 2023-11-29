<div class="container">
    <div class="row my-5">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>/leads">Leads</a></li>
                <li class="breadcrumb-item active">Nuevo Lead</li>
            </ul>
        </div>
    </div>
</div>
<form id="formLeads" action="" class="was-validated">
    <div class="container">
        <h5>Información de Lead</h5>
        <hr>
        <div class="row my-5">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Nombre del partner</label>
                    <input type="text" class="form-control" name="nombre_partner" value="<?= $this->session->userdata('name'); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" name="nombre" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Teléfono</label>
                    <input type="text" class="form-control" name="telefono" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Móvil</label>
                    <input type="text" class="form-control" name="movil">
                </div>
                <div class="form-group">
                    <label for="">Titulo</label>
                    <input type="text" class="form-control" name="titulo">
                </div>
                <div class="form-group">
                    <label for="">Fuente de Lead</label>
                    <select class="form-control" name="fuente" required>
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
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Presupuesto</label>
                    <input type="text" class="form-control" name="presupuesto" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Autoridad</label>
                    <input type="text" class="form-control" name="autoridad" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Necesidad</label>
                    <input type="text" class="form-control" name="necesidad" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Tiempo de Implementación</label>
                    <input type="text" class="form-control" name="tiempo" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Siguientes Pasos</label>
                    <input type="text" class="form-control" name="pasos" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Sector</label>
                    <select class="form-control" name="sector">
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
                        <option value="ERP">ERP</option>
                        <option value="Management ISV">Management ISV</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Ingresos anuales</label>
                    <input type="text" class="form-control" name="ingresos" placeholder="MXN $">
                </div>
                <hr>
                <div class="form-check my-2">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" value="true" name="marketing"> No participación del correo electrónico
                    </label>
                </div>
                <div class="form-group">
                    <label for="">Tasa de cambio</label>
                    <input type="number" class="form-control" readonly value="1" name="tasa">
                </div>
                <div class="form-group">
                    <label for="">Twitter</label>
                    <input type="text" class="form-control" name="twitter" placeholder="@">
                </div>
                <div class="form-group">
                    <label for="">Producto (Para agregar más de uno mantén precionado CTRL/Command)</label>
                    <select class="form-control" multiple required name="producto[]">
                        <option value="">Ninguno</option>
                        <option value="KontUX">KontUX</option>
                        <option value="Vocom Call Center">Vocom Call Center</option>
                        <option value="Vocom Teams">Vocom Teams</option>
                        <option value="Vocom UC">Vocom UC</option>
                        <option value="Zoho">Zoho</option>
                    </select>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Empresa</label>
                    <input type="text" name="empresa" class="form-control" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Correo eletrónico</label>
                    <input type="text" class="form-control" name="correo" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Sitio web</label>
                    <input type="text" class="form-control" name="website">
                </div>
                <div class="form-group">
                    <label for="">Fax</label>
                    <input type="text" class="form-control" name="fax">
                </div>
                <div class="form-group">
                    <label for="">Estado de Lead</label>
                    <select class="form-control" name="estadoLead">
                        <option value="">-None-</option>
                        <option value="Attempted to Contact">Attempted to Contact</option>
                        <option value="Contact in Future">Contact in Future</option>
                        <option value="Contacted">Contacted</option>
                        <option value="Junk Lead">Junk Lead</option>
                        <option value="Lost Lead">Lost Lead</option>
                        <option value="Not Contacted">Not Contacted</option>
                        <option value="Pre-Qualified">Pre-Qualified</option>
                        <option value="Not Qualified">Not Qualified</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Partner</label>
                    <input type="text" class="form-control" name="partner" value="<?= $this->session->userdata('company'); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Contacto Partner</label>
                    <input type="text" class="form-control" name="contacto" value="<?= $this->session->userdata('name'); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Cantidad de empleados</label>
                    <input type="number" class="form-control" name="empleados" min="0" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Calificación</label>
                    <select class="form-control" name="calificacion">
                        <option value="">-None-</option>
                        <option value="Acquired">Acquired</option>
                        <option value="Active">Active</option>
                        <option value="Market Failed">Market Failed</option>
                        <option value="Project Cancelled">Project Cancelled</option>
                        <option value="Shut Down">Shut Down</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Id de skype</label>
                    <input type="text" class="form-control" name="skype">
                </div>
                <div class="form-group">
                    <label for="">Correo secundario</label>
                    <input type="text" class="form-control" name="correoSecundario">
                </div>
                <div class="form-group">
                    <label for="">Moneda</label>
                    <select class="form-control" name="moneda">
                        <option value="MXN">MXN</option>
                        <option value="USD">USD</option>
                    </select>
                </div>
            </div>
        </div>
        <h5>Información de la dirección</h5>
        <hr>
        <div class="row my-5">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Calle</label>
                    <input type="text" class="form-control" name="calle">
                </div>
                <div class="form-group">
                    <label for="">Estado</label>
                    <input type="text" class="form-control" name="estado">
                </div>
                <div class="form-group">
                    <label for="">Pais</label>
                    <input type="text" class="form-control" name="pais">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Ciudad</label>
                    <input type="text" class="form-control" name="ciudad">
                </div>
                <div class="form-group">
                    <label for="">Código Postal</label>
                    <input type="text" class="form-control" name="codigoPostal">
                </div>
            </div>
        </div>
        <h5>Información de la descripción</h5>
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
                <button type="submit" class="btn btn-outline-success">Guardar</button>
            </div>
        </div>
    </div>
</form>

<?= $this->template->javascript->add(base_url().'assets/js/leads.js'); ?>
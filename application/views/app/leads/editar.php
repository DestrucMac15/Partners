<div class="container">
    <div class="row my-5">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <!--<li class="breadcrumb-item"><a href="">Dashboard</a></li>-->
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>leads">Leads</a></li>
                <li class="breadcrumb-item active">Editar Lead</li>
            </ul>
        </div>
    </div>
</div>
<form id="formLeadsEdit" action="" class="was-validated">
    <div class="container">
        <h5>Información de Lead</h5>
        <hr>
        <div class="row my-5">
            <div class="col-md-6">
                <div class="form-group" hidden>
                    <label for="">id</label>
                    <input type="number" class="form-control" name="id" value="<?= $lead['id']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Nombre del partner</label>
                    <input type="text" class="form-control" name="nombre_partner" value="<?= $this->session->userdata('name'); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Nombre</label>
                    <input type="text" class="form-control" name="nombre" required value="<?= $lead['First_Name']; ?>">
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Teléfono</label>
                    <input type="text" class="form-control" name="telefono" required value="<?= $lead['Phone']; ?>">
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Móvil</label>
                    <input type="text" class="form-control" name="movil" value="<?= !empty($lead['Mobile']) ? $lead['Mobile'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Titulo</label>
                    <input type="text" class="form-control" name="titulo" value="<?= !empty($lead['Designation']) ? $lead['Designation'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Fuente de Lead</label>
                    <select class="form-control" name="fuente" required>
                        <option <?= ($lead['Lead_Source'] == '') ? 'selected' : '';?> value="">-None-</option>
                        <option <?= ($lead['Lead_Source'] == 'Advertisement') ? 'selected' : '';?> value="Advertisement">Advertisement</option>
                        <option <?= ($lead['Lead_Source'] == 'Base de Datos') ? 'selected' : '';?> value="Base de Datos">Base de Datos</option>
                        <option <?= ($lead['Lead_Source'] == 'Chat') ? 'selected' : '';?> value="Chat">Chat</option>
                        <option <?= ($lead['Lead_Source'] == 'Cold Call') ? 'selected' : '';?> value="Cold Call">Cold Call</option>
                        <option <?= ($lead['Lead_Source'] == 'Employee Referral') ? 'selected' : '';?> value="Employee Referral">Employee Referral</option>
                        <option <?= ($lead['Lead_Source'] == 'External Referral') ? 'selected' : '';?> value="External Referral">External Referral</option>
                        <option <?= ($lead['Lead_Source'] == 'Facebook') ? 'selected' : '';?> value="Facebook">Facebook</option>
                        <option <?= ($lead['Lead_Source'] == 'Google AdWords') ? 'selected' : '';?> value="Google AdWords">Google AdWords</option>
                        <option <?= ($lead['Lead_Source'] == 'Google+') ? 'selected' : '';?> value="Google+">Google+</option>
                        <option <?= ($lead['Lead_Source'] == 'Internal Seminar') ? 'selected' : '';?> value="Internal Seminar">Internal Seminar</option>
                        <option <?= ($lead['Lead_Source'] == 'Networking') ? 'selected' : '';?> value="Networking">Networking</option>
                        <option <?= ($lead['Lead_Source'] == 'Online Store') ? 'selected' : '';?> value="Online Store">Online Store</option>
                        <option <?= ($lead['Lead_Source'] == 'Partner') ? 'selected' : '';?> value="Partner">Partner</option>
                        <option <?= ($lead['Lead_Source'] == 'Public Relations') ? 'selected' : '';?> value="Public Relations">Public Relations</option>
                        <option <?= ($lead['Lead_Source'] == 'Sales Email Alias') ? 'selected' : '';?> value="Sales Email Alias">Sales Email Alias</option>
                        <option <?= ($lead['Lead_Source'] == 'Seminar Partner') ? 'selected' : '';?> value="Seminar Partner">Seminar Partner</option>
                        <option <?= ($lead['Lead_Source'] == 'Trade Show') ? 'selected' : '';?> value="Trade Show">Trade Show</option>
                        <option <?= ($lead['Lead_Source'] == 'Twitter') ? 'selected' : '';?> value="Twitter">Twitter</option>
                        <option <?= ($lead['Lead_Source'] == 'Web Download') ? 'selected' : '';?> value="Web Download">Web Download</option>
                        <option <?= ($lead['Lead_Source'] == 'Web Research') ? 'selected' : '';?> value="Web Research">Web Research</option> 
                    </select>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Presupuesto</label>
                    <input type="text" class="form-control" name="presupuesto" required value="<?= $lead['Presupuesto']; ?>">
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Autoridad</label>
                    <input type="text" class="form-control" name="autoridad" required value="<?= $lead['Autoridad']; ?>">
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Necesidad</label>
                    <input type="text" class="form-control" name="necesidad" required value="<?= $lead['Necesidad']; ?>">
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Tiempo de Implementación</label>
                    <input type="text" class="form-control" name="tiempo" required value="<?= $lead['Tiempo_de_Implementaci_n']; ?>">
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Siguientes Pasos</label>
                    <input type="text" class="form-control" name="pasos" required value="<?= $lead['Siguientes_Pasos']; ?>">
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Sector</label>
                    <select class="form-control" name="sector">
                        <option <?= ($lead['Industry'] == '') ? 'selected' : '';?> value="">-None-</option>
                        <option <?= ($lead['Industry'] == 'ASP (Application Service Provider)') ? 'selected' : '';?> value="ASP (Application Service Provider)">ASP (Application Service Provider)</option>
                        <option <?= ($lead['Industry'] == 'Data/Telecom OEM') ? 'selected' : '';?> value="Data/Telecom OEM">Data/Telecom OEM</option>
                        <option <?= ($lead['Industry'] == 'ERP (Enterprise Resource Planning)') ? 'selected' : '';?> value="ERP (Enterprise Resource Planning)">ERP (Enterprise Resource Planning)</option>
                        <option <?= ($lead['Industry'] == 'Government/Military') ? 'selected' : '';?> value="Government/Military">Government/Military</option>
                        <option <?= ($lead['Industry'] == 'Large Enterprise') ? 'selected' : '';?> value="Large Enterprise">Large Enterprise</option>
                        <option <?= ($lead['Industry'] == 'ManagementISV') ? 'selected' : '';?> value="ManagementISV">ManagementISV</option>
                        <option <?= ($lead['Industry'] == 'MSP (Management Service Provider)') ? 'selected' : '';?> value="MSP (Management Service Provider)">MSP (Management Service Provider)</option>
                        <option <?= ($lead['Industry'] == 'Network Equipment Enterprise') ? 'selected' : '';?> value="Network Equipment Enterprise">Network Equipment Enterprise</option>
                        <option <?= ($lead['Industry'] == 'Non-management ISV') ? 'selected' : '';?> value="Non-management ISV">Non-management ISV</option>
                        <option <?= ($lead['Industry'] == 'Optical Networking') ? 'selected' : '';?> value="Optical Networking">Optical Networking</option>
                        <option <?= ($lead['Industry'] == 'Service Provider') ? 'selected' : '';?> value="Service Provider">Service Provider</option>
                        <option <?= ($lead['Industry'] == 'Small/Medium Enterprise') ? 'selected' : '';?> value="Small/Medium Enterprise">Small/Medium Enterprise</option>
                        <option <?= ($lead['Industry'] == 'Storage Equipment') ? 'selected' : '';?> value="Storage Equipment">Storage Equipment</option>
                        <option <?= ($lead['Industry'] == 'Storage Service Provider') ? 'selected' : '';?> value="Storage Service Provider">Storage Service Provider</option>
                        <option <?= ($lead['Industry'] == 'Systems Integrator') ? 'selected' : '';?> value="Systems Integrator">Systems Integrator</option>
                        <option <?= ($lead['Industry'] == 'Wireless Industry') ? 'selected' : '';?> value="Wireless Industry">Wireless Industry</option>
                        <option <?= ($lead['Industry'] == 'ERP') ? 'selected' : '';?> value="ERP">ERP</option>
                        <option <?= ($lead['Industry'] == 'Management ISV') ? 'selected' : '';?> value="Management ISV">Management ISV</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Ingresos anuales</label>
                    <input type="text" class="form-control" name="ingresos" placeholder="MXN $" value="<?= !empty($lead['Annual_Revenue']) ? $lead['Annual_Revenue'] : ''; ?>">
                </div>
                <hr>
                <div class="form-check my-2">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="marketing" value="true" <?= ($lead['Email_Opt_Out']) ? 'checked' : '';?>> No participación del correo electrónico
                    </label>
                </div>
                <div class="form-group">
                    <label for="">Tasa de cambio</label>
                    <input type="number" class="form-control" readonly value="1" name="tasa">
                </div>
                <div class="form-group">
                    <label for="">Twitter</label>
                    <input type="text" class="form-control" name="twitter" placeholder="@" value="<?= !empty($lead['Twitter']) ? $lead['Twitter'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label class="form-label select-label">Productos (Para agregar más de uno mantén precionado CTRL)</label>
                    <select class="form-control" multiple required name="producto[]">
                            <option <?= ($lead['Producto'] == '') ? 'selected' : '';?> value="">Ninguno</option>
                            <option <?= (array_search('KontUX', $lead['Producto']) === false) ? '' : 'selected';?> value="KontUX">KontUX</option>
                            <option <?= (array_search('Vocom Call Center', $lead['Producto']) === false) ? '' : 'selected';?> value="Vocom Call Center">Vocom Call Center</option>
                            <option <?= (array_search('Vocom Teams', $lead['Producto']) === false) ? '' : 'selected';?> value="Vocom Teams">Vocom Teams</option> 
                            <option <?= (array_search('Vocom UC', $lead['Producto']) === false) ? '' : 'selected';?> value="Vocom UC">Vocom UC</option>
                            <option <?= (array_search('Zoho', $lead['Producto']) === false) ? '' : 'selected';?> value="Zoho">Zoho</option>
                    </select>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Empresa</label>
                    <input type="text" name="empresa" class="form-control" required value="<?= $lead['Company']; ?>">
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Apellidos</label>
                    <input type="text" class="form-control" name="apellidos" required value="<?= $lead['Last_Name']; ?>">
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Correo eletrónico</label>
                    <input type="email" class="form-control" name="correo" required value="<?= $lead['Email']; ?>">
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Sitio web</label>
                    <input type="text" class="form-control" name="website" value="<?= !empty($lead['Website']) ? $lead['Website'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Fax</label>
                    <input type="text" class="form-control" name="fax" value="<?= !empty($lead['Fax']) ? $lead['Fax'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Estado de Lead</label>
                    <select class="form-control" name="estadoLead">
                        <option <?= ($lead['Lead_Status'] == '') ? 'selected' : '';?> value="">-None-</option>
                        <option <?= ($lead['Lead_Status'] == 'Attempted to Contact') ? 'selected' : '';?> value="Attempted to Contact">Attempted to Contact</option>
                        <option <?= ($lead['Lead_Status'] == 'Contact in Future') ? 'selected' : '';?> value="Contact in Future">Contact in Future</option>
                        <option <?= ($lead['Lead_Status'] == 'Contacted') ? 'selected' : '';?> value="Contacted">Contacted</option>
                        <option <?= ($lead['Lead_Status'] == 'Junk Lead') ? 'selected' : '';?> value="Junk Lead">Junk Lead</option>
                        <option <?= ($lead['Lead_Status'] == 'Lost Lead') ? 'selected' : '';?> value="Lost Lead">Lost Lead</option>
                        <option <?= ($lead['Lead_Status'] == 'Not Contacted') ? 'selected' : '';?> value="Not Contacted">Not Contacted</option>
                        <option <?= ($lead['Lead_Status'] == 'Pre-Qualified') ? 'selected' : '';?> value="Pre-Qualified">Pre-Qualified</option>
                        <option <?= ($lead['Lead_Status'] == 'Not Qualified') ? 'selected' : '';?> value="Not Qualified">Not Qualified</option>
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
                    <input type="number" class="form-control" name="empleados" min="0" value="<?= isset($lead['No_of_Employees']) ? $lead['No_of_Employees'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Calificación</label>
                    <select class="form-control" name="calificacion">
                        <option <?= ($lead['Rating'] == '') ? 'selected' : '';?> value="">-None-</option>
                        <option <?= ($lead['Rating'] == 'Acquired') ? 'selected' : '';?> value="Acquired">Acquired</option>
                        <option <?= ($lead['Rating'] == 'Active') ? 'selected' : '';?> value="Active">Active</option>
                        <option <?= ($lead['Rating'] == 'Market Failed') ? 'selected' : '';?> value="Market Failed">Market Failed</option>
                        <option <?= ($lead['Rating'] == 'Project Cancelled') ? 'selected' : '';?> value="Project Cancelled">Project Cancelled</option>
                        <option <?= ($lead['Rating'] == 'Shut Down') ? 'selected' : '';?> value="Shut Down">Shut Down</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Id de skype</label>
                    <input type="text" class="form-control" name="skype" value="<?= !empty($lead['Skype_ID']) ? $lead['Skype_ID'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Correo secundario</label>
                    <input type="email" class="form-control" name="correoSecundario" value="<?= !empty($lead['Secondary_Email']) ? $lead['Secondary_Email'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Moneda</label>
                    <select class="form-control" name="moneda">
                        <option <?= ($lead['Currency'] == 'MXN') ? 'selected' : '';?> value="MXN">MXN</option>
                        <option <?= ($lead['Currency'] == 'USD') ? 'selected' : '';?> value="USD">USD</option>
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
                    <input type="text" class="form-control" name="calle" value="<?= !empty($lead['Street']) ? $lead['Street'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Estado</label>
                    <input type="text" class="form-control" name="estado" value="<?= !empty($lead['State']) ? $lead['State'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Pais</label>
                    <input type="text" class="form-control" name="pais" value="<?= !empty($lead['Country']) ? $lead['Country'] : ''; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Ciudad</label>
                    <input type="text" class="form-control" name="ciudad" value="<?= !empty($lead['City']) ? $lead['City'] : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="">Código Postal</label>
                    <input type="text" class="form-control" name="codigoPostal" value="<?= !empty($lead['Zip_Code']) ? $lead['Zip_Code'] : ''; ?>">
                </div>
            </div>
        </div>
        <h5>Información de la descripción</h5>
        <hr>
        <div class="row my-5">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Descripción</label>
                    <textarea class="form-control" name="descripcion" rows="5" required><?= $lead['Description']; ?></textarea>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-outline-success mx-2">Actualizar</button>
                <a href="<?php echo base_url(); ?>leads" class="btn btn-outline-secondary">Regresar</a>
            </div>
        </div>
    </div>
</form>


<?= $this->template->javascript->add(base_url().'assets/js/leads.js'); ?> 

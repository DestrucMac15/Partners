<div class="container">
    <div class="row my-5">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>opportunities">Oportunidades</a></li>
                <li class="breadcrumb-item active">Nueva Oportunidad</li>
            </ul>
        </div>
    </div>
</div>
<form id="formLeadsEdit" action="" class="was-validated">
    <div class="container">
        <h5>Crear Oportunidad</h5>
        <hr>
        <div class="row my-5">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Nombre de la Oportunidad</label>
                    <input type="text" class="form-control" name="nombreOportunidad" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Nombre de la Cuenta</label>
                    <!--<input type="text" class="form-control" name="nombreCuenta" required>-->
                    <select name="nombreCuenta" class="form-control" required>
                        <option value="">-None-</option>
                        <?php foreach($accounts['data'] as $account){ ?>
                            <option value="<?= $account['id']; ?>"><?= $account['Account_Name']; ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Ingeniero Preventa</label>
                    <select name="ingeniero" required class="form-control">
                        <?php foreach(get_users($token)['users'] as $user){ ?>
                        <option value="<?= $user['id']; ?>"><?= $user['full_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">RFC</label>
                    <input type="text" class="form-control" name="rfc">
                </div>
                <div class="form-group">
                    <label for="">Tipo</label>
                    <select name="tipo" id="" class="form-control">
                        <option value="">-None-</option>
                        <option value="Existing Business">Existing Business</option>
                        <option value="New Business">New Business</option>
                        <option value="Ganada">Ganada</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Siguiente Paso</label>
                    <input type="text" class="form-control" name="paso">
                </div>
                <div class="form-group">
                    <label for="">Fuente de Lead</label>
                    <select name="fuente_lead" class="form-control">
                        <option value="">-None-</option>
                        <option value="Advertisement">Advertisement</option>
                        <option value="Cold Call">Cold Call</option>
                        <option value="Employee Referral">Employee Referral</option>
                        <option value="External Referral">External Referral</option>
                        <option value="Online Store">Online Store</option>
                        <option value="Partner">Partner</option>
                        <option value="Public Relations">Public Relations</option>
                        <option value="Sales Email Alias">Sales Email Alias</option>
                        <option value="Seminar Partner">Seminar Partner</option>
                        <option value="Internal Seminar">Internal Seminar</option>
                        <option value="Trade Show">Trade Show</option>
                        <option value="Web Download">Web Download</option>
                        <option value="Web Research">Web Research</option>
                        <option value="Chat">Chat</option>
                        <option value="Base de Datos">Base de Datos</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Nombre de Contacto</label>
                    <!--<input type="text" class="form-control" name="nombreContacto">-->
                    <select name="nombreContacto" class="form-control" required>
                        <option value="">-None-</option>
                        <?php foreach($contacts['data'] as $contact){ ?>
                            <option value="<?= $contact['id']; ?>"><?= $contact['Full_Name']; ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Contacto Partner</label>
                    <input type="text" class="form-control" name="contactoPartner" value="<?= $this->session->userdata('name'); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Partner</label>
                    <input type="text" class="form-control" name="partner" value="<?= $this->session->userdata('company'); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Moneda</label>
                    <select name="moneda" class="form-control">
                        <option value="MXN">MXN</option>
                        <option value="USD">USD</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tiempo de implementación</label>
                    <input type="text" class="form-control" name="tiempo" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Autoridad</label>
                    <input type="text" class="form-control" name="autoridad" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Importe</label>
                    <input type="text" class="form-control" name="importe" placeholder="MX $" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Fecha de cierre</label>
                    <input type="date" class="form-control" name="fechaCierre" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Fase</label>
                    <select class="form-control" name="fase" required>
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
                    <label for="">Probabilidad (%)</label>
                    <input type="number" class="form-control" name="probabilidad" value="10">
                </div>
                <div class="form-group">
                    <label for="">Ingresos esperados</label>
                    <input type="number" class="form-control" name="Ingresos" placeholder="MX$" readonly>
                </div>
                <div class="form-group">
                    <label for="">Fuente de Campaña</label>
                    <select name="fuente" class="form-control">
                            <option value="">-None-</option>
                        <?php foreach(get_campaigns($token)['data'] as $campaign){ ?>
                            <option value="<?= $campaign['id']; ?>"><?= $campaign['Campaign_Name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tasa de Cambio</label>
                    <input type="number" class="form-control" name="tasa" value="1" readonly>
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
                <div class="form-group">
                    <label for="">Presupuesto</label>
                    <input type="text" class="form-control" name="presupuesto" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Necesidad</label>
                    <input type="text" class="form-control" name="necesidad" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Número de Empleados</label>
                    <input type="number" class="form-control" name="numEmpleados" min="0" required>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Categoría de la previsión</label>
                    <select name="prevision" class="form-control">
                        <option value="Pipeline">Pipeline</option>
                        <option value="Best Case">Best Case</option>
                        <option value="Committed">Committed</option>
                    </select>
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
                <button type="submit" class="btn btn-outline-success mx-2">Guardar</button>
                <a href="<?php echo base_url(); ?>opportunities" class="btn btn-outline-secondary">Regresar</a>
            </div>
        </div>
    </div>
</form>


<?= $this->template->javascript->add(base_url().'assets/js/opportunities.js'); ?> 

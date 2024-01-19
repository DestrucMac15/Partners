<div class="container">
    <div class="row my-5">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>opportunities">Oportunidades</a></li>
                <li class="breadcrumb-item active">Editar Oportunidad</li>
            </ul>
        </div>
    </div>
</div>
<form id="formOppEdit" action="" class="was-validated">
    <div class="container">
        <h5>Información de Oportunidad</h5>
        <hr>
        <div class="row my-5">
            <div class="col-md-6">
                <div class="form-group" hidden>
                    <label for="">Id</label>
                    <input type="text" class="form-control" name="id" value="<?= $opportunitie['id']; ?>"> 
                </div>
                <div class="form-group">
                    <label for="">Nombre de la Oportunidad</label>
                    <input type="text" class="form-control" name="nombreOportunidad" required value="<?= $opportunitie['Deal_Name']; ?>">
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Nombre de la Cuenta</label>
                    <!--<input type="text" class="form-control" name="nombreCuenta" required value="$opportunitie['Account_Name']['name'];" readonly>-->
                    <select name="nombreCuenta" class="form-control" required>
                            <option value="">-None-</option>
                        <?php foreach($accounts['data'] as $account){ ?>
                            <option <?= (!empty($opportunitie['Account_Name']['id']) && $opportunitie['Account_Name']['id'] == $account['id']) ? 'selected' : '' ;?> value="<?= $account['id']; ?>"><?= $account['Account_Name']; ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group">
                    <label for="">Ingeniero Preventa</label>
                    <select name="ingeniero" required class="form-control">
                        <?php foreach(get_users($token)['users'] as $user){ ?>
                        <option <?= ($opportunitie['Ingeniero_Preventa']['id'] == $user['id']) ? 'selected' : '' ;?> value="<?= $user['id']; ?>"><?= $user['full_name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">RFC</label>
                    <input type="text" class="form-control" name="rfc" value="<?= $opportunitie['RFC']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Tipo</label>
                    <select name="tipo" id="" class="form-control">
                        <option <?= ($opportunitie['Type'] == '') ? 'selected' : ''; ?> value="">-None-</option>
                        <option <?= ($opportunitie['Type'] == 'Existing Business') ? 'selected' : ''; ?> value="Existing Business">Existing Business</option>
                        <option <?= ($opportunitie['Type'] == 'New Business') ? 'selected' : ''; ?> value="New Business">New Business</option>
                        <option <?= ($opportunitie['Type'] == 'Ganada') ? 'selected' : ''; ?> value="Ganada">Ganada</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Siguiente Paso</label>
                    <input type="text" class="form-control" name="paso" value="<?= $opportunitie['Next_Step']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Fuente de Lead</label>
                    <select name="fuente_lead" class="form-control">
                        <option <?= ($opportunitie['Lead_Source'] == '') ? 'selected' : ''; ?> value="">-None-</option>
                        <option <?= ($opportunitie['Lead_Source'] == 'Advertisement') ? 'selected' : ''; ?> value="Advertisement">Advertisement</option>
                        <option <?= ($opportunitie['Lead_Source'] == 'Cold Call') ? 'selected' : ''; ?> value="Cold Call">Cold Call</option>
                        <option <?= ($opportunitie['Lead_Source'] == 'Employee Referral') ? 'selected' : ''; ?> value="Employee Referral">Employee Referral</option>
                        <option <?= ($opportunitie['Lead_Source'] == 'External Referral') ? 'selected' : ''; ?> value="External Referral">External Referral</option>
                        <option <?= ($opportunitie['Lead_Source'] == 'Online Store') ? 'selected' : ''; ?> value="Online Store">Online Store</option>
                        <option <?= ($opportunitie['Lead_Source'] == 'Partner') ? 'selected' : ''; ?> value="Partner">Partner</option>
                        <option <?= ($opportunitie['Lead_Source'] == 'Public Relations') ? 'selected' : ''; ?> value="Public Relations">Public Relations</option>
                        <option <?= ($opportunitie['Lead_Source'] == 'Sales Email Alias') ? 'selected' : ''; ?> value="Sales Email Alias">Sales Email Alias</option>
                        <option <?= ($opportunitie['Lead_Source'] == 'Seminar Partner') ? 'selected' : ''; ?> value="Seminar Partner">Seminar Partner</option>
                        <option <?= ($opportunitie['Lead_Source'] == 'Internal Seminar') ? 'selected' : ''; ?> value="Internal Seminar">Internal Seminar</option>
                        <option <?= ($opportunitie['Lead_Source'] == 'Trade Show') ? 'selected' : ''; ?> value="Trade Show">Trade Show</option>
                        <option <?= ($opportunitie['Lead_Source'] == 'Web Download') ? 'selected' : ''; ?> value="Web Download">Web Download</option>
                        <option <?= ($opportunitie['Lead_Source'] == 'Web Research') ? 'selected' : ''; ?> value="Web Research">Web Research</option>
                        <option <?= ($opportunitie['Lead_Source'] == 'Chat') ? 'selected' : ''; ?> value="Chat">Chat</option>
                        <option <?= ($opportunitie['Lead_Source'] == 'Base de Datos') ? 'selected' : ''; ?> value="Base de Datos">Base de Datos</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Nombre de Contacto</label>
                    <!--<input type="text" class="form-control" name="nombreContacto" value="$opportunitie['Contact_Name']['name']; ?>">-->
                    <select name="nombreContacto" class="form-control" required>
                            <option value="">-None-</option>
                        <?php foreach($contacts['data'] as $contact){ ?>
                            <option <?= (!empty($opportunitie['Contact_Name']['id']) && $opportunitie['Contact_Name']['id'] == $contact['id']) ? 'selected' : '' ;?> value="<?= $contact['id']; ?>"><?= $contact['Full_Name']; ?></option>
                        <?php } ?>
                    </select>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
                <div class="form-group" hidden>
                    <label for="">Contacto Partner</label>
                    <input type="text" class="form-control" name="contactoPartner" value="<?= $opportunitie['Contacto_Partner']['name']; ?>" readonly>
                </div>
                <div class="form-group" hidden>
                    <label for="">Partner</label>
                    <input type="text" class="form-control" name="partner" value="<?= $opportunitie['Partner']['name']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Moneda</label>
                    <select name="" id="" class="form-control">
                        <option <?= ($opportunitie['Currency'] == 'MXN') ? 'selected' : ''; ?> value="MXN">MXN</option>
                        <option <?= ($opportunitie['Currency'] == 'USD') ? 'selected' : ''; ?> value="USD">USD</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tiempo de implementación</label>
                    <input type="text" class="form-control" name="tiempo" required value="<?= $opportunitie['Tiempo_de_Implementaci_n']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Autoridad</label>
                    <input type="text" class="form-control" name="autoridad" required value="<?= $opportunitie['Autoridad']; ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="">Importe</label>
                    <input type="text" class="form-control" name="importe" placeholder="MX$" required value="<?= $opportunitie['Amount']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Fecha de cierre</label>
                    <input type="date" class="form-control" name="fechaCierre" required value="<?= $opportunitie['Closing_Date']; ?>">
                </div>
                <!--<div class="form-group">
                    <label for="">Canal</label>
                    <select class="form-control" name="canal" required>
                        <option value="Standard (Standard)">Standard (Standard)</option>
                        <option value="Ciclo de Venta">Ciclo de Venta</option>
                    </select>
                </div>-->
                <div class="form-group">
                    <label for="">Fase</label>
                    <select class="form-control" name="fase" required>
                        <option <?= ($opportunitie['Stage'] == 'Descubrimiento') ? 'selected' : ''; ?> value="Descubrimiento">Descubrimiento</option>
                        <option <?= ($opportunitie['Stage'] == 'Calificación') ? 'selected' : ''; ?> value="Calificación">Calificación</option>
                        <option <?= ($opportunitie['Stage'] == 'Propuesta') ? 'selected' : ''; ?> value="Propuesta">Propuesta</option>
                        <option <?= ($opportunitie['Stage'] == 'Decisión') ? 'selected' : ''; ?> value="Decisión">Decisión</option>
                        <option <?= ($opportunitie['Stage'] == 'Ganada') ? 'selected' : ''; ?> value="Ganada">Ganada</option>
                        <option <?= ($opportunitie['Stage'] == 'Cerrada Perdida') ? 'selected' : ''; ?> value="Cerrada Perdida">Cerrada Perdida</option>
                        <option <?= ($opportunitie['Stage'] == 'Perdida a la competencia') ? 'selected' : ''; ?> value="Perdida a la competencia">Perdida a la competencia</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Probabilidad (%)</label>
                    <input type="number" class="form-control" name="probabilidad" value="<?= $opportunitie['Probability']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Ingresos esperados</label>
                    <input type="number" class="form-control" name="Ingresos" placeholder="MX$" value="<?= $opportunitie['Expected_Revenue']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Fuente de Campaña</label>
                    <select name="fuente" class="form-control">
                            <option value="">-None-</option>
                        <?php foreach(get_campaigns($token)['data'] as $campaign){ ?>
                            <option <?= (!empty($opportunitie['Campaign_Source']['id']) && $opportunitie['Campaign_Source']['id'] == $campaign['id']) ? 'selected' : '' ;?> value="<?= $campaign['id']; ?>"><?= $campaign['Campaign_Name']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Tasa de Cambio</label>
                    <input type="number" class="form-control" name="tasa" value="<?= $opportunitie['Exchange_Rate']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="">Producto (Para agregar más de uno mantén precionado CTRL/Command)</label>
                    <select name="producto[]" multiple class="form-control" required>
                    <option <?= ($opportunitie['Producto'] == '') ? 'selected' : '';?> value="">Ninguno</option>
                        <option <?= (array_search('KontUX', $opportunitie['Producto']) === false) ? '' : 'selected';?> value="KontUX">KontUX</option>
                        <option <?= (array_search('Vocom Call Center', $opportunitie['Producto']) === false) ? '' : 'selected';?> value="Vocom Call Center">Vocom Call Center</option>
                        <option <?= (array_search('Vocom Teams', $opportunitie['Producto']) === false) ? '' : 'selected';?> value="Vocom Teams">Vocom Teams</option> 
                        <option <?= (array_search('Vocom UC', $opportunitie['Producto']) === false) ? '' : 'selected';?> value="Vocom UC">Vocom UC</option>
                        <option <?= (array_search('Zoho', $opportunitie['Producto']) === false) ? '' : 'selected';?> value="Zoho">Zoho</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Presupuesto</label>
                    <input type="text" class="form-control" name="presupuesto" required value="<?= $opportunitie['Presupuesto']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Necesidad</label>
                    <input type="text" class="form-control" name="necesidad" required value="<?= $opportunitie['Necesidad']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Número de Empleados</label>
                    <input type="number" class="form-control" name="numEmpleados" required value="<?= $opportunitie['N_mero_de_Empleados']; ?>">
                </div>
                <div class="form-group">
                    <label for="">Categoría de la previsión</label>
                    <select name="prevision" class="form-control">
                        <option value="">-None-</option>
                        <option <?= ($opportunitie['Forecast_Category__s'] == 'Pipeline') ? 'selected' : '';?> value="Pipeline">Pipeline</option>
                        <option <?= ($opportunitie['Forecast_Category__s'] == 'Best Case') ? 'selected' : '';?> value="Best Case">Best Case</option>
                        <option <?= ($opportunitie['Forecast_Category__s'] == 'Committed') ? 'selected' : '';?> value="Committed">Committed</option>
                        <option <?= ($opportunitie['Forecast_Category__s'] == 'Closed') ? 'selected' : '';?> value="Closed">Closed</option>
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
                    <textarea class="form-control" name="descripcion" rows="5" required><?= $opportunitie['Description']; ?></textarea>
                    <div class="invalid-feedback">Campo obligatorio.</div>
                </div>
            </div>
        </div>
        <div class="row my-5">
            <div class="col-md-12 d-flex justify-content-end">
                <button type="submit" class="btn btn-outline-success mx-2">Actualizar</button>
                <a href="<?php echo base_url(); ?>opportunities" class="btn btn-outline-secondary">Regresar</a>
            </div>
        </div>
    </div>
</form>


<?= $this->template->javascript->add(base_url().'assets/js/opportunities.js'); ?> 

<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>home">Home</a></li>
                <li class="breadcrumb-item active">Oportunidades</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 my-5">
            <table class="table table-bordered table-striped display responsive nowrap" id="tabla" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">Oportunidad</th>
                        <th class="text-center">Fecha de Cierre</th>
                        <!--<th class="text-center">Descripción</th>-->
                        <th class="text-center">Monto</th>
                        <th class="text-center">Fase</th>
                        <th class="text-center">Cuenta</th>
                        <th class="text-center">Contacto</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(!empty($opportunities)){
                            foreach($opportunities['data'] as $info){ 
                                $closing_date = new DateTime($info['Closing_Date']);
                                $formatDate = "M d,Y";
                    ?>
                            <tr>
                                <td><a href="<?php echo base_url(); ?>opportunities/editar/<?= $info['id']; ?>"><?= $info['Deal_Name']; ?></a></td>
                                <td><?= $closing_date->format($formatDate); ?></td>
                                <td><?= $info['$currency_symbol'].number_format($info['Amount'],2,'.',','); ?></td>
                                <td><?= $info['Stage']; ?></td>
                                <td><?= $info['Account_Name']['name']; ?></td>
                                <td><?= $info['Contact_Name']['name']; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                            Acciones
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="<?php echo base_url(); ?>opportunities/editar/<?= $info['id']; ?>">Editar</a>
                                            <a class="dropdown-item" href="<?php echo base_url(); ?>books/?opp=<?= $info['id']; ?>">Presupuestos</a>
                                            <!--<a class="dropdown-item btn_upload" href="" data-id="">Subir Archivo</a>-->
                                            <a class="dropdown-item" href="<?php echo base_url(); ?>attachments/?opp=<?= $info['id']; ?>">Subir Archivo</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                    <?php 
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="modalOpportunities">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Subir Archivo</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="" id="formArchivos">
            <div class="form-group" hidden>
                <label for="">id</label>
                <input type="text" class="form-control" name="id" id="id" required>
            </div>
            <div class="form-group">
                <label for="">Subir Archivo</label>
                <input type="file" class="form-control" name="archivo" id="archivo" required>
            </div>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" form="formArchivos" class="btn btn-success">Guardar</button>
      </div>

    </div>
  </div>
</div>

<?= $this->template->javascript->add(base_url().'assets/js/opportunities.js'); ?>

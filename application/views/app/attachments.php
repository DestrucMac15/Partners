<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>opportunities">Oportunidades</a></li>
                <li class="breadcrumb-item active">Archivos adjuntos</li>
            </ul>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-md-12 text-right">
            <a class="btn btn-success btn_upload" href="" data-id="<?= $_GET['opp']; ?>">Subir archivo</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 my-5">
            <table class="table table-bordered table-striped display responsive nowrap" id="tabla" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">Nombre del archivo</th>
                        <th class="text-center">Adjuntado Por</th>
                        <th class="text-center">Fecha Agregada</th>
                        <th class="text-center">Tamaño</th>
                        <!--<th>Acciones</th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(!empty($attachments)){
                            foreach($attachments['data'] as $info){
                                $Created_Time = new DateTime($info['Created_Time']);
                                $formatDate = "d/m/Y H:i:s";
                    ?>
                            <tr>
                                <td><a href="<?= base_url(); ?>attachments/downloadAttachment/<?= $info['Parent_Id']['id']; ?>/<?= $info['id']; ?>" target="_blank"><i class="fas fa-file-pdf"></i> <?= $info['File_Name']; ?></a></td>
                                <td><?= $info['Created_By']['name']; ?></td>
                                <td><?= $Created_Time->format($formatDate); ?></td>
                                <td><?= $info['Size']; ?></td>
                                <!--<td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                            Acciones
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item">ver</a>
                                        </div>
                                    </div>
                                </td>-->
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
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>

<?= $this->template->javascript->add(base_url().'assets/js/attachments.js'); ?>
<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item active">Leads</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="alert alert-warning alert-dismissible w-100">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Antención!</strong> La creación del lead puede demorar unos minutos.
        </div>
        <div class="col-md-12 d-flex justify-content-end">
            <a href="<?php echo base_url(); ?>leads/nuevo" class="btn btn-outline-success">Agregar</a>
        </div>
        <div class="col-md-12 my-5">
            <table class="table table-bordered table-striped display responsive nowrap" id="tabla" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">Nombre</th>
                        <th class="text-center">Correo</th>
                        <th class="text-center">Telefono</th>
                        <th class="text-center">Empresa</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                        if(!empty($leads)){
                            foreach($leads['data'] as $lead){
                    ?>
                                <tr>
                                    <td><?= $lead['Full_Name']; ?></td>
                                    <td><?= $lead['Email']; ?></td>
                                    <td><?= $lead['Phone']; ?></td>
                                    <td><?= $lead['Company']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                Acciones
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?php echo base_url(); ?>leads/editar/<?= $lead['id']; ?>">Editar</a>
                                                <a class="dropdown-item" href="<?php echo base_url(); ?>leads/convertir/<?= $lead['id']; ?>">Convertir</a>
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


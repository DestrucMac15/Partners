<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>home">Home</a></li>
                <li class="breadcrumb-item active">Cuentas</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 d-flex justify-content-end">
            <a href="<?php echo base_url(); ?>accounts/nuevo" class="btn btn-outline-success">Agregar</a>
        </div>
        <div class="col-md-12 my-5">
            <table class="table table-bordered table-striped display responsive nowrap" id="tabla" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">Cuenta</th>
                        <th class="text-center">Descripción</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                        if(!empty($accounts)){
                            foreach($accounts['data'] as $account){ 
                    ?>
                                <tr>
                                    <td><a href="<?php echo base_url(); ?>accounts/editar/<?= $account['id']; ?>"><?= $account['Account_Name']; ?></a></td>
                                    <td><?= $account['Description']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                Acciones
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?php echo base_url(); ?>accounts/editar/<?= $account['id']; ?>">Editar</a>
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
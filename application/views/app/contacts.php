<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="">Dashboard</a></li>
                <li class="breadcrumb-item active">Contactos</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 my-5">
            <table class="table table-bordered table-striped display responsive nowrap" id="tabla" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">Contacto</th>
                        <th class="text-center">Telefono</th>
                        <th class="text-center">Cuenta</th>
                        <th class="text-center">Fuente de Lead</th>
                        <th class="text-center">Correo electrónico</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php   
                        if(!empty($contacts)){
                            foreach($contacts['data'] as $contact){ 
                    ?>
                                <tr>
                                    <td><a href="<?php echo base_url(); ?>contacts/editar/<?= $contact['id']; ?>"><?= $contact['Full_Name']; ?></a></td>
                                    <td><?= $contact['Phone']; ?></td>
                                    <td><?= $contact['Account_Name']['name']; ?></td>
                                    <td><?= $contact['Lead_Source']; ?></td>
                                    <td><?= $contact['Email']; ?></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown">
                                                Acciones
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="<?php echo base_url(); ?>contacts/editar/<?= $contact['id']; ?>">Editar</a>
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
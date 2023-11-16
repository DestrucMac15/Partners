<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>/dashboard">Dashboard</a></li>
                <li class="breadcrumb-item active">Books</li>
            </ul>
        </div>
    </div>
    <div class="row my-3">
        <div class="col-md-12 text-right">
            <a href="<?= base_url(); ?>books/nuevo/<?= $_GET['opp']; ?>" class="btn btn-success">Nuevo Presupuesto</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 my-5">
            <table class="table table-bordered table-striped display responsive nowrap" id="tabla" width="100%">
                <thead>
                    <tr>
                        <th class="text-center">Presupuesto N.°</th>
                        <th class="text-center">Estado</th>
                        <th class="text-center">Fecha del Presupuesto</th>
                        <th class="text-center">N.° de Referencia</th>
                        <th class="text-center">Subtotal</th>
                        <th class="text-center">Importe</th>
                        <th class="text-center">Válido Hasta</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        if(!empty($books)){
                            foreach($books['estimates'] as $book){ 
                    ?>
                            <tr>
                                <td><a href="<?= base_url(); ?>books/downloadBook/<?= $book['estimate_id']; ?>" target="_blank"><i class="fas fa-file-pdf"></i> <?= $book['estimate_number']; ?></a></td>
                                <td><?= $book['status']; ?></td>
                                <td><?= $book['date']; ?></td>
                                <td><?= $book['reference_number']; ?></td>
                                <td>MXN <?= $book['sub_total']; ?></td>
                                <td>MXN <?= $book['total']; ?></td>
                                <td><?= $book['expiry_date']; ?></td>
                                <td>
                                    <a class="dropdown-item" href="<?php echo base_url(); ?>books_edit/editar/<?= $book['estimate_id']; ?>">Editar</a>
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

<?= $this->template->javascript->add(base_url().'assets/js/opportunities.js'); ?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6 offset-md-3 align-items-center justify-content-center">
            <section class="card w-100 my-5" style="border-radius: 10px;">
                <form class="card-body" id="form_login" role="login" class="needs-validation" novalidate>    
                    <div class="d-flex justify-content-center ">
                        <img src="<?php echo base_url(); ?>assets/images/logo2.png" width="100" alt="">
                    </div>
                    <hr>
                    <div class="form-group">
                        <p class="text-center">Ingresa tu nueva contraseña para: <?= urldecode($correo); ?></p>
                    </div>
                    <div class="form-group" hidden>
                        <input type="text" name="correo" class="form-control" value="<?= $correo; ?>" readonly>
                    </div>

                    <div class="d-flex justify-content-between">
                        <label for="">Nueva contraseña</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password1" class="form-control"  required>
                    </div>

                    <div class="d-flex justify-content-between">
                        <label for="">Confirmar contraseña</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password2" class="form-control"  required>
                    </div>

                    <button type="submit" class="btn bg-vocom text-white btn-block">
                        Enviar
                    </button>
                </form>
            </section>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){

        let ruta = $('body').data('ruta');

        $('#form_login').submit(function(event){
    
            event.preventDefault();
    
            let datos = $(this).serialize();
    
            $.ajax({
                url: ruta+'login/create_password',
                method: 'POST',
                dataType: 'JSON',
                data: datos,
                success: function(response){
    
                iziToast.success({
                    timeout: 3000,
                    overlay: true,
                    displayMode: 'once',
                    id: 'inputs',
                    zindex: 999,
                    title: 'Correcto!',
                    message: 'Bienvenido',
                    position: 'topRight',
                    drag: false
                });
    
                setInterval(function(){
    
                    location.replace(ruta+'login');
    
                },1000);
                },
                statusCode: {
                    400: function(xhr){
    
                        iziToast.error({
                            timeout: 3000,
                            overlay: true,
                            displayMode: 'once',
                            id: 'inputs',
                            zindex: 999,
                            title: 'Atención!',
                            message: 'Rellena los campos correctamente',
                            position: 'topRight',
                            drag: false
                        });
    
                    },
                    402: function(xhr){
                    
                        iziToast.error({
                            timeout: 3000,
                            overlay: true,
                            displayMode: 'once',
                            id: 'inputs',
                            zindex: 999,
                            title: 'Atención!',
                            message: xhr.responseText,
                            position: 'topRight',
                            drag: false
                        });
    
                    }
                }
            })
    
        });

    });
</script>
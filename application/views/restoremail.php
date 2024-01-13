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
                        <p class="text-center">Restaura tu contraseña</p>
                        <p class="text-center">Escriba su dirección de correo electrónico registrada</p>
                    </div>

                    <div class="d-flex justify-content-between">
                        <label for="">Ingresa tu correo:</label>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="correo" class="form-control"  required>
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
                url: ruta+'login/mail',
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
                    //message: 'Bienvenido',
                    position: 'topRight',
                    drag: false
                });
    
                setTimeout(function(){
    
                    location.href = ruta+"login/reset?"+datos;
    
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
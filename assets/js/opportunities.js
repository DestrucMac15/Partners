$(document).ready(function(){

    const ruta = $('body').data('ruta');

    //Actulizar
    $('#formLeadsEdit').on('submit',function(event){

        event.preventDefault();

        let data = new FormData(this);

        let boton = $(this).find(':submit');
        

        iziToast.success({
            timeout: 5000,
            overlay: true,
            displayMode: 'once',
            id: 'inputs',
            zindex: 999,
            title: 'Atención!',
            message: '¿Estás seguro de actualizar?',
            position: 'topRight',
            drag: false,
            buttons: [
                ['<button>Actualizar</button>', function (instance, toast) {

                    boton.text('Enviando..');
                    boton.prop('disabled', true);

                    $.ajax({
                        url: ruta+'opportunities/edit',
                        dataType: 'JSON',
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: 'POST'
                    }).done(function(respuesta){
                            
                            if(respuesta.estatus){

                                iziToast.success({
                                    timeout: 3000,
                                    overlay: true,
                                    displayMode: 'once',
                                    id: 'inputs',
                                    zindex: 999,
                                    title: 'Correcto!',
                                    message: respuesta.mensaje,
                                    position: 'topRight',
                                    drag: false
                                });

                                setInterval(function(){
                                    location.href = ruta+"opportunities";
                                },1500);

                            }else{

                                iziToast.error({
                                    title: 'Alerta!',
                                    message: respuesta.mensaje,
                                    position: 'topRight',
                                });

                            }

                    }).always(function(){
                        boton.prop('disabled', false);
                        boton.text('Actualizar');
                    });
                    
                }, true],
                ['<button>Cancelar</button>', function (instance, toast) {

                    iziToast.hide({
                        transitionOut: 'fadeOutUp'
                    }, toast);
                    
                }, true],
            ]
        });

        
    

    });

    $('.btn_upload').click(function(event){

        event.preventDefault();

        $('#id').val($(this).data('id'));

        $('#modalOpportunities').modal('show');

    });

    $("#archivo").on("change", function(event) {

        event.preventDefault();

        var fileName = $(this).val().split("\\").pop();

        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);

        let imagen = this.files[0];

        if(imagen['type'] != 'application/pdf'){

            $(this).val('');
            iziToast.error({
                timeout: 3000,
                overlay: true,
                displayMode: 'once',
                id: 'inputs',
                zindex: 999,
                title: 'Atención!',
                message: 'La imagen tiene que ser formato PDF',
                position: 'topRight',
                drag: false
              });

        }else if(imagen['size'] > 2000000){

            $(this).val('');
            iziToast.error({
                timeout: 3000,
                overlay: true,
                displayMode: 'once',
                id: 'inputs',
                zindex: 999,
                title: 'Atención!',
                message: 'La imagen tiene que ser menor a 10 MB',
                position: 'topRight',
                drag: false
              });

        }

    });

    $('#formArchivos').submit(function(event){

        event.preventDefault();

        let data = new FormData(this);

        let boton = $(this).find(':submit');
        boton.text('Enviando..');
        boton.prop('disabled', true);

        $.ajax({
            url: ruta+'opportunities/upload',
            dataType: 'JSON',
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            type: 'POST'
          }).done(function(respuesta){
      
            if(respuesta){
        
              iziToast.success({
                  timeout: 3000,
                  overlay: true,
                  displayMode: 'once',
                  id: 'inputs',
                  zindex: 999,
                  title: 'Correcto!',
                  message: respuesta.estatus,
                  position: 'topRight',
                  drag: false
              });
              
              setTimeout(function(){
                
                location.reload();
        
              },1000);
        
            }else{
        
              iziToast.error({
                  title: 'Alerta!',
                  message: respuesta.mensaje,
                  position: 'topRight',
              });
        
            }
        
        }).always(function(){

            boton.prop('disabled', false);
            boton.text('Guardar');
            
        });

    });


});

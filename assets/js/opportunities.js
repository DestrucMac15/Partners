$(document).ready(function(){

    const ruta = $('body').data('ruta');

    /*=====AGREGAR OPORTUNIDAD======*/
    $('#formOppInsert').on('submit',function(event){

        event.preventDefault();
        let boton = $(this).find(':submit');

        let data = new FormData(this);

        iziToast.success({
            timeout: 3000,
            overlay: true,
            displayMode: 'once',
            id: 'inputs',
            zindex: 999,
            title: 'Atención!',
            message: '¿Estás seguro de guardar?',
            position: 'topRight',
            drag: false,
            buttons: [
                ['<button>Guardar</button>', function (instance, toast) {

                    boton.text('Enviando..');
                    boton.prop('disabled', true);

                    $.ajax({
                        url: ruta+'opportunities/save',
                        dataType: 'JSON',
                        type: 'POST',
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(response){
    
                            iziToast.success({
                                timeout: 3000,
                                overlay: true,
                                displayMode: 'once',
                                id: 'inputs',
                                zindex: 998,
                                title: 'Correcto!',
                                message: 'Bienvenido',
                                position: 'topRight',
                                drag: false
                            });
                
                            setTimeout(function(){
                
                                location.replace(ruta+'opportunities');
                
                            },1500);

                        },
                        statusCode: {
                            401: function(xhr){
                                
                                iziToast.error({
                                    title: 'Alerta!',
                                    message: xhr.responseJSON.mensaje,
                                    position: 'topRight',
                                });

                            }
                        },
                    }).always(function(){

                        boton.prop('disabled', false);
                        boton.text('Guardar');
                        
                    });

                }, true],
                ['<button>Cancelar</button>', function (instance, toast) {

                    iziToast.hide({
                        transitionOut: 'fadeOutUp'
                    }, toast);

                    boton.prop('disabled', false);
                    boton.text('Guardar');
                    
                }, true],
            ]
        });

    });

    //Actulizar Oportunidad
    $('#formOppEdit').on('submit',function(event){

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

                                setTimeout(function(){
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

});

$(document).ready(function(){

    const ruta = $('body').data('ruta');

    /*=====EDITAR lEAD=======*/
    $('#formAccountEdit').on('submit',function(event){

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
                        url: ruta+'Accounts/edit',
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
                                    location.href = ruta+"accounts";
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
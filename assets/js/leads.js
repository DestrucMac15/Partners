$(document).ready(function(){

    const ruta = $('body').data('ruta');

    /*=====AGREGAR LEAD======*/
    $('#formLeads').on('submit',function(event){

        event.preventDefault();
        let boton = $(this).find(':submit');
        boton.text('Enviando..');
        boton.prop('disabled', true);

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

                    $.ajax({
                        url: ruta+'Leads/save',
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
                
                            setInterval(function(){
                
                                location.replace(ruta+'leads');
                
                            },1000);

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

    /*=====EDITAR lEAD=======*/
    $('#formLeadsEdit').on('submit',function(event){

        event.preventDefault();

        let data = new FormData(this);
        let boton = $(this).find(':submit');
        boton.text('Enviando..');
        boton.prop('disabled', true);

        iziToast.success({
            timeout: 5000,
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

                    $.ajax({
                        url: ruta+'Leads/edit',
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
                                    location.href = ruta+"leads";
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
                        boton.text('Guardar');
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

    $('.optAdd').click(function(){

        $('#modalAddAccount').modal('show');

    });

    $('.showAdd').click(function(event){

        event.preventDefault();

        $('#modalAddAccount').modal('show');

    });

    $('.optCreate').click(function(){

        $('#modalCreateAccount').modal('show');

    });

    $('.optCreateOptAccount').click(function(){

        $('.infomation').toggleClass('d-none');

    });
    
    $('#formConvert').submit(function(event){

        event.preventDefault();

        let data = new FormData(this);

        let boton = $(this).find(':submit');
        boton.text('Enviando..');
        boton.prop('disabled', true);

        iziToast.success({
            timeout: 5000,
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

                    $.ajax({
                        url: ruta+'Leads/convert',
                        dataType: 'JSON',
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: 'POST'
                    }).done(function(respuesta){
                            
                            if(respuesta.estatus === true){

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
                                    location.href = ruta+"leads";
                                },1500);

                            }else{

                                iziToast.error({
                                    timeout: 3000,
                                    overlay: true,
                                    displayMode: 'once',
                                    id: 'inputs',
                                    zindex: 999,
                                    title: 'Atención!',
                                    message: respuesta.mensaje,
                                    position: 'topRight',
                                    drag: false
                                });

                            }

                    }).always(function(){
                        boton.prop('disabled', false);
                        boton.text('Guardar');
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
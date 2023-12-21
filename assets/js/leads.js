$(document).ready(function(){

    const ruta = $('body').data('ruta');
    var idCheckboxSeleccionadoAccount;
    var idCheckboxSeleccionadoContact;

    /*=====AGREGAR LEAD======*/
    $('#formLeads').on('submit',function(event){

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
                
                            setTimeout(function(){
                
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

        iziToast.success({
            timeout: 5000,
            overlay: true,
            displayMode: 'once',
            id: 'inputs',
            zindex: 999,
            title: 'Atención!',
            message: '¿Estás seguro de actualizar el Lead?',
            position: 'topRight',
            drag: false,
            buttons: [
                ['<button>Actualizar</button>', function (instance, toast) {

                    boton.text('Enviando..');
                    boton.prop('disabled', true);

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

                                setTimeout(function(){
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

    $('#optAddAccount').click(function(){

        $('#modalAddAccount').modal('show');

        if($('.accountOpt').hasClass('d-none') == false){

            $('.accountOpt').addClass('d-none');   

        }

    });

    $('#optAddContacts').click(function(){

        $('#modalAddContact').modal('show');

    });

    $('.showAddAccount').click(function(event){

        event.preventDefault();

        $('#modalAddAccount').modal('show');

    });

    $('.showAddContact').click(function(event){

        event.preventDefault();

        $('#modalAddContact').modal('show');

    });

    $('.optCreateAccount').click(function(){

        $('#modalCreateAccount').modal('show');

    });

    $('.optCreateAccount').click(function(){

        $('.infomation').toggleClass('d-none');

    });
    
    /*=====CONVERTIR A OPORTUNIDAD=======*/
    
    $('#formConvert').submit(function(event){

        event.preventDefault();

        let data = new FormData(this);
        let id_account = $('#optAddAccount').data('id');
        let id_contact = $('#optAddContacts').data('id');

        if(id_account !== undefined){

            data.append('id_account',id_account);

        }else if(id_contact !== undefined){

            data.append('id_contact',id_contact);

        }else{

            data.append('id_deal',"new_deal");

        }

        let boton = $(this).find(':submit');
       
        iziToast.success({
            timeout: 5000,
            overlay: true,
            displayMode: 'once',
            id: 'inputs',
            zindex: 999,
            title: 'Atención!',
            message: '¿Estás seguro de convertir el lead?',
            position: 'topRight',
            drag: false,
            buttons: [
                ['<button>Convertir</button>', function (instance, toast) {

                    boton.text('Enviando..');
                    boton.prop('disabled', true);

                    $.ajax({
                        url: ruta+'Leads/convert',
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
                                    location.href = ruta+"leads";
                                },1500);

                            }else{

                                iziToast.error({
                                    //timeout: 3000,
                                    //overlay: true,
                                    //displayMode: 'once',
                                    //id: 'inputs',
                                    //zindex: 999,
                                    title: 'Atención!',
                                    message: respuesta.mensaje,
                                    position: 'topRight',
                                    //drag: false
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

    /*=====CONVERTIR A OPORTUNIDAD CUENTA=======*/

    $('#modalAddAccount').on('change', 'input[type="checkbox"]', function(){

        // Marcar el checkbox seleccionado
        //$(this).prop('checked', true);
        // Almacenar el ID del checkbox seleccionado
        idCheckboxSeleccionadoAccount = $(this).data('id');
    });

    $('.btnSaveModalAccount').on('click', function(){

        $('#optAddAccount').attr('data-id', idCheckboxSeleccionadoAccount);
        $('#optAddAccount').prop('checked', true);

        $('#optCreateAccountNew').prop('checked', false);

        /*if($('.accountOpt').hasClass('d-none') == false){

            $('.accountOpt').addClass('d-none');   

        }*/
        $('.accountOpt').removeClass('d-none');

        if($('#optCreateAccountOportunidad').checked ){
            //console.log("Activo");
            //$('#formConvert input').attr("required");
        }else{
            //console.log("InActivo");
            $('#formConvert input').removeAttr("required");
        }

    });

    $('#optCreateAccountNew').click(function(){

        $('#optAddAccount').prop('checked', false);
        $('#optAddAccount').attr('data-id', '');
        // Desmarcar todos los checkboxes del model 'Cuenta Existente'
        $('.account_id').prop('checked', false);

        //$('.accountOpt').toggleClass('d-none');
        $('.accountOpt').removeClass('d-none');

        if($('#optCreateAccountOportunidad').checked ){
            //console.log("Activo");
            //$('#formConvert input').attr("required");
            //$('#optCreateAccountOportunidad').prop('checked', false);
            //$('#formConvert input').removeAttr("required");
            //$('.formioConvertLead').addClass('d-none');
        }else{
            //console.log("InActivo");
            $('#formConvert input').removeAttr("required");
        }

    });

    $('#optCreateAccountOportunidad').click(function(){

        $('.formioConvertLead').toggleClass('d-none');
        //$('#formConvert input[type="text"]').attr("required","required");
        //$('#formConvert input[type="date"]').attr("required","required");

        if( this.checked ){
            $('#formConvert input[type="text"]').attr("required","required");
            $('#formConvert input[type="date"]').attr("required","required");
        }else{
            $('#formConvert input').removeAttr("required");
        }

    });

    /*=====CONVERTIR A OPORTUNIDAD CONTACTO=======*/

    $('#modalAddContact').on('change', 'input[type="checkbox"]', function(){
        // Almacenar el ID del checkbox seleccionado
        idCheckboxSeleccionadoContact = $(this).data('id');
    });

    $('.btnSaveModalContact').on('click', function(){

        $('#optAddContacts').attr('data-id', idCheckboxSeleccionadoContact);
        $('#optAddContacts').prop('checked', true);

        $('.contactOpt').removeClass('d-none');

        if($('#optCreateContactOportunidad').checked ){

        }else{
            //console.log("InActivo");
            $('#formConvert input').removeAttr("required");
        }

    });

    $('#optCreateContactOportunidad').click(function(){

        $('.formioConvertLead').toggleClass('d-none');

        if( this.checked ){
            $('#formConvert input[type="text"]').attr("required","required");
            $('#formConvert input[type="date"]').attr("required","required");
        }else{
            $('#formConvert input').removeAttr("required");
        }

    });



});
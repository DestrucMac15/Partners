$(document).ready(function(){

    const ruta = $('body').data('ruta');

    $('#buscador').select2();

    /*=====CREAR PRESUPUESTO=======*/
    $('#formEstimates').submit(function(event){

        event.preventDefault();

        let data   = new FormData(this);
        let emails = new FormData(document.getElementById("footerForm"));
        let opp_id = $('#opp_id').val();

        // Obtienes las entradas del formulario X para meterlos al fomulario Y.
        for (let [key, value] of emails.entries()) {
            data.append(key, value);
        }

        let boton = $(this).find(':submit');
        

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

                    boton.text('Enviando..');
                    boton.prop('disabled', true);

                    $.ajax({
                        url: ruta+'Books/save',
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
                                    location.href = ruta+"books/?opp="+opp_id;
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

    /*=====ENVIAR CORREO=======*/
    $('#sendMail').on('click',function(event){
        
        event.preventDefault();

        //let data = new FormData(this);
        let mails = [];

        $('.email').each(function(){
            if($(this).prop('checked')){
                mails.push($(this).data('email'));
            }
        });

        let data   = new FormData(document.getElementById("formEstimates"));
        let emails = new FormData(document.getElementById("footerForm"));
        let opp_id = $('#opp_id').val();
        //let opp_id = new FormData(document.getElementById("footerForm"));

        // Obtienes las entradas del formulario X para meterlos al fomulario Y.
        for (let [key, value] of emails.entries()) {
            data.append(key, value);
        }

        data.append('correos',mails);
        
        let boton = $(this).find(':submit');
        let descripcionProyecto = $('#descripcionProyecto').val();
        
        if($('.email').is(":checked") && $('#fechaVencimiento').val() !== '' && descripcionProyecto.trim() !== ''){

            iziToast.success({
                timeout: 5000,
                overlay: true,
                displayMode: 'once',
                id: 'inputs',
                zindex: 999,
                title: 'Atención!',
                message: '¿Estás seguro de enviar el presupuesto?',
                position: 'topRight',
                drag: false,
                buttons: [
                    ['<button>Enviar</button>', function (instance, toast){

                        boton.text('Enviando..');
                        boton.prop('disabled', true);
                        
                        $.ajax({
                            url: ruta+'Books/sendEmail',
                            dataType: 'JSON',
                            data: data,
                            cache: false,
                            contentType: false,
                            processData: false,
                            type: 'POST'
                        }).done(function(respuesta){
                                //console.log(respuesta);
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
                                        location.href = ruta+"books/?opp="+opp_id;
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

        }else{

            iziToast.error({
                title: 'Alerta!',
                message: 'Campos vacios/Marcar correo',
                position: 'topRight',
            });

        }
    });

    $('#form_buscador').submit(function(event){

        event.preventDefault();

        let item = $('#buscador').val();

        $.ajax({
            url: ruta+'books/addItem',
            method: 'POST',
            dataType: 'JSON',
            data: {
                'item': item
            }
        }).done(function(respuesta){

            cotizacion(ruta);
            
        });

    });

    cotizacion(ruta);

    $('#btn_agregarCabecera').click(function(){

        $.ajax({
            url: ruta+'books/addHeader',
            method: 'POST',
            dataType: 'JSON'
        }).done(function(respuesta){

            cotizacion(ruta);
            
        });

    });

    /*=====MODAL´S=======*/
    $('#modalUPDBillingAddress').on('show.bs.modal', function(event){

        $('#formBillingAddress')[0].reset();

    });

    $('#modalUPDShippingAddress').on('show.bs.modal', function(event){

        $('#formShippingAddress')[0].reset();

    });

    $('.showModalBillingAddress').click(function(event){

        event.preventDefault();

        $('#modalUPDBillingAddress').modal('show');

    });

    $('.showModalShippingAddress').click(function(event){

        event.preventDefault();

        $('#modalUPDShippingAddress').modal('show');

    });
    
    /*=====UPDATE FORM MODAL´S=======*/
    $('#formBillingAddress').submit(function(event){

        event.preventDefault();

        let data = new FormData(document.getElementById("formBillingAddress"));
        let boton = $(document.getElementById("billing_boton"));

        iziToast.success({
            timeout: 5000,
            overlay: true,
            displayMode: 'once',
            id: 'inputs',
            zindex: 1051,
            title: 'Atención!',
            message: '¿Estás seguro de Actualizar?',
            position: 'topRight',
            drag: false,
            buttons: [
                ['<button>Actualizar</button>', function (instance, toast) {

                    boton.text('Enviando..');
                    boton.prop('disabled', true);

                    $.ajax({
                        url: ruta+'Books/uptaddress',
                        dataType: 'JSON',
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: 'POST'
                    }).done(function(respuesta){
            
                        if(respuesta.estatus){
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            iziToast.success({
                                title: 'Correcto!',
                                overlay: true,
                                message: respuesta.mensaje,
                                position: 'topRight',
                            });
                            // Cerrar el modal después de una respuesta exitosa
                            //$('#modalUPDBillingAddress').modal('hide');

                            setTimeout(function(){
                                window.location.reload();
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

    $('#formShippingAddress').submit(function(event){

        event.preventDefault();

        let data = new FormData(document.getElementById("formShippingAddress"));
        let boton = $(document.getElementById("shipping_boton"));

        iziToast.success({
            timeout: 5000,
            overlay: true,
            displayMode: 'once',
            id: 'inputs',
            zindex: 1051,
            title: 'Atención!',
            message: '¿Estás seguro de Actualizar?',
            position: 'topRight',
            drag: false,
            buttons: [
                ['<button>Actualizar</button>', function (instance, toast) {

                    boton.text('Enviando..');
                    boton.prop('disabled', true);

                    $.ajax({
                        url: ruta+'Books/uptaddress',
                        dataType: 'JSON',
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: 'POST'
                    }).done(function(respuesta){
            
                        if(respuesta.estatus){
                            instance.hide({ transitionOut: 'fadeOut' }, toast, 'button');
                            iziToast.success({
                                title: 'Correcto!',
                                overlay: true,
                                message: respuesta.mensaje,
                                position: 'topRight',
                            });
                            // Cerrar el modal después de una respuesta exitosa
                            //$('#modalUPDBillingAddress').modal('hide');

                            setTimeout(function(){
                                window.location.reload();
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
    
    /*=====MARK AN ESTIMATE AS ACCEPTED=======*/
    $('#tabla tbody').on('click', '.estimate_accepted', function(event){

        event.preventDefault();

        let estimate_id = $(this).data('id');
        let opp_id = $(this).data('estimate');
        let data = new FormData();
        
        data.append('estimate_id',estimate_id);
        data.append('opp_id',opp_id);
        //console.log(data);
        let boton = $(this).find(':submit');

        iziToast.success({
            timeout: 5000,
            overlay: true,
            displayMode: 'once',
            id: 'inputs',
            zindex: 999,
            title: 'Atención!',
            message: '¿Estás seguro de Aceptar el presupuesto?',
            position: 'topRight',
            drag: false,
            buttons: [
                ['<button>Enviar</button>', function (instance, toast){

                    boton.text('Enviando..');
                    boton.prop('disabled', true);
                    
                    $.ajax({
                        url: ruta+'Books/updEstatusEstimate',
                        dataType: 'JSON',
                        data: data,
                        cache: false,
                        contentType: false,
                        processData: false,
                        type: 'POST'
                    }).done(function(respuesta){
                            //console.log(respuesta);
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
                                    window.location.reload();
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

});
/*=====FUNCTION´S=======*/
function cotizacion(ruta){

    let contenido;

    $.ajax({
        url: ruta+'books/getBook',
        method: 'POST',
        dataType: 'JSON',
    }).done(function(respuesta){
        //console.log(respuesta.articulos);
        let formatCurrency = new Intl.NumberFormat('es-Mx',{
            style: 'currency',
            currency: 'MXN'
        });

        if(respuesta.articulos.length > 0){

            $.each(respuesta.articulos, function(indice, items){


                contenido += `
                    <tr>
                        <td colspan="8">
                            <input type="text" class="form-control inputHeader" data-cabecera=${indice} value="${items.header}">
                        </td>
                        <td>
                            <button class="btn btn-danger btn-sm btnQuitarHeader" data-cabecera=${indice}>X</button>
                        </td>
                    </tr>
                `;

                $.each(items.items, function(clave, valor){
                    
                    contenido += `
                        <tr data-indice=${clave} class="small">
                            <td> ${valor.name}</td>
                            <td>${valor.custom_field_hash.cf_codigo_sat}</td>
                            <td>${valor.custom_field_hash.cf_nombresat}</td>
                            <td>${valor.custom_field_hash.cf_clave_de_producto_o_servici}</td>
                            <td>
                                <input type="number" class="form-control cantidadItem" value="${valor.quantity}" data-cabecera=${indice} data-item=${clave} value="1" min="0">
                            </td>
                            <td>
                                <input type="number" class="form-control rateItem" value="${valor.pricebook_rate}" data-cabecera=${indice} data-item=${clave} min="0">
                            </td>
                            <td>${valor.tax_name+' - '+valor.tax_percentage+'%'}<br>${formatCurrency.format(valor.impuesto)}</td>
                            <td>${formatCurrency.format(valor.item_total)}</td>
                            <td>
                                <button class="btn btn-danger btn-sm btnQuitar" data-cabecera=${indice} data-item=${clave}>X</button>
                            </td>
                       </tr>
                    `;
    
                });
    
            });
            

        }else{

            contenido = `
                <tr>
                    <td colspan="10">
                        <h5 class="text-center">Sin artículos</h5>
                    </td>
                </tr>
            `;
            
        }

        $('#contenido').html(contenido);

        let tabulador = "";

        tabulador += `
            <li class="list-group-item d-flex justify-content-between"><b>Subtotal:</b> ${formatCurrency.format(respuesta.tabulador.subtotal)}</li>
            <li class="list-group-item d-flex justify-content-between"><b>Cargo de envió:</b> <input class="form-control cargoEnvio" type="number" value="${respuesta.tabulador.envio.toFixed(2)}" min="0"></li>
            <li class="list-group-item d-flex justify-content-between"><input type="text" class="form-control nombreImpuesto" value="${respuesta.tabulador.nombre_impuesto}"><input type="number" class="form-control mx-1 valorImpuesto" value="${respuesta.tabulador.impuesto.toFixed(2)}" min="0"></li>
            <li class="list-group-item d-flex justify-content-between"><b>Total (MXN)</b> ${formatCurrency.format(respuesta.tabulador.total)}</li>
        `;


        $('#tabulador').html(tabulador);

        //Eliminar articulo
        $('.btnQuitar').click(function(){

            let cabecera = $(this).data('cabecera');
            let item = $(this).data('item');

            $.ajax({
                url: ruta+'books/deleteItem',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    cabecera: cabecera,
                    item: item
                }
            }).done(function(respuesta){

                cotizacion(ruta);

            });
        });
        
        //Editar cabecera
        $('.inputHeader').on('focusout',function(){ 

            let cabecera = $(this).data('cabecera');
            let valor = $(this).val();

            $.ajax({
                url: ruta+'books/editHeader',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    cabecera: cabecera,
                    valor: valor
                }
            }).done(function(respuesta){

                cotizacion(ruta);

            });

        });

        //Eliminar Cabecera
        $('.btnQuitarHeader').click(function(){

            let cabecera = $(this).data('cabecera');

            $.ajax({
                url: ruta+'books/deleteHeader',
                method: 'POST',
                dataType: 'JSON',
                data: {
                    cabecera: cabecera
                }
            }).done(function(respuesta){

                cotizacion(ruta);

            });

        });

        //Editar la cantidad
        $('.cantidadItem').on('focusout',function(){

            let cantidad = $(this).val();
            let cabecera = $(this).data('cabecera');
            //let rate = $(this).data('rate');
            let item = $(this).data('item');

            $.ajax({
                url: ruta+'books/editQuantity', 
                method: 'POST',
                dataType: 'JSON',
                data: {
                    cantidad: cantidad,
                    cabecera: cabecera,
                    //rate: rate,
                    item: item
                }
            }).done(function(respuesta){

                cotizacion(ruta);

            });

        });

        //Editar Descuento
        /*$('.discount').on('focusout',function(){

            let descuento = $(this).val();
            let TipoDescuento = $(this).siblings('.typeDiscount').val();
            let cabecera = $(this).data('cabecera');
            let item = $(this).data('item');


            $.ajax({
                url: ruta+'books/addDiscount', 
                method: 'POST',
                dataType: 'JSON',
                data: {
                    descuento: descuento,
                    cabecera: cabecera,
                    TipoDescuento: TipoDescuento,
                    item: item
                }
            }).done(function(respuesta){

                cotizacion(ruta);

            });

        });*/
        
        //Editar Precio del producto
        $('.rateItem').on('focusout',function(){

            let rate = $(this).val();
            let cabecera = $(this).data('cabecera');
            let item = $(this).data('item');

            $.ajax({
                url: ruta+'books/addRate', 
                method: 'POST',
                dataType: 'JSON',
                data: {
                    rate: rate,
                    cabecera: cabecera,
                    item: item
                }
            }).done(function(respuesta){

                cotizacion(ruta);

            });

        });

        //Editar tipo de descuento de simbolo
        $('.typeDiscount').on('change',function(){

            let descuento = $(this).siblings('.discount').val();
            let TipoDescuento = $(this).val();
            let cabecera = $(this).data('cabecera');
            let item = $(this).data('item');


            $.ajax({
                url: ruta+'books/addDiscount', 
                method: 'POST',
                dataType: 'JSON',
                data: {
                    descuento: descuento,
                    cabecera: cabecera,
                    TipoDescuento: TipoDescuento,
                    item: item
                }
            }).done(function(respuesta){

                cotizacion(ruta);

            });

        });

        //Agregar Cargo de envío
        $('.cargoEnvio').on('focusout',function(){

            let shipment = $(this).val();

            $.ajax({
                url: ruta+'books/editShipment', 
                method: 'POST',
                dataType: 'JSON',
                data: {
                    shipment: shipment
                }
            }).done(function(respuesta){

                cotizacion(ruta);

            });

        });

        //Editar nombre del Impuesto
        $('.nombreImpuesto').on('focusout',function(){

            let nameTax = $(this).val();

            $.ajax({
                url: ruta+'books/editNameTax', 
                method: 'POST',
                dataType: 'JSON',
                data: {
                    nameTax: nameTax
                }
            }).done(function(respuesta){

                cotizacion(ruta);

            });

        });

        //Editar Impuesto
        $('.valorImpuesto').on('focusout',function(){

            let tax = $(this).val();

            $.ajax({
                url: ruta+'books/editTax', 
                method: 'POST',
                dataType: 'JSON',
                data: {
                    tax: tax
                }
            }).done(function(respuesta){

                cotizacion(ruta);

            });

        });


    });

}


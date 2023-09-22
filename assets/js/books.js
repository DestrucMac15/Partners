$(document).ready(function(){

    const ruta = $('body').data('ruta');

    $('#buscador').select2();

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

});

function cotizacion(ruta){

    let contenido;

    $.ajax({
        url: ruta+'books/getBook',
        method: 'POST',
        dataType: 'JSON',
    }).done(function(respuesta){

        if(respuesta.articulos.length > 0){

            $.each(respuesta.articulos, function(indice, items){


                contenido += `
                    <tr>
                        <td colspan="9">
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
                                <input type="number" class="form-control cantidadItem" value="${valor.quantity}" data-cabecera=${indice} data-item=${clave} data-rate="${valor.rate}" value="1">
                            </td>
                            <td>
                                ${valor.pricebook_rate.toFixed(2)}
                            </td>
                            <td class="d-flex">
                                <input type="number" class="form-control discount" value="${valor.discount_amount}" data-cabecera=${indice} data-item=${clave}>
                                <select  class="form-control typeDiscount" value="${valor.discount_amount}" data-cabecera=${indice} data-item=${clave}>
                                    <option ${(typeof valor.discount !== "undefined") ? (valor.discount.indexOf("%") > -1) ? 'selected' : '' : ''} value="%">%</option>
                                    <option ${(typeof valor.discount !== "undefined") ? (valor.discount.indexOf("%") > -1) ? '' : 'selected' : ''} value="MXN">MXN</option>
                                </select>
                            </td>
                            <td>${valor.tax_name+' - '+valor.tax_percentage+'%'}</td>
                            <td>${valor.item_total.toFixed(2)}</td>
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
            <li class="list-group-item d-flex justify-content-between"><b>Subtotal:</b> ${respuesta.tabulador.subtotal.toFixed(2)}</li>
            <li class="list-group-item d-flex justify-content-between"><b>Cargo de envió:</b> <input class="form-control type="number" value="${respuesta.tabulador.envio.toFixed(2)}"></li>
            <li class="list-group-item d-flex justify-content-between"><input type="text" class="form-control" value="Ajuste"><input type="number" class="form-control mx-1" value="${respuesta.tabulador.impuesto.toFixed(2)}"></li>
            <li class="list-group-item d-flex justify-content-between"><b>Total (MXN)</b> ${respuesta.tabulador.total.toFixed(2)}</li>
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
            let rate = $(this).data('rate');
            let item = $(this).data('item');

            $.ajax({
                url: ruta+'books/editQuantity', 
                method: 'POST',
                dataType: 'JSON',
                data: {
                    cantidad: cantidad,
                    cabecera: cabecera,
                    rate: rate,
                    item: item
                }
            }).done(function(respuesta){

                cotizacion(ruta);

            });

        });

        //Editar Descuento
        $('.discount').on('focusout',function(){

            let descuento = $(this).val();
            let TipoDescuento = $('.typeDiscount').val();
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

        //Editar tipo de descuento de simbolo
        $('.typeDiscount').on('change',function(){

            let descuento = $('.discount').val();
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


    });

}

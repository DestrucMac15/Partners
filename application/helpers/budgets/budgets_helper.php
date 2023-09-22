<?php

function getItems(){

    $CI = get_instance();

    $CI->load->helper(array('zoho_refresh/refresh_token'));

    $CI->load->model('Books_model');

    $token = comprobarToken();

    $articulos = array();

    $inicio = 1;

    while($CI->Books_model->get_listItems($token,$inicio)['page_context']['has_more_page']){

        $articulos[] = $CI->Books_model->get_listItems($token,$inicio)['items'];

        $inicio++;

    }

    $articulos[] = $CI->Books_model->get_listItems($token,$inicio)['items'];

    // Inicializar el resultado con el primer array para asegurar que existan elementos al principio
    $resultado = $articulos[0];

    // Iterar desde el segundo array en adelante y fusionarlos con el resultado
    for ($i = 1; $i < count($articulos); $i++) {
        $resultado = array_merge_recursive($resultado, $articulos[$i]);
    }

    return $resultado;

}


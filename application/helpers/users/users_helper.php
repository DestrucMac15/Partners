<?php 

function get_users($token){

    $CI = get_instance();

    $CI->load->model('Users_model');

    $respuesta = $CI->Users_model->all_dataUsers($token);

    return $respuesta;

}
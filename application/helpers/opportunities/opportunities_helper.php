<?php 

function get_campaigns($token){

    $CI = get_instance();

    $CI->load->model('Opportunities_model');

    $respuesta = $CI->Opportunities_model->get_allCampaigns($token);

    return $respuesta;

}
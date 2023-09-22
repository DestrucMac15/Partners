<?php 

function getLoginRules(){

    return array(
        array(
                'field' => 'correo',
                'label' => 'correo',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => 'El %s es requerido.',
                ),
        ),
        array(
                'field' => 'password',
                'label' => 'contraseña',
                'rules' => 'required|trim',
                'errors' => array(
                        'required' => 'La %s es requerida.',
                ),
        )
    );

}
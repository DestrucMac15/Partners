<?php
    class Partners_model extends CI_Model{

        public function get_login($token, $email, $password){
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://www.zohoapis.com/crm/v2/Contactos_Partners/search?criteria=((Email%3Aequals%3A'.$email.')and(Contrase_a%3Aequals%3A'.$password.'))',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Authorization: Zoho-oauthtoken '.$token
            ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return $response;
        }
    }
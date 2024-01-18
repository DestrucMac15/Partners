<?php
    class Leads_model extends CI_Model{

        public function all_dataModel($token,$company,$name){
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://www.zohoapis.com/crm/v6/Leads/search?criteria=(Partner%3Aequals%3A'.$company.')',
              //CURLOPT_URL => 'https://www.zohoapis.com/crm/v2/Leads/search?criteria=((Partner%3Aequals%3A'.$company.')and(Contacto_Partner%3Aequals%3A'.$name.'))',
              //CURLOPT_URL => 'https://www.zohoapis.com/crm/v2/Leads?page='.$pag.'&per_page=200',
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
            return json_decode($response,true);
        }

        public function get_lead($token, $id){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.zohoapis.com/crm/v6/Leads?ids='.$id,
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
            return json_decode($response,true);
        }

        public function insert_lead($token, $data){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.zohoapis.com/crm/v6/Leads',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>$data,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Zoho-oauthtoken '.$token,
                    'Content-Type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response, true);
        }

        public function update_lead($token, $data, $id){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.zohoapis.com/crm/v6/Leads/'.$id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'PUT',
                CURLOPT_POSTFIELDS =>$data,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Zoho-oauthtoken '.$token,
                    'Content-Type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response, true);
        }

        public function convert_lead($token, $data, $id_lead){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.zohoapis.com/crm/v6/Leads/'.$id_lead.'/actions/convert',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $data,
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Zoho-oauthtoken '.$token,
                    'Content-Type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response, true);
        }
    }
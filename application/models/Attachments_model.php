<?php
    class Attachments_model extends CI_Model{

        public function post_documentFile($token, $id, $file){
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://www.zohoapis.com/crm/v6/Potentials/'.$id.'/Attachments',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => array('file'=> new CURLFILE($file['tmp_name'], 'application/pdf', $file['name'])), 
              CURLOPT_HTTPHEADER => array(
                'Authorization: Zoho-oauthtoken '.$token
              ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response,true);
        }

        public function get_attachmentsAll($token,$id){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.zohoapis.com/crm/v6/Potentials/'.$id.'/Attachments',
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

        public function get_attachmentsPDF($token,$id_potentials,$id_attachments){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.zohoapis.com/crm/v6/Potentials/'.$id_potentials.'/Attachments/'.$id_attachments,
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
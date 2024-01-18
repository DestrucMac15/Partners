<?php
    class Contacts_model extends CI_Model{

        public function all_dataModelContacts($token,$company,$name){
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://www.zohoapis.com/crm/v6/Contacts/search?criteria=(Partner%3Aequals%3A'.$company.')',
              //CURLOPT_URL => 'https://www.zohoapis.com/crm/v2/Contacts/search?criteria=((Partner%3Aequals%3A'.$company.')and(Contacto_Partner%3Aequals%3A'.$name.'))',
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
        
        public function get_contacts($token,$id){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.zohoapis.com/crm/v6/Contacts?ids='.$id,
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

        public function get_contactEmail($token,$email){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.zohoapis.com/crm/v6/Contacts/search?criteria=Email%3Aequals%3A'.$email,
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

        public function get_contactByAccountID($token,$id){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.zohoapis.com/crm/v6/Contacts/search?criteria=Account_Name%3Aequals%3A'.$id,
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

        public function upd_contactData($token,$id,$data){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.zohoapis.com/crm/v6/Contacts/'.$id,
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

        public function get_allVendors($token){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.zohoapis.com/crm/v6/Vendors?fields=Vendor_Name',
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
            return json_decode($response, true);

        }

    }
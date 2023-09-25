<?php
    class Books_model extends CI_Model{
        /**
         * ZOHO BOOKS ESTIMATES (COTIZACIONES)
         */
        public function get_listEstimates($token,$potential_id){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.zohoapis.com/books/v3/estimates?organization_id=737962647&zcrm_potential_id='.$potential_id,
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

        public function get_pdfEstimate($token,$id){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.zohoapis.com/books/v3/estimates/pdf?organization_id=737962647&estimate_ids='.$id,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Zoho-oauthtoken '.$token,
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response,true);
        }
        
        public function create_estimates($token,$data){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.zohoapis.com/books/v3/estimates?organization_id=737962647',
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
                    'content-type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response,true);
        }

        public function upd_estimates($token,$data,$id){
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://www.zohoapis.com/books/v3/estimates/'.$id.'?organization_id=737962647',
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
                'content-type: application/json'
              ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response,true);            
        }

        /**
         * ZOHO BOOKS ITEMS (PRODUCTOS)
         */
        public function get_listItems($token,$page){##TRAER LOS PRODUCTOS POR PAGINACION DE 200 CADA UNA
            $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://www.zohoapis.com/books/v3/items?organization_id=737962647&page='.$page,
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

        public function get_itemId($token,$id){##TRAR UN PRODUCTO EN ESPECIFICO UTILIZANDO 'item_id'
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.zohoapis.com/books/v3/items/'.$id.'?organization_id=737962647',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Zoho-oauthtoken '.$token,
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
            return json_decode($response,true);
        }
        /**
         * ZOHO BOOKS TAXES (IMPUESTOS)
        */
        public function get_allTaxes($token){
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://www.zohoapis.com/books/v3/settings/taxes?organization_id=737962647&page=1',
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
    }
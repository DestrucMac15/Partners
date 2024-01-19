<?php

class Contacts extends CI_Controller{

    public function __construct(){

		parent::__construct();

        $this->load->library(array('session'));

        $this->load->model(array('Contacts_model','Accounts_model'));

		$this->load->helper(array('zoho_refresh/refresh_token'));

	}

    public function index(){

        if($this->session->userdata('is_logged')){

            $this->template->title = 'Dashboard';

            $token = comprobarToken();

            $company = urlencode($this->session->userdata('company'));
            $name = urlencode($this->session->userdata('name'));

            if(empty($contacts = $this->Contacts_model->all_dataModelContacts($token, $company, $name))){

               $contacts = ''; 
               
            }

            $data = array(
                'contacts' => $contacts
            );
    
            $this->template->content->view('app/contacts', $data);
    
            $this->template->publish();

        }else{

            redirect(base_url('login'), 'refresh'); 

        }

    }

    public function nuevo(){

        if($this->session->userdata('is_logged')){
            
            $this->template->title = 'Agregar Contacto';
            
            $token = comprobarToken();
            $company = urlencode($this->session->userdata('company'));
            $name = urlencode($this->session->userdata('name'));
            
            $accounts = $this->Accounts_model->all_dataModel($token, $company, $name);
            $vendors = $this->Contacts_model->get_allVendors($token);

            $data = array(
                'token' => $token,
                'accounts' => $accounts,
                'vendors' => $vendors
            );

            $this->template->content->view('app/contacts/nuevo', $data);

            $this->template->publish();

        }else{

            redirect(base_url('login'), 'refresh'); 

        }

    }

    public function editar($id){

        if($this->session->userdata('is_logged')){

            $this->template->title = 'Contacts';

            $token = comprobarToken();
            $company = urlencode($this->session->userdata('company'));
            $name = urlencode($this->session->userdata('name'));

            $accounts = $this->Accounts_model->all_dataModel($token, $company, $name);
            $vendors = $this->Contacts_model->get_allVendors($token);

            $contact = $this->Contacts_model->get_contacts($token, $id);

            $data = array(
                'contact' => $contact['data'][0],
                'accounts' => $accounts,
                'vendors' => $vendors
            );
    
            $this->template->content->view('app/contacts/editar', $data);
    
            $this->template->publish();

        }else{

            redirect(base_url('login'), 'refresh'); 

        }

    }

    public function save(){

        $data = array(
            'Owner' => array('id' => 4768126000000300001),
            'Account_Name' => $this->input->post('nombreCuenta'),
            'Email' => $this->input->post('correo'),
            'Empresa_a_la_que_pertenece' => $this->input->post('empresaPertenece'),
            'Phone' => $this->input->post('phone'),
            'Other_Phone' => $this->input->post('other_phone'),
            'Mobile' => $this->input->post('mobile'),
            'Assistant' => $this->input->post('asistente'),
            'Currency' => $this->input->post('moneda'),
            'Lead_Source' => $this->input->post('fuenteLead'),
            'First_Name' => $this->input->post('nombreContacto'),
            'Last_Name' => $this->input->post('apellidoContacto'),
            'Vendor_Name' => $this->input->post('nombreProveedor'),
            'Title' => $this->input->post('titulo'),
            'Department' => $this->input->post('departamento'),
            'Home_Phone' => $this->input->post('home_phone'),
            'Fax' => $this->input->post('fax'),
            'Date_of_Birth' => $this->input->post('date_birth'),
            'Asst_Phone' => $this->input->post('asst_phone'),
            'Skype_ID' => $this->input->post('dkype_id'),
            'Secondary_Email' => $this->input->post('secondary_email'),
            'Twitter' => $this->input->post('twitter'),
            //'Reporting_To' => $this->input->post('reporting_to'),
            'Exchange_Rate' => $this->input->post('exchange_rate'),
            'Contacto_Partner' => $this->session->userdata('id_partner'),
            'Partner' => $this->session->userdata('id_company'),
            'Mailing_Street' => $this->input->post('domicilioCorrespondencia'),
            'Mailing_City' => $this->input->post('ciudadCorrespondencia'),
            'Mailing_State' => $this->input->post('estadoCorrespondencia'),
            'Mailing_Zip' => $this->input->post('codigoCorrespondencia'),
            'Mailing_Country' => $this->input->post('paisCorrespondencia'),
            'Other_Street' => $this->input->post('domicilioOtro'),
            'Other_City' => $this->input->post('ciudadOtro'),
            'Other_State' => $this->input->post('estadoOtro'),
            'Other_Zip' => $this->input->post('codigoOtro'),
            'Other_Country' => $this->input->post('paisOtro'),
            'Description' => $this->input->post('descripcion')
        );

        if($this->input->post('email_opt_out')){

            $data['Email_Opt_Out'] = true;

        }else{

            $data['Email_Opt_Out'] = false;

        }

        $json = '{"data":['.json_encode($data).']}';

        $encode_data = json_encode($json);

        $token = comprobarToken();

        $contact = $this->Contacts_model->insert_contactData($token, json_decode($encode_data))['data'][0];
        
        if($contact['status'] == "success"){ 

            $this->output->set_status_header(200);
                
            echo json_encode(array('estatus' => true, 'mensaje' => 'Se a agregado correctamente.'));

        }else{

            $this->output->set_status_header(401);

            echo json_encode(array('estatus' => false, 'mensaje' => 'Error en el campo: '.$contact['details']['api_name']));

        }

    }

    public function edit(){

        $data = array(
            'Email' => $this->input->post('correo'),
            'Account_Name' => $this->input->post('nombreCuenta'),
            'Empresa_a_la_que_pertenece' => $this->input->post('empresaPertenece'),
            'Phone' => $this->input->post('phone'),
            'Other_Phone' => $this->input->post('other_phone'),
            'Mobile' => $this->input->post('mobile'),
            'Assistant' => $this->input->post('asistente'),
            'Currency' => $this->input->post('moneda'),
            'Lead_Source' => $this->input->post('fuenteLead'),
            'First_Name' => $this->input->post('nombreContacto'),
            'Last_Name' => $this->input->post('apellidoContacto'),
            'Vendor_Name' => $this->input->post('nombreProveedor'),
            'Title' => $this->input->post('titulo'),
            'Department' => $this->input->post('departamento'),
            'Home_Phone' => $this->input->post('home_phone'),
            'Fax' => $this->input->post('fax'),
            'Date_of_Birth' => $this->input->post('date_birth'),
            'Asst_Phone' => $this->input->post('asst_phone'),
            'Skype_ID' => $this->input->post('dkype_id'),
            'Secondary_Email' => $this->input->post('secondary_email'),
            'Twitter' => $this->input->post('twitter'),
            //'Reporting_To' => $this->input->post('reporting_to'),
            //'Exchange_Rate' => $this->input->post('exchange_rate'),
            'Mailing_Street' => $this->input->post('domicilioCorrespondencia'),
            'Mailing_City' => $this->input->post('ciudadCorrespondencia'),
            'Mailing_State' => $this->input->post('estadoCorrespondencia'),
            'Mailing_Zip' => $this->input->post('codigoCorrespondencia'),
            'Mailing_Country' => $this->input->post('paisCorrespondencia'),
            'Other_Street' => $this->input->post('domicilioOtro'),
            'Other_City' => $this->input->post('ciudadOtro'),
            'Other_State' => $this->input->post('estadoOtro'),
            'Other_Zip' => $this->input->post('codigoOtro'),
            'Other_Country' => $this->input->post('paisOtro'),
            'Description' => $this->input->post('descripcion')
        );

        if($this->input->post('email_opt_out')){

            $data['Email_Opt_Out'] = true;

        }else{

            $data['Email_Opt_Out'] = false;

        }

        $json = '{"data":['.json_encode($data).']}';

        $encode_data = json_encode($json);

        $token = comprobarToken();

        $account = $this->Contacts_model->upd_contactData($token, $this->input->post('id'), json_decode($encode_data))['data'][0];

        if($account['status'] == "success"){

            echo json_encode(array('estatus' => true, 'mensaje' => 'Se actualizo correctamente.'));

        }else{

            echo json_encode(array('estatus' => false, 'mensaje' => 'Error en el campo: '.$account['details']['api_name']));

        }


    }

}
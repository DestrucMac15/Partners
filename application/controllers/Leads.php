<?php 

class Leads extends CI_Controller{

    function __construct(){
        
        parent::__construct();

        $this->load->library(array('session'));
        $this->load->model(array('Leads_model','Accounts_model','Contacts_model'));
        $this->load->helper(array('zoho_refresh/refresh_token','users/users'));

    }

    public function index(){

        if($this->session->userdata('is_logged')){

            $token = comprobarToken();
            
            $company = urlencode($this->session->userdata('company'));
            $name = urlencode($this->session->userdata('name'));

            $leads = $this->Leads_model->all_dataModel($token, $company, $name);
            $data = array(
                'leads' => $leads
            );
            
            $this->template->title = 'Dashboard';
            
            $this->template->content->view('app/leads',$data);
    
            $this->template->publish();

        }else{

            redirect(base_url('login'), 'refresh'); 

        }

    }

    public function nuevo(){

        if($this->session->userdata('is_logged')){
            
            $this->template->title = 'Agregar Leads';
            
            $token = comprobarToken();

            $data = array(
                'token' => $token
            );

            $this->template->content->view('app/leads/nuevo', $data);

            $this->template->publish();

        }else{

            redirect(base_url('login'), 'refresh'); 

        }

    }

    public function editar($id){

        if($this->session->userdata('is_logged')){

            $this->template->title = 'Editar Leads';

            $token = comprobarToken();

            $lead = $this->Leads_model->get_lead($token,$id)['data'][0];

            $data = array(
                'lead' => $lead
            );

            $this->template->content->view('app/leads/editar',$data);

            $this->template->publish();

        }else{

            redirect(base_url('login'), 'refresh'); 

        }
        
    }

    public function convertir($id){

        if($this->session->userdata('is_logged')){

            $this->template->title = 'Convertir Leads';

            $token = comprobarToken();

            $lead = $this->Leads_model->get_lead($token,$id)['data'][0];

            $company_name = urlencode($lead['Company']);
            $email = urlencode($lead['Email']);

            /*if(empty($accounts = $this->Accounts_model->get_accountName($token,$company_name)) or empty($accounts = $this->Contacts_model->get_contactEmail($token,$email))){

               $accounts = ''; 
               
            }*/

            if(!empty($accounts = $this->Accounts_model->get_accountName($token,$company_name)) AND !empty($contacts = $this->Contacts_model->get_contactEmail($token,$email))){
                
                $type = "both";

           }elseif(!empty($accounts = $this->Accounts_model->get_accountName($token,$company_name))){

                $type = "company";

           }elseif (!empty($contacts = $this->Contacts_model->get_contactEmail($token,$email))) {

                $type = "email";

           }else{

                $type = "nuevo";
                $contacts = '';
                $accounts = '';

           }

            //var_dump($id);

            $data = array(
                'type' => $type,
                'lead' => $lead,
                'contacts' => $contacts,
                'accounts' => $accounts
            );

            $this->template->content->view('app/leads/convertir',$data);

            $this->template->publish();

        }else{

            redirect(base_url('login'), 'refresh'); 

        }
        
    }

    public function mail($correo){

        $config['protocol']     = 'sendmail';
        $config['smtp_port']    = 587; // Puedes usar 465 para SSL o 587 para TLS
        $config['smtp_crypto']  = 'tls'; // Puedes usar 'ssl' o 'tls'
        $config['mailtype']     = 'html';
        $config['charset']      = 'utf-8';
        $config['newline']      = "\r\n";

        $this->load->library('email');

        $this->email->initialize($config);
        $this->email->from('admin@vocom.com', 'Zoho Partners Vocom');
        $this->email->to($correo);

        $this->email->subject('Creación de Lead');

        $data = array(
            'lead' => 'Marco Ortega'
        );

        $body = $this->load->view('emails/lead',$data,TRUE);

        $this->email->message($body);

        if($this->email->send()){

            echo true;    

        }else{

            echo false;
            //echo $this->email->print_debugger();
        }

    }
    
    public function save(){

        $data = array(
            'Owner' => array('id' => 4768126000000300001),
            'Layout' => array('id' => 4768126000000091055),
            'Nombre_de_partner' => $this->input->post('nombre_partner'),
            'First_Name' => $this->input->post('nombre'),
            'Phone' => $this->input->post('telefono'),
            'Mobile' => $this->input->post('movil'),
            'Designation' => $this->input->post('titulo'),
            'Lead_Source' => $this->input->post('fuente'),
            'Presupuesto' => $this->input->post('presupuesto'),
            'Autoridad' => $this->input->post('autoridad'),
            'Necesidad' => $this->input->post('necesidad'),
            'Tiempo_de_Implementaci_n' => $this->input->post('tiempo'),
            'Siguientes_Pasos' => $this->input->post('pasos'),
            'Industry' => $this->input->post('sector'),
            'Annual_Revenue' => $this->input->post('ingresos'),
            //'tasa' => $this->input->post('tasa'),
            //'tasa' => $this->input->post('marketing'),Boolean
            'Twitter' => $this->input->post('twitter'),
            'Producto' => $this->input->post('producto'),
            'Company' => $this->input->post('empresa'),
            'Last_Name' => $this->input->post('apellidos'),
            'Email' => $this->input->post('correo'),
            'Website' => $this->input->post('website'),
            'Fax' => $this->input->post('fax'),
            'Lead_Status' => $this->input->post('estadoLead'),
            'Partner' => $this->session->userdata('id_company'),
            'Contacto_Partner' => $this->session->userdata('id_partner'),
            'No_of_Employees' => $this->input->post('empleados'),
            'Rating' => $this->input->post('calificacion'),
            'Skype_ID' => $this->input->post('skype'),
            'Secondary_Email' => $this->input->post('correoSecundario'),
            'Currency' => $this->input->post('moneda'),
            'Street' => $this->input->post('calle'),
            'State' => $this->input->post('estado'),
            'Country' => $this->input->post('pais'),
            'City' => $this->input->post('ciudad'),
            'Zip_Code' => $this->input->post('codigoPostal'),
            'Description' => $this->input->post('descripcion')
        );
        
        if($this->input->post('marketing')){

            $data['Email_Opt_Out'] = true;

        }else{

            $data['Email_Opt_Out'] = false;

        }

        $json_insert = '{"data":['.json_encode($data).']}';
        $encode_data = json_encode($json_insert);

        $token = comprobarToken();

        $lead = $this->Leads_model->insert_lead($token, json_decode($encode_data))['data'][0];
        
        if($lead['status'] == "success"){ 

            $this->output->set_status_header(200);
                
            echo json_encode(array('estatus' => true, 'mensaje' => 'Se a agregado correctamente.'));

            /*if($this->mail($this->session->userdata('email'))){
            }else{
                echo json_encode(array('estatus' => true, 'mensaje' => 'Error al enviar correo.'));
            }*/

        }else{

            $this->output->set_status_header(401);

            echo json_encode(array('estatus' => false, 'mensaje' => 'Error en el campo: '.$lead['details']['api_name']));

        }


    }

    public function edit(){

        $data = array(
            //'Nombre_de_partner' => $this->input->post('nombre_partner'),
            'First_Name' => $this->input->post('nombre'),
            'Phone' => $this->input->post('telefono'),
            'Mobile' => $this->input->post('movil'),
            'Designation' => $this->input->post('titulo'),
            'Lead_Source' => $this->input->post('fuente'),
            'Presupuesto' => $this->input->post('presupuesto'),
            'Autoridad' => $this->input->post('autoridad'),
            'Necesidad' => $this->input->post('necesidad'),
            'Tiempo_de_Implementaci_n' => $this->input->post('tiempo'),
            'Siguientes_Pasos' => $this->input->post('pasos'),
            'Industry' => $this->input->post('sector'),
            'Annual_Revenue' => $this->input->post('ingresos'),
            //'tasa' => $this->input->post('tasa'),
            //'tasa' => $this->input->post('marketing'),Boolean
            'Twitter' => $this->input->post('twitter'),
            'Producto' => $this->input->post('producto'),
            'Company' => $this->input->post('empresa'),
            'Last_Name' => $this->input->post('apellidos'),
            'Email' => $this->input->post('correo'),
            'Website' => $this->input->post('website'),
            'Fax' => $this->input->post('fax'),
            'Lead_Status' => $this->input->post('estadoLead'),
            //'Partner' => $this->input->post('partner'),
            //'Contacto_Partner' => $this->input->post('contacto'),
            'No_of_Employees' => $this->input->post('empleados'),
            'Rating' => $this->input->post('calificacion'),
            'Skype_ID' => $this->input->post('skype'),
            'Secondary_Email' => $this->input->post('correoSecundario'),
            'Currency' => $this->input->post('moneda'),
            'Street' => $this->input->post('calle'),
            'State' => $this->input->post('estado'),
            'Country' => $this->input->post('pais'),
            'City' => $this->input->post('ciudad'),
            'Zip_Code' => $this->input->post('codigoPostal'),
            'Description' => $this->input->post('descripcion')
        );

        if($this->input->post('marketing')){

            $data['Email_Opt_Out'] = true;

        }else{

            $data['Email_Opt_Out'] = false;

        }

        $json = '{"data":['.json_encode($data).']}';

        $encode_data = json_encode($json);

        $token = comprobarToken();

        $lead = $this->Leads_model->update_lead($token, json_decode($encode_data), $this->input->post('id'))['data'][0];


        if($lead['status'] == "success"){

            echo json_encode(array('estatus' => true, 'mensaje' => 'Se actualizo correctamente.'));

        }else{

            echo json_encode(array('estatus' => false, 'mensaje' => 'Error en el campo: '.$lead['details']['api_name']));

        }

    }

    public function convert(){

        if(!empty($this->input->post('id_contact')) AND !empty($this->input->post('contactoCrearOportunidad'))){

            $data = array(
                'overwrite' => true,
                'notify_lead_owner' => true,
                'Contacts' => $this->input->post('id_contact'),
                'assign_to' => '4768126000000300001',
                'Deals' => array(
                    'Amount' => intval($this->input->post('importe')),
                    'Tiempo_de_Implementaci_n' => $this->input->post('tiempo'),
                    'Producto' => $this->input->post('producto'),
                    'Presupuesto' => $this->input->post('presupuesto'),
                    'Autoridad' => $this->input->post('autoridad'),
                    'Necesidad' => $this->input->post('necesidad'),
                    'Deal_Name' => $this->input->post('nombreOportunidad'),
                    'Closing_Date' => $this->input->post('fecha'),
                    'Stage' => $this->input->post('fase'),
                    'Description' => $this->input->post('descripcion'),
                    'Currency' => $this->input->post('moneda'),
                    'canal' => 'Standard (Standard)',
                    'Ingeniero_Preventa' => '4768126000000300001',
                    'N_mero_de_Empleados' => $this->input->post('empleados'),
                    'Partner' => $this->session->userdata('id_company'),
                    'Contacto_Partner' => $this->session->userdata('id_partner')
                )
            );

        }else if(!empty($this->input->post('id_account')) AND !empty($this->input->post('cuentaCrearOportunidad'))){

            $data = array(
                'overwrite' => true,
                'notify_lead_owner' => true,
                'Accounts' => $this->input->post('id_account'),
                'assign_to' => '4768126000000300001',
                'Deals' => array(
                    'Amount' => intval($this->input->post('importe')),
                    'Tiempo_de_Implementaci_n' => $this->input->post('tiempo'),
                    'Producto' => $this->input->post('producto'),
                    'Presupuesto' => $this->input->post('presupuesto'),
                    'Autoridad' => $this->input->post('autoridad'),
                    'Necesidad' => $this->input->post('necesidad'),
                    'Deal_Name' => $this->input->post('nombreOportunidad'),
                    'Closing_Date' => $this->input->post('fecha'),
                    'Stage' => $this->input->post('fase'),
                    'Description' => $this->input->post('descripcion'),
                    'Currency' => $this->input->post('moneda'),
                    'canal' => 'Standard (Standard)',
                    'Ingeniero_Preventa' => '4768126000000300001',
                    'N_mero_de_Empleados' => $this->input->post('empleados'),
                    'Partner' => $this->session->userdata('id_company'),
                    'Contacto_Partner' => $this->session->userdata('id_partner')
                )
            );

        }else if(!empty($this->input->post('id_account'))){//Cuando se manda sin datos de deals ***ACCOUNT

            //$token = comprobarToken();
            //$data_accountsGet = $this->Accounts_model->get_potentialAccountById($token,$this->input->post('id_account'))['data'][0];

            $data = array(
                'overwrite' => true,
                'notify_lead_owner' => true,
                'Accounts' => $this->input->post('id_account'),
                'assign_to' => '4768126000000300001'
                //'Deals' => $data_accountsGet['id']
            );

        }else if(!empty($this->input->post('id_contact'))){//Cuando se manda sin datos de deals ***Contacts

            //$token = comprobarToken();
            //$data_contactsGet = $this->Accounts_model->get_potentialContactById($token,$this->input->post('id_contact'))['data'][0];

            $data = array(
                'overwrite' => true,
                'notify_lead_owner' => true,
                'Contacts' => $this->input->post('id_contact'),
                'assign_to' => '4768126000000300001'
                //'Deals' => $data_contactsGet['id']
            );

        }else{

            $data = array(
                'overwrite' => false,
                'notify_lead_owner' => true,
                'assign_to' => '4768126000000300001',
                'Deals' => array(
                    'Amount' => intval($this->input->post('importe')),
                    'Tiempo_de_Implementaci_n' => $this->input->post('tiempo'),
                    'Producto' => $this->input->post('producto'),
                    'Presupuesto' => $this->input->post('presupuesto'),
                    'Autoridad' => $this->input->post('autoridad'),
                    'Necesidad' => $this->input->post('necesidad'),
                    'Deal_Name' => $this->input->post('nombreOportunidad'),
                    'Closing_Date' => $this->input->post('fecha'),
                    'Stage' => $this->input->post('fase'),
                    'Description' => $this->input->post('descripcion'),
                    'Currency' => $this->input->post('moneda'),
                    'canal' => 'Standard (Standard)',
                    'Ingeniero_Preventa' => '4768126000000300001',
                    'N_mero_de_Empleados' => $this->input->post('empleados'),
                    'Partner' => $this->session->userdata('id_company'),
                    'Contacto_Partner' => $this->session->userdata('id_partner')
                )
            );
        }

        if($this->input->post('notificacion')){

            $data['notify_new_entity_owner'] = true;

        }else{

            $data['notify_new_entity_owner'] = false;

        }

        $json = '{"data":['.json_encode($data).']}';

        $encode_data = json_encode($json);

        $token = comprobarToken();

        $lead = "";

        while (empty($lead)) {

            $lead_resut = $this->Leads_model->convert_lead($token, json_decode($encode_data), $this->input->post('id'))['data'][0];

            if(isset($lead_resut)){

                $lead = $lead_resut;

            }

            sleep(3);
        }
        /**UPD Accounts*/
        $data_account = array(

            'Partner' => $this->session->userdata('id_company'),
            'Contacto_Partner' => $this->session->userdata('id_partner')

        );

        $json_account = '{"data":['.json_encode($data_account).']}';
        $encode_dataAcoount = json_encode($json_account);

        $account = $this->Accounts_model->upd_accountData($token,$lead['Accounts'],json_decode($encode_dataAcoount))['data'][0];
        $contact = $this->Contacts_model->upd_contactData($token,$lead['Contacts'],json_decode($encode_dataAcoount))['data'][0];

        if($account['code'] == "SUCCESS"){ 

            echo json_encode(array('estatus' => true, 'mensaje' => 'Se a agregado correctamente.'));

        }else{

            echo json_encode(array('estatus' => false, 'mensaje' => 'Error en el campo: '.$lead['message']));

        }

    }

}
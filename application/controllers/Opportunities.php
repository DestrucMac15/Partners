<?php
class Opportunities extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model(array('Opportunities_model','Accounts_model','Contacts_model'));
        $this->load->helper(array('zoho_refresh/refresh_token','opportunities/opportunities','users/users'));
    }

    public function index(){

        if($this->session->userdata('is_logged')){

            $token = comprobarToken();

            $company = urlencode($this->session->userdata('company')); 
            $name = urlencode($this->session->userdata('name'));

            $opportunities = $this->Opportunities_model->all_dataOpportunitiesModel($token, $company, $name);
            
            $data = array(
                'opportunities' => $opportunities
            );
            
            $this->template->title = 'Dashboard';
            
            $this->template->content->view('app/opportunities',$data);
    
            $this->template->publish();

        }else{

            redirect(base_url('login'), 'refresh'); 

        }

    }

    public function nuevo(){

        if($this->session->userdata('is_logged')){
            
            $this->template->title = 'Agregar Oportunidad';
            
            $token = comprobarToken();

            $company = urlencode($this->session->userdata('company')); 
            $name = urlencode($this->session->userdata('name'));

            $accounts = $this->Accounts_model->all_dataModel($token, $company, $name);
            $contacts = $this->Contacts_model->all_dataModelContacts($token, $company, $name);

            $data = array(
                'token' => $token,
                'accounts' => $accounts,
                'contacts' => $contacts
            );

            $this->template->content->view('app/opportunities/nuevo', $data);

            $this->template->publish();

        }else{

            redirect(base_url('login'), 'refresh'); 

        }

    }

    public function editar($id){

        if($this->session->userdata('is_logged')){

            $this->template->title = 'Editar Oppotunities';

            $token = comprobarToken();

            $company = urlencode($this->session->userdata('company')); 
            $name = urlencode($this->session->userdata('name'));

            $opportunitie = $this->Opportunities_model->get_opportunities($token,$id)['data'][0];
            $accounts = $this->Accounts_model->all_dataModel($token, $company, $name);
            $contacts = $this->Contacts_model->all_dataModelContacts($token, $company, $name);

            $data = array(
                'token' => $token,
                'opportunitie' => $opportunitie,
                'accounts' => $accounts,
                'contacts' => $contacts
            );

            $this->template->content->view('app/opportunities/editar',$data);

            $this->template->publish();

        }else{

            redirect(base_url('login'), 'refresh'); 

        }
        
    }

    public function save(){

        $data = array(
            'Owner' => array('id' => 4768126000000300001),
            'Layout' => array('id' => 4768126000000091055),
            'Deal_Name' => $this->input->post('nombreOportunidad'),
            'Account_Name' => $this->input->post('nombreCuenta'),
            'Ingeniero_Preventa' => $this->input->post('ingeniero'),
            'RFC' => $this->input->post('rfc'),
            'Type' => $this->input->post('tipo'),
            'Next_Step' => $this->input->post('paso'),
            'Lead_Source' => $this->input->post('fuente_lead'),
            'Contact_Name' => $this->input->post('nombreContacto'),
            'Contacto_Partner' => $this->session->userdata('id_partner'),
            'Partner' => $this->session->userdata('id_company'),
            'Tiempo_de_Implementaci_n' => $this->input->post('tiempo'),
            'Autoridad' => $this->input->post('autoridad'),
            'Amount' => $this->input->post('importe'),
            'Closing_Date' => $this->input->post('fechaCierre'),
            'Pipeline' => 'Standard (Standard)',
            'Stage' => $this->input->post('fase'),
            'Probability' => $this->input->post('probabilidad'),
            'Expected_Revenue' => $this->input->post('Ingresos'),
            'Campaign_Source' => $this->input->post('fuente'),
            'tasa' => $this->input->post('tasa'),
            'Producto' => $this->input->post('producto'),
            'Presupuesto' => $this->input->post('presupuesto'),
            'Necesidad' => $this->input->post('necesidad'),
            'N_mero_de_Empleados' => $this->input->post('numEmpleados'),
            'Forecast_Category__s' => $this->input->post('prevision'),
            'Description' => $this->input->post('descripcion')
        );

        $json_insert = '{"data":['.json_encode($data).']}';
        $encode_data = json_encode($json_insert);
        
        $token = comprobarToken();

        $opp = $this->Opportunities_model->insert_opportunities($token, json_decode($encode_data))['data'][0];
        
        if($opp['status'] == "success"){ 

            $this->output->set_status_header(200);
                
            echo json_encode(array('estatus' => true, 'mensaje' => 'Se a agregado correctamente.'));

        }else{

            $this->output->set_status_header(401);

            echo json_encode(array('estatus' => false, 'mensaje' => 'Error en el campo: '.$opp['details']['api_name']));

        }


    }

    public function edit(){

        $data = array(
            'RFC' => $this->input->post('rfc'),
            'Account_Name' => $this->input->post('nombreCuenta'),
            'Contact_Name' => $this->input->post('nombreContacto'),
            'Type' => $this->input->post('tipo'),
            'Next_Step' => $this->input->post('paso'),
            'Lead_Source' => $this->input->post('fuente_lead'),
            'Tiempo_de_Implementaci_n' => $this->input->post('tiempo'),
            'Autoridad' => $this->input->post('autoridad'),
            'Amount' => $this->input->post('importe'),
            'Closing_Date' => $this->input->post('fechaCierre'),
            'Stage' => $this->input->post('fase'),
            'Probability' => $this->input->post('probabilidad'),
            'Expected_Revenue' => $this->input->post('Ingresos'),
            'Campaign_Source' => $this->input->post('fuente'),
            'Producto' => $this->input->post('producto'),
            'Presupuesto' => $this->input->post('presupuesto'),
            'Necesidad' => $this->input->post('necesidad'),
            'N_mero_de_Empleados' => $this->input->post('numEmpleados'),
            'Forecast_Category__s' => $this->input->post('prevision'),
            'Description' => $this->input->post('descripcion')
        ); 

        $json = '{"data":['.json_encode($data).']}';

        $encode_data = json_encode($json);
        $token = comprobarToken();
        
        $Opportunities = $this->Opportunities_model->update_opportunities($token, json_decode($encode_data), $this->input->post('id'))['data'][0];

        if($Opportunities['status'] == "success"){

            echo json_encode(array('estatus' => true, 'mensaje' => 'Se a Actulizo correctamete.'));

        }else{

            echo json_encode(array('estatus' => false, 'mensaje' => 'Error en el campo: '.$Opportunities['details']['api_name']));

        }

    }

}
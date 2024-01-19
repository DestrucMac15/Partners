<?php 

class Accounts extends CI_Controller{

    public function __construct(){

		parent::__construct();

        $this->load->library(array('session'));

        $this->load->model(array('Accounts_model'));

		$this->load->helper(array('zoho_refresh/refresh_token'));

	}

    public function index(){

        if($this->session->userdata('is_logged')){

            $this->template->title = 'Dashboard';

            $token = comprobarToken();

            $company = urlencode($this->session->userdata('company'));
            $name = urlencode($this->session->userdata('name'));

            if(empty($accounts = $this->Accounts_model->all_dataModel($token, $company, $name))){

               $accounts = ''; 
               
            }

            $data = array(
                'accounts' => $accounts
            );
    
            $this->template->content->view('app/accounts', $data);
    
            $this->template->publish();

        }else{

            redirect(base_url('login'), 'refresh'); 

        }

    }

    public function nuevo(){

        if($this->session->userdata('is_logged')){
            
            $this->template->title = 'Agregar Cuenta';
            
            $token = comprobarToken();
            $company = urlencode($this->session->userdata('company'));
            $name = urlencode($this->session->userdata('name'));
            
            $accounts = $this->Accounts_model->all_dataModel($token, $company, $name);

            $data = array(
                'token' => $token,
                'accounts' => $accounts
            );

            $this->template->content->view('app/accounts/nuevo', $data);

            $this->template->publish();

        }else{

            redirect(base_url('login'), 'refresh'); 

        }

    }

    public function editar($id){

        if($this->session->userdata('is_logged')){

            $this->template->title = 'Accounts';

            $token = comprobarToken();
            $company = urlencode($this->session->userdata('company'));
            $name = urlencode($this->session->userdata('name'));

            $account = $this->Accounts_model->get_account($token, $id);
            $accountAll = $this->Accounts_model->all_dataModel($token, $company, $name);

            $data = array(
                'account' => $account['data'][0],
                'accountAll' => $accountAll
            );
    
            $this->template->content->view('app/accounts/editar', $data);
    
            $this->template->publish();

        }else{

            redirect(base_url('login'), 'refresh'); 

        }

    }

    public function save(){

        $data = array(
            'Owner' => array('id' => 4768126000000300001),
            'Account_Name' => $this->input->post('nombreCuenta'),
            'Account_Site' => $this->input->post('sitioCuenta'),
            'Parent_Account' => $this->input->post('cuentaPrincipal'),
            'Account_Type' => $this->input->post('tipoCuenta'),
            'Industry' => $this->input->post('sector'),
            'Annual_Revenue' => $this->input->post('IngresosAnuales'),
            'Currency' => $this->input->post('moneda'),
            'Rating' => $this->input->post('calificacion'),
            'Phone' => $this->input->post('telefono'),
            'Ticker_Symbol' => $this->input->post('simboloValor'),
            'Employees' => $this->input->post('empleados'),
            'Website' => $this->input->post('website'),
            'Account_Number' => $this->input->post('numCuenta'),
            'Ownership' => $this->input->post('propietario'),
            'SIC_Code' => $this->input->post('codigoSic'),
            'tasaCambio' => $this->input->post('tasaCambio'),
            'Billing_Street' => $this->input->post('domicilioFacturacion'),
            'Billing_City' => $this->input->post('ciudadFacturacion'),
            'Billing_State' => $this->input->post('estadoFacturacion'),
            'Billing_Country' => $this->input->post('paisFacturacion'),
            'Billing_Code' => $this->input->post('codigoFacturacion'),
            'Shipping_Street' => $this->input->post('domicilioEnvio'),
            'Shipping_City' => $this->input->post('ciudadEnvio'),
            'Shipping_State' => $this->input->post('estadoEnvio'),
            'Shipping_Country' => $this->input->post('paisEnvio'),
            'Shipping_Code' => $this->input->post('codigoEnvio'),
            'Contacto_Partner' => $this->session->userdata('id_partner'),
            'Partner' => $this->session->userdata('id_company'),
            'Description' => $this->input->post('descripcion')
        );

        $json = '{"data":['.json_encode($data).']}';

        $encode_data = json_encode($json);

        $token = comprobarToken();

        $account = $this->Accounts_model->insert_accountData($token, json_decode($encode_data))['data'][0];

        if($account['status'] == "success"){ 

            $this->output->set_status_header(200);
                
            echo json_encode(array('estatus' => true, 'mensaje' => 'Se a agregado correctamente.'));

        }else{

            $this->output->set_status_header(401);

            echo json_encode(array('estatus' => false, 'mensaje' => 'Error en el campo: '.$account['details']['api_name']));

        }
    }

    public function edit(){

        $data = array(
            //'propietarioCuenta' => $this->input->post('propietarioCuenta'),
            'Account_Name' => $this->input->post('nombreCuenta'),
            'Account_Site' => $this->input->post('sitioCuenta'),
            'Parent_Account' => $this->input->post('cuentaPrincipal'),
            'Account_Type' => $this->input->post('tipoCuenta'),
            'Industry' => $this->input->post('sector'),
            'Annual_Revenue' => $this->input->post('IngresosAnuales'),
            'Currency' => $this->input->post('moneda'),
            'Rating' => $this->input->post('calificacion'),
            'Phone' => $this->input->post('telefono'),
            'Ticker_Symbol' => $this->input->post('simboloValor'),
            'Ownership' => $this->input->post('propietario'),
            'Employees' => $this->input->post('empleados'),
            'SIC_Code' => $this->input->post('codigoSic'),
            'Website' => $this->input->post('website'),
            'Account_Number' => $this->input->post('numCuenta'),
            //'tasaCambio' => $this->input->post('tasaCambio'),
            'Billing_Street' => $this->input->post('domicilioFacturacion'),
            'Billing_City' => $this->input->post('ciudadFacturacion'),
            'Billing_State' => $this->input->post('estadoFacturacion'),
            'Billing_Country' => $this->input->post('paisFacturacion'),
            'Billing_Code' => $this->input->post('codigoFacturacion'),
            'Shipping_Street' => $this->input->post('domicilioEnvio'),
            'Shipping_City' => $this->input->post('ciudadEnvio'),
            'Shipping_State' => $this->input->post('estadoEnvio'),
            'Shipping_Country' => $this->input->post('paisEnvio'),
            'Shipping_Code' => $this->input->post('codigoEnvio'),
            'Description' => $this->input->post('descripcion')
        );
        
        $json = '{"data":['.json_encode($data).']}';

        $encode_data = json_encode($json);
        
        $token = comprobarToken();

        $account = $this->Accounts_model->upd_accountData($token, $this->input->post('id'), json_decode($encode_data))['data'][0];

        if($account['status'] == "success"){

            echo json_encode(array('estatus' => true, 'mensaje' => 'Se actualizo correctamente.'));

        }else{

            echo json_encode(array('estatus' => false, 'mensaje' => 'Error en el campo: '.$account['details']['api_name']));

        }


    }



}
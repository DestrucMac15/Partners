<?php

class Home extends CI_Controller{

    function __construct(){
        
        parent::__construct();

        $this->load->library(array('session'));
        //$this->load->model(array('Leads_model','Accounts_model','Contacts_model'));
        $this->load->helper(array('zoho_refresh/refresh_token','users/users'));

    }

    public function index(){

        if($this->session->userdata('is_logged')){

            $token = comprobarToken();
            
            $company = urlencode($this->session->userdata('company'));
            $name = urlencode($this->session->userdata('name'));

            /*$leads = $this->Leads_model->all_dataModel($token, $company, $name);
            $data = array(
                'leads' => $leads
            );*/
            
            $this->template->title = 'Dashboard';
            
            $this->template->content->view('app/home');
    
            $this->template->publish();

        }else{

            redirect(base_url('login'), 'refresh'); 

        }

    }

}
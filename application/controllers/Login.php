<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){

		parent::__construct();

        $this->load->library(array('form_validation', 'session'));
		$this->load->helper(array('zoho_refresh/refresh_token', 'auth/login_rules'));
		$this->load->model('Partners_model');

	}

	public function index(){

		$this->template->title = 'Login';

        $this->template->set_template('templates/template_login');

		$this->template->content->view('login');

        $this->template->publish();
	}

    public function auth(){

        $this->form_validation->set_error_delimiters('','');

        $rules = getLoginRules();

        $this->form_validation->set_rules($rules); 

        if(!$this->form_validation->run()){
            
            $errors = array(
                'correo' => form_error('correo'),
                'password' => form_error('password')
            );

            $this->output->set_status_header(400);

            echo json_encode($errors);

        }else{

            $correo = $this->input->post('correo');
            $password = $this->input->post('password');

            $hashedPassword = hash('sha512', $password);

            $token = comprobarToken();

            if(empty($res = $this->Partners_model->get_login($token, $correo, $hashedPassword))){

                $this->output->set_status_header(401);
                

                echo json_encode('Correo o contraseña no válida!');

            }else{

                $this->output->set_status_header(200);

                $res = json_decode($res);

                $data = array(
                    'id_owner' => $res->data[0]->Owner->id,
                    'id_partner' => $res->data[0]->id,
                    'email' => $res->data[0]->Email,
                    'name' => $res->data[0]->Name,
                    'company' => $res->data[0]->Empresa_Partner->name,
                    /*'company' => "Dacotek",
                    'name' => "Bruno Reyna",*/
                    'id_company' => $res->data[0]->Empresa_Partner->id,
                    'is_logged' => true
                );
                
                $this->session->set_userdata($data);

                echo json_encode('Correcto, bienvenido!');

            }
            
        }
        
    }

    public function logout(){

        $data = array('id_owner','id_partner','email','name','is_logged');

        $this->session->unset_userdata($data);

        $this->session->sess_destroy();

        redirect(base_url().'login');

    }

    public function reset($email=''){

        $this->template->title = 'Login';

        $this->template->set_template('templates/template_login');

        $data = array(
            'correo' => $email
        );

		$this->template->content->view('reset', $data);

        $this->template->publish();

    }

    public function restoremail($email=''){

        $this->template->title = 'Login';

        $this->template->set_template('templates/template_login');

        $data = array(
            'correo' => $email
        );

        $this->template->content->view('restoremail', $data);

        $this->template->publish();

    }

    public function create_password(){

        $correo    = $this->input->post('correo');
        $password  = $this->input->post('password1');
        $password2 = $this->input->post('password2');

        $token = comprobarToken();

        if($password == $password2){

            if(empty($res = $this->Partners_model->get_email($token, $correo)['data'][0])){

                $this->output->set_status_header(402);
                echo json_encode('No se encontro un correo valido!');

            }else{

                $this->output->set_status_header(200);

                $hashedPassword = hash('sha512', $password);

                $data = $this->Partners_model->upd_password($token,$res['id'],$hashedPassword)['data'][0];
                //echo $data['code'];
                //$this->session->set_userdata($data);

                if($data['code'] == "SUCCESS"){

                    $this->output->set_status_header(200);

                    echo json_encode('Correcto, Se cambio la contraseña!');

                }else{

                    $this->output->set_status_header(402);
                    echo json_encode('Error, No se puede actualizar!');

                }
                

            }

        }else{

            $this->output->set_status_header(402);

            echo json_encode('Error, Las contraseñas no son iguales');

        }
    }

    public function mail(){

        $token = comprobarToken();
        $correo = $this->input->post('correo');

        if(empty($data_email = $this->Partners_model->get_email($token, $correo))){

            $this->output->set_status_header(402);
            echo json_encode(array('estatus' => false, 'mensaje' => 'No esta registrado'));

        }else{

            $this->output->set_status_header(200);
            echo json_encode(array('estatus' => true, 'mensaje' => 'Correcto'));
            
            $data = $this->Partners_model->upd_password($token,$data_email['data'][0]['id'],'reset')['data'][0];

        }

    }

}

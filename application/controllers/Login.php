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

            $token = comprobarToken();

            if(empty($res = $this->Partners_model->get_login($token, $correo, $password))){

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

        $correo = $this->input->post('correo');
        $password = $this->input->post('password1');
        $password2 = $this->input->post('password2');

        $token = comprobarToken();

        if($password == $password2){

            if(empty($res = $this->Partners_model->get_email($token, $correo)['data'][0])){

                $this->output->set_status_header(402);
                echo json_encode('No se encontro un correo valido!');

            }else{

                $this->output->set_status_header(200);

                $data = $this->Partners_model->upd_password($token,$res['id'],$password)['data'][0];
                echo $data['code'];
                //$this->session->set_userdata($data);

                if($data['code'] == "SUCCESS"){

                    $this->output->set_status_header(200);

                    echo json_encode('Correcto, bienvenido!');

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

        $correo = $this->input->post('correo');

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
            'lead' => urlencode($correo)
        );

        $body = $this->load->view('emails/restorePassword',$data,TRUE);

        $this->email->message($body);

        if($this->email->send()){

            echo true;
            //echo "Se envio correctamente";

        }else{

            echo false;
            //echo $this->email->print_debugger();

        }

    }

}

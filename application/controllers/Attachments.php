<?php
class Attachments extends CI_Controller{

    function __construct(){
        parent::__construct();
        $this->load->library(array('session'));
        $this->load->model(array('Attachments_model'));
        $this->load->helper(array('zoho_refresh/refresh_token'));
    }

    public function index(){

        if($this->session->userdata('is_logged')){

            $token = comprobarToken();

            $attachments = $this->Attachments_model->get_attachmentsAll($token,$_GET['opp']);
            
            $data = array(
                'attachments' => $attachments
            );
            
            $this->template->title = 'Dashboard';
            
            $this->template->content->view('app/attachments',$data);
    
            $this->template->publish();

        }else{

            redirect(base_url('login'), 'refresh'); 

        }

    }

    public function downloadAttachment($id_potentials,$id_attachments){

        $token = comprobarToken();

        $attachment = $this->Attachments_model->get_attachmentsPDF($token,$id_potentials,$id_attachments);

        $bin = base64_encode($attachment);

        echo "<iframe src='data:application/pdf;base64,$bin' width=100% height=100%></iframe>";

    }

    public function upload(){

        if($_FILES['archivo']['type'] == 'application/pdf'){

            $id = $this->input->post('id');

            $token = comprobarToken();
            
            $upload = $this->Attachments_model->post_documentFile($token, $id, $_FILES['archivo'])['data'][0];

            if($upload['status'] === 'success'){

                echo json_encode(array('estatus' => true, 'mensaje' => 'Se a subio correctamente.'));

            }else{

                echo json_encode(array('estatus' => false, 'mensaje' => 'Error en el campo: '.$upload['message']));
                
            }

        }
    }

}
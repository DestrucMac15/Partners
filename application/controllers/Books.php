<?php 

$_SESSION['book'] = array();

class Books extends CI_Controller{

    public function __construct(){

		parent::__construct();

        $this->load->library(array('session'));

        $this->load->model(array('Books_model','Opportunities_model','Accounts_model'));

		$this->load->helper(array('zoho_refresh/refresh_token','budgets/budgets'));

	}

    public function nuevo($id){

        if($this->session->userdata('is_logged')){

            $this->template->title = 'Books';

            $token = comprobarToken();

            $opportunitie = $this->Opportunities_model->get_opportunities($token,$id)['data'][0];
            $account = $this->Accounts_model->get_account($token,$opportunitie['Account_Name']['id'])['data'][0];
            
            $data = array(
                'opportunitie' => $opportunitie,
                'account' => $account
            );
    
            $this->template->content->view('app/books/nuevo', $data);
    
            $this->template->publish();

        }else{

            redirect(base_url('login'), 'refresh'); 

        }

    }
    

    public function getBook(){

        if(!isset($_SESSION['book'])){

            
            $token = comprobarToken();
            //$tarifas = $this->Books_model->get_allTaxes($token)['taxes'];
            
            $_SESSION['book'] = array(
                'articulos' => array(),
                'tabulador' => array(
                    'subtotal' => 0,
                    'envio' => 0,
                    'impuesto' => 0,
                    'total' => 0
                ),
                //'tarifas' => $tarifas
            );
            
        }
        
        echo json_encode($_SESSION['book']);

    }

    public function addItem(){

        $id = $this->input->post('item');

        $token = comprobarToken();

        $item = $this->Books_model->get_itemId($token,$id);

        $indice = count($_SESSION['book']['articulos']);

        if($indice > 1){

            $indice --;

            $item['item']['quantity'] = 1;
            $item['item']['item_total'] = $item['item']['rate'];

            
            $_SESSION['book']['articulos'][$indice]['items'][] = $item['item'];
            
        }else{
            
            $item['item']['quantity'] = 1;
            $item['item']['item_total'] = $item['item']['rate'];
            
            $_SESSION['book']['articulos'][0]['header'] = 'Nueva Cabecera';

            $_SESSION['book']['articulos'][0]['items'][] = $item['item'];

        }

        $this->createTabulador();

        echo json_encode($_SESSION['book']);

    }

    public function addHeader(){

        $indice = count($_SESSION['book']['articulos']);

        $_SESSION['book']['articulos'][$indice]['header'] = 'Nueva Cabecera';

        echo json_encode($_SESSION['book']);

    }

    public function editHeader(){

        $cabecera = $this->input->post('cabecera');
        $valor = $this->input->post('valor');

        $_SESSION['book']['articulos'][$cabecera]['header'] = $valor;

        echo json_encode($_SESSION['book']);

    }

    public function deleteHeader(){

        $cabecera = $this->input->post('cabecera');

        unset($_SESSION['book']['articulos'][$cabecera]);

        $this->createTabulador();

        echo json_encode($_SESSION['book']);

    }

    public function createTabulador(){

        $subtotal = 0;

        foreach($_SESSION['book']['articulos'] as $articulo){

                foreach($articulo['items'] as $item){

                    $subtotal += $item['item_total'];

                }

        }

        $_SESSION['book']['tabulador']['subtotal'] = $subtotal;

        $total = $subtotal + $_SESSION['book']['tabulador']['envio'] + $_SESSION['book']['tabulador']['impuesto'];

        $_SESSION['book']['tabulador']['total'] = $total; 

    }

    public function deleteItem(){

        $cabecera = $this->input->post('cabecera');
        $item = $this->input->post('item');

        unset($_SESSION['book']['articulos'][$cabecera]['items'][$item]);

        $this->createTabulador();

        echo json_encode($_SESSION['book']);

    }

    public function addDiscount(){

        $descuento = $this->input->post('descuento');
        $item = $this->input->post('item');
        $TipoDescuento = $this->input->post('TipoDescuento');
        $cabecera = $this->input->post('cabecera');

        if($TipoDescuento == '%'){

            $subtotal = $_SESSION['book']['articulos'][$cabecera]['items'][$item]['rate'] * $_SESSION['book']['articulos'][$cabecera]['items'][$item]['quantity'];

            $total = $subtotal - (($descuento / 100) * $subtotal);

            $_SESSION['book']['articulos'][$cabecera]['items'][$item]['discount_amount'] = $descuento / 100;

            $_SESSION['book']['articulos'][$cabecera]['items'][$item]['discount'] = strval($descuento / 100).'%';

        }
        if($TipoDescuento == 'MXN'){

            $subtotal = $_SESSION['book']['articulos'][$cabecera]['items'][$item]['rate'] * $_SESSION['book']['articulos'][$cabecera]['items'][$item]['quantity'];

            $total = $subtotal - $descuento;

            $_SESSION['book']['articulos'][$cabecera]['items'][$item]['discount'] = $descuento;

            $_SESSION['book']['articulos'][$cabecera]['items'][$item]['discount_amount'] = $descuento;

        }

        $_SESSION['book']['articulos'][$cabecera]['items'][$item]['item_total'] = $total;

        $this->createTabulador();

        echo json_encode($_SESSION['book']);

    }

    public function editQuantity(){

        $cantidad = $this->input->post('cantidad');
        $item = $this->input->post('item');
        $rate = $this->input->post('rate');
        $cabecera = $this->input->post('cabecera');

        $item_total = $cantidad * $rate;

        if(isset($_SESSION['book']['articulos'][$cabecera]['items'][$item]['discount'])){

            if(str_contains($_SESSION['book']['articulos'][$cabecera]['items'][$item]['discount'],'%')){

                $item_total *= $_SESSION['book']['articulos'][$cabecera]['items'][$item]['discount_amount'];

            }else{

                $item_total -= $_SESSION['book']['articulos'][$cabecera]['items'][$item]['discount_amount'];

            }

        }

        $_SESSION['book']['articulos'][$cabecera]['items'][$item]['quantity'] = $cantidad;
        $_SESSION['book']['articulos'][$cabecera]['items'][$item]['item_total'] = $item_total;


        $this->createTabulador();

        echo json_encode($_SESSION['book']);


    }

    public function save(){
        $_SESSION['book'];
    }



}
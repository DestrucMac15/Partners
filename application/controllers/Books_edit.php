<?php 

$_SESSION['book'] = array();

class Books_edit extends CI_Controller{

    public function __construct(){

		parent::__construct();

        $this->load->library(array('session'));

        $this->load->model(array('Books_model','Opportunities_model','Accounts_model','Contacts_model'));

		$this->load->helper(array('zoho_refresh/refresh_token','budgets/budgets'));

	}

    public function index(){

        if($this->session->userdata('is_logged')){

            $this->template->title = 'Books';

            $token = comprobarToken();

            $books = $this->Books_model->get_listEstimates($token, $_GET['opp']);
            
            $data = array(
                'books' => $books
            );
    
            $this->template->content->view('app/books', $data);
    
            $this->template->publish();

        }else{

            redirect(base_url('login'), 'refresh'); 

        }

    }

    public function editar($id){

        $this->session->unset_userdata('book');

        if($this->session->userdata('is_logged')){

            $this->template->title = 'Editar Estimates';

            $token = comprobarToken();

            $estimate = $this->Books_model->get_estimateByID($token, $id)['estimate'];

            $data = array(
                'estimate' => $estimate,
                'id_opp'   => $estimate['zcrm_potential_id'],
                'id_estimate' => $estimate['estimate_id']
            );

            $this->template->content->view('app/books/editar',$data);

            $this->template->publish();

        }else{
            redirect(base_url('login'), 'refresh');
        }
    }

    public function downloadBook($id){

        $token = comprobarToken();

        $book = $this->Books_model->get_pdfEstimate($token, $id);

        $bin = base64_encode($book);

        echo "<iframe src='data:application/pdf;base64,$bin' width=100% height=100%></iframe>";

    }
    
    public function getBook(){

        if(!isset($_SESSION['book'])){

            
            $token = comprobarToken();
            
            $_SESSION['book'] = array(
                'articulos' => array(),
                'tabulador' => array(
                    'subtotal' => 0,
                    'envio' => 0,
                    'nombre_impuesto' => 'Ajuste',
                    'impuesto' => 0,
                    'total' => 0
                )
            );
            
        }
        
        echo json_encode($_SESSION['book']);

    }

    public function getBookEdit(){

        if(!isset($_SESSION['book'])){

            $token  = comprobarToken();
            $estimate_id = $this->input->post('opp');
            $estimate = $this->Books_model->get_estimateByID($token,$estimate_id)['estimate'];   
            
            $_SESSION['book'] = array(
                'articulos' => array(),
                'tabulador' => array(
                    'subtotal' => $estimate['sub_total'],
                    'envio'    => $estimate['shipping_charge'],
                    'nombre_impuesto' => $estimate['adjustment_description'],
                    'impuesto'        => $estimate['adjustment'],
                    'total'           => $estimate['total']
                )
            );
            
            foreach($estimate['line_items'] as $key => $item){
             
                if($key == 0){

                    $this->viewHeader($item['header_name'],$item['header_id']);

                }

                if($this->searchHeader($item['header_id'])){

                    $this->editItem($item);

                }else{

                    $this->viewHeader($item['header_name'],$item['header_id']);
                    $this->editItem($item);

                }

            }
            
        }
        
        echo json_encode($_SESSION['book']);

    }

    public function searchHeader($header_id){

        foreach($_SESSION['book']['articulos'] as $data){
            if($data['id'] == $header_id){
                return true;
            }
        }
        return false;

    }

    public function editItem($data){

        $token = comprobarToken();
        
        $item = $this->Books_model->get_itemId($token,$data['item_id']);

        $indice = count($_SESSION['book']['articulos']);

        if($indice > 1){

            $indice --;

            $item['item']['line_item_id'] = $data['line_item_id'];
            $item['item']['item_order']   = $data['item_order'];
            $item['item']['quantity']     = $data['quantity'];
            $item['item']['discount_amount']  = str_replace("%", "", strval($data['discount']));
            $item['item']['discount']   = strval($data['discount']);
            /** CALCULO */

            if(str_contains($item['item']['discount'],'%')){
                $sub_discount = ($data['rate'] * $item['item']['quantity']) * ($item['item']['discount_amount']/100);
            }else{
                $sub_discount = $item['item']['discount_amount'];
            }
            
            $total_discount = ($item['item']['rate'] * $item['item']['quantity']) - $sub_discount;

            $sub_impuesto = $total_discount * ($data['tax_percentage']/100);
            $total_impuesto = $total_discount + $sub_impuesto;

            $item['item']['impuesto']   = $sub_impuesto;
            $item['item']['item_total'] = $total_impuesto;

            $_SESSION['book']['articulos'][$indice]['items'][] = $item['item'];
            
        }else{

            $item['item']['line_item_id'] = $data['line_item_id'];
            $item['item']['item_order']   = $data['item_order'];
            $item['item']['quantity']     = $data['quantity'];
            $item['item']['discount_amount']  = str_replace("%", "", strval($data['discount']));
            $item['item']['discount']   = strval($data['discount']);
            /** CALCULO */

            if(str_contains($item['item']['discount'],'%')){
                $sub_discount = ($data['rate'] * $item['item']['quantity']) * ($item['item']['discount_amount']/100);
            }else{
                $sub_discount = $item['item']['discount_amount'];
            }

            
            $total_discount = ($item['item']['rate'] * $item['item']['quantity']) - $sub_discount;

            $sub_impuesto = $total_discount * ($data['tax_percentage']/100);
            $total_impuesto = $total_discount + $sub_impuesto;

            $item['item']['impuesto']   = $sub_impuesto;
            $item['item']['item_total'] = $total_impuesto;
            
            $_SESSION['book']['articulos'][0]['items'][] = $item['item'];

        }

        $this->createTabulador();

    }

    public function addItem(){

        $id = $this->input->post('item');

        $token = comprobarToken();

        $item = $this->Books_model->get_itemId($token,$id);

        $indice = count($_SESSION['book']['articulos']);

        if($indice > 1){

            $indice --;

            $item['item']['quantity'] = 1;

            $item['item']['impuesto'] = $item['item']['rate'] * ($item['item']['tax_percentage']/100);
            $item['item']['item_total'] = ($item['item']['rate'] * $item['item']['quantity']) + $item['item']['impuesto'];

            $_SESSION['book']['articulos'][$indice]['items'][] = $item['item'];
            
        }else{

            $item['item']['quantity'] = 1;

            $item['item']['impuesto'] = $item['item']['rate'] * ($item['item']['tax_percentage']/100);
            $item['item']['item_total'] = ($item['item']['rate'] * $item['item']['quantity']) + $item['item']['impuesto'];
            
            //$_SESSION['book']['articulos'][0]['header'] = 'Nueva Cabecera';

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

    public function viewHeader($nombre,$id){

        $indice = count($_SESSION['book']['articulos']);

        $_SESSION['book']['articulos'][$indice]['header'] = $nombre;
        $_SESSION['book']['articulos'][$indice]['id'] = $id;

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

        $_SESSION['book']['articulos'] = array_values($_SESSION['book']['articulos']);

        $this->createTabulador();

        echo json_encode($_SESSION['book']);

    }

    public function createTabulador(){

        $subtotal = 0;

        foreach($_SESSION['book']['articulos'] as $articulo){

                foreach($articulo['items'] as $item){

                    $subtotal += $item['item_total'];
                    //$subtotal = $subtotal + $item['item_total'] + $item['impuesto'];

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

            $imp =  $total * ($_SESSION['book']['articulos'][$cabecera]['items'][$item]['tax_percentage']/100);

            $total = $total + $imp;

            $_SESSION['book']['articulos'][$cabecera]['items'][$item]['discount_amount'] = $descuento;

            $_SESSION['book']['articulos'][$cabecera]['items'][$item]['discount'] = strval($descuento).'%';

        }
        if($TipoDescuento == 'MXN'){

            $subtotal = $_SESSION['book']['articulos'][$cabecera]['items'][$item]['rate'] * $_SESSION['book']['articulos'][$cabecera]['items'][$item]['quantity'];

            $total = $subtotal - $descuento;

            $imp =  $total * ($_SESSION['book']['articulos'][$cabecera]['items'][$item]['tax_percentage']/100);

            $total = $total + $imp;

            $_SESSION['book']['articulos'][$cabecera]['items'][$item]['discount'] = $descuento;
            
            $_SESSION['book']['articulos'][$cabecera]['items'][$item]['discount_amount'] = $descuento;

        }

        $_SESSION['book']['articulos'][$cabecera]['items'][$item]['item_total'] = $total;
        $_SESSION['book']['articulos'][$cabecera]['items'][$item]['impuesto'] = $imp;

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

                //$item_total *= $_SESSION['book']['articulos'][$cabecera]['items'][$item]['discount_amount'];
                $descuento = $item_total * ($_SESSION['book']['articulos'][$cabecera]['items'][$item]['discount_amount']/100);

                $item_total = $item_total - $descuento;

                //echo $descuento;

            }else{

                $item_total -= $_SESSION['book']['articulos'][$cabecera]['items'][$item]['discount_amount'];

            }

            $imp =  $item_total * ($_SESSION['book']['articulos'][$cabecera]['items'][$item]['tax_percentage']/100);
            $item_total = $item_total + $imp;

        }

        $_SESSION['book']['articulos'][$cabecera]['items'][$item]['quantity'] = $cantidad;
        $_SESSION['book']['articulos'][$cabecera]['items'][$item]['item_total'] = $item_total;
        $_SESSION['book']['articulos'][$cabecera]['items'][$item]['impuesto'] = $imp;

        $this->createTabulador();

        echo json_encode($_SESSION['book']);

    }

    public function editShipment(){

        $_SESSION['book']['tabulador']['envio'] = floatval($this->input->post('shipment'));

        $this->createTabulador();

        echo json_encode($_SESSION['book']);

    }

    public function editNameTax(){

        $_SESSION['book']['tabulador']['nombre_impuesto'] = $this->input->post('nameTax');

        $this->createTabulador();

        echo json_encode($_SESSION['book']);

    }

    public function editTax(){

        $_SESSION['book']['tabulador']['impuesto'] = floatval($this->input->post('tax'));

        $this->createTabulador();

        echo json_encode($_SESSION['book']);

    }

    public function edit(){

        $dataSessions = $_SESSION['book'];
        $token = comprobarToken();

        $tabulador = $_SESSION['book']['tabulador'];
        $tabulador['subtotal'];

        $envio           = $tabulador['envio'];
        $nombre_impuesto = $tabulador['nombre_impuesto'];
        $impuesto        = $tabulador['impuesto'];

        $articulosB = array();
        $order = 0;

        foreach($dataSessions['articulos'] as $cabecera){

            if(isset($cabecera['id'])){

                $header = $cabecera['header'];
                $header_id = $cabecera['id'];

            }else{

                $header = $cabecera['header'];
                
            }
            // Accede a los valores dentro de "items" en cada artículo
            foreach($cabecera['items'] as $item){

                if(isset($item['line_item_id'])){
                    
                    $articulosB[] = array(
                        'header_id'  => $header_id,
                        'header_name'  => $header,
                        'item_id' => $item['item_id'],
                        'line_item_id' => $item['line_item_id'],//*
                        'item_order'   => $item['item_order'],
                        'name'    => $item['name'],
                        'sku'     => $item['sku'],
                        'unit'    => $item['unit'],
                        'description' => $item['description'],
                        'quantity' => $item['quantity'],
                        'bcy_rate' => $item['rate'],
                        'rate' => $item['rate'],
                        'tax_name'    => $item['tax_name'],
                        'tax_percentage'    => $item['tax_percentage'],
                        'tax_type'          => $item['tax_type'],
                        'purchase_tax_id'   => $item['purchase_tax_id'],
                        'purchase_tax_name' => $item['purchase_tax_name'],
                        'discount'        => isset($item['discount']) ? $item['discount'] : '',//Descuento aplicado a la factura. Puede ser en % o en cantidad
                        'discount_amount' => isset($item['discount_amount']) ? $item['discount_amount'] : '',
                        'is_default_tax_applied'  => $item['is_default_tax_applied'],
                        'purchase_tax_percentage' => $item['purchase_tax_percentage'],
                        'purchase_tax_type'       => $item['purchase_tax_type'],
                        //'associated_template_id'  => $item['associated_template_id']
                        'item_total'              => $item['item_total']
                    );
                }else{

                    $articulosB[] = array(
                        'header_id'  => $header_id,
                        'header_name'  => $header,
                        'item_id' => $item['item_id'],
                        'name'    => $item['name'],
                        'sku'     => $item['sku'],
                        'unit'    => $item['unit'],
                        'description' => $item['description'],
                        'quantity' => $item['quantity'],
                        'bcy_rate' => $item['rate'],
                        'rate' => $item['rate'],
                        'tax_name'    => $item['tax_name'],
                        'tax_percentage'    => $item['tax_percentage'],
                        'tax_type'          => $item['tax_type'],
                        'purchase_tax_id'   => $item['purchase_tax_id'],
                        'purchase_tax_name' => $item['purchase_tax_name'],
                        'discount'        => isset($item['discount']) ? $item['discount'] : '',//Descuento aplicado a la factura. Puede ser en % o en cantidad
                        'discount_amount' => isset($item['discount_amount']) ? $item['discount_amount'] : '',
                        'is_default_tax_applied'  => $item['is_default_tax_applied'],
                        'purchase_tax_percentage' => $item['purchase_tax_percentage'],
                        'purchase_tax_type'       => $item['purchase_tax_type'],
                        //'associated_template_id'  => $item['associated_template_id']
                        'item_total'              => $item['item_total']
                    );

                }

                $item_id = $item['item_id'];
                $tax_id  = $item['tax_id'];
                $name    = $item['name'];
                $rate    = $item['rate'];
                $unit    = $item['unit'];
                $cf_nombresat = $item['custom_field_hash']['cf_nombresat'];
                $quantity     = $item['quantity'];
                $order++;

            }
              
        }

        $custom_fields = array(
            'api_name' => 'cf_descripci_n_del_proyecto',
            'value'    => $this->input->post('descripcionProyecto')
        );

        $data_save = array(
            'contact_persons' => $this->input->post('emailContactoPerson'),
            'reference_number'  => $this->input->post('numeroReferencia'),//Estimaciones de búsqueda por número de referencia
            'date'          => $this->input->post('fechaPresupuesto'),
            'expiry_date'   => $this->input->post('fechaVencimiento'), //FECHA DE EXPIRACION DE LA COTIZACION
            //'salesperson_name' => 'Nacir Coronado',//Nombre del vendedor PREGUNTA A QUE NOMBRE TIENE QUE ESTAR ???
            'custom_fields'   => array($custom_fields),//Campos personalizados para un presupuesto
            'line_items'      => $articulosB,// ARRAY DE LOS PRODUCTOS
            'subject_content' => $this->input->post('asunto'),
            'notes' => $this->input->post('notasCliente'),//Las notas agregadas a continuación expresando gratitud o por transmitir alguna información
            'terms' => $this->input->post('terminosCondiciones'),
            'adjustment'             => $impuesto,
            'adjustment_description' => $nombre_impuesto,
            //'item_id' => $item_id,
            //'name'    => $name,//El nombre del elemento de línea
            'description' => $cf_nombresat,
            'rate' => $rate,
            'unit' => $unit,
            'shipping_charge' => $envio,
            //'quantity' => $quantity,//La cantidad de línea de pedido
        );
        //echo json_encode($data_save);
        //die();

        $editBook = $this->Books_model->upd_estimates($token,json_encode($data_save),$this->input->post('estimate'));
       
        if($editBook['code'] == 0){

            echo json_encode(array('estatus' => true, 'mensaje' => 'Se actualizo correctamente.'));

        }else{

            echo json_encode(array('estatus' => true, 'mensaje' => $editBook['message']));

        }

    }

    public function sendMailContacts(){

        //var_dump($this->input->post());
        $this->edit();
        $token = comprobarToken();

        $estimate_id = $this->input->post('estimate');
        $correos = $this->input->post('correos');
        
        $enviar_correo = $this->Books_model->sendMail($token,$estimate_id,$correos);

        /*if($enviar_correo['code'] == 0){

            echo json_encode(array('estatusEmail' => true, 'mensaje' => 'Se actualizo correctamente y envio la cotización.'));

        }else{

            echo json_encode(array('estatusEmail' => true, 'mensaje' => $enviar_correo['message']));

        }*/

    }

}
<?php 

$_SESSION['book'] = array();

class Books extends CI_Controller{

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

    public function nuevo($id){

        if($this->session->userdata('is_logged')){

            $this->template->title = 'Crear Books';

            $token = comprobarToken();

            $opportunitie = $this->Opportunities_model->get_opportunities($token,$id)['data'][0];
            $account = $this->Accounts_model->get_account($token,$opportunitie['Account_Name']['id'])['data'][0];
            $contact = $this->Contacts_model->get_contacts($token, $opportunitie['Contact_Name']['id'])['data'][0];
            $book    = $this->Books_model->get_contactsBy($token,$contact['Account_Name']['id']);
            $contactPersons = $this->Books_model->get_contactsPersonsAll($token,$book['contacts'][0]['contact_id']);

            $data = array(
                'opportunitie' => $opportunitie,
                'account' => $account,
                'contact' => $contact,
                'id' => $id,
                'zcrm_account_id' => $book['contacts'][0]['contact_id'],
                'customer_id' => $account['id'],
                'contactPersons' => $contactPersons
            );
    
            $this->template->content->view('app/books/nuevo', $data);
    
            $this->template->publish();

        }else{

            redirect(base_url('login'), 'refresh'); 

        }

    }

    public function editar($id){

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

                    $this->addHeader($item['header_name'],$item['header_id']);

                }

                if($this->searchHeader($item['header_id'])){

                    $this->editItem($item);

                }else{

                    $this->addHeader($item['header_name'],$item['header_id']);
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

            $item['item']['quantity'] = $data['quantity'];
            $item['item']['descuento'] = $data['quantity'];
            $item['item']['impuesto'] = $item['item']['rate'] * ($item['item']['tax_percentage']/100);
            $item['item']['item_total'] = $item['item']['rate'] + $item['item']['impuesto'];

            $_SESSION['book']['articulos'][$indice]['items'][] = $item['item'];
            
        }else{

            $item['item']['quantity'] = $data['quantity'];

            $item['item']['impuesto'] = $item['item']['rate'] * ($item['item']['tax_percentage']/100);
            $item['item']['item_total'] = $item['item']['rate'] + $item['item']['impuesto'];
            
            $_SESSION['book']['articulos'][0]['items'][] = $item['item'];

        }

        $this->createTabulador();

    }

    public function addItem($id=''){

        if(empty($id)){
            $id = $this->input->post('item');
        }

        $token = comprobarToken();

        $item = $this->Books_model->get_itemId($token,$id);

        $indice = count($_SESSION['book']['articulos']);

        if($indice > 1){

            $indice --;

            $item['item']['quantity'] = 1;
            $item['item']['impuesto'] = $item['item']['rate'] * ($item['item']['tax_percentage']/100);
            $item['item']['item_total'] = $item['item']['rate'] + $item['item']['impuesto'];

            $_SESSION['book']['articulos'][$indice]['items'][] = $item['item'];
            
        }else{

            $item['item']['quantity'] = 1;

            $item['item']['impuesto'] = $item['item']['rate'] * ($item['item']['tax_percentage']/100);
            $item['item']['item_total'] = $item['item']['rate'] + $item['item']['impuesto'];
            
            //$_SESSION['book']['articulos'][0]['header'] = 'Nueva Cabecera';

            $_SESSION['book']['articulos'][0]['items'][] = $item['item'];

        }

        $this->createTabulador();

        //echo json_encode($_SESSION['book']);

    }

    public function addHeader($nombre,$id){

        $indice = count($_SESSION['book']['articulos']);

        $_SESSION['book']['articulos'][$indice]['header'] = $nombre;
        $_SESSION['book']['articulos'][$indice]['id'] = $id;

        //echo json_encode($_SESSION['book']);

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

    public function save(){
        
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

            $header = $cabecera['header'];
            // Accede a los valores dentro de "items" en cada artículo
            foreach($cabecera['items'] as $item){
                $articulosB[] = array(
                    'header_name'  => $header,
                    'item_id' => $item['item_id'],
                    'name'    => $item['name'],
                    'sku'     => $item['sku'],
                    'unit'    => $item['unit'],
                    'description' => $item['description'],
                    //'tax_id'      => $item['tax_id'],// REVISAR EL ERROR
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
                    'associated_template_id'  => $item['associated_template_id']
                );

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
            'zcrm_potential_id' => $this->input->post('oportunidad'),// ID DE LA OPORTUNIDAD
            'customer_id' => $this->input->post('customer_id'),// ID DE CUENTA 
            'currency_id' => '2511149000000072080',//ID DE MONEDA
            //'contact_persons' => array(),//SE ENVIA A UNA PERSONA O PERSONAS DE CONTACTO PARA EL ENVIO DE LA ESTIMACION.
            'template_id'       => '2511149000000017003',//ID DE LA PLANTILLA PDF ASOCIADA AL PRESUPUESTO.
            //'estimate_number'   => $this->input->post('numeroPresupuesto'),//Buscar estimaciones por número estimado
            'reference_number'  => $this->input->post('numeroReferencia'),//Estimaciones de búsqueda por número de referencia
            'date'          => $this->input->post('fechaPresupuesto'),
            'expiry_date'   => $this->input->post('fechaVencimiento'), //FECHA DE EXPIRACION DE LA COTIZACION
            'exchange_rate' => 1.00,//Tipo de cambio de la moneda.
            'is_discount_before_tax' => true,//Se utiliza para especificar cómo debe aplicarse el descuento. Ya sea antes o después del cálculo del impuesto.
            'discount_type'          => 'item_level',//Cómo se especifica el descuento. Los valores permitidos son entity_level o item_level.
            //'custom_body' => $custom_body,//
            //'custom_subject' => $custom_subject,
            //'salesperson_id'   => '2511149000000149005',
            'salesperson_name' => 'Nacir Coronado',//Nombre del vendedor PREGUNTA A QUE NOMBRE TIENE QUE ESTAR ???
            'custom_fields' => array($custom_fields),//Campos personalizados para un presupuesto
            'line_items'      => $articulosB,// ARRAY DE LOS PRODUCTOS
            'subject_content' => $this->input->post('asunto'),
            'notes' => $this->input->post('notasCliente'),//Las notas agregadas a continuación expresando gratitud o por transmitir alguna información
            'terms' => $this->input->post('terminosCondiciones'),
            'adjustment'             => $impuesto,
            'adjustment_description' => $nombre_impuesto,
            //'tax_id'  => $tax_id,
            'item_id' => $item_id,
            'name'    => $name,//El nombre del elemento de línea
            'description' => $cf_nombresat,
            'rate' => $rate,
            'unit' => $unit,
            'shipping_charge' => $envio,
            'quantity' => $quantity,//La cantidad de línea de pedido
        );
        //echo json_encode($data_save);
        //die();
        $book = $this->Books_model->create_estimates($token,json_encode($data_save));
        if($book['code'] == 0){

            echo json_encode(array('estatus' => true, 'mensaje' => 'Se creo correctamente.'));

        }else{

            echo json_encode(array('estatus' => true, 'mensaje' => $book['message']));

        }
        
    }

    public function edit(){

        $token = comprobarToken();
        //$book = $this->Books_model->upd_estimates($token,json_encode($data_save),$id);
    }


}
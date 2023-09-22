<?php 

$_SESSION['book'] = array();

class Books extends CI_Controller{

    public function __construct(){

		parent::__construct();

        $this->load->library(array('session'));

        $this->load->model(array('Books_model','Opportunities_model','Accounts_model','Contacts_model'));

		$this->load->helper(array('zoho_refresh/refresh_token','budgets/budgets'));

	}

    public function nuevo($id){

        if($this->session->userdata('is_logged')){

            $this->template->title = 'Books';

            $token = comprobarToken();

            $opportunitie = $this->Opportunities_model->get_opportunities($token,$id)['data'][0];
            $account = $this->Accounts_model->get_account($token,$opportunitie['Account_Name']['id'])['data'][0];
            $contact = $this->Contacts_model->get_contacts($token, $opportunitie['Contact_Name']['id'])['data'][0];
            
            $data = array(
                'opportunitie' => $opportunitie,
                'account' => $account,
                'contact' => $contact
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
        
        foreach($dataSessions as $dataSession){
            echo $dataSession['articulos'];
        }

        /*$data = array(
            'customer_id' => $customer,//ESTIMACIONES ID DE CLIENTE
            'currency_id' => $currency_id,//ID DE CLIENTE
            //'contact_persons' => array(),//SE ENVIA A UNA PERSONA O PERSONAS DE CONTACTO PARA EL ENVIO DE LA ESTIMACION.
            'template_id' => $template_id,//ID DE LA PLANTILLA PDF ASOCIADA AL PRESUPUESTO.
            //'place_of_supply' => $place_of_supply,//Lugar donde se suministran los bienes/servicios a
            //'estimate_number' => $estimate_number,//Buscar estimaciones por número estimado
            //'reference_number' => $reference_number,//Estimaciones de búsqueda por número de referencia
            'date' => date(Y-m-d),
            'expiry_date' => $expiry_date, //FECHA DE EXPIRACION DE LA COTIZACION
            'exchange_rate' => $exchange_rate,//Tipo de cambio de la moneda.
            'discount' => $discount,//Descuento aplicado a la factura. Puede ser en % o en cantidad
            'is_discount_before_tax' => $is_discount_before_tax,//Se utiliza para especificar cómo debe aplicarse el descuento. Ya sea antes o después del cálculo del impuesto.
            'discount_type' => $discount_type,//Cómo se especifica el descuento. Los valores permitidos son entity_level o item_level.
            'custom_body' => $custom_body,//
            'custom_subject' => $custom_subject,
            'salesperson_name' => $salesperson_name,//Nombre del vendedor
            //'custom_fields' => $custom_fields,//Campos personalizados para un presupuesto
            'line_items' => $line_items array(
                'item_id' => $item_id,
                'line_item_id' => $line_item_id,
                'name' => $name,
                'description' => $description,
                'product_type' => $product_type,
                'sat_item_key_code' => $sat_item_key_code,
                'unitkey_code' => $unitkey_code,
                'item_order' => $item_order,
                'bcy_rate' => $bcy_rate,
                'rate' => $rate,
                'quantity' => $quantity,
                'unit' => $unit,
                'discount_amount' => $discount_amount,
                'discount' => $discount,
                'tax_id' => $tax_id,
                'tds_tax_id' => $tds_tax_id,
                'tax_name' => $tax_name,
                'tax_type' => $tax_type,
                'tax_percentage' => $tax_percentage,
                'tax_treatment_code' => $tax_treatment_code,
                'item_total' => $item_total,
            ),//Partidas de un presupuesto.
            'notes' => $notes,
            'terms' => $terms,
            'adjustment' => $adjustment,
            'adjustment_description' => $adjustment_description,
            'tax_id' => $tax_id,
            'tax_treatment' => $tax_treatment,//Tratamiento del IVA para el Estimado.Valor permitidos
            'item_id' => $item_id,
            'line_item_id' => $line_item_id,//Identificador de la línea de pedido. Obligatorio, si es necesario actualizar la línea de pedido existente. Si está vacío, se creará una nueva línea de pedido.
            'name' => $name,//El nombre del elemento de línea
            'description' => $description,
            'rate' => $rate,
            'unit' => $unit,
            'quantity' => $quantity,//La cantidad de línea de pedido
            'project_id' => $project_id//ID del proyecto

        );*/

    }



}
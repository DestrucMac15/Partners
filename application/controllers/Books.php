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

        $data = array(
            'propietarioPresupuesto' => $this->input->post('propietarioPresupuesto'),
            'cuentaNombre' => $this->input->post('cuentaNombre'),
            'oportunidadNombre' => $this->input->post('oportunidadNombre'),
            'numeroPresupuesto' => $this->input->post('numeroPresupuesto'),
            'numeroReferencia' => $this->input->post('numeroReferencia'),
            'fechaPresupuesto' => $this->input->post('fechaPresupuesto'),
            'fechaVencimiento' => $this->input->post('fechaVencimiento'),
            'nombreProyecto' => $this->input->post('nombreProyecto'),
            'listaPrecios' => $this->input->post('listaPrecios'),
            'descripcionProyecto' => $this->input->post('descripcionProyecto'),
            'asunto' => $this->input->post('asunto'),
            'create' => $this->input->post('create'),
            'emailContacto' => $this->input->post('emailContacto'),
            'emailPropietario' => $this->input->post('emailPropietario'),
        );
        var_dump($data);
        die();
        $dataSessions = $_SESSION['book'];
        //$data_save = array();
        foreach($dataSessions as $clave => $valor){

            if($clave == "articulos"){

                foreach($valor as $articulo){

                    $header = $articulo['header'];
                    //var_dump($header);
                    //$data_save['titulo'] = $articulo['header'];
                    // Accede a los valores dentro de "items" en cada artículo
                    foreach($articulo['items'] as $item){

                        $item_id = $item['item_id'];
                        $name    = $item['name'];
                        $sku     = $item['sku'];
                        $brand   = $item['brand'];
                        $manufacturer  = $item['manufacturer'];
                        $category_id   = $item['category_id'];
                        $category_name = $item['category_name'];
                        $image_name = $item['image_name'];
                        $image_type = $item['image_type'];
                        $status = $item['status'];
                        $source = $item['source'];
                        $is_linked_with_zohocrm = $item['is_linked_with_zohocrm'];
                        $zcrm_product_id        = $item['zcrm_product_id'];
                        $crm_owner_id           = $item['crm_owner_id'];
                        $unit    = $item['unit'];
                        $unit_id = $item['unit_id'];
                        $description = $item['description'];
                        $rate        = $item['rate'];
                        $account_id  = $item['account_id'];
                        $tax_id      = $item['tax_id'];
                        $tax_name    = $item['tax_name'];
                        $tax_percentage    = $item['tax_percentage'];
                        $tax_type          = $item['tax_type'];
                        $purchase_tax_id   = $item['purchase_tax_id'];
                        $purchase_tax_name = $item['purchase_tax_name'];
                        $is_default_tax_applied  = $item['is_default_tax_applied'];
                        $purchase_tax_percentage = $item['purchase_tax_percentage'];
                        $purchase_tax_type       = $item['purchase_tax_type'];
                        $associated_template_id  = $item['associated_template_id'];
                        $documents = $item['documents'];//*
                        $purchase_description = $item['purchase_description'];
                        $pricebook_rate = $item['pricebook_rate'];
                        $pricing_scheme = $item['pricing_scheme'];
                        $price_brackets = $item['price_brackets'];//*
                        $default_price_brackets = $item['default_price_brackets'];//*
                        $sales_rate             = $item['sales_rate'];
                        $purchase_rate          = $item['purchase_rate'];
                        $purchase_account_id    = $item['purchase_account_id'];
                        $purchase_account_name  = $item['purchase_account_name'];
                        $inventory_account_id   = $item['inventory_account_id'];
                        $inventory_account_name = $item['inventory_account_name'];
                        $created_at   = $item['created_at'];
                        $created_time = $item['created_time'];
                        $offline_created_date_with_time = $item['offline_created_date_with_time'];
                        $last_modified_time             = $item['last_modified_time'];
                        $tags      = $item['tags'];//*
                        $item_type = $item['item_type'];
                        $product_type  = $item['product_type'];
                        $is_returnable = $item['is_returnable'];
                        //$reorder_level = $item['reorder_level'];
                        $minimum_order_quantity = $item['minimum_order_quantity'];
                        $maximum_order_quantity = $item['maximum_order_quantity'];
                        $initial_stock = $item['initial_stock'];
                        //$vendor_id     = $item['vendor_id'];
                        //$vendor_name   = $item['vendor_name'];
                        //$stock_on_hand = $item['stock_on_hand'];//*
                        /*$asset_value   = $item['asset_value'];
                        $available_stock        = $item['available_stock'];
                        $actual_available_stock = $item['actual_available_stock'];
                        $committed_stock        = $item['committed_stock'];
                        $actual_committed_stock = $item['actual_committed_stock'];
                        $available_for_sale_stock        = $item['available_for_sale_stock'];
                        $actual_available_for_sale_stock = $item['actual_available_for_sale_stock'];
                        $custom_fields       = $item['custom_fields'];//*
                        $custom_field_hash   = $item['custom_field_hash'];//*
                        $track_serial_number = $item['track_serial_number'];
                        $is_fulfillable      = $item['is_fulfillable'];
                        $upc  = $item['upc'];
                        $ean  = $item['ean'];
                        $isbn = $item['isbn'];
                        $part_number       = $item['part_number'];
                        $is_combo_product  = $item['is_combo_product'];
                        $sales_channels    = $item['sales_channels'];//*
                        $preferred_vendors = $item['preferred_vendors'];
                        $package_details   = $item['package_details'];//*
                        $quantity   = $item['quantity'];
                        $item_total = $item['item_total'];*/
                    }
                }

            }elseif($clave == "tabulador"){

                // Accede a los valores dentro de "tabulador"
                $subtotal        = $valor['subtotal'];
                $envio           = $valor['envio'];
                $nombre_impuesto = $valor['nombre_impuesto'];
                $impuesto        = $valor['impuesto'];
                $total           = $valor['total'];

            }

        }

        $data_save = array(
            'customer_id' => $customer,//ESTIMACIONES ID DE CLIENTE
            'currency_id' => $currency_id,//ID DE CLIENTE
            //'contact_persons' => array(),//SE ENVIA A UNA PERSONA O PERSONAS DE CONTACTO PARA EL ENVIO DE LA ESTIMACION.
            'template_id' => '2511149000000017003',//ID DE LA PLANTILLA PDF ASOCIADA AL PRESUPUESTO.
            //'place_of_supply' => $place_of_supply,//Lugar donde se suministran los bienes/servicios a
            'estimate_number' => $this->input->post('numeroPresupuesto'),//Buscar estimaciones por número estimado
            'reference_number' => $this->input->post('numeroReferencia'),//Estimaciones de búsqueda por número de referencia
            'date' => date('Y-m-d'),
            'expiry_date' => $this->input->post('fechaPresupuesto'), //FECHA DE EXPIRACION DE LA COTIZACION
            'exchange_rate' => 1.00,//Tipo de cambio de la moneda.
            //'discount' => $discount,//Descuento aplicado a la factura. Puede ser en % o en cantidad
            'is_discount_before_tax' => true,//Se utiliza para especificar cómo debe aplicarse el descuento. Ya sea antes o después del cálculo del impuesto.
            'discount_type' => 'item_level',//Cómo se especifica el descuento. Los valores permitidos son entity_level o item_level.
            //'custom_body' => $custom_body,//
            //'custom_subject' => $custom_subject,
            //'salesperson_name' => $salesperson_name,//Nombre del vendedor PREGUNTA A QUE NOMBRE TIENE QUE ESTAR ???
            //'custom_fields' => $custom_fields,//Campos personalizados para un presupuesto
            /*'line_items' => $line_items array(
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
            ),//Partidas de un presupuesto.*/
            'notes' => '',//Las notas agregadas a continuación expresando gratitud o por transmitir alguna información
            'terms' => '',
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
        );
        die();

    }



}
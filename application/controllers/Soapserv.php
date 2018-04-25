<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Soapserv extends CI_Controller {
    function __construct()
    {

        ini_set("log_errors", 1);
        ini_set("error_log", "php-error.log");
        error_log( "Hello, errors!!" );


        parent::__construct();

        $this->load->library("Nusoap_library"); //load the library here
        $this->nusoap_server = new soap_server();
        $this->nusoap_server->soap_defencoding = 'UTF-8';
        $this->nusoap_server->decode_utf8 = false;
        $this->nusoap_server->encode_utf8 = true;
        $this->nusoap_server->configureWSDL("DealerSystemSoapServer", "urn:DealerSystemSoapServer");
        $this->nusoap_server->wsdl->schemaTargetNamespace = 'urn:DealerSystemSoapServer';

        //DATA TYPES
        //Invoice
        $this->nusoap_server->wsdl->addComplexType(
            'Invoice',
            'complexType',
            'struct',
            'all',
            '',
            array(
                //'id_invoice' => array('name' => 'id_invoice', 'type' => 'xsd:integer'),
                'company_name' => array('name' => 'company_name', 'type' => 'xsd:string'),
                'inn' => array('name' => 'inn', 'type' => 'xsd:string'),
                'invoice_serial_number' => array('name' => 'invoice_serial_number', 'type' => 'xsd:string'),

                'creating_date_time' => array('name' => 'pay_date_time', 'type' => 'xsd:dateTime'),
                'pay_date_time' => array('name' => 'creating_date_time', 'type' => 'xsd:dateTime'),
                'requisites_creating_date_time' => array('name' => 'requisites_creating_date_time', 'type' => 'xsd:dateTime'),

                'invoice_payed' => array('name' => 'invoice_payed', 'type' => 'xsd:string'),
                'pay_invoice_out' => array('name' => 'pay_invoice_out', 'type' => 'xsd:string'),
                'invoice_payed' => array('name' => 'invoice_payed', 'type' => 'xsd:string'),
                'total_sum' => array('name' => 'total_sum', 'type' => 'xsd:string'),
                'sell' => array('name' => 'sell', 'type'=>'tns:SellArray'),
                'serial' => array('name' => 'serial', 'type' => 'xsd:string'),
                'number' => array('name' => 'number', 'type' => 'xsd:string'),

                'id_users' => array('name' => 'id_users', 'type' => 'xsd:string'),
                'surname' => array('name' => 'surname', 'type' => 'xsd:string'),
                'name' => array('name' => 'name', 'type' => 'xsd:string'),
                'patronymic_name' => array('name' => 'patronymic_name', 'type' => 'xsd:string'),

                'full_name' => array('name' => 'full_name', 'type' => 'xsd:string'),
                'id_distributor' => array('name' => 'id_distributor', 'type' => 'xsd:string'),

            )
        );


        $this->nusoap_server->wsdl->addComplexType(
            'SellArray',
            'complexType',
            'array',
            '',
            'SOAP-ENC:Array',
            array(),
            array(
                array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Sell[]')
            ),
            'tns:Sell'
        );
        $this->nusoap_server->wsdl->addComplexType(
            'Sell',
            'complexType',
            'struct',
            'all',
            '',
            array(
                'id_inventory' => array('name' => 'count', 'type' => 'xsd:string'),
                'count' => array('name' => 'count', 'type' => 'xsd:string'),
                'inventory_name' => array('name' => 'inventory_name', 'type' => 'xsd:string'),
                'price_count' => array('name' => 'price_count', 'type' => 'xsd:string'),
            )
        );

        //InvoiceArray
        $this->nusoap_server->wsdl->addComplexType(
            'InvoiceArray',
            'complexType',
            'array',
            '',
            'SOAP-ENC:Array',
            array(),
            array(
                array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'tns:Invoice[]')
            ),
            'tns:Invoice'
        );

        //REGISTRATION
        //getInvoice
        $this->nusoap_server->register(
            'getInvoice',
            array('id' => 'xsd:integer'),
            array('return' => 'tns:Invoice'),
            'urn:DealerSystemSoapServer',   //namespace
            'urn:DealerSystemSoapServer#getInvoice',  //soapaction
            'rpc', // style
            'encoded', // use
            'Get single invoice' //description
        );

        //getInvoices
        $this->nusoap_server->register(
            'getInvoices',
            array(),  //parameters
            array('return' => 'tns:InvoiceArray'),  //output
            'urn:DealerSystemSoapServer',   //namespace
            'urn:DealerSystemSoapServer#getInvoices',  //soapaction
            'rpc', // style
            'encoded', // use
            'Get all invoices' //description
        );

        //getInvoicesByDate
        $this->nusoap_server->register(
            'getInvoicesByDate',
            array('dateN' => 'xsd:dateTime', 'dateK' => 'xsd:dateTime'),  //parameters
            array('return' => 'tns:InvoiceArray'),  //output
            'urn:DealerSystemSoapServer',   //namespace
            'urn:DealerSystemSoapServer#getInvoicesByDate',  //soapaction
            'rpc', // style
            'encoded', // use
            'Get all invoices by date' //description
        );

        //getInvoicesByCreateDate
        $this->nusoap_server->register(
            'getInvoicesByCreateDate',
            array('dateN' => 'xsd:dateTime', 'dateK' => 'xsd:dateTime'),  //parameters
            array('return' => 'tns:InvoiceArray'),  //output
            'urn:DealerSystemSoapServer',   //namespace
            'urn:DealerSystemSoapServer#getInvoicesByCreateDate',  //soapaction
            'rpc', // style
            'encoded', // use
            'Get all invoices by create date' //description
        );

        $this->nusoap_server->register(
            'getInvoicesByPayDate',
            array('dateN' => 'xsd:dateTime', 'dateK' => 'xsd:dateTime'),  //parameters
            array('return' => 'tns:InvoiceArray'),  //output
            'urn:DealerSystemSoapServer',   //namespace
            'urn:DealerSystemSoapServer#getInvoicesByPayDate',  //soapaction
            'rpc', // style
            'encoded', // use
            'Get all invoices by Pay date' //description
        );

        $this->nusoap_server->register(
            'getInvoicesByRequisitesDate',
            array('dateN' => 'xsd:dateTime', 'dateK' => 'xsd:dateTime'),  //parameters
            array('return' => 'tns:InvoiceArray'),  //output
            'urn:DealerSystemSoapServer',   //namespace
            'urn:DealerSystemSoapServer#getInvoicesByRequisitesDate',  //soapaction
            'rpc', // style
            'encoded', // use
            'Get all invoices by Pay date' //description
        );

        //IMPLEMENTATION
        function getInvoice($id){

            try{
                ini_set("log_errors", 1);
                ini_set("error_log", "php-error.log");
                error_log( "function getInvoices(){" );


//                $CI =& get_instance();
//                $CI->load->model('invoice_model'); // THIS IS MY MODEL
//
//                $data = $this->pdf_Invoice_model->get_all_invoice_unique();
//                print_r($data);
//                return $data;

                $ci =& get_instance();
                $ci->db->select('id_invoice, invoice_serial_number, creating_date_time')
                    ->where('id_invoice', $id);
                $qcd = $ci->db->get('"Dealer_data".invoice');
                if ($qcd->num_rows()>0) {
                    error_log( "return \$qcd->row_array(); - "  );
                    return $qcd->row_array();

                } else {
                    error_log( "return false - " );
                    return false;
                }

            } catch (Exception $e) {
                error_log("exception - ".$e);
            } finally {
                error_log("ok");
            }

            return array(array('1','2','3'));
        }

        function getInvoices(){

            try{
                ini_set("log_errors", 1);
                ini_set("error_log", "php-error.log");
                error_log( "function getInvoices(){" );

                $CI =& get_instance();
                $CI->load->model('soap_model'); // THIS IS MY MODEL

//                $data = $CI->soap_model->get_invoice_serial_2_soap();
                $data = $CI->soap_model->get_invoice_serial_soap();
                //print_r($data);
                return $data;

            } catch (Exception $e) {
                error_log("exception - ".$e);
            } finally {
                error_log("ok");
            }
        }

        function getInvoicesByDate($dateN, $dateK){
            try{
                ini_set("log_errors", 1);
                ini_set("error_log", "php-error.log");
                error_log( "function getInvoices(){" );

                $CI =& get_instance();
                $CI->load->model('soap_model'); // THIS IS MY MODEL

                $data = $CI->soap_model->get_invoices_by_date($dateN, $dateK);
//                print_r($data);
                return $data;

            } catch (Exception $e) {
                error_log("exception - ".$e);
            } finally {
                error_log("ok");
            }
        }

        function getInvoicesByCreateDate($dateN, $dateK){
            try{
                ini_set("log_errors", 1);
                ini_set("error_log", "php-error.log");
                error_log( "function getInvoices(){" );

                $CI =& get_instance();
                $CI->load->model('soap_model'); // THIS IS MY MODEL

                $data = $CI->soap_model->get_invoices_by_create_date($dateN, $dateK);
                //print_r($data);
                return $data;

            } catch (Exception $e) {
                error_log("exception - ".$e);
            } finally {
                error_log("ok");
            }
        }

        function getInvoicesByPayDate($dateN, $dateK){
            try{
                ini_set("log_errors", 1);
                ini_set("error_log", "php-error.log");
                error_log( "function getInvoices(){" );

                $CI =& get_instance();
                $CI->load->model('soap_model'); // THIS IS MY MODEL

                $data = $CI->soap_model->get_invoices_by_pay_date($dateN, $dateK);
                //print_r($data);
                return $data;

            } catch (Exception $e) {
                error_log("exception - ".$e);
            } finally {
                error_log("ok");
            }
        }

        function getInvoicesByRequisitesDate($dateN, $dateK){
            try{
                ini_set("log_errors", 1);
                ini_set("error_log", "php-error.log");
                error_log( "function getInvoices(){" );

                $CI =& get_instance();
                $CI->load->model('soap_model'); // THIS IS MY MODEL

                $data = $CI->soap_model->get_invoices_by_pay_date($dateN, $dateK);
                //print_r($data);
                return $data;

            } catch (Exception $e) {
                error_log("exception - ".$e);
            } finally {
                error_log("ok");
            }
        }

    }

    public function index()
    {
        $this->nusoap_server->service(file_get_contents("php://input")); //shows the standard info about service
    }

    public function test()
    {
        try {
            $wsdl = 'http://'.$_SERVER['HTTP_HOST'].'/index.php/soapserv?wsdl';
//            $wsdl = 'http://'.$_SERVER['SERVER_ADDR'].'/'.'demo-ds.token.kg'.'/index.php/soapserv?wsdl';
            $this->load->library("Nusoap_library"); //load the library here

            $client = new nusoap_client($wsdl, 'wsdl');

            $res1 = $client->call('getInvoice', array('id' => 4));
            var_dump($res1);

            $res2 = $client->call('getInvoices');
            var_dump($res2);
        } catch(Exception $e) {
            error_log("exception - ".$e);
        }
    }

}
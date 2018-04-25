<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Soap_model extends CI_Model {

    public function get_invoice_serial_2_soap(){
        $result = $this->db->
        from('"Dealer_data".invoice')->
        join('"Dealer_data".sell', 'sell.invoice_id = invoice.id_invoice', 'inner')->
        join('"Dealer_data".inventory', 'sell.inventory_id = inventory.id_inventory', 'inner')->
        join('"Dealer_data".users', 'invoice.users_id = users.id_users', 'inner')->
        join('"Dealer_data".requisites', 'requisites.requisites_invoice_id = invoice.id_invoice', 'left')->
        join('"Dealer_data".invoice_version', 'invoice.invoice_version_id = invoice_version.id_invoice_version', 'left' )->
        join('"Dealer_data".distributor', 'users.distributor_id = distributor.id_distributor', 'left')->

        get();
//        $qcd = $this->db->get('"Dealer_data".invoice');
        if ($result->num_rows() > 0) {
            $ret_val = array();
            $i = 0;

//            var_dump($result->result_array());

            foreach ($result->result_array() as $row) {

//                var_dump($row);

                $ret_val[$i] = $row;

                if ($ret_val[$i]['creating_date_time'] != '') {
                    $creating_date_time = new DateTime($ret_val[$i]['creating_date_time']);
                    $ret_val[$i]['creating_date_time'] = $creating_date_time->format('Y/m/d H:i:s');
                }
                if ($ret_val[$i]['pay_date_time'] != '') {
                    $pay_date_time = new DateTime($ret_val[$i]['pay_date_time']);
                    $ret_val[$i]['pay_date_time'] = $pay_date_time->format('Y/m/d H:i:s');
                }
                if ($ret_val[$i]['requisites_creating_date_time'] != '') {
                    $requisites_creating_date_time = new DateTime($ret_val[$i]['requisites_creating_date_time']);
                    $ret_val[$i]['requisites_creating_date_time'] = $requisites_creating_date_time->format('Y/m/d H:i:s');
                }

                if($ret_val[$i]['pay_date_time'] <> '') {
                    $ret_val[$i]['invoice_payed'] = 'true';
                } else {
                    $ret_val[$i]['invoice_payed'] = 'false';
                }
                if($ret_val[$i]['requisites_creating_date_time'] <> '') {
                    $ret_val[$i]['pay_invoice_out'] = 'true';
                } else {
                    $ret_val[$i]['pay_invoice_out'] = 'false';
                }
                $i++;
            }
//                    var_dump($ret_val);
            error_log("return \$ret_val;");
            return $ret_val;
        } else {
            error_log("return false;");
            return false;
        }


    }
    /**
     * @return array|bool
     !! убрали * id_invoice - внутренний идентификатор (не для 1с)
     * company_name - имя компании
     * invoice_serial_number - серийный номер счета на оплату (для 1с)
     * creating_date_time - дата создания счета на оплату
     * pay_date_time - дата оплаты счета на оплату
     * requisites_creating_date_time - дата выдачи счет фактуры
     * invoice_payed - флаг оплаты
     * pay_invoice_out - флаг выдачи
     */
    public function get_invoice_serial_soap()
    {
        /*
         *
            'id_invoice,
            company_name,
            inn,
            invoice_serial_number,
            creating_date_time,
            pay_date_time,
            requisites_creating_date_time,
            total_sum,
            serial,
            number'
         */
        $result = $this->db->select()->
        from('"Dealer_data".invoice')->
        join('"Dealer_data".requisites', 'requisites.requisites_invoice_id = invoice.id_invoice', 'left')->
//            join('"Dealer_data".inventory')->
        join('"Dealer_data".pay_invoice', 'pay_invoice.id_pay_invoice = requisites.pay_invoice_id', 'left')->
        join('"Dealer_data".users', 'users.id_users = invoice.users_id', 'left')->
        join('"Dealer_data".distributor', 'distributor.id_distributor = users.distributor_id', 'left')->
        get();
//        $qcd = $this->db->get('"Dealer_data".invoice');
        if ($result->num_rows() > 0) {
            $ret_val = array();
            $i = 0;

//            var_dump($result->result_array());

            foreach ($result->result_array() as $row) {
//                var_dump($row);

                $ret_val[$i] = $row;


                $result_inventory_sell = $this->db->from('"Dealer_data".sell')->
                    join('"Dealer_data".inventory','sell.inventory_id = inventory.id_inventory','left')->
                    where('invoice_id', $row['id_invoice']  )->//$ret_val[$i]['id_invoice']
                    get();
                if($result_inventory_sell->num_rows() > 0) {
                    $ret_val[$i]['sell'] = $result_inventory_sell->result_array();
                } else {}



                if ($ret_val[$i]['creating_date_time'] != '') {
                    $creating_date_time = new DateTime($ret_val[$i]['creating_date_time'], new DateTimeZone('UTC'));
                    $ret_val[$i]['creating_date_time'] = $creating_date_time->format('Y-m-d\TH:i:s');
//                    $ret_val[$i]['creating_date_time'] = $creating_date_time->format('Y-m-d');
                }
                if ($ret_val[$i]['pay_date_time'] != '') {
                    $pay_date_time = new DateTime($ret_val[$i]['pay_date_time']);
                    $ret_val[$i]['pay_date_time'] = $pay_date_time->format('Y-m-d\TH:i:s');
//                    $ret_val[$i]['pay_date_time'] = $pay_date_time->format('Y-m-d');
                }
                if ($ret_val[$i]['requisites_creating_date_time'] != '') {
                    $requisites_creating_date_time = new DateTime($ret_val[$i]['requisites_creating_date_time']);
                    $ret_val[$i]['requisites_creating_date_time'] = $requisites_creating_date_time->format('Y-m-d\TH:i:s');
//                    $ret_val[$i]['requisites_creating_date_time'] = $requisites_creating_date_time->format('Y-m-d');

                }

                if($ret_val[$i]['pay_date_time'] <> '') {
                    $ret_val[$i]['invoice_payed'] = 'true';
                } else {
                    $ret_val[$i]['invoice_payed'] = 'false';
                }
                if($ret_val[$i]['requisites_creating_date_time'] <> '') {
                    $ret_val[$i]['pay_invoice_out'] = 'true';
                } else {
                    $ret_val[$i]['pay_invoice_out'] = 'false';
                }
                $i++;
            }
//                    var_dump($ret_val);
            error_log("return \$ret_val;");
            return $ret_val;
        } else {
            error_log("return false;");
            return false;
        }



//        $result = $this->db->select('id_invoice, invoice_serial_number, creating_date_time');
//        $qcd = $this->db->get('"Dealer_data".invoice');
//        if ($qcd->num_rows() > 0) {
//            $ret_val = array();
//            $i = 0;
//            foreach ($qcd->result_array() as $row) {
////                        var_dump($row);
//                $ret_val[$i] = $row;
//                $i++;
//            }
////                    var_dump($ret_val);
//            error_log("return \$ret_val;");
//            return $ret_val;
//        } else {
//            error_log("return false;");
//            return false;
//        }



//                $ci =& get_instance();
//                $ci->db->select('id_invoice, invoice_serial_number, creating_date_time');
//                $qcd = $ci->db->get('"Dealer_data".invoice');
//                if ($qcd->num_rows()>0) {
//                    $ret_val=array();
//                    $i=0;
//                    foreach ($qcd->result_array() as $row) {
////                        var_dump($row);
//                        $ret_val[$i]=$row;
//                        $i++;
//                    }
////                    var_dump($ret_val);
//                    error_log("return \$ret_val;");
//                    return $ret_val;
//                } else {
//                    error_log("return false;");
//                    return false;
//                }

    }

    /*
     * http://1c.dostek.kg:8080/TEST_BASE/ws/ENOT/?wsdl

        логин: enot
        пароль:  dhfkueleif948594kgerg345kgg0e4j34

        метод GetNumberSF()
     */
    private function soap_1c_client() {
        ini_set("soap.wsdl_cache_enabled", "0");
        $wsdl = 'http://1c.dostek.kg:8080/TEST_BASE/ws/ENOT/?wsdl';
        $user = array(
            'login' => 'enot',
            'password' => 'dhfkueleif948594kgerg345kgg0e4j34',
            "trace" => 1, "exception" => 0
        );
        return new SoapClient($wsdl, $user);
    }

    public function index($invoice_Serial_number = '2017033100000045'){
        try {

            $array =  ['_id' => $invoice_Serial_number];

            $client = $this->soap_1c_client();
//            var_dump($client->__getFunctions());
            $result = $client->GetNumberSF($array);

            return $result;
        } catch (Exception $e) {
            echo $e;
        }
    }



    public function get_invoices_by_date($dateN, $dateK)
    {
//        $dateN = "2017-01-26 14:09:29";
//        $dateK = "2017-05-28 14:09:29";
        $result = $this->db->select()->
        from('"Dealer_data".invoice')->
        join('"Dealer_data".requisites', 'requisites.requisites_invoice_id = invoice.id_invoice', 'left')->
        join('"Dealer_data".pay_invoice', 'pay_invoice.id_pay_invoice = requisites.pay_invoice_id', 'left')->
        join('"Dealer_data".users', 'users.id_users = invoice.users_id', 'left')->
        join('"Dealer_data".distributor', 'distributor.id_distributor = users.distributor_id', 'left')->
        where("(\"creating_date_time\" >= '$dateN' AND \"creating_date_time\" <= '$dateK')
                OR ((\"pay_date_time\" >= '$dateN' AND \"pay_date_time\" <= '$dateK'))
                OR ((\"requisites_creating_date_time\" >= '$dateN' AND \"requisites_creating_date_time\" <= '$dateK'))");

        /*

        "(\"creating_date_time\" >= '$dateN'
AND \"creating_date_time\" <= '$dateK')
AND ((\"pay_date_time\" >= '$dateN'
AND \"pay_date_time\" <= '$dateK') OR \"pay_date_time\" IS NULL )
AND ((\"requisites_creating_date_time\" >= '$dateN'
AND \"requisites_creating_date_time\" <= '$dateK') OR \"requisites_creating_date_time\" IS NULL)"

         */
//        where('creating_date_time >= ', $dateN)->where('creating_date_time <= ', $dateK)->
//        where('pay_date_time >= ', $dateN)->where('pay_date_time <= ', $dateK)->
//        where('requisites_creating_date_time >= ', $dateN)->where('requisites_creating_date_time <= ', $dateK);//->
//        get();


//        echo $result->get_compiled_select();

        $result = $result->get();

        if ($result->num_rows() > 0) {
            $ret_val = array();
            $i = 0;

//            var_dump($result->result_array());

            foreach ($result->result_array() as $row) {
//                var_dump($row);

                $ret_val[$i] = $row;


                $result_inventory_sell = $this->db->from('"Dealer_data".sell')->
                join('"Dealer_data".inventory','sell.inventory_id = inventory.id_inventory','left')->
                where('invoice_id', $row['id_invoice']  )->//$ret_val[$i]['id_invoice']
                get();
                if($result_inventory_sell->num_rows() > 0) {
                    $ret_val[$i]['sell'] = $result_inventory_sell->result_array();
                } else {}



                if ($ret_val[$i]['creating_date_time'] != '') {
                    $creating_date_time = new DateTime($ret_val[$i]['creating_date_time'], new DateTimeZone('UTC'));
                    $ret_val[$i]['creating_date_time'] = $creating_date_time->format('Y-m-d\TH:i:s');
//                    $ret_val[$i]['creating_date_time'] = $creating_date_time->format('Y-m-d');
                }
                if ($ret_val[$i]['pay_date_time'] != '') {
                    $pay_date_time = new DateTime($ret_val[$i]['pay_date_time']);
                    $ret_val[$i]['pay_date_time'] = $pay_date_time->format('Y-m-d\TH:i:s');
//                    $ret_val[$i]['pay_date_time'] = $pay_date_time->format('Y-m-d');
                }
                if ($ret_val[$i]['requisites_creating_date_time'] != '') {
                    $requisites_creating_date_time = new DateTime($ret_val[$i]['requisites_creating_date_time']);
                    $ret_val[$i]['requisites_creating_date_time'] = $requisites_creating_date_time->format('Y-m-d\TH:i:s');
//                    $ret_val[$i]['requisites_creating_date_time'] = $requisites_creating_date_time->format('Y-m-d');

                }

                if($ret_val[$i]['pay_date_time'] <> '') {
                    $ret_val[$i]['invoice_payed'] = 'true';
                } else {
                    $ret_val[$i]['invoice_payed'] = 'false';
                }
                if($ret_val[$i]['requisites_creating_date_time'] <> '') {
                    $ret_val[$i]['pay_invoice_out'] = 'true';
                } else {
                    $ret_val[$i]['pay_invoice_out'] = 'false';
                }
                $i++;
            }
//                    var_dump($ret_val);
            error_log("return \$ret_val;");
            return $ret_val;
        } else {
            error_log("return false;");
            return false;
        }

    }



    public function get_invoices_by_create_date($dateN, $dateK)
    {
//        $dateN = "2017-01-26 14:09:29";
//        $dateK = "2017-05-28 14:09:29";
        $result = $this->db->select()->
        from('"Dealer_data".invoice')->
        join('"Dealer_data".requisites', 'requisites.requisites_invoice_id = invoice.id_invoice', 'left')->
        join('"Dealer_data".pay_invoice', 'pay_invoice.id_pay_invoice = requisites.pay_invoice_id', 'left')->
        join('"Dealer_data".users', 'users.id_users = invoice.users_id', 'left')->
        join('"Dealer_data".distributor', 'distributor.id_distributor = users.distributor_id', 'left')->
        where('creating_date_time >= ', $dateN)->where('creating_date_time <= ', $dateK);//->

//        echo $result->get_compiled_select();

        $result = $result->get();

        if ($result->num_rows() > 0) {
            $ret_val = array();
            $i = 0;

//            var_dump($result->result_array());

            foreach ($result->result_array() as $row) {
//                var_dump($row);

                $ret_val[$i] = $row;


                $result_inventory_sell = $this->db->from('"Dealer_data".sell')->
                join('"Dealer_data".inventory','sell.inventory_id = inventory.id_inventory','left')->
                where('invoice_id', $row['id_invoice']  )->//$ret_val[$i]['id_invoice']
                get();
                if($result_inventory_sell->num_rows() > 0) {
                    $ret_val[$i]['sell'] = $result_inventory_sell->result_array();
                } else {}



                if ($ret_val[$i]['creating_date_time'] != '') {
                    $creating_date_time = new DateTime($ret_val[$i]['creating_date_time'], new DateTimeZone('UTC'));
                    $ret_val[$i]['creating_date_time'] = $creating_date_time->format('Y-m-d\TH:i:s');
//                    $ret_val[$i]['creating_date_time'] = $creating_date_time->format('Y-m-d');
                }
                if ($ret_val[$i]['pay_date_time'] != '') {
                    $pay_date_time = new DateTime($ret_val[$i]['pay_date_time']);
                    $ret_val[$i]['pay_date_time'] = $pay_date_time->format('Y-m-d\TH:i:s');
//                    $ret_val[$i]['pay_date_time'] = $pay_date_time->format('Y-m-d');
                }
                if ($ret_val[$i]['requisites_creating_date_time'] != '') {
                    $requisites_creating_date_time = new DateTime($ret_val[$i]['requisites_creating_date_time']);
                    $ret_val[$i]['requisites_creating_date_time'] = $requisites_creating_date_time->format('Y-m-d\TH:i:s');
//                    $ret_val[$i]['requisites_creating_date_time'] = $requisites_creating_date_time->format('Y-m-d');

                }

                if($ret_val[$i]['pay_date_time'] <> '') {
                    $ret_val[$i]['invoice_payed'] = 'true';
                } else {
                    $ret_val[$i]['invoice_payed'] = 'false';
                }
                if($ret_val[$i]['requisites_creating_date_time'] <> '') {
                    $ret_val[$i]['pay_invoice_out'] = 'true';
                } else {
                    $ret_val[$i]['pay_invoice_out'] = 'false';
                }
                $i++;
            }
//                    var_dump($ret_val);
            error_log("return \$ret_val;");
            return $ret_val;
        } else {
            error_log("return false;");
            return false;
        }

    }

    public function get_invoices_by_pay_date($dateN, $dateK)
    {
        $result = $this->db->select()->
        from('"Dealer_data".invoice')->
        join('"Dealer_data".requisites', 'requisites.requisites_invoice_id = invoice.id_invoice', 'left')->
        join('"Dealer_data".pay_invoice', 'pay_invoice.id_pay_invoice = requisites.pay_invoice_id', 'left')->
        join('"Dealer_data".users', 'users.id_users = invoice.users_id', 'left')->
        join('"Dealer_data".distributor', 'distributor.id_distributor = users.distributor_id', 'left')->
        where('pay_date_time >= ', $dateN)->where('pay_date_time <= ', $dateK);//->

//        echo $result->get_compiled_select();

        $result = $result->get();

        if ($result->num_rows() > 0) {
            $ret_val = array();
            $i = 0;

//            var_dump($result->result_array());

            foreach ($result->result_array() as $row) {
//                var_dump($row);

                $ret_val[$i] = $row;


                $result_inventory_sell = $this->db->from('"Dealer_data".sell')->
                join('"Dealer_data".inventory','sell.inventory_id = inventory.id_inventory','left')->
                where('invoice_id', $row['id_invoice']  )->//$ret_val[$i]['id_invoice']
                get();
                if($result_inventory_sell->num_rows() > 0) {
                    $ret_val[$i]['sell'] = $result_inventory_sell->result_array();
                } else {}



                if ($ret_val[$i]['creating_date_time'] != '') {
                    $creating_date_time = new DateTime($ret_val[$i]['creating_date_time'], new DateTimeZone('UTC'));
                    $ret_val[$i]['creating_date_time'] = $creating_date_time->format('Y-m-d\TH:i:s');
//                    $ret_val[$i]['creating_date_time'] = $creating_date_time->format('Y-m-d');
                }
                if ($ret_val[$i]['pay_date_time'] != '') {
                    $pay_date_time = new DateTime($ret_val[$i]['pay_date_time']);
                    $ret_val[$i]['pay_date_time'] = $pay_date_time->format('Y-m-d\TH:i:s');
//                    $ret_val[$i]['pay_date_time'] = $pay_date_time->format('Y-m-d');
                }
                if ($ret_val[$i]['requisites_creating_date_time'] != '') {
                    $requisites_creating_date_time = new DateTime($ret_val[$i]['requisites_creating_date_time']);
                    $ret_val[$i]['requisites_creating_date_time'] = $requisites_creating_date_time->format('Y-m-d\TH:i:s');
//                    $ret_val[$i]['requisites_creating_date_time'] = $requisites_creating_date_time->format('Y-m-d');

                }

                if($ret_val[$i]['pay_date_time'] <> '') {
                    $ret_val[$i]['invoice_payed'] = 'true';
                } else {
                    $ret_val[$i]['invoice_payed'] = 'false';
                }
                if($ret_val[$i]['requisites_creating_date_time'] <> '') {
                    $ret_val[$i]['pay_invoice_out'] = 'true';
                } else {
                    $ret_val[$i]['pay_invoice_out'] = 'false';
                }
                $i++;
            }
//                    var_dump($ret_val);
            error_log("return \$ret_val;");
            return $ret_val;
        } else {
            error_log("return false;");
            return false;
        }

    }

    public function get_invoices_by_requisites_date($dateN, $dateK)
    {
        /*
         * 'id_invoice,
            company_name,
            inn,
            invoice_serial_number,
            creating_date_time,
            pay_date_time,
            requisites_creating_date_time,
            total_sum,
            serial,
            number'
         */
        $result = $this->db->select(            )->
        from('"Dealer_data".invoice')->
        join('"Dealer_data".requisites', 'requisites.requisites_invoice_id = invoice.id_invoice', 'left')->
        join('"Dealer_data".pay_invoice', 'pay_invoice.id_pay_invoice = requisites.pay_invoice_id', 'left')->
        join('"Dealer_data".users', 'users.id_users = invoice.users_id', 'left')->
        join('"Dealer_data".distributor', 'distributor.id_distributor = users.distributor_id', 'left')->
        where('requisites_creating_date_time >= ', $dateN)->where('requisites_creating_date_time <= ', $dateK);//->

//        echo $result->get_compiled_select();

        $result = $result->get();

        if ($result->num_rows() > 0) {
            $ret_val = array();
            $i = 0;

//            var_dump($result->result_array());

            foreach ($result->result_array() as $row) {
//                var_dump($row);

                $ret_val[$i] = $row;


                $result_inventory_sell = $this->db->from('"Dealer_data".sell')->
                join('"Dealer_data".inventory','sell.inventory_id = inventory.id_inventory','left')->
                where('invoice_id', $row['id_invoice']  )->//$ret_val[$i]['id_invoice']
                get();
                if($result_inventory_sell->num_rows() > 0) {
                    $ret_val[$i]['sell'] = $result_inventory_sell->result_array();
                } else {}



                if ($ret_val[$i]['creating_date_time'] != '') {
                    $creating_date_time = new DateTime($ret_val[$i]['creating_date_time'], new DateTimeZone('UTC'));
                    $ret_val[$i]['creating_date_time'] = $creating_date_time->format('Y-m-d\TH:i:s');
//                    $ret_val[$i]['creating_date_time'] = $creating_date_time->format('Y-m-d');
                }
                if ($ret_val[$i]['pay_date_time'] != '') {
                    $pay_date_time = new DateTime($ret_val[$i]['pay_date_time']);
                    $ret_val[$i]['pay_date_time'] = $pay_date_time->format('Y-m-d\TH:i:s');
//                    $ret_val[$i]['pay_date_time'] = $pay_date_time->format('Y-m-d');
                }
                if ($ret_val[$i]['requisites_creating_date_time'] != '') {
                    $requisites_creating_date_time = new DateTime($ret_val[$i]['requisites_creating_date_time']);
                    $ret_val[$i]['requisites_creating_date_time'] = $requisites_creating_date_time->format('Y-m-d\TH:i:s');
//                    $ret_val[$i]['requisites_creating_date_time'] = $requisites_creating_date_time->format('Y-m-d');

                }

                if($ret_val[$i]['pay_date_time'] <> '') {
                    $ret_val[$i]['invoice_payed'] = 'true';
                } else {
                    $ret_val[$i]['invoice_payed'] = 'false';
                }
                if($ret_val[$i]['requisites_creating_date_time'] <> '') {
                    $ret_val[$i]['pay_invoice_out'] = 'true';
                } else {
                    $ret_val[$i]['pay_invoice_out'] = 'false';
                }
                $i++;
            }
//                    var_dump($ret_val);
            error_log("return \$ret_val;");
            return $ret_val;
        } else {
            error_log("return false;");
            return false;
        }

    }
}
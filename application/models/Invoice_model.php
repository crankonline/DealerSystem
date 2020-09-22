<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice_model extends CI_Model {

    private $token_pay_service = '5828dc4001dd67544c9f3110aa490fda88f37cf76b36c97fb00b6615a837ae98';

    private static function zerofill($num, $length = 8) {
        $result = $num;
        while (strlen($result) < $length) {
            $result = '0' . $result;
        }
        return $result;
    }

    private function pay_service_client() {
        $wsdl = (ENVIRONMENT == 'production') ?
                getenv('PAY_SERVICE_PROD') : //prod
                getenv('PAY_SERVICE_DEV'); //test
        $context = stream_context_create([
            'ssl' => [
                // set some SSL/TLS specific options
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ]);
        $options = [
            'soap_version' => SOAP_1_1,
            'exceptions' => true,
            'trace' => 1,
            'cache_wsdl' => WSDL_CACHE_NONE,
            'compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP,
            'connection_timeout' => 10,
            'stream_context' => $context
        ];
        return new SoapClient($wsdl, $options);
    }

    public function menu_invoice_nonpay_count() { //для отображения не оплаченных счетов на оплату
        $this->db->join('"Dealer_data".users', 'invoice.users_id = users.id_users');
        $this->db->join('"Dealer_data".distributor', 'users.distributor_id = distributor.id_distributor');
        $this->db->where('distributor.id_distributor', $this->session->userdata['logged_in']['UserDistributorID']);
        ($this->session->userdata['logged_in']['Show_Operator']) ?: //если это не менагер то посчитать только пользовательские
                        $this->db->where('users_id', $this->session->userdata['logged_in']['UserID'])->
                                where(array('delete_marker' => FALSE)); //проверяем на доступ и не показываем удаленки
        $this->db->where('invoice.pay_sum < invoice.total_sum');
        return $this->db->count_all_results('"Dealer_data".invoice'); //->result() у count_all_results отсутствует
    }

    public function menu_invoice_pay_count() { //для отображения оплаченых счетов которые не связанные с заявками, т.е. оплаченные но не выданные
        $this->db->join('"Dealer_data".users', 'invoice.users_id = users.id_users', 'inner')->
                join('"Dealer_data".distributor', 'users.distributor_id = distributor.id_distributor', 'inner')->
                //      join('"Dealer_data".requisites', 'requisites.requisites_invoice_id = invoice.id_invoice', 'inner')->
                where('distributor.id_distributor', $this->session->userdata['logged_in']['UserDistributorID']);
        ($this->session->userdata['logged_in']['Show_Operator']) ?:
                        $this->db->where('users_id', $this->session->userdata['logged_in']['UserID'])->
                                where(array('delete_marker' => FALSE)); //проверяем на доступ и не показываем удаленки
        $this->db->where('invoice.pay_sum >= invoice.total_sum')->
                where('COALESCE((SELECT requisites.requisites_invoice_id FROM "Dealer_data".requisites WHERE requisites_invoice_id=id_invoice),\'0\') = 0');
        //
        return $this->db->count_all_results('"Dealer_data".invoice'); //->result() у count_all_results отсутствует
    }

    public function enum_operators() { //перечисление операторов в свойствах счета на полату
        $result = $this->db->get_where('"Dealer_data".users', array('role_id' => 3));
        return $result->result();
    }

    public function get_invoice($InvoiceSerialNumber) {
        $this->db->select()->
                from('"Dealer_data".invoice')->
                join('"Dealer_data".sell', 'sell.invoice_id = invoice.id_invoice', 'inner')->
                join('"Dealer_data".inventory', 'sell.inventory_id = inventory.id_inventory', 'inner')->
                join('"Dealer_data".users', 'invoice.users_id = users.id_users', 'inner')->
                join('"Dealer_data".requisites', 'requisites.requisites_invoice_id = invoice.id_invoice', 'left')->
                where('invoice_serial_number', $InvoiceSerialNumber);
        ($this->session->userdata['logged_in']['Show_Operator']) ? $this->db->where('users.distributor_id', $this->session->userdata['logged_in']['UserDistributorID']) :
                        $this->db->where('users.id_users', $this->session->userdata['logged_in']['UserID'])->
                                where(array('delete_marker' => FALSE)); ///проверяем на доступ и не показываем удаленки
        //убейте меня так делать нельзя
        return $this->db->get()->result();
    }
    
        public function get_invoice_convert($InvoiceSerialNumber) {
        $this->db->select()->
                from('"Dealer_data".invoice')->
                join('"Dealer_data".sell', 'sell.invoice_id = invoice.id_invoice', 'inner')->
                join('"Dealer_data".inventory', 'sell.inventory_id = inventory.id_inventory', 'inner')->
                join('"Dealer_data".users', 'invoice.users_id = users.id_users', 'inner')->
                join('"Dealer_data".requisites', 'requisites.requisites_invoice_id = invoice.id_invoice', 'left')->
                where('invoice_serial_number', $InvoiceSerialNumber);
         ///проверяем на доступ и не показываем удаленки
        //убейте меня так делать нельзя
        return $this->db->get()->result();
    }

    public function get_companyname_by_inn($inn) {
        $this->db->select("inn")->
                select("company_name")->
                from('"Dealer_data".invoice')->
                where('inn', $inn)->
                order_by('creating_date_time', 'DESC')->
                limit(1);
        $result = $this->db->get()->row();
        if (empty($result)) {
            throw new Exception("Ничего не удалось найти");
        }
        return $result;
    }

    public function record_count() {
        $this->db->join('"Dealer_data".users', 'invoice.users_id = users.id_users', 'left')->
                join('"Dealer_data".distributor', 'users.distributor_id = distributor.id_distributor', 'left');
        ($this->session->userdata['logged_in']['Show_Operator']) ? $this->db->where('users.distributor_id', $this->session->userdata['logged_in']['UserDistributorID']) :
                        $this->db->where('users.id_users', $this->session->userdata['logged_in']['UserID'])->
                                where(array('delete_marker' => FALSE)); ///проверяем на доступ и не показываем удаленки
        return $this->db->count_all_results('"Dealer_data".invoice');
    }

    public function get_invoice_all_v2($limit, $offset) {
        $this->db->
                select('invoice.delete_marker')->
                select('invoice.invoice_serial_number')->
                select('invoice.inn')->
                select('invoice.company_name')->
                select('to_char(invoice.creating_date_time,\'DD.MM.YYYY HH24:MI\') AS creatingdatetime')->
                //select('COALESCE((SELECT "count" FROM "Dealer_data".sell WHERE invoice_id=id_invoice AND inventory_id =2),\'0\') AS TokenCount')->
                //select('COALESCE((SELECT "count" FROM "Dealer_data".sell WHERE invoice_id=id_invoice AND inventory_id =1),\'0\') AS EDSCount')->
                select('COALESCE((SELECT requisites.requisites_invoice_id FROM "Dealer_data".requisites WHERE requisites_invoice_id=id_invoice),\'0\') AS id_requisites')->
                select('invoice.pay_sum')->
                select('invoice.total_sum')->
                select('users."name" AS username')->
                select('distributor.short_name AS distributorname')->
                from('"Dealer_data".invoice')->
                join('"Dealer_data".users', 'invoice.users_id = users.id_users', 'left')->
                join('"Dealer_data".distributor', 'users.distributor_id = distributor.id_distributor', 'left');
        ($this->session->userdata['logged_in']['Show_Operator']) ? $this->db->where('users.distributor_id', $this->session->userdata['logged_in']['UserDistributorID']) :
                        $this->db->where('users.id_users', $this->session->userdata['logged_in']['UserID'])->
                                where(array('delete_marker' => FALSE)); ///проверяем на доступ и не показываем удаленки
        $this->db->limit($limit)->offset($offset);
        return $this->db->order_by('invoice.creating_date_time', 'DESC')->get()->result();
    }

    public function get_invoice_search_v2($search) {
        $this->db->
                select('invoice.delete_marker')->
                select('invoice.invoice_serial_number')->
                select('invoice.inn')->
                select('invoice.company_name')->
                select('to_char(invoice.creating_date_time,\'DD.MM.YYYY HH24:MI\') AS creatingdatetime')->
                //select('COALESCE((SELECT "count" FROM "Dealer_data".sell WHERE invoice_id=id_invoice AND inventory_id =2),\'0\') AS TokenCount')->
                //select('COALESCE((SELECT "count" FROM "Dealer_data".sell WHERE invoice_id=id_invoice AND inventory_id =1),\'0\') AS EDSCount')->
                select('COALESCE((SELECT requisites.requisites_invoice_id FROM "Dealer_data".requisites WHERE requisites_invoice_id=id_invoice),\'0\') AS id_requisites')->
                select('invoice.pay_sum')->
                select('invoice.total_sum')->
                select('users."name" AS username')->
                select('distributor.short_name AS distributorname')->
                from('"Dealer_data".invoice')->
                join('"Dealer_data".users', 'invoice.users_id = users.id_users', 'left')->
                join('"Dealer_data".distributor', 'users.distributor_id = distributor.id_distributor', 'left');
        ($this->session->userdata['logged_in']['Show_Operator']) ? $this->db->where('users.distributor_id', $this->session->userdata['logged_in']['UserDistributorID']) :
                        $this->db->where('users.id_users', $this->session->userdata['logged_in']['UserID'])->
                                where(array('delete_marker' => FALSE)); ///проверяем на доступ и не показываем удаленки
        ($search == 'pay') ? $this->db->where('invoice.pay_sum >= invoice.total_sum') : ""; //фильтр оплаченые счета
        ($search == 'nonpay') ? $this->db->where('invoice.pay_sum < invoice.total_sum') : ""; //фильтр не оплаченные счета
        ($search == 'wait') ? $this->db->where('COALESCE((SELECT requisites.requisites_invoice_id FROM "Dealer_data".requisites WHERE requisites_invoice_id=id_invoice),\'0\') = 0 AND invoice.pay_sum >= invoice.total_sum') : ""; //фильтр оплаченые и ожидающие заполнения
        ($search == 'pay' || $search == 'nonpay' || $search == 'wait') ? $this->db->or_group_start() : $this->db->group_start(); //если чебуфильтр присутсвует нужно менять конструкцию OR like или AND like
        $this->db->like('invoice.inn', $search)->
                or_like('invoice.company_name', $search)->
                or_like('lower(invoice.company_name)', $search)->//регистр
                or_like('upper(invoice.company_name)', $search)->//регистр
                or_like('invoice.invoice_serial_number', $search)->
                group_end()->
                //limit($limit)->offset($offset)->
                order_by('invoice.creating_date_time', 'DESC');
        return $this->db->get()->result();
    }

    public function invoice_create($InvoiceData) { //!!!!переписать!!!!
        /* обрабатываю-поготовливаю данные в модели тут т.к. часть данных завсит от инсертов */
        $TotalSumm = 0;
        if (is_array($InvoiceData['SellDataInventoryPriceAll'])) {
            foreach ($InvoiceData['SellDataInventoryPriceAll'] as $val) {//считаем общую сумму для invoice
                $TotalSumm += $val;
            }
        } else {
            $TotalSumm = $InvoiceData['SellDataInventoryPriceAll'];
        }
        $InvoiceDataBatch = array('users_id' => $this->session->userdata['logged_in']['UserID'], //готовим данные для инсерта в invoice
            'inn' => $InvoiceData['InvoiceDataInn'],
            'company_name' => $InvoiceData['InvoiceCompanyName'],
            'total_sum' => $TotalSumm);
        /* конец подготовки данных */

        $this->db->trans_start(); //TRUE тестирование - trans_rollback()
        $this->db->insert('"Dealer_data".invoice', $InvoiceDataBatch); //вносим основные данные ($InvoiceDataBatch пафосно, BatchInsert не использеутся)
        $InvoiceSerialNumber = date('Ymd') . static::zerofill($this->db->insert_id()); //генерируем серийник счета на оплату
        $this->db->where('id_invoice', $this->db->insert_id()); //вставляем серийник счета на оплату
        $this->db->update('"Dealer_data".invoice', array('invoice_serial_number' => $InvoiceSerialNumber));

        foreach ($InvoiceData['SellDataInventoryId'] as $key => $val) {//готовим данные для модели, batch формируется в модели т.к. сейчас нет данных invoice_id
            $SellDataBatch[$key] = array('invoice_id' => $this->db->insert_id(),
                'inventory_id' => $InvoiceData['SellDataInventoryId'][$key],
                'count' => $InvoiceData['SellDataInventoryCount'][$key],
                'price_count' => $InvoiceData['SellDataInventoryPriceAll'][$key]);
        }

        $this->db->insert_batch('"Dealer_data".sell', $SellDataBatch);
        $this->db->trans_complete(); //конец транзакции
        if ($this->db->trans_status() === FALSE) { // производит ошибку... или используйте функцию log_message() для журналирования ошибок
            throw new Exception("Ошибка транзакции при сохранении счета на опалту.");
        }
        return $InvoiceSerialNumber;
    }

    public function invoice_delete($InvoiceSerialNumber) {
        $this->db->set(array('delete_marker' => TRUE), FALSE)->
                where('invoice_serial_number', $InvoiceSerialNumber)->
                update('"Dealer_data".invoice');
    }

    public function invoice_update($reference, $InvoiceSerialNumber) {
        $this->db->where('invoice_serial_number', $InvoiceSerialNumber);
        $this->db->update('"Dealer_data".invoice', $reference);
    }

    public function invoice_pay($reference) {
        try {
            $client = $this->pay_service_client();
            $client->pay($this->token_pay_service, date('YmdHis') . rand(0, 9), $reference['invoice_serial_number'], $reference['pay_sum']);
        } catch (Exception $ex) {
            throw new Exception('Ошибка сервиса оплаты -> ' . $ex->getMessage());
        }
    }

    public function pay_log($invoice_number) {
        $result = $this->db->select('PayLog.Account')->
                        select('PayLog.Sum')->
                        select('PayLog.DateTime')->
                        select('PaymentSystem.Name')->
                        from('"Dealer_payments".PayLog')->
                        join('"Dealer_payments".PaymentSystem', 'PayLog.PaymentSystemID = PaymentSystem.IDPaymentSystem')->
                        where('PayLog.Account', $invoice_number)->
                        order_by('PayLog.DateTime', 'DESC')->
                        get()->result();
        return $result;
    }

}

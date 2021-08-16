<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Invoice_sochi_model extends CI_Model
{
    private static function zerofill($num, $length = 8) {
        $result = $num;
        while (strlen($result) < $length) {
            $result = '0' . $result;
        }
        return $result;
    }

    public function insert_entry($InvoiceData)
    {
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
            'total_sum' => $TotalSumm,
            'json'=>json_encode([
                'InvoiceCompanyCity'=>$InvoiceData['InvoiceCompanyCity'],
                'InvoiceCompanyAddress'=>$InvoiceData['InvoiceCompanyAddress'],
                'InvoiceCompanyBankBik'=>$InvoiceData['InvoiceCompanyBankBik'],
                'InvoiceCompanyBankName'=>$InvoiceData['InvoiceCompanyBankName'],
                'InvoiceCompanyBankAccount'=>$InvoiceData['InvoiceCompanyBankAccount'],
            ]));
        /* конец подготовки данных */

        $this->db->trans_start(); //TRUE тестирование - trans_rollback()
        $this->db->insert('"Dealer_data".invoice_sochi', $InvoiceDataBatch); //вносим основные данные ($InvoiceDataBatch пафосно, BatchInsert не использеутся)
        $InvoiceSerialNumber = date('Ymd') . static::zerofill($this->db->insert_id()); //генерируем серийник счета на оплату
        $this->db->where('id_invoice_sochi', $this->db->insert_id()); //вставляем серийник счета на оплату
        $this->db->update('"Dealer_data".invoice_sochi', array('invoice_sochi_serial_number' => $InvoiceSerialNumber));

        foreach ($InvoiceData['SellDataInventoryId'] as $key => $val) {//готовим данные для модели, batch формируется в модели т.к. сейчас нет данных invoice_id
            $SellDataBatch[$key] = array('invoice_sochi_id' => $this->db->insert_id(),
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

    public function select_entry($user_id, $condition)
    {

    }

    public function select_rows_entry($limit, $offset)
    {
        $this->db->
        select('invoice_sochi.invoice_sochi_serial_number')->
        select('invoice_sochi.inn')->
        select('invoice_sochi.company_name')->
        select('to_char(invoice_sochi.creating_date_time,\'DD.MM.YYYY HH24:MI\') AS creatingdatetime')->
        select('invoice_sochi.total_sum')->
        select('users."name" AS username')->
        select('distributor.short_name AS distributorname')->
        from('"Dealer_data".invoice_sochi')->
        join('"Dealer_data".users', 'invoice_sochi.users_id = users.id_users', 'left')->
        join('"Dealer_data".distributor', 'users.distributor_id = distributor.id_distributor', 'left');
        ($this->session->userdata['logged_in']['Show_Operator']) ?
            $this->db->where('users.distributor_id', $this->session->userdata['logged_in']['UserDistributorID']) :
            $this->db->where('users.id_users', $this->session->userdata['logged_in']['UserID']);//->
            //where(array('delete_marker' => FALSE)); ///проверяем на доступ и не показываем удаленки
        $this->db->limit($limit)->offset($offset);
        return $this->db->order_by('invoice_sochi.creating_date_time', 'DESC')->get()->result();
    }

    public function count_all_entry()
    {
        $this->db->join('"Dealer_data".users', 'invoice_sochi.users_id = users.id_users', 'left')->
        join('"Dealer_data".distributor', 'users.distributor_id = distributor.id_distributor', 'left');
        ($this->session->userdata['logged_in']['Show_Operator']) ?
            $this->db->where('users.distributor_id', $this->session->userdata['logged_in']['UserDistributorID']) :
            $this->db->where('users.id_users', $this->session->userdata['logged_in']['UserID']);//->
        return $this->db->count_all_results('"Dealer_data".invoice_sochi');
    }

    public function get_where_invoice_sochi($data){
        return $this->db->get_where('"Dealer_data".invoice_sochi', $data)->result();
    }
}
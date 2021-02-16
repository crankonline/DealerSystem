<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Pdfrender_model extends CI_Model {

    //<editor-fold desc="Invoice">
    /**
     * @param $InvoiceSerialNumber
     * @return mixed
     */
    public function get_invoice($InvoiceSerialNumber) {
        $result = $this->db->select()->
        from('"Dealer_data".invoice')->
        join('"Dealer_data".sell', 'sell.invoice_id = invoice.id_invoice', 'inner')->
        join('"Dealer_data".inventory', 'sell.inventory_id = inventory.id_inventory', 'inner')->
        join('"Dealer_data".users', 'invoice.users_id = users.id_users', 'inner')->
        join('"Dealer_data".requisites', 'requisites.requisites_invoice_id = invoice.id_invoice', 'left')->
        join('"Dealer_data".invoice_version', 'invoice.invoice_version_id = invoice_version.id_invoice_version', 'left' )->
        join('"Dealer_data".distributor', 'users.distributor_id = distributor.id_distributor', 'left')->
        where('invoice_serial_number', $InvoiceSerialNumber)->get();
        return $result->result();
    }

    public function get_invoice_sochi($InvoiceSerialNumber) {
        $result = $this->db->select()->
        from('"Dealer_data".invoice_sochi')->
        join('"Dealer_data".sell', 'sell.invoice_sochi_id = invoice_sochi.id_invoice_sochi', 'inner')->
        join('"Dealer_data".inventory', 'sell.inventory_id = inventory.id_inventory', 'inner')->
        join('"Dealer_data".users', 'invoice_sochi.users_id = users.id_users', 'inner')->
        join('"Dealer_data".distributor', 'users.distributor_id = distributor.id_distributor', 'left')->
        where('invoice_sochi_serial_number', $InvoiceSerialNumber)->get();
        return $result->result();
    }

    /**
     * @param $InvoiceSerialNumber
     * @return mixed
     */
    public function get_invoice_single($InvoiceSerialNumber) {
        $result = $this->db->select()->
        from('"Dealer_data".invoice')->
        join('"Dealer_data".sell', 'sell.invoice_id = invoice.id_invoice', 'inner')->
        join('"Dealer_data".inventory', 'sell.inventory_id = inventory.id_inventory', 'inner')->
        join('"Dealer_data".users', 'invoice.users_id = users.id_users', 'inner')->
        join('"Dealer_data".requisites', 'requisites.requisites_invoice_id = invoice.id_invoice', 'left')->
        join('"Dealer_data".invoice_version', 'invoice.invoice_version_id = invoice_version.id_invoice_version', 'left' )->
        join('"Dealer_data".distributor', 'users.distributor_id = distributor.id_distributor')->
        where('invoice_serial_number', $InvoiceSerialNumber)->
        get()->
        row();
        return $result;
    }

    /**
     * get all invoce for pdf rendering
     */
    public function get_all_invoice() {
        $result = $this->db->select()->
        from('"Dealer_data".invoice')->
        join('"Dealer_data".sell', 'sell.invoice_id = invoice.id_invoice', 'inner')->
        join('"Dealer_data".inventory', 'sell.inventory_id = inventory.id_inventory', 'inner')->
        join('"Dealer_data".users', 'invoice.users_id = users.id_users', 'inner')->
        join('"Dealer_data".requisites', 'requisites.requisites_invoice_id = invoice.id_invoice', 'left')->
        get();
        return $result->result();
    }

    /**
     * get unique invoice for index page
     * @return mixed
     */
    public function get_all_invoice_unique() {
        $result = $this->db->group_by(array('invoice.invoice_serial_number','invoice.id_invoice'))->select()->
        from('"Dealer_data".invoice')->
        get();
        return $result->result();
    }

    /**
     * @return mixed
     */
    public function get_current_invoice_Version() {
        $result = $this->db->select()->
        from('"Dealer_data".invoice_version')->
        where('current', true)->
        get();
        return $result->result();

    }

    /**
     * @return mixed
     */
    public function get_invoice_version() {
        $result = $this->db->select()->
        from('"Dealer_data".invoice_version')->
        join('"Dealer_data".invoice', 'invoice_version.id_invoice_version = invoice.invoice_version_id')->
        where('current', true)->
        get();
        return $result->result();
    }

    //</editor-fold>



    //<editor-fold desc="Pay invoice">
    /**
     * @param $id_requisites
     * @return mixed
     */
    public function get_pay_invoice($id_requisites) {
        $result = $this->db->select()->
        from('"Dealer_data".requisites')->
        join('"Dealer_data".invoice', 'requisites.requisites_invoice_id = invoice.id_invoice', 'left' )->
        join('"Dealer_data".users', 'invoice.users_id = users.id_users', 'left' )->
        join('"Dealer_data".distributor', 'users.distributor_id = distributor.id_distributor', 'left' )->
        join('"Dealer_data".pay_invoice', 'requisites.pay_invoice_id = pay_invoice.id_pay_invoice', 'left' )->
        join('"Dealer_data".pay_invoice_version', 'pay_invoice.pay_invoice_version_id = pay_invoice_version.id_pay_invoice_version', 'left' )->
        where('id_requisites', $id_requisites)->
        get()->
        row();
        return $result;
    }

    /**
     * @param $InvoiceSerialNumber
     * @return mixed
     */
    public function get_pay_invoice_all($InvoiceSerialNumber) {
        $result = $this->db->select()->
        from('"Dealer_data".invoice')->
        join('"Dealer_data".sell', 'sell.invoice_id = invoice.id_invoice', 'inner')->
        join('"Dealer_data".inventory', 'sell.inventory_id = inventory.id_inventory', 'inner')->
        where('invoice_serial_number', $InvoiceSerialNumber)->get();
        return $result->result();
    }

    /**
     * print all requsites ti ondex page
     * @return mixed
     */
    public function get_all_requisites_for_invoice() {
        $result = $this->db->select()->
        from('"Dealer_data".requisites')->
        join('"Dealer_data".invoice', 'requisites.requisites_invoice_id = invoice.id_invoice', 'left' )->
        get();
        return $result->result();
    }
    //</editor-fold>
}
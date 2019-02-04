<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics_model extends CI_Model { //модель сосзда на всякий случай для обновдения цен с 1С

    public function pay_count() {
        return $this->db->count_all_results('"Dealer_payments"."PayLog"');
    }

    public function get_operators_enum() {
        return $this->db->select('id_users')->
                        select("CONCAT (users.surname, ' ',users.\"name\",' ',users.patronymic_name) AS UserName")->
                        from('"Dealer_data".users')->
                        where('users.role_id', 3)->
                        where('id_users !=', $this->session->userdata['logged_in']['UserID'])->//что бы не показывать себя
                        order_by('id_users')->get()->result();
    }

    public function get_statistics_all_daily($period_start = NULL, $period_end = NULL) {
        if (is_null($period_start) || is_null($period_end)) {
            $period_start = date("Y") . "-" . date("m") . "-" . date("01") . " 00:00:00";
            $period_end = date("Y") . "-" . date("m") . "-" . date("t") . " 23:59:59";
        }
        $sql = 'SELECT requisites_creating_date_time, sum(edscount) as edscount, sum(tokencount)as tokencount, count(DISTINCT(invoice_111)) as invoice_count, sum(pay_sum) as pay_sum FROM
(
  SELECT
    to_date(to_char("requisites_creating_date_time",\'DD-MM-YYYY\'), \'DD-MM-YYYY\') as requisites_creating_date_time,
    CASE WHEN inventory_id = 2 THEN "count" ELSE \'0\' END as tokencount,
    CASE WHEN inventory_id = 1 OR inventory_id = 3 OR inventory_id = 5 THEN "count" ELSE \'0\' END as edscount,
    "invoice"."id_invoice" as invoice_111,
    invoice.pay_sum as pay_sum
  FROM "Dealer_data"."invoice"
    LEFT JOIN "Dealer_data"."requisites" ON "requisites"."requisites_invoice_id" = "invoice"."id_invoice"
    LEFT JOIN "Dealer_data"."sell" ON "sell"."invoice_id" = "invoice"."id_invoice"
    LEFT JOIN "Dealer_data"."inventory" ON "sell"."inventory_id" = "inventory"."id_inventory"
    LEFT JOIN "Dealer_data"."users" ON "users"."id_users" = "invoice"."users_id"
  WHERE
    "requisites_creating_date_time" >= ? AND "requisites_creating_date_time" <= ?
)
AS t
GROUP BY requisites_creating_date_time
ORDER BY requisites_creating_date_time DESC';
        return $this->db->query($sql, array($period_start, $period_end))->result();
    }

    public function get_statistics_operator_daily($user_id, $period_start = NULL, $period_end = NULL) {
        if (is_null($period_start) || is_null($period_end)) {
            $period_start = date("Y") . "-" . date("m") . "-" . date("01") . " 00:00:00";
            $period_end = date("Y") . "-" . date("m") . "-" . date("t") . " 23:59:59";
        }
        $sql = 'SELECT requisites_creating_date_time, sum(edscount) as edscount, sum(tokencount)as tokencount, count(DISTINCT(invoice_111)) as invoice_count, sum(pay_sum) as pay_sum FROM
(
  SELECT
    to_date(to_char("requisites_creating_date_time",\'DD-MM-YYYY\'), \'DD-MM-YYYY\') as requisites_creating_date_time,
    CASE WHEN inventory_id = 2 THEN "count" ELSE \'0\' END as tokencount,
    CASE WHEN inventory_id = 1 OR inventory_id = 3 OR inventory_id = 5 THEN "count" ELSE \'0\' END as edscount,
    "invoice"."id_invoice" as invoice_111,
    invoice.pay_sum as pay_sum
  FROM "Dealer_data"."invoice"
    LEFT JOIN "Dealer_data"."requisites" ON "requisites"."requisites_invoice_id" = "invoice"."id_invoice"
    LEFT JOIN "Dealer_data"."sell" ON "sell"."invoice_id" = "invoice"."id_invoice"
    LEFT JOIN "Dealer_data"."inventory" ON "sell"."inventory_id" = "inventory"."id_inventory"
    LEFT JOIN "Dealer_data"."users" ON "users"."id_users" = "invoice"."users_id"
  WHERE
    "requisites_creating_date_time" >= ? AND "requisites_creating_date_time" <= ?
  AND "users"."id_users" = ?
)
AS t
GROUP BY requisites_creating_date_time
ORDER BY requisites_creating_date_time DESC';
        return $this->db->query($sql, array($period_start, $period_end, $user_id))->result();
    }

    public function get_statistics_operator_period($period_start, $period_end) {
//        $this->db->select('sum(COALESCE((SELECT "count" FROM "Dealer_data".sell WHERE invoice_id=id_invoice AND inventory_id =2),\'0\')) AS TokenCount')->
//                select('sum(COALESCE((SELECT "count" FROM "Dealer_data".sell WHERE invoice_id=id_invoice AND inventory_id =1),\'0\')) AS EDSCount')->
//                select('count(invoice.id_invoice) AS invoice_count')->
//                from('"Dealer_data".invoice')->
//                join('"Dealer_data".users', 'invoice.users_id = users.id_users', 'left')->
//                join('"Dealer_data".distributor', 'users.distributor_id = distributor.id_distributor', 'left')->
//                join('"Dealer_data".requisites', 'requisites.requisites_invoice_id = invoice.id_invoice', 'left')->
//                where('users.id_users', $this->session->userdata['logged_in']['UserID'])->
//                where('requisites.requisites_creating_date_time>=', $period_start)->
//                where('requisites.requisites_creating_date_time<=', $period_end);
//        return $this->db->get()->row();
        $sql = 'SELECT requisites_creating_date_time, sum(edscount) as edscount, sum(tokencount)as tokencount, count(DISTINCT(invoice_111)) as invoice_count FROM
(
  SELECT
    to_date(to_char("requisites_creating_date_time",\'DD-MM-YYYY\'), \'DD-MM-YYYY\') as requisites_creating_date_time,
    CASE WHEN inventory_id = 2 THEN "count" ELSE \'0\' END as tokencount,
    CASE WHEN inventory_id = 1 OR inventory_id = 3 OR inventory_id = 5 THEN "count" ELSE \'0\' END as edscount,
    "invoice"."id_invoice" as invoice_111
  FROM "Dealer_data"."invoice"
    LEFT JOIN "Dealer_data"."requisites" ON "requisites"."requisites_invoice_id" = "invoice"."id_invoice"
    LEFT JOIN "Dealer_data"."sell" ON "sell"."invoice_id" = "invoice"."id_invoice"
    LEFT JOIN "Dealer_data"."inventory" ON "sell"."inventory_id" = "inventory"."id_inventory"
    LEFT JOIN "Dealer_data"."users" ON "users"."id_users" = "invoice"."users_id"
  WHERE
    "requisites_creating_date_time" >= ? AND "requisites_creating_date_time" <= ?
  AND "users"."id_users" = ?
)
AS t
GROUP BY requisites_creating_date_time
ORDER BY requisites_creating_date_time DESC';
        return $this->db->query($sql, array($period_start, $period_end, $this->session->userdata['logged_in']['UserID']))->result();
    }

    public function get_statistics_operator_reiting($period_start = NULL, $period_end = NULL) {
        if (is_null($period_start) || is_null($period_end)) {
            $period_start = date("Y") . "-" . date("m") . "-" . date("01") . " 00:00:00";
            $period_end = date("Y") . "-" . date("m") . "-" . date("t") . " 23:59:59";
        }
        return $this->db->select("CONCAT (users.surname, ' ',users.\"name\",' ',users.patronymic_name) AS UserName")->
                        select("count(requisites.id_requisites) AS count")->
                        from('"Dealer_data".users')->
                        join('"Dealer_data".invoice', 'invoice.users_id = users.id_users', 'left')->
                        join('"Dealer_data".requisites', 'requisites.requisites_invoice_id = invoice.id_invoice', 'left')->
                        where('"users".role_id', 3)->// ID ROLE - Operator = 3
                        where('requisites_creating_date_time >=', $period_start)->
                        where('requisites_creating_date_time <=', $period_end)->
                        group_by('username')->
                        order_by('count', 'DESC')->get()->result(); //DESC MAST HAVE 
    }

    public function get_statistics_boss_cash_history($limit, $offset, $search = NULL) {
        $this->db->select('Dealer_payments"."PayLog"."Account')->
                select('"Dealer_data".invoice.company_name')->
                select('Dealer_payments"."PayLog"."Sum')->
                select('to_char("Dealer_data".invoice.pay_date_time, \'DD-MM-YYYY HH24:MI\')AS pay_date_time')->
                select('"Dealer_payments"."PaymentSystem"."Name"')->
                from('"Dealer_payments"."PayLog"')->
                join('"Dealer_data".invoice', 'invoice.invoice_serial_number = PayLog.Account', 'inner')->
                join('"Dealer_payments"."PaymentSystem"', 'PaymentSystem.IDPaymentSystem = PayLog.PaymentSystemID', 'inner');
        !is_null($search) ? $this->db->like('"PayLog"."Account', $search)->
                                or_like('invoice.company_name', $search)->
                                or_like('lower(invoice.company_name)', $search)->
                                or_like('upper(invoice.company_name)', $search)->
                                or_like('invoice.inn', $search) : '';
        return $this->db->limit($limit)->offset($offset)->order_by('"PayLog".IDPayLog', 'DESC')->get()->result();
    }

    public function get_statistics_error_eds_pki_ext($period_start, $period_end, $user_id = null) {
        $this->db->select('invoice.invoice_serial_number')->
                select('invoice.inn')->
                select('COALESCE((SELECT "count" FROM "Dealer_data".sell WHERE invoice_id=id_invoice AND (inventory_id =1 OR inventory_id =3 OR inventory_id =5)),\'0\') AS EDSCount')->//???????
                select('to_char(requisites.requisites_creating_date_time,\'DD.MM.YYYY HH24:MI\') AS creatingdatetime')->
                select('users."name" AS username');
        is_null($user_id) ? NULL : $this->db->select("CONCAT (users.surname, ' ',users.\"name\",' ',users.patronymic_name) AS user_full_name");
        $this->db->from('"Dealer_data".requisites')->
                join('"Dealer_data".invoice', 'requisites.requisites_invoice_id = invoice.id_invoice', 'left')->
                join('Dealer_data".pay_invoice', 'requisites.pay_invoice_id = id_pay_invoice', 'left')->
                join('"Dealer_data".users', 'invoice.users_id = users.id_users', 'left');
        is_null($user_id) ? NULL : $this->db->where('users.id_users', $user_id);
        $this->db->where('requisites_creating_date_time >=', $period_start)->
                where('requisites_creating_date_time <=', $period_end);

        return $this->db->order_by('creatingdatetime')->get()->result();
    }

    public function get_statistics_pki($period_start, $period_end, $inn = NULL) {
        $DbPki = $this->load->database('pki', TRUE);
        $DbPki->select('DATE_FORMAT(DateStart, \'%d.%m.%Y %H:%i\') AS DateStart')->
                select('inn')->
                select('OrgName')->
                select('Owner')->
                select('Title')->
                from('Cert')->
                join('Owner', 'Cert.OwnerID = Owner.id')->
                join('Org', 'Owner.OrgID = Org.id')->
                where('DateStart >=', $period_start)->
                where('DateStart <=', $period_end);
        !is_null($inn) ? $DbPki->where('inn', $inn) : NULL;
        return $DbPki->get()->result();
    }

}

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Messages_model extends CI_Model {

    public function get_messages($limit, $offset) {
        return $this->db->select('messages.headline')->
                        select('messages.message')->
                        select("to_char(messages.creating_datetime,'DD.MM.YYYY HH24:MI') AS creating_datetime")->
                        select('users.surname')->
                        select('users.name')->
                        from('"Dealer_data".messages')->
                        join('"Dealer_data".users', 'users.id_users=messages.users_id')->
                        //where('messages.status', $status)->
                        order_by('id_messages', 'DESC')->
                        limit($limit)->
                        offset($offset)->
                        get()->result();
    }

    public function create_message($message) {
        $MessageBatch = array('message' => $message, users_id => $this->session->userdata['logged_in']['UserID']);
        $this->db->insert('"Dealer_data".messages', $MessageBatch);
        //return "Cообщение успешно создано";
    }

    public function record_count() {
        //$this->db->where('messages.status', $status);
        return $this->db->count_all_results('"Dealer_data".messages');
    }

}

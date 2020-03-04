<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_table_files extends CI_Migration
{

    public function up()
    {
        $this->db->empty_table('Dealer_data".ci_sessions');

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_field(
            array(
                'requisites_id' => array(
                    'type' => 'INT',
                    'null' => FALSE
                ),
                'fileid' => array(
                    'type' => 'TEXT',
                    'null' => FALSE
                ),
                'timestamp' => array(
                    'type' => 'BIGINT',
                    'default' => 0,
                    'null' => FALSE
                )
            )
        );
        $this->dbforge->add_field('CONSTRAINT FOREIGN KEY (filetype_id) REFERENCES "Dealer_data".requisites(id_requisites)');
        $this->dbforge->create_table('"Dealer_data".files', TRUE);
        $this->dbforge->add_column('"Dealer_data".files', [
            'CONSTRAINT FOREIGN KEY (filetype_id) REFERENCES "Dealer_data".requisites(id_requisites)',
        ]);
    }

    public function down()
    {
        $this->dbforge->drop_table('"Dealer_data".files');
    }
}

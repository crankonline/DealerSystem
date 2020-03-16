<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_table_files extends CI_Migration
{

    public function up()
    {
        $this->db->empty_table('"Dealer_data".ci_sessions');

        $this->dbforge->add_field(
            array(
                'id_file_owner' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => true,
                    'auto_increment' => true,
                ),
                'name' => array(
                    'type' => 'TEXT',
                    'null' => false,
                ),
            )
        );
        $this->dbforge->add_field('PRIMARY KEY (id_file_owner)');
        $this->dbforge->create_table('Dealer_data.files_owner', true);

        $this->dbforge->add_field(
            array(
                'id_file_type' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => true,
                    'auto_increment' => true,
                ),
                'file_owner_id' => array(
                    'type' => 'INT',
                    'null' => false,
                ),
                'name' => array(
                    'type' => 'TEXT',
                    'null' => false,
                ),
            )
        );
        $this->dbforge->add_field('PRIMARY KEY (id_file_type)');
        $this->dbforge->add_field('FOREIGN KEY (file_owner_id) REFERENCES "Dealer_data".files_owner(id_file_owner)');
        $this->dbforge->create_table('Dealer_data.files_type', true);

        $this->dbforge->add_field(
            array(
                'id_files' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => true,
                    'auto_increment' => true,
                ),
                'requisites_id' => array(
                    'type' => 'INT',
                    'null' => false,
                ),
                'filetype_id' => array(
                    'type' => 'INT',
                    'null' => false,
                ),
                'file_ident' => array(
                    'type' => 'TEXT',
                    'null' => false,
                ),
                'timestamp' => array(
                    'type' => 'TIMESTAMP',
                    'default' => 'NOW()',
                    'null' => false,
                ),
            )
        );
        $this->dbforge->add_field('PRIMARY KEY (id_files)');
        $this->dbforge->add_field('FOREIGN KEY (requisites_id) REFERENCES "Dealer_data".requisites(id_requisites)');
        $this->dbforge->add_field('FOREIGN KEY (filetype_id) REFERENCES "Dealer_data".files_type(id_file_type)');
        $this->dbforge->create_table('Dealer_data.files_juridical', true);

        $this->dbforge->add_field(
            array(
                'id_files' => array(
                    'type' => 'INT',
                    'constraint' => 5,
                    'unsigned' => true,
                    'auto_increment' => true,
                ),
                'requisites_id' => array(
                    'type' => 'INT',
                    'null' => false,
                ),
                'filetype_id' => array(
                    'type' => 'INT',
                    'null' => false,
                ),
                'representative_ident' => array(
                    'type' => 'text',
                    'null' => false,
                ),
                'file_ident' => array(
                    'type' => 'TEXT',
                    'null' => false,
                ),
                'timestamp' => array(
                    'type' => 'TIMESTAMP',
                    'default' => 'NOW()',
                    'null' => false,
                ),
            )
        );
        $this->dbforge->add_field('PRIMARY KEY (id_files)');
        $this->dbforge->add_field('FOREIGN KEY (requisites_id) REFERENCES "Dealer_data".requisites(id_requisites)');
        $this->dbforge->add_field('FOREIGN KEY (filetype_id) REFERENCES "Dealer_data".files_type(id_file_type)');
        $this->dbforge->create_table('Dealer_data.files_representatives', true);

        $data = array(
            array(
                'name' => 'Juridical'
            ),
            array(
                'name' => 'Representatives'
            )
        );
        $this->db->insert_batch('"Dealer_data".files_owner', $data);

        $data = array(
            array(
                'file_owner_id' => 1,
                'name' => 'Свидетельство о государственной регистрации Министерсва Юстиции (Русская стороная)'
            ),
            array(
                'file_owner_id' => 1,
                'name' => 'Свидетельство о государственной регистрации Министерсва Юстиции (Кыргызская стороная)'
            ),
            array(
                'file_owner_id' => 1,
                'name' => 'Форма М2А'
            ),
            array(
                'file_owner_id' => 2,
                'name' => 'Паспорт физического лица (Cторона 1)'
            ),
            array(
                'file_owner_id' => 2,
                'name' => 'Паспорт физического лица (Cторона 2)'
            ),
            array(
                'file_owner_id' => 2,
                'name' => 'Нотариально заверенная копия'
            ),

        );
        $this->db->insert_batch('"Dealer_data".files_type', $data);
    }

    public function down()
    {
        $this->dbforge->drop_table('"Dealer_data".files_representatives');
        $this->dbforge->drop_table('"Dealer_data".files_juridical');
        $this->dbforge->drop_table('"Dealer_data".files_type');
        $this->dbforge->drop_table('"Dealer_data".files_owner');
    }
}

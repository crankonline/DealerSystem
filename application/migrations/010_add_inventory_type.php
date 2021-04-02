<?php
defined('BASEPATH') or exit('No direct script access allowed');

class  Migration_Add_inventory_type extends CI_Migration
{
    public function up()
    {
        $this->db->empty_table('"Dealer_data".ci_sessions');

        $this->db->query(
            <<<SQL
 create table if not exists "Dealer_data" . inventory_type
(
    id_inventory_type serial not null
		constraint inventory_type_pk
		primary key,
	    name varchar not null);
SQL
        );
        $this->db->query(
            <<<SQL
INSERT INTO "Dealer_data" . inventory_type(id_inventory_type, name) VALUES(1, 'Электронная подпись');
INSERT INTO "Dealer_data" . inventory_type(id_inventory_type, name) VALUES(2, 'Носитель ЭП');
INSERT INTO "Dealer_data" . inventory_type(id_inventory_type, name) VALUES(3, 'Отчетность');
SQL
        );
        $this->db->query(
            <<<SQL
alter table "Dealer_data".inventory
	add inventory_type_id int;
		
alter table "Dealer_data" . inventory
	add constraint inventory_inventory_type_id_inventory_type_fk
	foreign key(inventory_type_id) references "Dealer_data" . inventory_type;
SQL
        );
    }

    public function down()
    {
        $this->db->query(
            <<<SQL
drop table if exists "Dealer_data" . inventory_type
SQL
        );
    }
}
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_Create_schema_images extends CI_Migration {

    public function up() {
        $this->db->empty_table('"Dealer_data".ci_sessions');

        $sql = <<<SQL
create schema if not exists "Dealer_images";

create table if not exists "Dealer_images".files_owner
(
	id_file_owner serial not null
		constraint files_owner_pkey
			primary key,
	name text not null
);

create table if not exists "Dealer_images".files_type
(
	id_file_type serial not null
		constraint files_type_pkey
			primary key,
	file_owner_id integer not null
		constraint files_type_file_owner_id_fkey
			references files_owner,
	name text not null
);

create table if not exists "Dealer_images".files_representatives
(
	id_files serial not null
		constraint files_representatives_pkey
			primary key,
	requisites_id integer not null
		constraint files_representatives_requisites_id_fkey
			references "Dealer_data".requisites,
	filetype_id integer not null
		constraint files_representatives_filetype_id_fkey
			references files_type,
	representative_ident text not null,
	file_ident text not null,
	timestamp timestamp default (now())::timestamp without time zone not null
);

create table if not exists "Dealer_images".files_juridical
(
	id_files serial not null
		constraint files_juridical_pkey
			primary key,
	requisites_id integer not null
		constraint files_juridical_requisites_id_fkey
			references "Dealer_data".requisites,
	filetype_id integer not null
		constraint files_juridical_filetype_id_fkey
			references files_type,
	file_ident text not null,
	timestamp timestamp default (now())::timestamp without time zone not null
);

SQL;
        $this->db->query($sql);
    }

    public function down() {
        
    }

}

<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_Regions extends CI_Migration
{
	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'city' => array(
				'type' => 'VARCHAR',
				'constraint' => '50',
			),
			'town' => array(
				'type' => 'TEXT',
			),
			'district' => array(
				'type' => 'TEXT',
			),
			'active' => array(
				'type' => 'INT',
				'constraint' => 10
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('regions');
		
	}

	public function down()
	{
		$this->dbforge->drop_table('regions');
	}

}
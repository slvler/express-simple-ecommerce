<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_Payment_method extends CI_Migration
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
			'title' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
			),
			'active' => array(
				'type' => 'INT',
				'constraint' => 10
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('payment_method');
		
	}

	public function down()
	{
		$this->dbforge->drop_table('payment_method');
	}

}
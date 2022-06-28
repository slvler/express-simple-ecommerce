<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Install_Basket extends CI_Migration
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
			'order_key' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				),
			'member_id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => TRUE,
				),
			'region_id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => TRUE,
				),
			'address_id' => array(
				'type' => 'TEXT',
				),
			'products' => array(
				'type' => 'TEXT',
				),
			'note' => array(
				'type' => 'TEXT',
				),
			'discount_price' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				),
			'total' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				),
			'installment' => array(
				'type' => 'INT',
				'constraint' => 2,
				'null' => TRUE,
				),
			'payment_status' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				),
			'status' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				),
			'failed_text' => array(
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => TRUE,
				),
			'date' => array(
				'type' => 'DATETIME',
				'null' => FALSE,
				)
			));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('order');
		
	}

	public function down()
	{
		$this->dbforge->drop_table('order');
	}

}
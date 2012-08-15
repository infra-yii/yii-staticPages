<?php

class m120815_111008_staticPageOnMainMenu extends CDbMigration
{
	public function up()
	{
        $this->addColumn("{{static_page}}", "in_main_menu", "tinyint(1) DEFAULT 0");
	}

	public function down()
	{
		echo "m120815_111008_staticPageOnMainMenu does not support migration down.\n";
		return false;
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}
<?php

class m120716_142029_static extends CDbMigration
{
    public function up()
    {
        $this->createTable('{{static_page}}', array(
            'id' => 'pk',
            'parent_id' => 'int DEFAULT null',
            'title' => 'varchar(255)',
            'content' => 'text',
            'sorting' => 'int DEFAULT 0',
        ), "Engine=InnoDB CHARACTER SET utf8");
        $this->addForeignKey("parent_page", "{{static_page}}", "parent_id", "{{static_page}}", "id", null, "CASCADE");
        $this->createIndex("page_sorting", "{{static_page}}", "sorting");
    }

    public function down()
    {
        $this->dropTable('{{static_page}}');
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
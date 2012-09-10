<?php

class m120815_135347_staticPageDivide extends CDbMigration
{
    public function down()
    {
        echo "m120815_135347_staticPageDivide does not support migration down.\n";
        return false;
    }

    public function safeUp()
    {
        $this->createTable("{{static_page_content}}", array(
            "id" => "pk",
            "page_id" => "INT",
            "content" => "TEXT",
        ), "Engine=InnoDB CHARACTER SET utf8");
        $this->createIndex("page_content_id_index", "{{static_page_content}}", "page_id", true);
        $this->addForeignKey("static_page_body", "{{static_page_content}}", "page_id", "{{static_page}}", "id", "CASCADE", "CASCADE");

        $pages = $this->dbConnection->createCommand()->select("id, content")->from("tbl_static_page")->queryAll();
        foreach ($pages as $p) {
            $this->dbConnection->createCommand()->insert("tbl_static_page_content", array(
                "content" => $p["content"],
                "page_id" => $p["id"]
            ));
        }

        $this->dropColumn("{{static_page}}", "content");
    }
}
<?php

use yii\db\Schema;
use yii\db\Migration;

class m150919_215317_cm_content extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cm_content}}', [
            'id' => Schema::TYPE_PK,
            'key' => Schema::TYPE_STRING . ' NOT NULL COMMENT "Content key"',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL DEFAULT 1 COMMENT "Status"',
            'created_at' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "Created"',
            'updated_at' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "Updated"',
        ], $tableOptions);

        $this->execute("ALTER TABLE {{%cm_content}} COMMENT 'Content table'");
    }

    public function down()
    {
        echo "m150919_215317_cm_content cannot be reverted.\n";

        return false;
    }
}

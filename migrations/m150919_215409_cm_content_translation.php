<?php

use yii\db\Schema;
use yii\db\Migration;

class m150919_215409_cm_content_translation extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%cm_content_translation}}', [
            'content_id' => Schema::TYPE_INTEGER . ' NOT NULL COMMENT "Content ID"',
            'language' => Schema::TYPE_STRING . '(16) NOT NULL COMMENT "Language"',
            'name' => Schema::TYPE_STRING . ' NOT NULL COMMENT "Content description"',
            'content' => Schema::TYPE_TEXT . ' NULL COMMENT "Content"',
        ], $tableOptions);

        $this->addPrimaryKey('', '{{%cm_content_translation}}', ['content_id', 'language']);

        $this->execute("ALTER TABLE {{%cm_content_translation}} COMMENT 'Translations of content'");
    }

    public function down()
    {
        echo "m150919_215409_cm_content_translation cannot be reverted.\n";

        return false;
    }
}

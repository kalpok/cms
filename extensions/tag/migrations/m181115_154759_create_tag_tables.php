<?php

use yii\db\Migration;

class m181115_154759_create_tag_tables extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%tag}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'frequency' => $this->integer()->notNull()->defaultValue(0)
        ],$tableOptions);

        $this->createTable('{{%tag_module}}', [
            'id' => $this->primaryKey(),
            'tagId' => $this->integer()->notNull(),
            'moduleId' => $this->string()->notNull(),
            'modelClassName' => $this->string()->notNull(),
            'modelId' => $this->integer()->notNull()
        ],$tableOptions);

        $this->addForeignKey(
            'FK_tag_module_tag',
            'tag_module',
            'tagId',
            'tag',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('{{%tag_module}}');
        $this->dropTable('{{%tag}}');
    }
}

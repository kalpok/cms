<?php

use yii\db\Migration;

class m180810_064647_create_notification_table extends Migration
{
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('notification', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'category' => $this->string()->notNull(),
            'description' => $this->text(),
            'route' => $this->string(),
            'class' => $this->string()->notNull(),
            'module' => $this->string()->notNull(),
            'seen' => $this->boolean()->notNull()->defaultValue(false),
            'read' => $this->boolean()->notNull()->defaultValue(false),
            'userId' => $this->integer()->unsigned()->notNull(),
            'createdAt' => $this->integer()->unsigned()->notNull()
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('notification');
    }
}

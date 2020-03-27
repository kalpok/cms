<?php

use yii\db\Migration;

class m180704_073705_create_comment_table extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions =
                'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('comment', [
            'id' => $this->primaryKey(),
            'content' => $this->text()->notNull(),
            'insertedBy' => $this->integer(),
            'inserterName' => $this->string(),
            'inserterEmail' => $this->string(),
            'inserterIp' => $this->string(),
            'insertedAt' => $this->integer()->notNull(),
            'reply' => $this->text(),
            'repliedBy' => $this->integer(),
            'repliedAt' => $this->integer(),
            'status' => $this->tinyInteger()->notNull()->defaultValue(1)
                ->comment('1 => pending, 2 => reject, 3 => accept'),
            'moduleId' => $this->string()->notNull(),
            'ownerId' => $this->integer()->notNull(),
            'ownerClassName' => $this->string()->notNull()
        ], $tableOptions);

        $this->createIndex(
            'IDX_comment_moduleId',
            'comment',
            'moduleId'
        );

        $this->createIndex(
            'IDX_comment_ownerId',
            'comment',
            'ownerId'
        );

        $this->createIndex(
            'IDX_comment_ownerClassName',
            'comment',
            'ownerClassName'
        );

        $this->addForeignKey(
            'FK_comment_user_insertedBy',
            'comment',
            'insertedBy',
            'user',
            'id',
            'SET NULL',
            'CASCADE'
        );

        $this->addForeignKey(
            'FK_comment_user_repliedBy',
            'comment',
            'repliedBy',
            'user',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    public function safeDown()
    {
        $this->dropTable('comment');
    }
}

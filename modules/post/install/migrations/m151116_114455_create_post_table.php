<?php

use yii\db\Schema;
use yii\db\Migration;

class m151116_114455_create_post_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%post}}', array(
            'id' => 'pk',
            'title' => 'string COLLATE utf8_unicode_ci NOT NULL',
            'summary' => 'text COLLATE utf8_unicode_ci',
            'content' => 'text COLLATE utf8_unicode_ci NOT NULL',
            'language' => 'string',
            'slug' => 'string NOT NULL',
            'createdAt' => 'int(10) NOT NULL',
            'updatedAt' => 'int(10) NOT NULL',
            'isActive' => 'boolean NOT NULL DEFAULT 1',
            'priority' => 'smallint',
        ));

        $this->createTable('{{%post_category}}', array(
            'id' => 'pk',
            'title' => 'varchar(255) NOT NULL',
            'description' => 'text COLLATE utf8_unicode_ci',
            'language' => 'string',
            'slug' => 'string NOT NULL',
            'createdAt' => 'int(10) NOT NULL',
            'updatedAt' => 'int(10) NOT NULL',
            'isActive' => 'boolean NOT NULL DEFAULT 1',
        ));

        $this->createTable('{{%post_category_relation}}', array(
            'postId' => 'int(10) NOT NULL',
            'categoryId' => 'int(10) NOT NULL',
        ));

        $this->addPrimaryKey('PK_post_category_relation', '{{%post_category_relation}}', 'postId, categoryId');
        $this->addForeignKey('FK_post', '{{%post_category_relation}}', 'postId', '{{%post}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('FK_category', '{{%post_category_relation}}', 'categoryId', '{{%post_category}}', 'id', 'CASCADE', 'RESTRICT');
    }

    public function down()
    {
        $this->dropForeignKey('FK_post','{{%post_category_relation}}');
        $this->dropForeignKey('FK_category','{{%post_category_relation}}');
        $this->dropTable('{{%post}}');
        $this->dropTable('{{%post_category}}');
        $this->dropTable('{{%post_category_relation}}');
    }
}

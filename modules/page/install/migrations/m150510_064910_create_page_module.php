<?php

use yii\db\Schema;
use yii\db\Migration;

class m150510_064910_create_page_module extends Migration
{
    public function up()
    {
        $this->createTable('page', array(
            'id' => Schema::TYPE_PK,
            'language' => 'string',
            'title' => Schema::TYPE_STRING . ' COLLATE utf8_unicode_ci NOT NULL',
            'content' => 'text COLLATE utf8_unicode_ci NOT NULL',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER .  ' NOT NULL',
            'isActive' => 'boolean NOT NULL DEFAULT 1',
            'root' => Schema::TYPE_INTEGER . ' UNSIGNED NULL',
            'lft' => Schema::TYPE_INTEGER . ' NOT NULL',
            'rgt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'depth' => Schema::TYPE_INTEGER . ' NOT NULL'
        ));
        $this->createIndex('root', 'page', 'root');
        $this->createIndex('left', 'page', 'lft');
        $this->createIndex('right', 'page', 'rgt');
    }

    public function down()
    {
        $this->dropTable('page');
    }

}

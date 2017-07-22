<?php

use yii\db\Schema;
use yii\db\Migration;
use yii\base\Security;

class m150308_124115_create_user_module_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%user}}', [
            'id' => 'pk',
            'email' => 'string NOT NULL UNIQUE',
            'authKey' => 'string NOT NULL UNIQUE',
            'passwordHash' => 'string NOT NULL',
            'randomToken' => 'string UNIQUE',
            'status' => 'smallint NOT NULL DEFAULT 2'.
                ' COMMENT "1 => active, 2 => not active, 3 => banned"',
            'type' => 'smallint NOT NULL DEFAULT 1'.
                ' COMMENT "1=>normal user, 2=>operator, 3=>editor, 4=>superuser "',
            'failedAttempts' => 'smallint NOT NULL DEFAULT 0',
            'lastLoggedInAt' => 'integer',
            'createdAt' => 'integer NOT NULL',
            'updatedAt' => 'integer NOT NULL',
        ], $tableOptions);

        $security = new Security;

        $this->insert(
            'user',
            [
                'email' => 'admin@example.com',
                'authKey' => $security->generateRandomString(),
                'passwordHash' => $security->generatePasswordHash('admin123'),
                'randomToken' => $security->generateRandomString(),
                'status' => 1,
                'type' => 4,
                'createdAt' => time(),
                'updatedAt' => time(),
            ]
        );
    }

    public function down()
    {
        echo "m150308_124115_create_user_module_table cannot be reverted.\n";

        return false;
    }
}

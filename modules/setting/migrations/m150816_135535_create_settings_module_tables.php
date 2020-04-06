<?php

use yii\db\Schema;
use yii\db\Migration;

class m150816_135535_create_settings_module_tables extends Migration
{
    public function up()
    {
        $this->createTable('{{%setting}}', array(
             'id' => $this->primaryKey(),
             'key' => $this->string(255)->notNull(),
             'value' => $this->string(1023)
        ));

        $this->batchInsert('{{%setting}}',
            $columns = ['key'],
            $rows = [
                ['email.senderEmail'],
                ['email.senderName'],
                ['email.smtpServer'],
                ['email.smtpUsername'],
                ['email.smtpPassword'],
                ['website.googleAnalytics'],
            ]
        );

        $this->batchInsert('{{%setting}}',
            $columns = ['key','value'],
            $rows = [
                ['website.cache', 1],
                ['website.timezone', 'Asia/Tehran'],
                ['website.deactiveUser', 1],
                ['website.failedLoginAttempts', 5],
                ['website.maintenanceMode', 0],
                ['email.protocol', 'smtp'],
                ['email.smtpPort', 25],
            ]
        );
    }

    public function down()
    {
        $this->dropTable('{{%setting}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

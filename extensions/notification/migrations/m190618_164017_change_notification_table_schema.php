<?php

use yii\db\Migration;

class m190618_164017_change_notification_table_schema extends Migration
{
    public function safeUp()
    {
        $this->dropColumn('notification', 'category');
        $this->addColumn('notification', 'category', $this->string());
        $this->renameColumn('notification', 'module', 'moduleId');
        $this->dropColumn('notification', 'userId');
        $this->addColumn('notification', 'userId', $this->integer()->unsigned());
        $this->addColumn('notification', 'data', $this->text());
    }

    public function safeDown()
    {
        echo "m190618_164017_change_notification_table_schema cannot be reverted.\n";
        return false;
    }
}

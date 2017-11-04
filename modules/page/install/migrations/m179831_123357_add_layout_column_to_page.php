<?php

use yii\db\Schema;
use yii\db\Migration;

class m179831_123357_add_layout_column_to_page extends Migration
{
    public function up()
    {
        $this->addColumn('page', 'layout', 'string');
    }

    public function down()
    {
        echo "m179831_123357_add_layout_column_to_page cannot be reverted.\n";

        return false;
    }
}

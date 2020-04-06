<?php

use yii\db\Schema;
use yii\db\Migration;

class m160831_123357_add_summary_column_to_page extends Migration
{
    public function up()
    {
        $this->addColumn('{{%page}}', 'summary', 'text');
    }

    public function down()
    {
        echo "m150831_123357_add_gallery_column_to_page cannot be reverted.\n";

        return false;
    }
}

<?php

use yii\db\Migration;

class m200719_185208_add_visit_counter_column_to_post_table extends Migration
{
    public function safeUp()
    {
        $this->addColumn(
            'post',
            'visitCounter',
            $this->integer()
        );
    }

    public function safeDown()
    {
        $this->dropColumn(
            'post',
            'visitCounter'
        );
    }
}

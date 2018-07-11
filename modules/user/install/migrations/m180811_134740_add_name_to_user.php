<?php

use yii\db\Migration;

class m180811_134740_add_name_to_user extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'name', $this->string());
        $this->addColumn('user', 'surname', $this->string());
        $this->addColumn('user', 'phone', $this->string());
        $this->addColumn('user', 'identityCode', $this->string());
    }

    public function down()
    {
        return false;
    }
}

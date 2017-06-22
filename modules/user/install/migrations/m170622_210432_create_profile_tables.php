<?php

use yii\db\Migration;

class m170622_210432_create_profile_tables extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{user_profile_field}}', [
                'id' => $this->primaryKey(),
                'language' => $this->string(),
                'label' => $this->string(),
                'type' => $this->string(),
                'priority' => $this->integer(),
                'createdAt' => $this->integer(),
                'updatedAt' => $this->integer()
            ], $tableOptions);
        $this->createTable('{{user_profile_data}}', [
                'id' => $this->primaryKey(),
                'userId' => $this->integer(),
                'profileFieldId' => $this->integer(),
                'data' => $this->text(),
                'createdAt' => $this->integer(),
                'updatedAt' => $this->integer()
            ], $tableOptions);
        $this->addForeignKey('FK_user_prfile_2_user', '{{user_profile_data}}', 'userId', '{{user}}', 'id');
        $this->addForeignKey('FK_user_prfile_2_profile_field', '{{user_profile_data}}', 'profileFieldId', '{{user_profile_field}}', 'id');
    }

    public function down()
    {
        $this->dropForeignKey('FK_user_prfile_2_profile_field', '{{user_profile_data}}');
        $this->dropForeignKey('FK_user_prfile_2_user', '{{user_profile_data}}');
        $this->dropTable('{{user_profile_data}}');
        $this->dropTable('{{user_profile_field}}');
    }
}

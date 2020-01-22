<?php

use yii\db\Schema;
use yii\db\Migration;

class m150525_064647_create_file_table extends Migration
{
    public function up()
    {
        $this->createTable(
            '{{%file}}',
            [
                'id' => 'pk',
                'filename' => 'string',
                'originalName' => 'string',
                'modelClassName' => 'string',
                'folderName' => 'string',
                'group' => 'string',
                'modelId' => 'integer',
                'extension' => 'string',
                'mimeType' => 'string',
                'byteSize' => 'integer',
                'hash' => 'string',
                'isImage' => 'boolean DEFAULT 0',
                'priority' => 'integer',
                'createdAt' => 'integer',
                'updatedAt' => 'integer'
            ]
        );
    }

    public function down()
    {
        $this->dropTable('{{%file}}');
    }
}

<?php

use yii\db\Schema;
use yii\db\Migration;

class m150831_123357_add_gallery_column_to_page extends Migration
{
    public function up()
    {
        $this->addColumn('page', 'galleryId', 'integer');
        $this->addForeignKey('page_gallery', 'page', 'galleryId', 'gallery', 'id');
    }

    public function down()
    {
        echo "m150831_123357_add_gallery_column_to_page cannot be reverted.\n";

        return false;
    }
}

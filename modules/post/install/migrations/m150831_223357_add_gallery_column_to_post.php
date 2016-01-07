<?php

use yii\db\Schema;
use yii\db\Migration;

class m150831_223357_add_gallery_column_to_post extends Migration
{
    public function up()
    {
        $this->addColumn('post', 'galleryId', 'integer');
        $this->addForeignKey('post_gallery', 'post', 'galleryId', 'gallery', 'id');
    }

    public function down()
    {
        echo "m150831_223357_add_gallery_column_to_post cannot be reverted.\n";

        return false;
    }
}

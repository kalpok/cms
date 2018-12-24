<?php

use yii\db\Schema;
use yii\db\Migration;

class m150826_115121_create_gallery_tables extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%gallery}}',
            [
                'id' => $this->primaryKey(),
                'handle' => $this->string(),
                'owner' => $this->string()
            ], $tableOptions
        );

        $this->createTable('{{%gallery_image}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'description' => $this->text(),
            'link' => $this->text(),
            'order' => $this->smallInteger(),
            'galleryId' => $this->integer()->notNull()
        ], $tableOptions);

        $this->addForeignKey(
            'gallery_image_fk',
            'gallery_image',
            'galleryId',
            'gallery',
            'id'
        );
    }

    public function down()
    {
        echo "m150826_115121_create_gallery_tables cannot be reverted.\n";

        return false;
    }
}

<?php

use yii\db\Migration;

class m200718_083853_add_meta_tags_setting extends Migration
{
    public function safeUp()
    {
        $this->batchInsert('setting',
            ['key','value'],
            [
                [
                    'website.metaKeywords',
                    ''
                ],
                [
                    'website.metaDescription',
                    ''
                ],
                [
                    'website.imageUrl',
                    ''
                ]
            ]
        );
    }
}

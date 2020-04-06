<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\GridView;
use extensions\gallery\models\Image;
use theme\widgets\Panel;
?>

<?php Panel::begin([
    'title' => 'عکس های گالری',
]) ?>
    <?php Pjax::begin([
        'id' => 'gallery-grid',
        'enablePushState' => false,
    ]); ?>
        <?= GridView::widget([
            'dataProvider' => $gallery->search(),
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'class' => 'core\grid\ThumbnailColumn',
                    'group' => 'gallery_image',
                    'preset' => 'gallery-grid',
                    'label' => false,
                    'options' => ['style' => 'width:25%;']
                ],
                'title',
                ['class' => 'core\grid\LinkColumn'],
                'order:farsiNumber',
                [
                    'class' => 'core\grid\ActionColumn',
                    'controller' => '/gallery',
                    'options' => ['style' => 'width:7%'],
                    'template' => '{edit-image} {remove-image}',
                    'buttons' => [
                        'edit-image' => function ($url, $model, $key) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                $url,
                                [
                                    'title' => 'ویرایش عکس',
                                    'data-pjax' => '0',
                                    'class' => 'ajaxupdate'
                                ]
                            );
                        },
                        'remove-image' => function ($url, $model, $key) {
                            return Html::a(
                                '<span class="glyphicon glyphicon-trash"></span>',
                                $url,
                                [
                                    'title' => 'حذف عکس',
                                    'data-confirmmsg' => 'آیا از حذف عکس مطمئن هستید؟',
                                    'data-pjax' => '0',
                                    'class' => 'ajaxdelete',
                                ]
                            );
                        }
                    ]
                ]
            ]
        ]); ?>
    <?php Pjax::end(); ?>
<?php Panel::end() ?>

<?php
$this->params['breadcrumbs'][] = ['label' => 'نوشته ها', 'url' => ['index']];
$this->params['breadcrumbs'][] = [
    'label' => $model->title,
    'url' => ['view', 'id' => $model->id]
];
$this->params['breadcrumbs'][] = 'گالری';
$this->title = 'مدیریت گالری نوشته';

echo $this->render(
    '@kalpok/gallery/views/index.php',
    [
        'gallery' => $gallery,
        'ownerId' => $model->id
    ]
);

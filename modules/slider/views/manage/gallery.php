<?php
$this->params['breadcrumbs'][] = 'اسلایدر صفحه نخست';
$this->title = 'مدیریت اسلایدر صفحه نخست';
?>

<?php
echo $this->render(
    '@kalpok/gallery/views/index.php',
    [
        'gallery' => $gallery
    ]
);

<?php
$this->params['breadcrumbs'][] = 'اسلایدر صفحه نخست';
$this->title = 'مدیریت اسلایدر صفحه نخست';
?>

<?php
echo $this->render(
    '@extensions/gallery/views/index.php',
    [
        'gallery' => $gallery
    ]
);

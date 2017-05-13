<?php
    use yii\helpers\Html;
?>
<div class="nestedpage-widget widget <?= $this->context->containerClass ?>">

    <?php if ($this->context->showTitle) : ?>
        <h4 class="<?= $this->context->titleClass ?>">
            <?php if (!empty($this->context->icon)) : ?>
                <i class="<?php echo $this->context->icon?>"></i>
            <?php endif ?>
            <?php echo $this->context->title; ?>
        </h4>
    <?php endif ?>

    <ul class="<?= $this->context->listClass ?>">
        <?php if (!$page->isRoot() && !empty($parent)) : ?>
            <li class="parent">
                <?= Html::a(
                    $this->context->listIcon.' '.$parent->title,
                    ['/page/front/view', 'slug' => $parent->slug]
                ); ?>
            </li>
        <?php elseif ($page->isRoot() or empty($parent)) : ?>
            <li class="active parent">
                <?= $this->context->listIcon.' '.$page->title; ?>
            </li>
        <?php endif ?>
        <?php
        $printArray = ($page->isRoot() or empty($parent)) ? $children : $sibling;
        ?>
        <?php foreach ($printArray as $node) : ?>
            <?php if ($node->id == $page->id) : ?>
                <li class="active">
                    <?= $this->context->listIcon.' '.$node->title ?>
                </li>
                    <?php if (isset($children)) : ?>
                        <ul>
                            <?php foreach ($children as $child) : ?>
                                <li>
                                <?= Html::a(
                                    $this->context->listIcon.' '.$child->title,
                                    [
                                        '/page/front/view',
                                        'slug' => $child->slug
                                    ]
                                ) ?>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    <?php endif ?>
            <?php else : ?>
                <li>
                <?= Html::a(
                    $this->context->listIcon.' '.$node->title,
                    [
                        '/page/front/view',
                        'slug' => $node->slug
                    ]
                ); ?>
                </li>
            <?php endif ?>
        <?php endforeach ?>
    </ul>
</div>

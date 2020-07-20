<div id="archive-accordion">
    <?php foreach ($list as $index => $item) : ?>
        <br>
        <a data-toggle="collapse" data-target="#archive<?= $index ?>" aria-expanded="true" aria-controls="collapseOne">
            <?= $item['label'] ?>
        </a>
        <div id="archive<?= $index ?>" class="collapse" aria-labelledby="headingOne" data-parent="#archive-accordion">
            <?= $item['content'] ?>
        </div>
    <?php endforeach; ?>
</div>

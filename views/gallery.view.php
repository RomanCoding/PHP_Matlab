<?php
view('_navbar');
?>
<div class="container-fluid">
    <div class="row">
        <?php foreach ($plots as $plot) : ?>
            <div class="col-xs-6 col-md-3 text-center">
                <a href="#" class="thumbnail">
                    <img src="<?= $plot->image ?>" onerror="this.src='load.gif';">
                </a>
                <ul>
                    <li>Радиус: <?= $plot->radius ?></li>
                    <li>Период: <?= $plot->period ?></li>
                    <li>Показатель преломления: <?= $plot->refrIndex ?></li>
                </ul>
                <p>Опубликовал <?= $plot->user()->email ?></p>
                <b><?= $plot->created_at ?></b>
            </div>
        <?php endforeach; ?>
    </div>
</div>
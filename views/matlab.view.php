<?php
use Core\App;

view('_navbar');
?>

<div class="container">
    <div class="col-md-4 col-md-offset-4">
        <form class="form-horizontal" role="form" method="POST" action="">
            <div class="form-group">
                <label for="radius" class="control-label">Радиус</label>
                <input type="number" class="form-control" name="radius" id="radius" required>
            </div>
            <div class="form-group">
                <label for="period" class="control-label">Период</label>
                <input type="number" class="form-control" name="period" id="period" required>
            </div>
            <div class="form-group">
                <label for="index" class="control-label">Показатель преломления</label>
                <input type="number" class="form-control" name="index" id="index" required>
            </div>
            <input type="hidden" name="matlabFile" value="graf1">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Скрин</button>
            </div>
        </form>
        <?php if (App::get('session')->hasFlash('errors')) : ?>
            <?php foreach (App::get('session')->get('errors') as $error) : ?>
                <div class="alert alert-danger" role="alert">
                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                    <span class="sr-only">Error:</span>
                    <?= $error ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

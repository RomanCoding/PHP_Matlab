<?php

use Core\App;

view('_navbar');
?>

<div class="container">
    <div class="col-md-6 col-md-offset-3">
        <form class="form-horizontal" role="form" method="POST" action="">
            <div class="form-group">
                <label for="email" class="control-label">E-Mail</label>
                <input type="text" class="form-control" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="password" class="control-label">Пароль</label>
                <input type="password" name="password" class="form-control"id="password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Регистрация</button>
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

<?php
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
            <input type="hidden" name="matlabFile" value="graf1">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Скрин</button>
            </div>
        </form>
    </div>
</div>

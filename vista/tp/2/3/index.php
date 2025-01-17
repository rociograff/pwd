<?php
$titulo = "TP2 - EJ3";
include_once '../../../estructura/cabecera.php';
?>
<div class="container-main text-center">
    <h2>Member Login</h2>
    <form class="needs-validation" novalidate name="form-ej3" action="verificaPass.php" method="post">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-floating col-md-4 mb-3">
                <input type="text" name="username" id="username" maxlength="15" placeholder="Username" class="form-control" required>
                <label for="username">Username</label>
                <div class="valid-feedback">Look good!</div>
                <div class="invalid-feedback">Please, enter your username!</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="form-floating col-md-4 mb-3">
                <input type="password" name="password" id="password" maxlength="15" placeholder="Password" minlength="8" class="form-control" required>
                <label for="password">Password</label>
                <div class="valid-feedback">Look good!</div>
                <div class="invalid-feedback">Please, enter your password!</div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <button class="btn btn-block btn-success w-100 btn-lg" type="submit">Login</button>
            </div>
        </div>
    </form>
</div>

<?php
include_once '../../../estructura/pie.php';

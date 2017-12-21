<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 21.12.2017
 * Time: 9:39
 */


?>

<?// print_r($data['background']) ?>

<section style="background: url('common/img/header/<?= $background ?>')">
    <div class="container">
        <div class="row">
            <div class="col-md-12 py-5 text-center">
                <h1><?= $title ?></h1>
            </div>
        </div>
    </div>
</section>
<div>
    <?= $content ?>
</div>
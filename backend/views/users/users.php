<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 20.11.2017
 * Time: 18:01
 */
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <? foreach($users as $user){ ?>
                <a href="<?='index.php?r=users%2Fedit&id='.$user['id']?>"><?=$user['username']?></a>
            <? } ?>
        </div>
    </div>
</div>

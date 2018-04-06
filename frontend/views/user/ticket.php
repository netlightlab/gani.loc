<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 06.04.2018
 * Time: 11:04
 */

use yii\widgets\Breadcrumbs;

$this->title = 'Билеты';

?>

<section class="section-header" style="background: url('../common/img/header/profile.jpg')">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="parallax-header-text">
                    <h2>ПРИВЕТСТВУЕМ ВАС <?= Yii::$app->user->identity->username ?>!</h2>
                    <p>Это Ваш личный кабинет. Здесь вы можете отслеживать статус своего заказа, просматривать список желаний и менять сведения о себе</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section style="background: #2e2e2e;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php $this->params['breadcrumbs'][] = $this->title; ?>
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
            </div>
        </div>
    </div>
</section>

<section id="ticket-data">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 style="text-align: center">Сертификат</h1>
                <p>Название тура: <?= $item->tour_name ?></p>
                <p>Компания: <?= $item->company_name ?></p>
                <p>Номер сертификата: <?= $item->certificate ?></p>
                <p>Номер заказа: <?= $item->order_num ?></p>
                <p>Количество билетов: <?= $item->qty ?></p>
                <p>Сумма: <?= $item->price ?></p>
            </div>
        </div>
    </div>
</section>

<a id="zxc" title="Распечатать проект">Распечатать</a>
<?php

$script = <<<JS
    
        var zxc = $('#zxc');
        zxc.on('click', function(){
            var prtContent = document.getElementById('ticket-data'); 
            // var prtCSS = '<link rel="stylesheet" href="/templates/css/template.css" type="text/css" />'; 
            var WinPrint = window.open('','','left=50,top=50,width=800,height=640,toolbar=0,scrollbars=1,status=0'); 
            WinPrint.document.write('<div id="print" class="contentpane">'); 
            // WinPrint.document.write(prtCSS); 
            WinPrint.document.write(prtContent.innerHTML); 
            WinPrint.document.write('</div>'); 
            WinPrint.document.close(); 
            WinPrint.focus(); 
            WinPrint.print(); 
            WinPrint.close(); 
            // prtContent.innerHTML=strOldOne;  
        });
JS;

$this->registerJs($script);

?>



<?php

/* @var $this yii\web\View */

$this->title = 'Туры и экскурсии по Казахстану по лучшим ценам!';

use yii\helpers\Html;
use common\models\Categories;

$category = new Categories();

?>

<section class="section-header-main">
    <video class="pageBg" src="/frontend/web/common/pages/1/uplmain.mp4" autoplay="" loop="" muted="" alt=""></video>
    <div class="container">
        <div class="row header-description-block">
            <div class="col-md-12 col-xs-12 text-center">
                <h1 id="flick" class="header-description"><?= Yii::t('app', 'ТУРЫ ПО КАЗАХСТАНУ') ?></h1>
            </div>
        </div>
        <?php $form = \yii\widgets\ActiveForm::begin([
                'action' => '/tours/search/',
                'method' => 'GET',
        ]) ?>
            <div class="row tour-block-white pb-2">
                <div class="col-md-12 tour-block-search">
                    <span><?= Yii::t('app', 'Поиск тура') ?></span>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 pb-3">
                    <?= Html::dropDownList('country_id', '', $searchForm['countries'], ['class' => 'form-control']) ?>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 pb-3">
                    <?= Html::dropDownList('city_id', '', $searchForm['cities'], ['class' => 'form-control']) ?>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 bg-white pb-3 position-relative">
                    <?= Html::submitButton(Yii::t('app', 'Поиск тура'), ['class' => 'search-tour-btn']) ?>
                    <img src="common/img/header/search.png" class="search-tour-img">
                </div>
            </div> <!-- BLOCK TOUR -->
            <div class="row bgGray pt-3 pb-3">
                <div class="col-md-12">
                    <?= Html::checkboxList('filter_categories', '', $searchForm['categories'], [
                        'class' => 'row',
                        'item' => function($index, $label, $name, $checked, $value){
                            $options = array_merge(['label' => $label, 'value' => $value], []);
                            return "<div class='col-md-4 col-xs-4'><label> <input hidden='true' type='checkbox' value='{$value}' name='{$name}'><span></span> {$label}</label></div>";
                        }
                    ]) ?>
                </div>
            </div>
        <?php \yii\widgets\ActiveForm::end(); ?>
    <!--</div>-->
</div>
</section>

<?php if($banner_top): ?>
<section style="background:#fbfbfb;">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center mt-4">
                <?= Html::a(Html::img('@web/common/banners/'.$banner_top->id.'/'.$banner_top->banner, ['style' => 'max-width: 100%']),$banner_top->link,['target' => 'blank']) ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<section style="background:#fbfbfb;">
    <div class="container">
        <!-- POPULAR TOUR -->
        <div class="row">
            <div class="col-md-12 col-xs-12 popular">
                <?= Yii::t('app', '<span class="popular-description">ПОПУЛЯРНЫЕ</span><span>направления</span>') ?>
            </div>
        </div>
        <div class="row">
            <?php foreach ($model as $tour):?>
                <articles class="col-md-4 col-sm-6 my-3">
                    <div class="boxTour-hit">
                        <?= Html::a('', ['/tours/view', 'id' => $tour->id], ['title' => $tour->name, 'class' => 'tour_link']) ?>
                        <div class="hit-sale"><b>Хит</b><br>Продаж</div>
                        <div class="tour-img">
                            <?= $tour->mini_image ? Html::img('@web/common/tour_img/'.$tour->id.'/'.$tour->mini_image) : Html::img('@web/common/users/no-image.png') ?>
                            <div class="tour-info">
                                <span><span style="font-weight:normal; font-size: 16px;">от</span> <?= $tour->price ?> <span style="font-weight:normal; font-size: 16px;">тг</span></span>
                                <p><?= Yii::t('app', 'Подробнее') ?></p>
                                <span class="h4"><?= $category->getCategoryName($tour->category_id) ?></span>
                            </div>
                        </div>
                        <span class="h5"><?= $tour->name ?></span>
                    </div>
                </articles>
            <?php endforeach; ?>
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <?= Html::a(Yii::t('app', 'Все туры'), ['tours/search'], ['class' => 'btn-all']) ?>
            </div>
        </div>
        <!-- POPULAR TOUR END -->
        <!-- ADS -->
        <div class="row">
            <div class="col-md-12 col-xs-12 popular">
                <?= Yii::t('app', '<span class="popular-description">Объявления</span><span>пользователей</span>') ?>
            </div>
            <?php foreach ($ads as $item): ?>
                <div class="col-md-3 col-sm-4 my-3">
                    <div class="boxAds-hit">
                        <?= Html::a('', ['ads/view', 'id' => $item->id], ['class' => 'tour_link']) ?>
                        <div class="boxAds-img">
                            <?= $item->mini_image ? Html::img('@web/common/users/'.$item->user_id.'/ads/'.$item->mini_image) : Html::img('@web/common/users/no-image.png') ?>
                        </div>
                        <div class="boxAds-info">
                            <span><?= $item->description ?></span>
                        </div>
                        <p class="tel"><?= $item->phone ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <?= Html::a(Yii::t('app', 'Все объявления'), ['ads/index'], ['class' => 'btn-all']) ?>
            </div>
        </div>
        <!-- ADS END -->
    </div>
</section>

<?php if($banner_mid): ?>
    <section style="background:#fbfbfb;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mb-4">
                    <?= Html::a(Html::img('@web/common/banners/'.$banner_mid->id.'/'.$banner_mid->banner, ['style' => 'max-width: 100%']),$banner_mid->link,['target' => 'blank']) ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<section class="bg-category-tour">
    <!-- CATEGORY TOUR -->
    <div class="col-md-12 col-xs-12 category">
        <?= Yii::t('app', '<span class="category-description">КАТЕГОРИЯ</span><span>тура</span>') ?>
    </div>
    <!-- CATEGORY TOUR END -->
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center pt-3 pb-3 position-relative">
                <img src="common/img/tour-category/map.png" width="100%" height="auto">
                <div class="jungle-icon">
                    <img src="common/img/tour-category/jungle.png"><br>
                    <?= Html::a(Yii::t('app', 'Природа'), ['/tours/search', 'filter_categories[]' => 1], ['class' => 'tour_link']) ?>
                </div>

                <div class="kupatsya-icon">
                    <img src="common/img/tour-category/kupatsya.png"><br>
                    <?= Html::a(Yii::t('app','Пляжный отдых'), ['/tours/search', 'filter_categories[]' => 6], ['class' => 'tour_link']) ?>
                </div>

                <div class="smile-icon">
                    <img src="common/img/tour-category/smile.png"><br>
                    <?= Html::a(Yii::t('app','Развлечения'), ['/tours/search', 'filter_categories[]' => 2], ['class' => 'tour_link']) ?>
                </div>

                <div class="babies-icon">
                    <img src="common/img/tour-category/babies.png"><br>
                    <?= Html::a(Yii::t('app','Исторические туры'), ['/tours/search', 'filter_categories[]' => 8], ['class' => 'tour_link']) ?>
                </div>

                <div class="fish-icon">
                    <img src="common/img/tour-category/fish.png"><br>
                    <?= Html::a(Yii::t('app','Активный отдых'), ['/tours/search', 'filter_categories[]' => 4], ['class' => 'tour_link']) ?>
                </div>

                <div class="sport-icon">
                    <img src="common/img/tour-category/sport.png"><br>
                    <?= Html::a(Yii::t('app','Многодневные туры'), ['/tours/search', 'filter_categories[]' => 3], ['class' => 'tour_link']) ?>
                </div>

                <div class="shrine-icon">
                    <img src="common/img/tour-category/shrine.png"><br>
                    <?= Html::a(Yii::t('app','Сакральный туризм'), ['/tours/search', 'filter_categories[]' => 9], ['class' => 'tour_link']) ?>
                </div>

                <div class="sanatoriy-icon">
                    <img src="common/img/tour-category/sanatoriy.png"><br>
                    <?= Html::a(Yii::t('app','Базы отдыха, санатории'), ['/tours/search', 'filter_categories[]' => 10], ['class' => 'tour_link']) ?>
                </div>

                <div class="photo-icon">
                    <img src="common/img/tour-category/photo.png"><br>
                    <?= Html::a(Yii::t('app','Транспорт'), ['/tours/search', 'filter_categories[]' => 7], ['class' => 'tour_link']) ?>
                </div>

                <div class="jeep-icon">
                    <img src="common/img/tour-category/babies.png"><br>
                    <?= Html::a(Yii::t('app','Джип-туры'), ['/tours/search', 'filter_categories[]' => 5], ['class' => 'tour_link']) ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if($banner_bottom): ?>
    <section style="background:#fbfbfb;">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center mt-4">
                    <?= Html::a(Html::img('@web/common/banners/'.$banner_bottom->id.'/'.$banner_bottom->banner, ['style' => 'max-width: 100%']),$banner_bottom->link,['target' => 'blank']) ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12 about-preim">
                <?= Yii::t('app', '<span>наши</span><span class="about-preim-description">ПРЕИМУЩЕСТВА</span>') ?>
            </div>
        </div>

       <div class="row preim-dashed-border">
            <div class="col-md p-0 m-0 box-top-tour pt-4 pb-4">
                <img src="common/img/preim/king.png">
                <div class="about-preim-grayLine"></div>
                <span class="h4 pt-3 pb-2"><?= Yii::t('app', 'Полезную информацию') ?></span>
                <p><?= Yii::t('app', 'Новости из мира туризма, а так же многое интересное, советы и рекомендации. Куда поехать и что увидеть') ?> </p>
                <button class="about-preim-btn" type="submit"><?= Yii::t('app', 'Подробнее') ?></button>
            </div>

            <div class="col-md p-0 m-0 box-top-tour pt-4 pb-4">
                <img src="common/img/preim/online.png">
                <div class="about-preim-grayLine"></div>
                <span class="h4 pt-3 pb-2"><?= Yii::t('app', 'Покупай интересное') ?></span>
                <p><?= Yii::t('app', 'Самые интересные предложения туров и экскурсий от ведущих компаний по внутреннему и въездному туризму Казахстана, а так же выбери услугу, предоставляемую пользователями на частной основе.') ?></p>
                <button class="about-preim-btn" type="submit"><?= Yii::t('app', 'Подробнее') ?></button>
            </div>

            <div class="col-md p-0 m-0 box-top-tour pt-4 pb-4">
                <img src="common/img/preim/price.png">
                <div class="about-preim-grayLine"></div>
                <span class="h4 pt-3 pb-2"><?= Yii::t('app', 'Продавай интересное') ?></span>
                <p><?= Yii::t('app', 'Если вам есть что предложить, размещайте бесплатные объявления. И если они хоть как-то связанны с туризмом Казахстана, мы обязательно опубликуем их.') ?></p>
                <button class="about-preim-btn" type="submit"><?= Yii::t('app', 'Подробнее') ?></button>
            </div>

            <div class="col-md p-0 m-0 box-top-tour pt-4 pb-4">
                <img src="common/img/preim/rating.png">
                <div class="about-preim-grayLine"></div>
                <span class="h4 pt-3 pb-2"><?= Yii::t('app', 'Отзывы') ?></span>
                <p><?= Yii::t('app', 'Получите информацию от реальных туристов, от тех, кто уже был и видел. Задай им интересующие вопросы.') ?></p>
                <button class="about-preim-btn" type="submit"><?= Yii::t('app', 'Подробнее') ?></button>
            </div>
            <div class="col-md p-0 m-0 box-top-tour pt-4 pb-4">
                <img src="common/img/preim/price.png">
                <div class="about-preim-grayLine"></div>
                <span class="h4 pt-3 pb-2"><?= Yii::t('app', 'Лёгкая покупка') ?></span>
                <p><?= Yii::t('app', 'Пройди легкую и короткую регистрацию чтобы иметь возможность воспользоваться заинтересовавшим предложением. Нужен минимум. Для регистрации только электронный адрес, а для покупки желание!') ?></p>
                <button class="about-preim-btn" type="submit"><?= Yii::t('app', 'Подробнее') ?></button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xs-12 vopros">
                <?= Yii::t('app', '<span>задать</span><span class="vopros-description">ВОПРОС</span>') ?>
            </div>
        </div>
    </div>
</section>

<section class="bg-zayavka">
    <div class="container pt-5 pb-5">
        <div class="row beforeAndAfter">
            <div class="offset-md-2 col-md-8 d-flex justify-content-center align-items-center flex-column bg-vopros">
                <span class="h5"><?= Yii::t('app', 'У вас остались вопросы?') ?></span>
                <span class="h2"><strong><?= Yii::t('app', 'Мы ответим на них!') ?></strong></span>
                <? $form = \yii\widgets\ActiveForm::begin([
                        'id' => 'main_form',
                        'action' => '/site/send-main-form'
                ]) ?>
                    <div class="input-vopros">
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($mailForm, 'name', ['options' => ['class' => 'mz-div my-2']])->textInput(['class' => 'mt-2 mb-2', 'required' => '', 'placeholder' => 'Представьтесь'])->label(false) ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($mailForm, 'mail', ['options' => ['class' => 'mz-div my-2']])->textInput(['class' => 'mt-2 mb-2', 'required' => '', 'placeholder' => 'E-mail'])->label(false) ?>
                            </div>
                            <div class="col-md-12">
                                <?= $form->field($mailForm, 'message', ['options' => ['class' => 'mz-div my-2']])->textarea(['class' => 'mt-2 mb-2', 'rows' => '5', 'placeholder' => 'Введите интересующий вас вопрос', 'required' => ''])->label(false) ?>
                            </div>
                            <div class="mt-3 offset-md-3 col-md-6">
                                <?= Html::submitButton(Yii::t('app', 'Задать вопрос'), ['class' => 'vopros-btn']) ?>
                            </div>
                        </div>
                    </div>
                <? \yii\widgets\ActiveForm::end() ?>
            </div>
        </div>
    </div>
</section>

<section class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12 about-preim">
                <?= Yii::t('app', '<span>наши</span><span class="about-preim-description">ОТЗЫВЫ</span>') ?>
            </div>
            <div class="col-md-12">
                <div class="owl-carousel">
                    <?php foreach ($comments as $item): ?>
                        <div class="item review__box my-3">
                            <div class="review__name"><?= $item->fio ?></div>
                            <div class="review__date"><?= substr($item->date, 0, 10) ?></div>
                            <div class="review__images">
                                <?= $item->user_photo ? Html::img('@web/common/users/'.$item->user_id.'/'.$item->user_photo) : Html::img('@web/common/users/no-image.png') ?>
                            </div>
                            <div class="rating">
                                <div class="rating_reviews"></div>
                                <div id="ratingBar" style="width: <?= $item->reviews?>%"></div>
                            </div>
                            <span class="h5"><?= $item->message ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php

$script = <<<JS
    var owl = $('.owl-carousel');
    owl.owlCarousel({
        margin: 10,
        loop: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 2
            },
            1000: {
                items: 3
            }
        }
    });
    
    $('#main_form').on('submit', function(event){
        event.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: '/site/send-main-form',
            type: 'POST',
            data: data,
            success: function(response){
                console.log(response);
            }
        });
    })
JS;

$this->registerJs($script);

?>
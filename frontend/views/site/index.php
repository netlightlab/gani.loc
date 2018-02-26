<?php

/* @var $this yii\web\View */

$this->title = 'Туры и экскурсии по Казахстану по лучшим ценам!';

use yii\helpers\Html;

?>
<section class="section-header-main" style="background: url('common/img/header/header_fon.jpg')">
<div class="container">
    <!--<div class="row">-->
        <div class="row header-description-block"> <!-- HEADER DESCRIPTION -->
            <div class="col-md-12 col-xs-12 text-center">
                <span class="header-description">ТУРЫ ПО КАЗАХСТАНУ</span>
            </div>
        </div> <!-- HEADER DESCRIPTION -->
        <div class="row tour-block-white pb-2"> <!-- BLOCK TOUR -->
            <div class="col-md-12 tour-block-search">
                <span>Поиск тура</span>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 pb-3">
                <select class="form-control" width="100%">
                    <option disabled selected value>Выберите страну:</option>
                    <option>Казахстан</option>
                    <option>Россия</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 pb-3">
                <select class="form-control" width="100%">
                    <option disabled selected value>Выберите город:</option>
                    <option>Алмата</option>
                    <option>Москва</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 bg-white pb-3 date">
                <input type="text" name="date-start" class="form-control date" required placeholder="с dd.mm по mm.dd">
                <img src="common/img/header/calendar.png">
            </div>
            <div class="col-lg-2 col-md-3 col-sm-6 bg-white pb-3">
                <input type="text" name="date-start" class="form-control days" required placeholder="на xx - xx ночей">
            </div>
            <div class="col-lg-2 col-md-12 col-sm-12 bg-white pb-3 position-relative">
                <input type="submit" name="submit" class="search-tour-btn" value="Поиск тура">
                <img src="common/img/header/search.png" class="search-tour-img">
            </div>
        </div> <!-- BLOCK TOUR -->
        <div class="row bgGray pt-3 pb-3">
            <div class="col-md-4 col-xs-4">
                <label for="c1"><input type="checkbox" hidden id="c1"><span></span>Однодневные Новогодние туры</label><br>
                <label for="c2"><input type="checkbox" hidden id="c2"><span></span>Автобусные туры на юг</label><br>
                <label for="c3"><input type="checkbox" hidden id="c3"><span></span>Автобусные туры на юг</label><br>
            </div>
            <div class="col-md-4 col-xs-4">
                <label for="c4"><input type="checkbox" hidden id="c4"><span></span>Развлекательные мероприятия</label><br>
                <label for="c5"><input type="checkbox" hidden id="c5"><span></span>Однодневные туры</label><br>
                <label for="c6"><input type="checkbox" hidden id="c6"><span></span>Однодневные туры</label><br>
            </div>
            <div class="col-md-4 col-xs-4">
                <label for="c7"><input type="checkbox" hidden id="c7"><span></span>Туры в Великий Устюг</label><br>
                <label for="c8"><input type="checkbox" hidden id="c8"><span></span>Развлекательные мероприятия</label><br>
                <label for="c9"><input type="checkbox" hidden id="c9"><span></span>Развлекательные мероприятия</label><br>
            </div>
        </div>
    <!--</div>-->
</div>
</section>

<section>
    <div class="container">
        <!-- POPULAR TOUR -->
        <div class="row">
            <div class="col-md-12 col-xs-12 popular">
                <span class="popular-description">ПОПУЛЯРНЫЕ</span>
                <span>направления</span>
            </div>
        </div>
        <div class="row">
            <?php foreach ($model as $tour):?>
                <div id="tour" class="col-md-4 col-sm-6 my-3">
                    <a href="/tours/view/?id=<?= $tour->id ?>" title="<?= $tour->name ?>">
                        <div class="boxTour-hit">
                            <div class="hit-sale"><b>Хит</b><br>Продаж</div>
                            <div class="tour-img">
                                <?= Html::img('@web/common/tour_img/'.$tour->id.'/'.$tour->mini_image) ?>
                                <div class="tour-info">
                                    <span><span style="font-weight:normal; font-size: 16px;">от</span> <?= $tour->price ?> <span style="font-weight:normal; font-size: 16px;">тг</span></span>
                                    <p>подробнее</p>
                                    <h4>Category</h4>
                                </div>
                            </div>
                            <h5><?= $tour->name ?></h5>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
            <div class="col-md-12 d-flex justify-content-center align-items-center">
                <?= Html::a('Все туры', ['tours/index'], ['class' => 'btn-all']) ?>
            </div>
        </div>
        <!-- POPULAR TOUR END -->
        <!-- CATEGORY TOUR -->
            <div class="col-md-12 col-xs-12 category">
                <span class="category-description">КАТЕГОРИЯ</span>
                <span>тура</span>
            </div>
        <!-- CATEGORY TOUR END -->
    </div>
</section>
<section class="bg-category-tour">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center pt-3 pb-3 position-relative">
                <img src="common/img/tour-category/map.png" width="100%" height="auto">
                <div class="jungle-icon">
                    <img src="common/img/tour-category/jungle.png"><br>
                    <a href="#">ПРИРОДА</a>
                </div>

                <div class="kupatsya-icon">
                    <img src="common/img/tour-category/kupatsya.png"><br>
                    <a href="#">КУПАТЬСЯ</a>
                </div>

                <div class="smile-icon">
                    <img src="common/img/tour-category/smile.png"><br>
                    <a href="#">РАЗВЛЕЧЕНИЯ</a>
                </div>

                <div class="babies-icon">
                    <img src="common/img/tour-category/babies.png"><br>
                    <a href="#">ДЛЯ ДЕТЕЙ</a>
                </div>

                <div class="fish-icon">
                    <img src="common/img/tour-category/fish.png"><br>
                    <a href="#">РЫБАЛКА</a>
                </div>

                <div class="sport-icon">
                    <img src="common/img/tour-category/sport.png"><br>
                    <a href="#">ЭКСТРИМ</a>
                </div>

                <div class="shrine-icon">
                    <img src="common/img/tour-category/shrine.png"><br>
                    <a href="#">СВЯТЫЕ МЕСТА</a>
                </div>

                <div class="sanatoriy-icon">
                    <img src="common/img/tour-category/sanatoriy.png"><br>
                    <a href="#">САНАТОРИЙ</a>
                </div>

                <div class="photo-icon">
                    <img src="common/img/tour-category/photo.png"><br>
                    <a href="#">ЭКСКУРСИИ</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12 about-preim">
                <span>наши</span>
                <span class="about-preim-description">ПРЕИМУЩЕСТВА</span>
            </div>
        </div>

        <div class="row preim-dashed-border">
            <div class="col-md-3 col-sm-6 p-0 m-0 box-top-tour pt-4 pb-4">
                <img src="common/img/preim/king.png">
                <div class="about-preim-grayLine"></div>
                <h4 class="pt-3 pb-2">Лучшие туры</h4>
                <p>Чем вы хотите заняться на выходных и в отпуске в Казахстане? Все туры Казахстана тут!</p>
                <button class="about-preim-btn" type="submit">Подробнее</button>
            </div>

            <div class="col-md-3 col-sm-6 p-0 m-0 box-top-tour pt-4 pb-4">
                <img src="common/img/preim/online.png">
                <div class="about-preim-grayLine"></div>
                <h4 class="pt-3 pb-2">Онлайн оплата 24/7</h4>
                <p>Вы легко и быстро можете выбрать, сравнить и купить туры онлайн прямо на нашем сайте, не выходя из дома.</p>
                <button class="about-preim-btn" type="submit">Подробнее</button>
            </div>

            <div class="col-md-3 col-sm-6 p-0 m-0 box-top-tour pt-4 pb-4">
                <img src="common/img/preim/price.png">
                <div class="about-preim-grayLine"></div>
                <h4 class="pt-3 pb-2">Лучшие цены</h4>
                <p>Поиск лучшей цены среди предложений всех компаний. У нас вы найдете различные предложения на любой бюджет.</p>
                <button class="about-preim-btn" type="submit">Подробнее</button>
            </div>

            <div class="col-md-3 col-sm-6 p-0 m-0 box-top-tour pt-4 pb-4">
                <img src="common/img/preim/rating.png">
                <div class="about-preim-grayLine"></div>
                <h4 class="pt-3 pb-2">Отзывы и рейтинги</h4>
                <p>Выбирайте ваш отдых по реальным отзывам и рекомендациям опытных туристов и путешественников.</p>
                <button class="about-preim-btn" type="submit">Подробнее</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 col-xs-12 vopros">
                <span>задать</span>
                <span class="vopros-description">ВОПРОС</span>
            </div>
        </div>
    </div>
</section>

<section class="bg-zayavka">
    <div class="container pt-5 pb-5">
        <div class="row beforeAndAfter">
            <div class="offset-md-2 col-md-8 pt-5 pb-5 d-flex justify-content-center align-items-center flex-column bg-vopros">
                <h5 align="center">У вас остались вопросы?</h5>
                <h2 align="center"><strong>Мы ответим на них!</strong></h2>
                <div class="input-vopros">
                    <input class="mt-2 mb-2" type="text" name="name" required placeholder="Представтесь">
                    <input class="mt-2 mb-2" type="email" name="name" required placeholder="E-mail">
                </div>
                <textarea class="mt-2 mb-2" type="text" rows="5" placeholder="Введите интересующий вас вопрос" required></textarea>
                <button type="submit" class="vopros-btn pl-3 pr-3">Задать вопрос</button>
            </div>
        </div>
    </div>
</section>

<section class="mb-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12 about-preim">
                <span>наши</span>
                <span class="about-preim-description">ОТЗЫВЫ</span>
            </div>
            <div class="col-md-12">
                <div class="owl-carousel">
                    <div class="item">
                        <div class="FIO">Титова Тамара Васильевна</div>
                        <div class="date-otziv">02.11.11</div>
                        <div class="otziv-client-box">
                            <div class="border-dashed-otziv"></div>
                            <img class="icon-face mt-3 mb-3" src="common/img/otziv/otziv-1.png">
                            <h4 class="pt-3 pb-3">Геолог Казахстана пансионат</h4>
                            <div id="reviewStars-input">
                                <input id="star-4" type="radio" name="reviewStars" checked/>
                                <label title="gorgeous" for="star-4"></label>
                                <input id="star-3" type="radio" name="reviewStars" />
                                <label title="good" for="star-3"></label>
                                <input id="star-2" type="radio" name="reviewStars" />
                                <label title="regular" for="star-2"></label>
                                <input id="star-1" type="radio" name="reviewStars" />
                                <label title="poor" for="star-1"></label>
                                <input id="star-0" type="radio" name="reviewStars" />
                                <label title="bad" for="star-0"></label>
                            </div>
                            <h5>Не первый год я отдыхаю в Геологе Казахстана, который находиться в п.Иноземцево.И в следующем году также собираюсь провести часть своего отпуска там. Персонал пансионата делает все возможное и не возможное чтобы у отдыхающих остались только положительные впечатления.</h5>
                        </div>
                    </div>

                    <div class="item">
                        <div class="FIO">Титова Тамара Васильевна</div>
                        <div class="date-otziv">02.11.11</div>
                        <div class="otziv-client-box">
                            <div class="border-dashed-otziv"></div>
                            <img class="icon-face mt-3 mb-3" src="common/img/otziv/otziv-1.png">
                            <h4 class="pt-3 pb-3">Геолог Казахстана пансионат</h4>
                            <div id="reviewStars-input">
                                <input id="star-4" type="radio" name="reviewStars" checked/>
                                <label title="gorgeous" for="star-4"></label>
                                <input id="star-3" type="radio" name="reviewStars" />
                                <label title="good" for="star-3"></label>
                                <input id="star-2" type="radio" name="reviewStars" />
                                <label title="regular" for="star-2"></label>
                                <input id="star-1" type="radio" name="reviewStars" />
                                <label title="poor" for="star-1"></label>
                                <input id="star-0" type="radio" name="reviewStars" />
                                <label title="bad" for="star-0"></label>
                            </div>
                            <h5>Не первый год я отдыхаю в Геологе Казахстана, который находиться в п.Иноземцево.И в следующем году также собираюсь провести часть своего отпуска там. Персонал пансионата делает все возможное и не возможное чтобы у отдыхающих остались только положительные впечатления.</h5>
                        </div>
                    </div>

                    <div class="item">
                        <div class="FIO">Титова Тамара Васильевна</div>
                        <div class="date-otziv">02.11.11</div>
                        <div class="otziv-client-box">
                            <div class="border-dashed-otziv"></div>
                            <img class="icon-face mt-3 mb-3" src="common/img/otziv/otziv-1.png">
                            <h4 class="pt-3 pb-3">Геолог Казахстана пансионат</h4>
                            <div id="reviewStars-input">
                                <input id="star-4" type="radio" name="reviewStars" checked/>
                                <label title="gorgeous" for="star-4"></label>
                                <input id="star-3" type="radio" name="reviewStars" />
                                <label title="good" for="star-3"></label>
                                <input id="star-2" type="radio" name="reviewStars" />
                                <label title="regular" for="star-2"></label>
                                <input id="star-1" type="radio" name="reviewStars" />
                                <label title="poor" for="star-1"></label>
                                <input id="star-0" type="radio" name="reviewStars" />
                                <label title="bad" for="star-0"></label>
                            </div>
                            <h5>Не первый год я отдыхаю в Геологе Казахстана, который находиться в п.Иноземцево.И в следующем году также собираюсь провести часть своего отпуска там. Персонал пансионата делает все возможное и не возможное чтобы у отдыхающих остались только положительные впечатления.</h5>
                        </div>
                    </div>

                    <div class="item">
                        <div class="FIO">Титова Тамара Васильевна</div>
                        <div class="date-otziv">02.11.11</div>
                        <div class="otziv-client-box">
                            <div class="border-dashed-otziv"></div>
                            <img class="icon-face mt-3 mb-3" src="common/img/otziv/otziv-1.png">
                            <h4 class="pt-3 pb-3">Геолог Казахстана пансионат</h4>
                            <div id="reviewStars-input">
                                <input id="star-4" type="radio" name="reviewStars" checked/>
                                <label title="gorgeous" for="star-4"></label>
                                <input id="star-3" type="radio" name="reviewStars" />
                                <label title="good" for="star-3"></label>
                                <input id="star-2" type="radio" name="reviewStars" />
                                <label title="regular" for="star-2"></label>
                                <input id="star-1" type="radio" name="reviewStars" />
                                <label title="poor" for="star-1"></label>
                                <input id="star-0" type="radio" name="reviewStars" />
                                <label title="bad" for="star-0"></label>
                            </div>
                            <h5>Не первый год я отдыхаю в Геологе Казахстана, который находиться в п.Иноземцево.И в следующем году также собираюсь провести часть своего отпуска там. Персонал пансионата делает все возможное и не возможное чтобы у отдыхающих остались только положительные впечатления.</h5>
                        </div>
                    </div>
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
    })
JS;

$this->registerJs($script);

?>
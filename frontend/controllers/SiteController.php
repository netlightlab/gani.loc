<?php
namespace frontend\controllers;

use common\components\PageRule;
use common\models\Banners;
use common\models\Cities;
use common\models\Mainform;
use frontend\models\Ads;
use frontend\models\Comments;
use common\models\Countries;
use frontend\models\Page;
use frontend\models\Search;
use frontend\models\SignupCompany;
use frontend\models\Tours;
use Yii;
use yii\base\InvalidParamException;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $bgFileExtension;
    /**
     * @inheritdoc
     */

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $lang = Yii::$app->language;

        $ads = Ads::find()->where(['active' => 1])->orderBy(['id' => SORT_DESC])->limit(4)->all();


        if($ads){
            foreach($ads as $ad){
                if($lang === 'kz'){
                    $ad->description_kz ? $ad->description = $ad->description_kz : $ad->description;
                }elseif($lang === 'en'){
                    $ad->description_en ? $ad->description = $ad->description_en : $ad->description;
                }
            }
        }


        $comments = Comments::find()->where(['active' => 1])->all();
        $mailForm = new Mainform();

        $banner_top = Banners::find()->where(['page_id' => 1])->andWhere(['position' => 'home_top'])->one();
        $banner_mid = Banners::find()->where(['page_id' => 1])->andWhere(['position' => 'home_mid'])->one();
        $banner_bottom = Banners::find()->where(['page_id' => 1])->andWhere(['position' => 'home_bottom'])->one();

        $searchForm = array(
            'categories' => (new \common\models\Categories())->getCategoriesList(),
            'countries' => ArrayHelper::map(Countries::find()->asArray()->all(), 'id', 'name'),
            'cities' => ArrayHelper::map(Cities::find()->asArray()->all(), 'id', 'name'),
        );

        return $this->render('index', [
            'searchForm'    => $searchForm,
            'model'         => $this->getMainTours(),
            'ads'           => $ads,
            'comments'      => $comments,
            'mailForm'      => $mailForm,
            'banner_top'    => $banner_top,
            'banner_mid'    => $banner_mid,
            'banner_bottom'    => $banner_bottom,
        ]);
    }

    public function getMainTours() {
        return Tours::find()->select('id, mini_image, price, name, category_id')->orderBy(['id' => SORT_DESC])->limit(9)->all();
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    /*public function actionAbout()
    {
        return $this->render('about');
    }*/

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Ссылка отправлена, проверьте ваш e-mail.');

                return $this->refresh();
            } else {
                Yii::$app->session->setFlash('error', 'Извините, невозможно восстановить пароль по указанному e-mail');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль сохранен.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }


//    public function actionPage($alias)
    public function actionPage($id)
    {
        /*$page = new Page();
        $data = $page->data();
        $title = $page->title;
        $content = $page->content;
        $background = $page->background;


        return $this->render('page', [
            "title" => $title,
            "content" => $content,
            "background" => $background,
            "data" => $data,
            "pageId" => $pageId,
            "fileType" => $this->bgFileExtension
        ]);*/
        if($id && is_numeric($id)){
            $model = Page::findOne(['id' => $id]);
        }elseif($id && !is_numeric($id)){
            $model = Page::findOne(['url' => $id]);
        }else{
            throw new BadRequestHttpException();
        }

        $lang = Yii::$app->language;

        if($lang === 'en'){
            $model->title_en ? $model->title = $model->title_en : $model->title;
            $model->content_en ? $model->content = $model->content_en : $model->content;
        }elseif($lang === 'kz'){
            $model->title_kz ? $model->title = $model->title_kz : $model->title;
            $model->content_kz ? $model->content = $model->content_kz : $model->content;
        }

        if(!$model)
            throw new BadRequestHttpException();

        $pageId = $model->id;

        $backgroundFile = pathinfo($model->background);
        $bgFExt = $backgroundFile['extension'];

        if($bgFExt == 'jpg' || $bgFExt == 'png' || $bgFExt == 'jpeg')
            $this->bgFileExtension = 'image';
        else
            $this->bgFileExtension = 'video';

        return $this->render('page', [
            'model' => $model,
            'fileType' => $this->bgFileExtension
        ]);
    }

    public function actionSignup_company(){
        $model = new SignupCompany();

        if (Yii::$app->request->isAjax) {
            $cities = new Cities();
            $arr = $cities->getCitiesList((int)Yii::$app->request->post('country_id'));
            echo json_encode($arr);
            return false;
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                $this->redirect(['/site/login']);
                Yii::$app->session->setFlash('success', 'Регистрация прошла успешно. Вы сможете войти в аккаунт, после активации аккаунта администратором.');
            }
        }

        return $this->render('signupcompany', [
            'model' => $model,
        ]);
    }

    public function actionSendMainForm(){
        $model = new Mainform();

        if($model->load(Yii::$app->request->post()) && $model->validate()){
            $model->sendEmail();

//            Yii::$app->session->setFlash('success', 'asd');
            return false;
        }

        return false;
    }
}

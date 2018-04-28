<?php
namespace frontend\controllers;

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


        $ads = Ads::find()->where(['active' => 1])->limit(4)->all();

        $comments = Comments::find()->where(['active' => 1])->all();

//        return $this->render('index', [
//            'model'     => $this->getMainTours(),
//            'ads'       => $ads,
//            'comments'  => $comments,]);
        $mailForm = new Mainform();

        $searchForm = array(
            'categories' => (new \common\models\Categories())->getCategoriesList(),
            'countries' => ArrayHelper::map(Countries::find()->asArray()->all(), 'id', 'name'),
            'cities' => ArrayHelper::map(Cities::find()->asArray()->all(), 'id', 'name'),
        );

        return $this->render('index', [
            'searchForm' => $searchForm,
            'model' => $this->getMainTours(),
            'ads'       => $ads,
            'comments'  => $comments,
            'mailForm' => $mailForm
        ]);
    }

    public function getMainTours() {
        return Tours::find()->select('id, mini_image, price, name, category_id')->limit(9)->all();
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
    public function actionAbout()
    {
        return $this->render('about');
    }

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

    public function actionPage($id)
    {
        $page = new Page();
        $data = $page->data();
        $title = $page->title;
        $content = $page->content;
        $background = $page->background;
        $pageId = $id;

        $backgroundFile = pathinfo($page->background);
        $bgFExt = $backgroundFile['extension'];

        if($bgFExt == 'jpg' || $bgFExt == 'png' || $bgFExt == 'jpeg')
            $this->bgFileExtension = 'image';
        else
            $this->bgFileExtension = 'video';

        return $this->render('page', [
            "title" => $title,
            "content" => $content,
            "background" => $background,
            "data" => $data,
            "pageId" => $pageId,
            "fileType" => $this->bgFileExtension
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
                return $this->goHome();
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

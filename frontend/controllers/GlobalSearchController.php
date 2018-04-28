<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.04.2018
 * Time: 11:23
 */

namespace frontend\controllers;


use yii\db\Query;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use Yii;

class GlobalSearchController extends Controller
{
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


    public function actionGlobalSearch(){
        $param = Yii::$app->request->get('param');
        if(!$param){
            return false;
        }

        $param = strip_tags($param);

        $tours = (new Query())
            ->select(['id', 'name', 'mini_image'])
            ->from('tours')
            ->where(['like', 'name', $param])
            ->all();

        $catalog = (new Query())
            ->select(['id', 'name', 'image'])
            ->from('catalog')
            ->where(['like', 'name', $param])
            ->all();

        $page = (new Query())
            ->select(['id', 'title'])
            ->from('page')
            ->where(['like', 'title', $param])
            ->all();

        $data = array(
            'tours' => $tours,
            'catalog' => $catalog,
            'page' => $page
        );

        foreach($data as $key => $value){
            if(empty($value))
                unset($data[$key]);
        }

        return $this->render('index', [
            'param' => $param,
            'data' => $data
        ]);
    }
}
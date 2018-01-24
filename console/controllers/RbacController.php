<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;

        // добавляем разрешение "createPost"
        $userAuth = $auth->createPermission('userAuth');
        $userAuth->description = 'User login';
        $auth->add($userAuth);

        // добавляем разрешение "updatePost"
      //  $adminAuth = $auth->createPermission('adminAuth');
        //$adminAuth->description = 'Admin login';
        //$auth->add($adminAuth);

        // добавляем роль "author" и даём роли разрешение "createPost"
//        $user = $auth->createRole('user');
  //      $auth->add($user);
    //    $auth->addChild($user, $userAuth);

        // добавляем роль "admin" и даём роли разрешение "updatePost"
        // а также все разрешения роли "author"
//        $admin = $auth->createRole('admin');
  //      $auth->add($admin);
    //    $auth->addChild($admin, $adminAuth);
      //  $auth->addChild($admin, $user);

        // Назначение ролей пользователям. 1 и 2 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        //$auth->assign($user, 2);
     //   $auth->assign($admin, 1);

        $user = $auth->createRole('partner');
        $auth->add($user);
        $auth->addChild($user, $userAuth);
        $auth->assign($user, 3);
    }
}
?>
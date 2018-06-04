<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.05.2018
 * Time: 16:18
 */

namespace common\components;

use common\models\Catalog;
use yii\web\UrlRuleInterface;
use yii\base\BaseObject;
use frontend\models\Page;

class PageUrlRule implements UrlRuleInterface
{


    public function createUrl($manager, $route, $params)
    {
        if ($route === 'site/page') {
            if(is_numeric($params['id'])){
                $url = Page::find()->select('url')->where(['id' => $params['id']])->one();
                if($url -> url)
                    return $url -> url . '/';
            }

            //return $params['id'] . '/';
            return $params['id'];
        }
        if($route === 'catalog/view'){
            $url = Catalog::find()->select('url')->where(['id' => $params['id']])->one();
            if($url -> url)
                return 'catalog/' . $url -> url;
                //return 'catalog/' . $url -> url . '/';

            return 'catalog/' . $params['id'];
            //return 'catalog/' . $params['id'] . '/';
        }
		
        return false;  // данное правило не применимо
    }
    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        if (preg_match('%^(\w+)(/(\w+))?$%', $pathInfo, $matches)) {
            // Ищем совпадения $matches[1] и $matches[3]
            // с данными manufacturer и model в базе данных
            // Если нашли, устанавливаем $params['manufacturer'] и/или $params['model']
            // и возвращаем ['car/index', $params]
        }
        return false;  // данное правило не применимо
    }
}

<?php

namespace app\controllers\v1;

use Yii;
use app\models\LoginForm; 
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\Response;
use yii\filters\ContentNegotiator;

/**
 * @OA\Tag(
 *   name="Bukus",
 *   description="Everything about your Bukus",
 *   @OA\ExternalDocumentation(
 *     description="更多相关",
 *     url="http://dakara.cn"
 *   )
 * )
 */
class LoginController extends ActiveController
{
    public $modelClass = 'app\models\TblUsers';

    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    // 'application/xml' => Response::FORMAT_XML,
                ],
            ],
        ];
    }

    public function actionMasuk(){
        $model = new LoginForm([
        'username' => Yii::$app->request->post('username'),
        'password' => Yii::$app->request->post('password'),
        ]); 
        return $model;
    }

}

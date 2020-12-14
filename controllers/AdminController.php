<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\Response;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\TblBukuSearch;
use app\models\TblChapterSearch;
use app\models\TblChapter;
use app\models\TblBuku;
use app\models\TblKuisSearch;
use app\models\TblKuis;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\TblUsers;
use yii\web\UploadedFile;

class AdminController extends Controller
{
	public $themeName = 'backend';
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
				'class' => AccessControl::className(),
				// 'only' => ['login', 'logout', 'signup'],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
					],
					[
						'actions' => ['login'],
						'allow' => true,
						'roles' => ['?'],
					],
				],
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionDashboard()
    {
         $model1 = TblBuku::find()
            ->where(['id_user' => Yii::$app->user->identity->id_user])
            ->all();

        return $this->render('dashboard',[
            'searchModel' => $searchModel,
            'model1' => $model1,
        ]);
    }

	/**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
		$this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
			return $this->redirect('dashboard');
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
			//return $this->goBack();
			return $this->redirect('login');
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
	}
	public function actionLogout() 
    {
        Yii::$app->user->logout();

        return $this->redirect('login');
    }

    public function actionChapter($id)
    {

        $model1 = TblBuku::find()
        ->where(['id_user' => Yii::$app->user->identity->id_user])
        ->one();
         
        $model2 = TblChapter::find()
        ->where(['id_buku' => $id])
        ->all();

        $model3 = TblKuis::find()
        ->where(['id_chapter' => $model2])
        ->all();
 
        return $this->render('/admin/view', [
            'model' => $this->findModel($id),
            'model1' => $model1,
            'model2' => $model2, 
            'model3' => $model3, 
        ]);
    }

    /**
     * Finds the TblBuku model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TblBuku the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblBuku::findOne($id)) !== null) {
            // echo "<pre>";
            // print_r($model->getChapters());
            // echo "</pre>";
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    protected function findModel1($id)
    {
        if (($model = TblChapter::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
 
     
}




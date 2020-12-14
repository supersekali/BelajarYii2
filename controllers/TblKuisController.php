<?php

namespace app\controllers;

use Yii;
use app\models\TblBuku;
use app\models\TblBukuSearch;
use app\models\TblKuis;
use app\models\TblKuisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\TblChapter;
use app\models\TblChapterSearch;
use yii\helpers\ArrayHelper; 
/**
 * TblKuisController implements the CRUD actions for TblKuis model.
 */
class TblKuisController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public $themeName = 'backend';
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TblKuis models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblKuisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblKuis model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TblKuis model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblKuis();
        $buku = TblBuku::find()
        ->where(['id_user' =>  Yii::$app->user->identity->id_user])
        ->all();
 
        $dafChap = TblChapterSearch::find()
        ->where(['id_buku' => $buku])
        ->all();
        $dafChap = ArrayHelper::map($dafChap, 'id_chapter','nama_chapter','buku.judul_buku');
      
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_kuis]);
        }

        return $this->render('create', [
            'model' => $model,
            'dafChap'=> $dafChap,
        ]);
    }

    /**
     * Updates an existing TblKuis model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $buku = TblBuku::find()
        ->where(['id_user' =>  Yii::$app->user->identity->id_user])
        ->all();
 
        $dafChap = TblChapterSearch::find()
        ->where(['id_buku' => $buku])
        ->all();
        $dafChap = ArrayHelper::map($dafChap, 'id_chapter','nama_chapter','buku.judul_buku');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_kuis]);
        }

        return $this->render('update', [
            'model' => $model,
            'dafChap'=> $dafChap,
        ]);
    }

    /**
     * Deletes an existing TblKuis model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TblKuis model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TblKuis the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblKuis::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

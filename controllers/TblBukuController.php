<?php

namespace app\controllers;

use Yii;
use app\models\TblBuku;
use app\models\TblBukuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * TblBukuController implements the CRUD actions for TblBuku model.
 */
class TblBukuController extends Controller
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
     * Lists all TblBuku models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblBukuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblBuku model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('/tbl-buku/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TblBuku model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblBuku();


        if ($model->load(Yii::$app->request->post())) {
            $model->save(); 
            $cover= $model->id_buku;

            $image = UploadedFile::getInstance($model,'cover');
            $imgName = 'stu_' . $cover .'.' . $image->getExtension();
            $image->saveAs(Yii::getAlias('@bukuImgPath') . '/'. $imgName);
            $model->cover= $imgName; 
            $model->save(); 

            return $this->redirect(['/tbl-buku/index', 'id' => $model->id_buku]);
        }

        return $this->render('/tbl-buku/create', [
            'model' => $model,
        ]); 
    }

    /**
     * Updates an existing TblBuku model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
             
            $cover= $model->id_buku;
            $image = UploadedFile::getInstance($model,'cover');
            if($image instanceof UploadedFile && !$image->getHasError()) {
                $imgName = 'stu_' . $cover .'.' . $image->getExtension();
                $image->saveAs(Yii::getAlias('@bukuImgPath') . '/'. $imgName);
                $model->cover= $imgName; 
                }  else {
                    $model->cover= $model->oldcover;  
                }
            $model->save();
            return $this->redirect(['/tbl-buku/index', 'id' => $model->id_buku]);
        }

        return $this->render('/tbl-buku/update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TblBuku model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['/tbl-buku/index']);
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

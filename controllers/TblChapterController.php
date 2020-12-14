<?php

namespace app\controllers;

use Yii;
use app\models\TblBuku;
use app\models\TblBukuSearch;
use yii\helpers\ArrayHelper; 
use app\models\TblChapter;
use app\models\TblChapterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * TblChapterController implements the CRUD actions for TblChapter model.
 */
class TblChapterController extends Controller
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
     * Lists all TblChapter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TblChapterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TblChapter model.
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
     * Creates a new TblChapter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblChapter();

        $dafBuku = TblBukuSearch::find()
        ->where(['id_user' => Yii::$app->user->identity->id_user])
        ->all();
        $dafBuku = ArrayHelper::map($dafBuku, 'id_buku','judul_buku');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $model->save(); 
            $chapter= $model->id_chapter;

            $pdf = UploadedFile::getInstance($model,'chapter');
            $pdfName = 'pdf_' . $chapter .'.' . $pdf->getExtension();

            $pdf->saveAs(Yii::getAlias('@chapterPdfPath') . '/'. $pdfName);
            $model->chapter= $pdfName; 
            $model->save(); 

            return $this->redirect(['view', 'id' => $model->id_chapter]);
        }

        return $this->render('create', [
            'model' => $model, 
            'dafBuku' =>$dafBuku ,
        ]);
    }

    /**
     * Updates an existing TblChapter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $dafBuku = TblBukuSearch::find()
        ->where(['id_user' => Yii::$app->user->identity->id_user])
        ->all();;

        $dafBuku = ArrayHelper::map($dafBuku, 'id_buku','judul_buku');

        if ($model->load(Yii::$app->request->post())) {

            $chapter= $model->id_chapter;
            $pdf = UploadedFile::getInstance($model,'chapter');

            if($pdf instanceof UploadedFile && !$pdf->getHasError()) {
            $pdfName = 'pdf_' . $chapter .'.' . $pdf->getExtension();

            $pdf->saveAs(Yii::getAlias('@chapterPdfPath') . '/'. $pdfName);
            $model->chapter= $pdfName; 
            }  else {
                $model->chapter= $model->oldpdf;  
            }

            $model->save(); 


            $id_buku=intval(Yii::$app->request->post()['TblChapter']['id_buku']);
            $model->id_buku=$id_buku;
            $id_chapter=intval($model->id_chapter);
            $model->id_chapter=$id_chapter;
        //     echo '<pre>';
        //     var_dump($model);
        //    exit;
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id_chapter]);
            }            
        }

        return $this->render('update', [
            'model' => $model,
            'dafBuku' =>$dafBuku ,
        ]);
    }

    /**
     * Deletes an existing TblChapter model.
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
     * Finds the TblChapter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TblChapter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblChapter::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

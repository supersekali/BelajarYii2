<?php

namespace app\controllers;

use Yii;
use app\models\TblUsers;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * TbluserController implements the CRUD actions for TblUsers model.
 */

class TbluserController extends Controller
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
     * Lists all TblUsers models.
     * @return mixed
     */

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TblUsers::find()
            ->where(['id_user' => Yii::$app->user->identity->id_user]),
        ]);

        $model1 = TblUsers::find()
            ->where(['id_user' => Yii::$app->user->identity->id_user])
            ->one();

        //  echo "<pre>";
        //  print_r ($dataProvider);
        //  exit;
        
        return $this->render('index', [
            'dataProvider' => $dataProvider, 'model' => $model1, 
        ]);
        
    }

   

    /**
     * Displays a single TblUsers model.
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
     * Creates a new TblUsers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TblUsers();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_user]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TblUsers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {

            $fotoId= $model->id_user;
            $image = UploadedFile::getInstance($model,'foto');
            
            if($image instanceof UploadedFile && !$image->getHasError()) {
            $imgName = 'stu_' . $fotoId .'.' . $image->getExtension();
            $image->saveAs(Yii::getAlias('@studentImgPath') . '/'. $imgName);
            $model->foto= $imgName; 

        }  else {
            $model->foto= $model->oldfoto;  
        }
            $model->save();

            return $this->redirect(['index', 'id' => $model->id_user]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TblUsers model.
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
     * Finds the TblUsers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TblUsers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblUsers::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}

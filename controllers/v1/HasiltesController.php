<?php

namespace app\controllers\v1;

use Yii;
use app\models\TblHasiltes;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * @OA\Tag(
 *   name="Hasiltes",
 *   description="Everything about your Hasiltes",
 *   @OA\ExternalDocumentation(
 *     description="更多相关",
 *     url="http://dakara.cn"
 *   )
 * )
 */
class HasiltesController extends ActiveController
{
    public $modelClass = 'app\models\TblHasiltes';

    /**
     * @OA\Get(
     *     path="/hasiltes",
     *     summary="查询 TblHasiltes",
     *     tags={"Hasiltes"},
     *     description="",
     *     operationId="findTblHasiltes",
     *     @OA\Parameter(
     *         name="ids",
     *         in="query",
     *         description="逗号隔开的 id",
     *         required=false,
     *         @OA\Schema(
     *           type="string",
     *           @OA\Items(type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="查询成功",
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/TblHasiltes")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="无效的id",
     *     ),
     *   security={{
     *     "bearerAuth":{}
     *   }}
     * )
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => TblHasiltes::find()->with('creator')->with('updater'),
        ]);
        return $dataProvider;
    }

    /**
     * @OA\Get(
     *     path="/hasiltes/{id}",
     *     summary="通过ID显示详情",
     *     description="",
     *     operationId="getTblHasiltesById",
     *     tags={"Hasiltes"},
     *     @OA\Parameter(
     *         description="id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="操作成功",
     *         @OA\JsonContent(ref="#/components/schemas/TblHasiltes")
     *     ),
     *     @OA\Response(
     *         response="400",
     *         description="无效的ID"
     *     ),
     *     @OA\Response(
     *         response="404",
     *         description="没有找到相应资源"
     *     ),
     *   security={{
     *     "bearerAuth":{}
     *   }}
     * )
     */
    public function actionView($id)
    {
        return $this->findModel($id);
    }

    /**
     * @OA\Post(
     *     path="/hasiltes",
     *     tags={"Hasiltes"},
     *     operationId="addTblHasiltes",
     *     summary="添加",
     *     description="",
     *   @OA\RequestBody(
     *       required=true,
     *       description="创建 TblHasiltes 对象",
     *       @OA\JsonContent(ref="#/components/schemas/TblHasiltes"),
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/TblHasiltes")
     *       )
     *   ),
     *     @OA\Response(
     *         response=201,
     *         description="操作成功",
     *         @OA\JsonContent(ref="#/components/schemas/TblHasiltes")
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="无效的输入",
     *     ),
     *   security={{
     *     "bearerAuth":{}
     *   }}
     * )
     */
    public function actionCreate()
    {
        $model = new TblHasiltes();
        if ($model->load(Yii::$app->getRequest()->getBodyParams(), '') && $model->save()) {
            $response = Yii::$app->getResponse();
            $response->setStatusCode(201);
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to create the object for unknown reason.');
        }
        return $model;
    }

    /**
     * @OA\Put(
     *     path="/hasiltes/{id}",
     *     tags={"Hasiltes"},
     *     operationId="updateTblHasiltesById",
     *     summary="更新指定ID数据",
     *     description="",
     *     @OA\Parameter(
     *         description="id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *           type="integer",
     *           format="int64"
     *         )
     *     ),
     *   @OA\RequestBody(
     *       required=true,
     *       description="更新 TblHasiltes 对象",
     *       @OA\JsonContent(ref="#/components/schemas/TblHasiltes"),
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/TblHasiltes")
     *       )
     *   ),
     *     @OA\Response(
     *         response=200,
     *         description="操作成功",
     *         @OA\JsonContent(ref="#/components/schemas/TblHasiltes")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="无效的ID",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="没有找到相应资源",
     *     ),
     *     @OA\Response(
     *         response=405,
     *         description="数据验证异常",
     *     ),
     *   security={{
     *     "bearerAuth":{}
     *   }}
     * )
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if ($model->load(Yii::$app->request->getBodyParams(), '') && $model->save()) {
            Yii::$app->response->setStatusCode(200);
        } elseif (!$model->hasErrors()) {
            throw new ServerErrorHttpException('Failed to update the object for unknown reason.');
        }
        return $model;
    }

    /**
     * @OA\Delete(
     *     path="/hasiltes/{id}",
     *     summary="删除TblHasiltes",
     *     description="",
     *     operationId="deleteTblHasiltes",
     *     tags={"Hasiltes"},
     *     @OA\Parameter(
     *         description="需要删除数据的ID",
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="没有找到相应资源"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="无效的ID"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="没有找到相应资源"
     *     ),
     *   security={{
     *     "bearerAuth":{}
     *   }}
     * )
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->softDelete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }
        Yii::$app->getResponse()->setStatusCode(204);
    }


    public function actionTambahhasiltes()
    { 
        $id_tes = Yii::$app->request->post('id_tes');
        $id_kuis = Yii::$app->request->post('id_kuis'); 
        $jawaban = Yii::$app->request->post('jawaban'); 

        $cek = TblHasiltes::find()->where(['id_tes'=> $id_tes ,'id_kuis'=> $id_kuis]) 
                                    ->All();

        if($cek == null)
            {
                $model=  new TblHasiltes();
                $model->id_tes= $id_tes;
                $model->id_kuis= $id_kuis;
                $model->jawaban= $jawaban; 
        
                if($model->save()){
                    $data['status'] = "ok"; 
                }else{
                    $data['status'] = 'error cuk'; 
                }
            } else {
                $customer = TblHasiltes::find()->where(['id_tes'=>$id_tes,'id_kuis'=>$id_kuis ])->one();  
                $customer->jawaban = $jawaban;
              
         
                    if($customer->save()){
                        $data['status'] = "ok";  
                    }else{
                        $data['status'] = 'error lek'; 
                    } 
        
            }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 200;
        return $data;
    }

    /**
     * Finds the TblHasiltes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TblHasiltes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblHasiltes::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested TblHasiltes does not exist.');
    }
}

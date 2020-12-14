<?php

namespace app\controllers\v1;

use Yii;
use yii\db\Query;
use app\models\Tes;
use app\models\TblChapter;
use app\models\TblBuku;
use app\models\TblKuis;
use app\models\TblHasiltes;
use app\models\TblUsers;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * @OA\Tag(
 *   name="Tes",
 *   description="Everything about your Tes",
 *   @OA\ExternalDocumentation(
 *     description="更多相关",
 *     url="http://dakara.cn"
 *   )
 * )
 */
class TesController extends ActiveController
{
    public $modelClass = 'app\models\Tes';

    /**
     * @OA\Get(
     *     path="/tes",
     *     summary="查询 Tes",
     *     tags={"Tes"},
     *     description="",
     *     operationId="findTes",
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
     *             @OA\Items(ref="#/components/schemas/Tes")
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
            'query' => Tes::find()->with('creator')->with('updater'),
        ]);
        return $dataProvider;
    }

    /**
     * @OA\Get(
     *     path="/tes/{id}",
     *     summary="通过ID显示详情",
     *     description="",
     *     operationId="getTesById",
     *     tags={"Tes"},
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
     *         @OA\JsonContent(ref="#/components/schemas/Tes")
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
     *     path="/tes",
     *     tags={"Tes"},
     *     operationId="addTes",
     *     summary="添加",
     *     description="",
     *   @OA\RequestBody(
     *       required=true,
     *       description="创建 Tes 对象",
     *       @OA\JsonContent(ref="#/components/schemas/Tes"),
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/Tes")
     *       )
     *   ),
     *     @OA\Response(
     *         response=201,
     *         description="操作成功",
     *         @OA\JsonContent(ref="#/components/schemas/Tes")
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
        $model = new Tes();
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
     *     path="/tes/{id}",
     *     tags={"Tes"},
     *     operationId="updateTesById",
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
     *       description="更新 Tes 对象",
     *       @OA\JsonContent(ref="#/components/schemas/Tes"),
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/Tes")
     *       )
     *   ),
     *     @OA\Response(
     *         response=200,
     *         description="操作成功",
     *         @OA\JsonContent(ref="#/components/schemas/Tes")
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
     *     path="/tes/{id}",
     *     summary="删除Tes",
     *     description="",
     *     operationId="deleteTes",
     *     tags={"Tes"},
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

    public function actionTambahtes()
    { //tambah tes di tabel tes
        $id_buku = Yii::$app->request->post('id_buku');
        $id_user = Yii::$app->request->post('id_user');
        $cek = Tes::find()
        ->where(['id_user'=> $id_user ,'id_buku'=> $id_buku  ]) 
        ->All();
        if($cek==null){
            $model=  new Tes();
            $model->id_user= $id_user;
            $model->id_buku= $id_buku;

            if($model->save()){
                $data['status'] = "ok"; 
                $data['id_tes'] = $model->id_tes; 
                $data['id_buku'] = $model->id_buku; 
            }else{
                $data['status'] = 'error'; 
            }
        }else{
            $cek2 = Tes::find()
            ->where(['id_user'=> $id_user ,'id_buku'=> $id_buku ]) 
            ->one();
            $data['status'] = "ok"; 
            $data['id_tes'] = $cek2->id_tes; 
            $data['id_buku'] = $cek2->id_buku; 
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 200;
        return $data;
    }

    //menambahkan nilai setiap menjawab tes
    public function actionTambahnilai($id_tes){
        $nilai = Yii::$app->request->post('nilai'); 
        $customer = Tes::findOne($id_tes);
        $customer->nilai = $nilai;
        $customer->save();
            if($customer->save()){
                $data['status'] = "ok";  
            }else{
                $data['status'] = 'error'; 
            } 

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 200;
        return $data;
    }

    public function actionHasilbeda($id_user)
    { // rekomendasi chapter berdasarkan jawaban salah
        $hasil= (new Query())
        ->select('t.id_tes, t.id_buku, t.id_user, h.id_tes, h.id_kuis, h.jawaban, 
        k.id_kuis, k.pilihan_benar, k.id_chapter, c.nama_chapter, b.judul_buku, b.cover')
        ->from(['h' => TblHasiltes::tableName()])  
        ->leftJoin(['t' => Tes::tableName()], 'h.id_tes = t.id_tes')
        ->leftJoin(['k' => TblKuis::tableName()], 'h.id_kuis = k.id_kuis') 
        ->leftJoin(['c' => TblChapter::tableName()], 'k.id_chapter = c.id_chapter') 
        ->leftJoin(['b' => TblBuku::tableName()], 'c.id_buku = b.id_buku') 
        ->andWhere(['<>','h.jawaban','k.pilihan_benar']) 
        ->andWhere(['t.id_user'=> $id_user])
        ->all(); 


// $hasil = TblHasiltes::find()->alias('h')
// ->select(['*', 't.id_user'])
// ->leftJoin(Tes::tableName().' t', 't.id_tes = h.id_tes')
// // ->leftJoin(TblKuis::tableName().' k', 'k.id_kuis = h.id_kuis')
// // ->where(['<>','h.jawaban','k.pilihan_benar'])
// ->andWhere(['t.id_user'=> $id_user])
// ->all(); 
 
        return $hasil;
    }

   

    /**
     * Finds the Tes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Tes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tes::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested Tes does not exist.');
    }
}

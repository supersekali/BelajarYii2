<?php

namespace app\controllers\v1;

use Yii;
use yii\db\Query;

use app\models\Users;
use app\models\TblUsers;
use app\models\TblChapter;
use app\models\TblBuku;
use app\models\TblConvertation;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * @OA\Tag(
 *   name="Convertations",
 *   description="Everything about your Convertations",
 *   @OA\ExternalDocumentation(
 *     description="更多相关",
 *     url="http://dakara.cn"
 *   )
 * )
 */
class ConvertationController extends ActiveController
{
    public $modelClass = 'app\models\TblConvertation';

    /**
     * @OA\Get(
     *     path="/convertations",
     *     summary="查询 TblConvertation",
     *     tags={"Convertations"},
     *     description="",
     *     operationId="findTblConvertation",
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
     *             @OA\Items(ref="#/components/schemas/TblConvertation")
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
            'query' => TblConvertation::find()->with('creator')->with('updater'),
        ]);
        return $dataProvider;
    }

    /**
     * @OA\Get(
     *     path="/convertations/{id}",
     *     summary="通过ID显示详情",
     *     description="",
     *     operationId="getTblConvertationById",
     *     tags={"Convertations"},
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
     *         @OA\JsonContent(ref="#/components/schemas/TblConvertation")
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
     *     path="/convertations",
     *     tags={"Convertations"},
     *     operationId="addTblConvertation",
     *     summary="添加",
     *     description="",
     *   @OA\RequestBody(
     *       required=true,
     *       description="创建 TblConvertation 对象",
     *       @OA\JsonContent(ref="#/components/schemas/TblConvertation"),
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/TblConvertation")
     *       )
     *   ),
     *     @OA\Response(
     *         response=201,
     *         description="操作成功",
     *         @OA\JsonContent(ref="#/components/schemas/TblConvertation")
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
        $model = new TblConvertation();
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
     *     path="/convertations/{id}",
     *     tags={"Convertations"},
     *     operationId="updateTblConvertationById",
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
     *       description="更新 TblConvertation 对象",
     *       @OA\JsonContent(ref="#/components/schemas/TblConvertation"),
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/TblConvertation")
     *       )
     *   ),
     *     @OA\Response(
     *         response=200,
     *         description="操作成功",
     *         @OA\JsonContent(ref="#/components/schemas/TblConvertation")
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
     *     path="/convertations/{id}",
     *     summary="删除TblConvertation",
     *     description="",
     *     operationId="deleteTblConvertation",
     *     tags={"Convertations"},
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

    //menampilkan daftar pesan 
    public function actionListchat($id_user){
        $hasil= (new Query())
        ->select('u.id_user,u.nama, u.foto ,b.judul_buku,c.nama_chapter,
            c.id_chapter,d.id_convertation, d.user_one')
        ->from(['d' => TblConvertation::tableName()])
        ->leftJoin(['c' => TblChapter::tableName()], 'c.id_chapter = d.id_chapter')
        ->leftJoin(['b' => TblBuku::tableName()], 'b.id_buku = c.id_buku') 
        ->leftJoin(['u' => TblUsers::tableName()], 'u.id_user = b.id_user') 
        ->where(['d.user_one'=> $id_user]) 
        ->all(); 
        return $hasil;
    }
    // buat pesan baru
    public function actionBuatchat(){ 
        $user_one = Yii::$app->request->post('user_one');
        $user_two = Yii::$app->request->post('user_two'); 
        $id_chapter = Yii::$app->request->post('id_chapter'); 

        $cek = TblConvertation::find()->where(['id_chapter'=> $id_chapter 
        ,'user_one'=> $user_one ,'user_two'=> $user_two ]) 
                                    ->All();

        if($cek == null)
            {
                $model=  new TblConvertation();
                $model->user_one= $user_one;
                $model->user_two= $user_two;
                $model->id_chapter= $id_chapter; 
        
                if($model->save()){
                    $data['status'] = "ok";
                    $data['id_convertation'] = $model->id_convertation; 
                }else{
                    $data['status'] = 'error'; 
                }
            } else {
                $findid = TblConvertation::find()->where(['id_chapter'=>$id_chapter 
                ,'user_one'=>$user_one ,'user_two'=>$user_two])->one();
                $data['status'] = "ok";
                $data['id_convertation'] = $findid->id_convertation; 
            }

        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 200;
        return $data;
    }
    //hapus pesan
    public function actionHapuslistpesan($id_convertation){
        $bisa=(new Query)
        ->createCommand()
        ->delete('convertation', ['id_convertation' => $id_convertation])
        ->execute();

        if($bisa){
            $data['status'] = 'ok'; 
        }else{
            $data['status'] = 'error'; 
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 200;
        return $data;
    }


    
    /**
     * Finds the TblConvertation model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TblConvertation the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblConvertation::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested TblConvertation does not exist.');
    }
}

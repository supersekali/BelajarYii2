<?php

namespace app\controllers\v1;

use Yii;
use yii\db\Query;

use app\models\TblUsers;
use app\models\TblChapter;
use app\models\TblBuku;
use app\models\TblConvertation;
use app\models\TblConvertation_replay;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * @OA\Tag(
 *   name="Convertationreplays",
 *   description="Everything about your Convertationreplays",
 *   @OA\ExternalDocumentation(
 *     description="更多相关",
 *     url="http://dakara.cn"
 *   )
 * )
 */
class ConvertationreplayController extends ActiveController
{
    public $modelClass = 'app\models\TblConvertation_replay';

    /**
     * @OA\Get(
     *     path="/convertationreplays",
     *     summary="查询 TblConvertation_replay",
     *     tags={"Convertationreplays"},
     *     description="",
     *     operationId="findTblConvertation_replay",
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
     *             @OA\Items(ref="#/components/schemas/TblConvertation_replay")
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
            'query' => TblConvertation_replay::find()->with('creator')->with('updater'),
        ]);
        return $dataProvider;
    }

    /**
     * @OA\Get(
     *     path="/convertationreplays/{id}",
     *     summary="通过ID显示详情",
     *     description="",
     *     operationId="getTblConvertation_replayById",
     *     tags={"Convertationreplays"},
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
     *         @OA\JsonContent(ref="#/components/schemas/TblConvertation_replay")
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
     *     path="/convertationreplays",
     *     tags={"Convertationreplays"},
     *     operationId="addTblConvertation_replay",
     *     summary="添加",
     *     description="",
     *   @OA\RequestBody(
     *       required=true,
     *       description="创建 TblConvertation_replay 对象",
     *       @OA\JsonContent(ref="#/components/schemas/TblConvertation_replay"),
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/TblConvertation_replay")
     *       )
     *   ),
     *     @OA\Response(
     *         response=201,
     *         description="操作成功",
     *         @OA\JsonContent(ref="#/components/schemas/TblConvertation_replay")
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
        $model = new TblConvertation_replay();
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
     *     path="/convertationreplays/{id}",
     *     tags={"Convertationreplays"},
     *     operationId="updateTblConvertation_replayById",
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
     *       description="更新 TblConvertation_replay 对象",
     *       @OA\JsonContent(ref="#/components/schemas/TblConvertation_replay"),
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/TblConvertation_replay")
     *       )
     *   ),
     *     @OA\Response(
     *         response=200,
     *         description="操作成功",
     *         @OA\JsonContent(ref="#/components/schemas/TblConvertation_replay")
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
     *     path="/convertationreplays/{id}",
     *     summary="删除TblConvertation_replay",
     *     description="",
     *     operationId="deleteTblConvertation_replay",
     *     tags={"Convertationreplays"},
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

    //menampilkan list pesan
    public function actionChatting($id_convertation){
        $hasil= (new Query())
        ->select('cr.id, cr.replay, cr.id_user, cr.time, u.foto, u.id_user, u.nama')
        ->from(['cr' => TblConvertation_replay::tableName()])    
        ->leftJoin(['u' => TblUsers::tableName()], 'u.id_user = cr.id_user') 
        ->where(['cr.id_convertation'=> $id_convertation]) 
        ->all(); 
        return $hasil;
    }
    //tambah pesan
    public function actionTambahreplay(){
        $id_convertation = Yii::$app->request->post('id_convertation');
        $id_user = Yii::$app->request->post('id_user');
        $replay = Yii::$app->request->post('replay'); 

        $model=  new TblConvertation_replay();
        $model->id_convertation= $id_convertation;
        $model->id_user= $id_user;
        $model->replay= $replay; 
        $hasil= $model->save();
        
        if($hasil){ 
            $data['id'] = $model->id;  
            $id= $model->id; 
            $data['status'] = 'Terkirim'; 
            $data['pesan'] = $replay; 

            $time = TblConvertation_replay::find()->select('time')
            ->where(['id'=> $id])  
            ->one()
            ->time;
            $data['time'] = $time; 
        }else{
            $data['status'] = 'error'; 
        }
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 200;
        return $data;
    }
    //hapus pesan
    public function actionHapuspesan($id){
        $bisa=(new Query)
        ->createCommand()
        ->delete('convertation_replay', ['id' => $id])
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

    public function actionListchat($id_user){
        $hasil= (new Query())
        ->select('u.id_user,u.nama, u.foto ,b.judul_buku,c.nama_chapter,
            c.id_chapter, ch.id_convertation, ch.user_one, cr.id_user')
        ->from(['cr' => TblConvertation_replay::tableName()])
        ->leftJoin(['ch' => TblConvertation::tableName()], 'ch.id_convertation = cr.id_convertation')
        ->leftJoin(['c' => TblChapter::tableName()], 'c.id_chapter = ch.id_chapter')
        ->leftJoin(['b' => TblBuku::tableName()], 'b.id_buku = c.id_buku') 
        ->leftJoin(['u' => TblUsers::tableName()], 'u.id_user = b.id_user') 
        ->where(['ch.user_one'=> $id_user]) 
        ->andwhere (['cr.id_user' => $id_user])
        ->all(); 
        return $hasil;
    }


    /**
     * Finds the TblConvertation_replay model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TblConvertation_replay the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblConvertation_replay::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested TblConvertation_replay does not exist.');
    }
}

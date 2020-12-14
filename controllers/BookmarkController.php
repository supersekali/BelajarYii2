<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
use app\models\TblBookmark;
use app\models\Users;
use app\models\TblUsers;
use app\models\TblChapter;
use app\models\TblBuku;
use app\models\TblBukuSearch;
use app\models\TblChapterSearch;
use yii\data\ActiveDataProvider;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;

/**
 * @OA\Tag(
 *   name="Bookmarks",
 *   description="Everything about your Bookmarks",
 *   @OA\ExternalDocumentation(
 *     description="更多相关",
 *     url="http://dakara.cn"
 *   )
 * )
 */
class BookmarkController extends ActiveController
{
    public $modelClass = 'app\models\TblBookmark';

    /**
     * @OA\Get(
     *     path="/bookmarks",
     *     summary="查询 TblBookmark",
     *     tags={"Bookmarks"},
     *     description="",
     *     operationId="findTblBookmark",
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
     *             @OA\Items(ref="#/components/schemas/TblBookmark")
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
            'query' => TblBookmark::find()->with('creator')->with('updater'),
        ]);
        return $dataProvider;
    }

    /**
     * @OA\Get(
     *     path="/bookmarks/{id}",
     *     summary="通过ID显示详情",
     *     description="",
     *     operationId="getTblBookmarkById",
     *     tags={"Bookmarks"},
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
     *         @OA\JsonContent(ref="#/components/schemas/TblBookmark")
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
     *     path="/bookmarks",
     *     tags={"Bookmarks"},
     *     operationId="addTblBookmark",
     *     summary="添加",
     *     description="",
     *   @OA\RequestBody(
     *       required=true,
     *       description="创建 TblBookmark 对象",
     *       @OA\JsonContent(ref="#/components/schemas/TblBookmark"),
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/TblBookmark")
     *       )
     *   ),
     *     @OA\Response(
     *         response=201,
     *         description="操作成功",
     *         @OA\JsonContent(ref="#/components/schemas/TblBookmark")
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
        $model = new TblBookmark();
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
     *     path="/bookmarks/{id}",
     *     tags={"Bookmarks"},
     *     operationId="updateTblBookmarkById",
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
     *       description="更新 TblBookmark 对象",
     *       @OA\JsonContent(ref="#/components/schemas/TblBookmark"),
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/TblBookmark")
     *       )
     *   ),
     *     @OA\Response(
     *         response=200,
     *         description="操作成功",
     *         @OA\JsonContent(ref="#/components/schemas/TblBookmark")
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
     *     path="/bookmarks/{id}",
     *     summary="删除TblBookmark",
     *     description="",
     *     operationId="deleteTblBookmark",
     *     tags={"Bookmarks"},
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
     * 
     * 
     */

     

     

    public function actionTambahbookmark(){



        $id_chapter = Yii::$app->request->post('id_chapter');
        $id_user = Yii::$app->request->post('id_user');

        $cek = TblBookmark::find()->where(['id_chapter'=> $id_chapter ,'id_user'=> $id_user  ]) 
        ->All();

        if($cek == null){
            $model=  new TblBookmark();
            $model->id_user= $id_user;
            $model->id_chapter= $id_chapter;
            
            if($model->save()){
                $data['status'] = 'ok'; 
            }else{
                $data['status'] = 'error'; 
            }
        } else {
            $findid = TblBookmark::find()->where(['id_chapter'=>$id_chapter ] && ['id_user'=>$id_user ])->one();
            $data['status'] = "ok"; 
        }

        
        
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        Yii::$app->response->statusCode = 200;
        return $data;
    }

    public function actionHapusbookmark($id_chapter,$id_user){
        $bisa=(new Query)
        ->createCommand()
        ->delete('bookmark', ['id_user' => $id_user,'id_chapter' => $id_chapter ])
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

    public function actionHapusbookmark2($id_bookmark){
        $bisa=(new Query)
        ->createCommand()
        ->delete('bookmark', ['id_bookmark' => $id_bookmark])
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

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->softDelete() === false) {
            throw new ServerErrorHttpException('Failed to delete the object for unknown reason.');
        }
        Yii::$app->getResponse()->setStatusCode(204);
    }



    public function actionBookmark2($id_user){

        $chapter = TblBookmark::find()->select(['id_chapter'])->where(['id_user' => $id_user])->All(); 
        $idbuku = TblChapter::find()->select(['id_buku'])->where(['id_chapter' => $chapter])->All();

        $hasil3= (new Query())
        ->select('b.id_bookmark,c.nama_chapter,c.id_chapter,c.chapter,d.judul_buku,d.cover')
        ->from(['b' => TblBookmark::tableName()])  
        ->leftJoin(['c' => TblChapter::tableName()], 'c.id_chapter = b.id_chapter')
        ->leftJoin(['d' => TblBuku::tableName()], 'd.id_buku = c.id_buku') 
        ->where(['b.id_user'=> $id_user])
        ->all();
        return $hasil3;
    }

    /**
     * Finds the TblBookmark model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TblBookmark the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TblBookmark::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested TblBookmark does not exist.');
    }
}

<?php

namespace app\controllers\v1;

use Yii;
use app\models\TblBuku;
use app\models\TblBukuSearch;
use yii\db\Query;
use app\models\TblChapter;
use app\models\TblUsers;
use app\models\User;
use app\models\TblRekomendasi;
use app\models\TblRekomendasiSearch;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\Response;
use yii\filters\ContentNegotiator;

/**
 * @OA\Tag(
 *   name="Bukus",
 *   description="Everything about your Bukus",
 *   @OA\ExternalDocumentation(
 *     description="更多相关",
 *     url="http://dakara.cn"
 *   )
 * )
 */
class BukuController extends ActiveController
{
    public $modelClass = 'app\models\TblBuku';
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    // 'application/xml' => Response::FORMAT_XML,
                ],
            ],
        ];
    }
    /**
     * @OA\Get(
     *     path="/bukus",
     *     summary="查询 TblBuku",
     *     tags={"Bukus"},
     *     description="",
     *     operationId="findTblBuku",
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
     *             @OA\Items(ref="#/components/schemas/TblBuku")
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
        $searchModel = new TblBukuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $dataProvider;
    }

    /**
     * @OA\Get(
     *     path="/bukus/{id}",
     *     summary="通过ID显示详情",
     *     description="",
     *     operationId="getTblBukuById",
     *     tags={"Bukus"},
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
     *         @OA\JsonContent(ref="#/components/schemas/TblBuku")
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
     *     path="/bukus",
     *     tags={"Bukus"},
     *     operationId="addTblBuku",
     *     summary="添加",
     *     description="",
     *   @OA\RequestBody(
     *       required=true,
     *       description="创建 TblBuku 对象",
     *       @OA\JsonContent(ref="#/components/schemas/TblBuku"),
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/TblBuku")
     *       )
     *   ),
     *     @OA\Response(
     *         response=201,
     *         description="操作成功",
     *         @OA\JsonContent(ref="#/components/schemas/TblBuku")
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
        $model = new TblBuku();
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
     *     path="/bukus/{id}",
     *     tags={"Bukus"},
     *     operationId="updateTblBukuById",
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
     *       description="更新 TblBuku 对象",
     *       @OA\JsonContent(ref="#/components/schemas/TblBuku"),
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/TblBuku")
     *       )
     *   ),
     *     @OA\Response(
     *         response=200,
     *         description="操作成功",
     *         @OA\JsonContent(ref="#/components/schemas/TblBuku")
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
     *     path="/bukus/{id}",
     *     summary="删除TblBuku",
     *     description="",
     *     operationId="deleteTblBuku",
     *     tags={"Bukus"},
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



    public function actionRekomendasi($id_user)
    {
        $user = TblUsers::find()->select('pendidikan,minat,pekerjaan')
        ->where(['id_user'=>$id_user])->one();
        $cari = $user->pendidikan.','.$user->minat.','.$user->pekerjaan;
        $params = explode(',',$cari);
         
        $bookCount = 0;
        if(!empty($params)) { 

            $books = TblBuku::find();
            foreach ($params as $val) {
                $books->orWhere(['or',['like','judul_buku', $val],
                ['like','penulis', $val],
                ['like','kategori', $val],['like','penerbit', $val],
                ['like','jenjang', $val],
                ['like','deskripsi', $val]]);
            }
            $bookCount = $books->count(); 
            $bookAll = $books
                ->orderBy('id_buku DESC')
                ->all();
            
        }
        
        return $bookAll; 
    }



    public function actionBukusaya($id_user){
        $books = TblBuku::find()->where(['id_user' =>$id_user])->all();

        return $books;
    }

    public function actionDetailbuku($id_buku){
        //$books = TblBuku::find()->where(['id_buku' =>$id_buku])->all();

        $books =(new Query())->select('b.*,u.id_user, u.nama')
                             ->from(['b' => TblBuku::tableName()])
                             ->leftJoin(['u' => TblUsers::tableName()], 'u.id_user = b.id_user')
                             ->where(['b.id_buku'=> $id_buku]) 
                             ->all();




       /* $hasil3= (new Query())
        ->select('b.id_bookmark,c.nama_chapter,d.judul_buku,d.cover')
        ->from(['b' => TblBookmark::tableName()])  
        ->leftJoin(['c' => TblChapter::tableName()], 'c.id_chapter = b.id_chapter')
        ->leftJoin(['d' => TblBuku::tableName()], 'd.id_buku = c.id_buku') 
        ->where(['b.id_user'=> $id_user])
        ->all();*/



        return $books;
    }


    public function actionChatroom($id_user,$id_chapter){
 
        $hasil= (new Query())
        ->select('u.nama, u.foto ,b.judul_buku,c.nama_chapter')
        ->from(['b' => TblBuku::tableName()])  
        ->leftJoin(['c' => TblChapter::tableName()], 'c.id_buku = b.id_buku')
        ->leftJoin(['u' => TblUsers::tableName()], 'u.id_user = b.id_user') 
        ->where(['b.id_user'=> $id_user])
        ->where(['c.id_chapter'=> $id_chapter])
        ->all();  
       return  $hasil; 
        
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
            return $model;
        }
        throw new NotFoundHttpException('The requested TblBuku does not exist.');
    }

  

}

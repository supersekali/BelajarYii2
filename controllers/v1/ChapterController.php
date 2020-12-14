<?php

namespace app\controllers\v1;

use Yii;
use app\models\TblChapter;
use app\models\TblChapterSearch;
use yii\rest\ActiveController;
use yii\web\NotFoundHttpException;
use yii\web\ServerErrorHttpException;
use yii\web\Response;
use yii\filters\ContentNegotiator;

/**
 * @OA\Tag(
 *   name="Chapters",
 *   description="Everything about your Chapters",
 *   @OA\ExternalDocumentation(
 *     description="更多相关",
 *     url="http://dakara.cn"
 *   )
 * )
 */
class ChapterController extends ActiveController
{
    public $modelClass = 'app\models\TblChapter';
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
     *     path="/chapters",
     *     summary="查询 TblChapter",
     *     tags={"Chapters"},
     *     description="",
     *     operationId="findTblChapter",
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
     *             @OA\Items(ref="#/components/schemas/TblChapter")
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
        $searchModel = new TblChapterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $dataProvider;
    }

    /**
     * @OA\Get(
     *     path="/chapters/{id}",
     *     summary="通过ID显示详情",
     *     description="",
     *     operationId="getTblChapterById",
     *     tags={"Chapters"},
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
     *         @OA\JsonContent(ref="#/components/schemas/TblChapter")
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
     *     path="/chapters",
     *     tags={"Chapters"},
     *     operationId="addTblChapter",
     *     summary="添加",
     *     description="",
     *   @OA\RequestBody(
     *       required=true,
     *       description="创建 TblChapter 对象",
     *       @OA\JsonContent(ref="#/components/schemas/TblChapter"),
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/TblChapter")
     *       )
     *   ),
     *     @OA\Response(
     *         response=201,
     *         description="操作成功",
     *         @OA\JsonContent(ref="#/components/schemas/TblChapter")
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
        $model = new TblChapter();
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
     *     path="/chapters/{id}",
     *     tags={"Chapters"},
     *     operationId="updateTblChapterById",
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
     *       description="更新 TblChapter 对象",
     *       @OA\JsonContent(ref="#/components/schemas/TblChapter"),
     *       @OA\MediaType(
     *           mediaType="multipart/form-data",
     *           @OA\Schema(ref="#/components/schemas/TblChapter")
     *       )
     *   ),
     *     @OA\Response(
     *         response=200,
     *         description="操作成功",
     *         @OA\JsonContent(ref="#/components/schemas/TblChapter")
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
     *     path="/chapters/{id}",
     *     summary="删除TblChapter",
     *     description="",
     *     operationId="deleteTblChapter",
     *     tags={"Chapters"},
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
    //menampilkan id_test dari tabel tes berdasarkan id_user
        $allTes = Tes::findModel(id_test)
            ->select(['id_tes'])
            ->where(['id_user'=> $id_user])
            ->all();
    //menampilkan data dari tabel hasil_tes berdasarkan var $allTes        
        $allhasiltes = TblHasiltes::find( ) 
            ->where(['id_tes'=> $allTes])
            ->all();

        
        
        
 

        $returnArray = [];
        foreach ($allBook as $key => $val) {
            $returnArray[$key] = [
                'id_chapter' => $val->id_chapter,
                'id_buku' => $val->id_buku,
                'nama_chapter' => $val->nama_chapter,
                'chapter' => $val->chapter,
                'level_kesulitan' => $val->level_kesulitan,
                'batasan' => $val->batasan,
                'rekomendasi' => $val->rekomendasi,
            ];
        }
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
        throw new NotFoundHttpException('The requested TblChapter does not exist.');
    }
}

<?php
// print_r(Yii::$app->user->identity->id_user);
// exit;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblBukuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Upload Books'; 
?>
	<div class="card card-nav-tabs">
		<div class="card-header" data-background-color="blue">
            <div class="tbl-buku-index">
                <table class="table">
					<tbody>
						<tr>
							<td> 
                                <h3><?= Html::encode($this->title) ?></h3>
                            </td>
                            <td align= right>
                                <p><?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            </div>
         </div>

        <div class="card-content">
            <div class="tab-content">
            
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        //'id_buku', 
                        [
                            'attribute' => 'cover',
                            'value' => function($model, $key , $index, $column){
                                return Yii::getAlias('@bukuImgUrl') . '/' . $model->cover;
                            },
                            'format'=> ['image', ['width'=>'10px' , 'height' => '10px']]
                            
                        ],
                        'judul_buku',
                        'penulis',
                        'kategori',
                        'tahun_terbit',
                        'kota_terbit',
                        'penerbit',
                        'jenjang',
                        'deskripsi:ntext',
                        //'id_user',

                        ['class' => 'yii\grid\ActionColumn'],
                ],
        ]); ?>

            </div>
        </div>
    </div>

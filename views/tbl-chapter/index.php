<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblChapterSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Uploads Chapter'; 
?>
<div class="card card-nav-tabs">
	<div class="card-header" data-background-color="blue">
        <div class="tbl-buku-index">
            <table class="table">
				<tbody>
				    <tr>
						<td> 
                            <h4><?= Html::encode($this->title) ?></h4>
                        </td>
                        <td align= right>
                            <p>
                                <?= Html::a('Create Tbl Chapter', ['create'], ['class' => 'btn btn-success']) ?>
                            </p>
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

                     //'id_chapter',
                    'buku.judul_buku',
                     //'id_buku',
                    'nama_chapter',
                      'chapter', 
                       'level_kesulitan',

                ['class' => 'yii\grid\ActionColumn'],
                            ],
                ]); ?>
        </div>
    </div>
</div>

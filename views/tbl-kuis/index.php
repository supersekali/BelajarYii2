<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblKuisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Upload Quiz';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-nav-tabs">
	<div class="card-header" data-background-color="blue">
        <div class="tbl-kuis-index">
            <table class="table">
				<tbody>
				    <tr>
						<td>  
                            <h4><?= Html::encode($this->title) ?></h4>
                        </td>
                        <td align= right>
                            <p>
                                <?= Html::a('Create Tbl Kuis', ['create'], ['class' => 'btn btn-success']) ?>
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

                    //'id_kuis',
                    //'id_chapter', 
                    'chapter.nama_chapter',
                    'soal',
                    'pilihan_benar',
                    'pilihan_a',
                     'pilihan_b',
                     'pilihan_c',
                     'pilihan_d',
                     'pilihan_e',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
    </div>
</div>

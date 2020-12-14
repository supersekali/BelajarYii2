<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TblRekomendasiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Rekomendasis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rekomendasi-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Rekomendasi', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_rekomendasi',
            'id_user',
            'id_buku',
            'bobot',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>

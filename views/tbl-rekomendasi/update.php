<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\rekomendasi */

$this->title = 'Update Rekomendasi: ' . $model->id_rekomendasi;
$this->params['breadcrumbs'][] = ['label' => 'Rekomendasis', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_rekomendasi, 'url' => ['view', 'id' => $model->id_rekomendasi]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="rekomendasi-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

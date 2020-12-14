<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblBuku */

$this->title = 'Update Buku: ' . $model->judul_buku;
$this->params['breadcrumbs'][] = ['label' => 'Update Book', 'url' => ['admin/tblbuku']];
$this->params['breadcrumbs'][] = ['label' => $model->id_buku, 'url' => ['view', 'id' => $model->id_buku]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="card card-nav-tabs">
	<div class="card-header" data-background-color="blue">
        <div class="tbl-buku-update">
            <h4><?= Html::encode($this->title) ?></h4>
        </div>
    </div>
    <div class="card-content">
        <div class="tab-content">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>

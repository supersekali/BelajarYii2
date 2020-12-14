<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblUsers */ 
$this->title = 'Update Tbl Users: ' . $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_user, 'url' => ['view', 'id' => $model->id_user]];
$this->params['breadcrumbs'][] = 'Update';

?>
<div class="card card-nav-tabs">
	<div class="card-header" data-background-color="blue">
        <div class="tbl-kuis-update"> 
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

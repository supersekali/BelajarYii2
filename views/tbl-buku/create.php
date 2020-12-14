<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblBuku */

$this->title = 'Create Book';
$this->params['breadcrumbs'][] = ['label' => 'Upload Book', 'url' => ['admin/tblbuku']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-nav-tabs">
	<div class="card-header" data-background-color="blue">
        <div class="tbl-buku-create">

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

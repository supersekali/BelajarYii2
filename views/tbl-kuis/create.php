<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblKuis */

$this->title = 'Create Quiz';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Kuis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-nav-tabs">
	<div class="card-header" data-background-color="blue">
        <div class="tbl-kuis-create">
            <h4><?= Html::encode($this->title) ?></h4>
        </div>
    </div>
    
    <div class="card-content">
        <div class="tab-content">
            <?= $this->render('_form', [
                'model' => $model,
                'dafChap'=> $dafChap,
            ]) ?>
        </div>
    </div>
</div>


<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblChapter */

$this->title = 'Create Chapters';
$this->params['breadcrumbs'][] = ['label' => 'Tbl Chapters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-nav-tabs">
	<div class="card-header" data-background-color="blue">
        <div class="tbl-chapter-create">
            <h4><?= Html::encode($this->title) ?></h4>
        </div>
    </div>
    <div class="card-content">
        <div class="tab-content">
            <?= $this->render('_form', [
                'model' => $model,
                'dafBuku' =>$dafBuku, 

            ]) ?>
        </div>
    </div>
</div>

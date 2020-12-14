<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TblChapter */

$this->title = 'Update Chapter: ' . $model->nama_chapter;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Chapters', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_chapter, 'url' => ['view', 'id' => $model->id_chapter]];
$this->params['breadcrumbs'][] = 'Update';
?>
    <div class="card card-nav-tabs">
        <div class="card-header" data-background-color="blue">
            <div class="tbl-chapter-update">
                <h4><?= Html::encode($this->title) ?></h4>
            </div>
        </div>
        <div class="card-content">
            <div class="tab-content">
                <?= $this->render('_form', [
                    'model' => $model,
                    'dafBuku' =>$dafBuku ,
                ]) ?>
            </div>  
        </div>
    </div>

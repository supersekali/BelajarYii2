<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblChapterSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-chapter-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_chapter') ?>

    <?= $form->field($model, 'id_buku') ?>

    <?= $form->field($model, 'nama_chapter') ?>

    <?= $form->field($model, 'chapter') ?>

    <?= $form->field($model, 'level_kesulitan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

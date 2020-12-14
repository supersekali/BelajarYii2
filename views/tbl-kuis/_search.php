<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblKuisSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-kuis-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_kuis') ?>

    <?= $form->field($model, 'id_chapter') ?>

    <?= $form->field($model, 'soal') ?>

    <?= $form->field($model, 'pilihan_benar') ?>

    <?= $form->field($model, 'pilihan_a') ?>

    <?php // echo $form->field($model, 'pilihan_b') ?>

    <?php // echo $form->field($model, 'pilihan_c') ?>

    <?php // echo $form->field($model, 'pilihan_d') ?>

    <?php // echo $form->field($model, 'pilihan_e') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblBukuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-buku-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_buku') ?>

    <?= $form->field($model, 'cover') ?>

    <?= $form->field($model, 'judul_buku') ?>

    <?= $form->field($model, 'penulis') ?>

    <?= $form->field($model, 'kategori') ?>

    <?php  echo $form->field($model, 'tahun_terbit') ?>

    <?php // echo $form->field($model, 'jenjang') ?>

    <?php // echo $form->field($model, 'deskripsi') ?>

    <?php // echo $form->field($model, 'id_user') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

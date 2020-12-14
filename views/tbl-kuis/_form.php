<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblKuis */
/* @var $form yii\widgets\ActiveForm */
?> 

<div class="tbl-kuis-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_chapter')->dropDownList($dafChap,['prompt'=> '-Pilih Chapter-'])->label('Nama Chapter') ?>
   
    <?= $form->field($model, 'soal')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pilihan_benar')->dropDownList(['prompt'=> '-Jawaban Benar-','a' => 'A','b' => 'B','c' => 'C','d' => 'D','e' => 'E']) ?>

    <?= $form->field($model, 'pilihan_a')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pilihan_b')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pilihan_c')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pilihan_d')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pilihan_e')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

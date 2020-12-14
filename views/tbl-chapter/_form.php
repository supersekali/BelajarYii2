<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblChapter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbl-chapter-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //echo= $form->field($model, 'id_chapter')->textInput(['value' => $type,'disabled' => true]) ?>

    <?= $form->field($model, 'id_buku')->dropDownList($dafBuku,['prompt'=> '-Pilih Buku-'])->label('Nama Buku') ?>

    <?= $form->field($model, 'nama_chapter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chapter')->fileInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'level_kesulitan')->dropDownList(['prompt'=> '-Tingkat Kesulitan-','1' => 'Mudah','2' => 'Sedang','3' => 'Sulit']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

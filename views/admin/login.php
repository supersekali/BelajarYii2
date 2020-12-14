<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card card-login">
	<div class="card-header text-center" data-background-color="blue">
		<h4 class="card-title"><?= Html::encode($this->title) ?></h4>
	</div>
	<div class="card-body">
		<br/>
		<p class="card-description text-center">Please fill out the following fields to login:</p>
		<div class="card-content">
			<?php $form = ActiveForm::begin([
				'id' => 'login-form',
				// 'layout' => 'horizontal',
				// 'fieldConfig' => [
				// 	'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
				// 	'labelOptions' => ['class' => 'col-lg-1 control-label'],
				// ],
			]); ?>
				<div>
					<?php 
						$field = $form->field($model, 'username', ['options' => ['class' => 'form-group label-floating']]);
						$field->template = "{label}\n{input}\n{error}";  
						echo $field->textInput(['autofocus' => true]);
					?>
				</div>
				<div>
					<?php 
						$field = $form->field($model, 'password', ['options' => ['class' => 'form-group label-floating']]);
						$field->template = "{label}\n{input}\n{error}";  
						echo $field->passwordInput();
					?>
				</div>
				<div>
					<?= $form->field($model, 'rememberMe')->checkbox([
						'template' => "{input} {label}</div>\n<div class=\"col-lg-8\">{error}",
					]) ?>
				</div>
				<div>
					<?= Html::submitButton('Login', ['class' => 'btn btn-info', 'name' => 'login-button']) ?>
				</div>

			<?php ActiveForm::end(); ?>
		</div>
	</div>
</div>
<?php /* 
<div class="site-login">
    

    <div class="col-lg-offset-1" style="color:#999;">
        You may login with <strong>admin/admin</strong> or <strong>demo/demo</strong>.<br>
        To modify the username/password, please check out the code <code>app\models\User::$users</code>.
    </div>
</div> */ ?>

<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblUsers */

$this->title = $model->nama;
$this->params['breadcrumbs'][] = ['label' => 'Tbl Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="card card-nav-tabs">
	<div class="card-header" data-background-color="blue">
        <div class="tbl-users-view">
            <table class="table">
                <tbody>
                    <tr>
                        <td> 
                            <h14><?= Html::encode($this->title) ?></h4>
                        </td>
                        <td>  
                            <p align = right>
                                <?= Html::a('Update', ['update', 'id' => $model->id_user], ['class' => 'btn btn-primary']) ?>
                                <?= Html::a('Delete', ['delete', 'id' => $model->id_user], [
                                    'class' => 'btn btn-danger',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this item?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                            </p>
                        </td> 
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-content">
        <div class="tab-content">
        <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_user',
            'username',
            'password',
            'authKey',
            'accessToken',
            'role',
            'foto',
            'nama',
            'pendidikan',
            'minat',
            'pekerjaan',
            'alamat:ntext',
            'usia',
                ],
            ]) ?>
        </div>
    </div>
</div>

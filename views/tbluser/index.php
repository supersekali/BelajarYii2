<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

   
$this->title = 'Data Diri'; 
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" data-background-color="blue">
                        <div class="tbl-users-index">
                    
                            <h4><?= Html::encode($this->title) 
                           ?></h4>
                        </div>
                    </div>

                    <div class="card-content">  
                        <div class="tab-content">
              
                            <?= GridView::widget([
                                'dataProvider' => $dataProvider,
                                'columns' => [
                                    ['class' => 'yii\grid\SerialColumn'],
                                    'username',
                                    'nama',
                                    'pendidikan',
                                    'minat', 
                                    //'foto',
                                    // [
                                    //     'attribute' => 'foto',
                                    //     'value' => function($model, $key , $index, $column){
                                    //         return Yii::getAlias('@studentImgUrl') . '/' . $model->foto;
                                    //     },
                                    //     'format'=> ['image', ['width'=>'10px' , 'height' => '10px']]
                                        
                                    // ],
                                    'pekerjaan',
                                    'alamat:ntext', 
                                    ['class' => 'yii\grid\ActionColumn'],
                                ],
                            ]);  ?>
                        </div>
                    </div>
                </div>       
            </div>        
        <div class="row">    
            <div class="col-md-4">
                <div class="card card-profile">
                    <div class="card-avatar">
                        <a href="javascript:;">
                         <img class="img" src=<?php echo Yii::getAlias('@studentImgUrl') . '/' . $model->foto;?> />
                        </a>
                    </div>
                    <div class="card-body">
                        <h6 class="card-category text-gray"><?php echo $model->pekerjaan;?> </h6>
                        <h4 class="card-title">
                             <?php echo $model->nama;
                             ?> 
                         </h4>
                        <p class="card-description">
                        <?php echo $model->alamat;?> 
                        </p>
                        <!-- <a href="javascript:;" class="btn btn-primary btn-round">Follow</a> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
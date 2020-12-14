<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TblBuku */

$this->title = $model->judul_buku; 
\yii\web\YiiAsset::register($this);
?>   
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-7">
                <div class="card card-nav-tabs">
                    <div class="card-header" data-background-color="blue">
                        <div class="tbl-buku-view">
                            <h4>Judul Buku : <?= Html::encode($this->title) ?></h4>          
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="tab-content">
                            <table class="table2">
                                <tbody>
                                    <tr>
                                        <td> 
                                            <a href="javascript:;">
                                                <img class="img" src=<?php echo Yii::getAlias('@bukuImgUrl') . '/' . $model->cover;?> />
                                            </a> 
                                        </td> 
                                        <td>
                                        <?= DetailView::widget([
                                                'model' => $model,
                                                'attributes' => [ 
                                                    'judul_buku',
                                                    'penulis',
                                                    'kategori',
                                                    'tahun_terbit',
                                                    'kota_terbit',
                                                    'penerbit',
                                                    'jenjang',
                                                    'deskripsi:ntext', 
                                                ],
                                            ]) ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> 
        <div class="row">
            <div class="col-md-5">
                <div class="card card-nav-tabs">
                    <div class="card-header" data-background-color="blue"> 
                        <h4>Chapter</h4>
                    </div>
                    <div class="card-content">  
                        <div class="tab-content">
                            <?php if ($model2!=null){
                                foreach ($model2 as $key => $value) {?>
                                    <div class="stats">
                                    <div class="card-footer"> 
                                        <h6 class="title"><a href="<?php echo Yii::getAlias('@chapterPdfUrl') . '/' . $value->chapter;?>" target="_blank"><?php echo $value->nama_chapter; ?> </a></h6> 
                                        <embed src="<?php echo Yii::getAlias('@chapterPdfUrl') . '/' . $value->chapter;?>#toolbar=0&navpanes=0&scrollbar=0" width="500" height="375"  type="application/pdf">
                                       
                                        </div>
                                    </div>
                                <?php }
                                }?>	
                        </div>
                    </div>
                </div>       
            </div>        
        </div>
    </div> 
</div>
<!-- / Tampilan Chapter -->
 
<div class="content">
    <div class="container-fluid">
        
       
<!-- / Tampilan pdf -->

        <div class="row">
                <div class="card card-nav-tabs">
                    <div class="card-header" data-background-color="blue"> 
                        <h4>Quiz</h4>
                    </div>
                    <div class="card-content">
                        <div class="tab-content">
                            <table>
                                <?php if ($model3!=null){
                                    foreach ($model3 as $key => $value) {?>
                                    <tbody class="card-footer">
                                        <tr>
                                            <td>  
                                            <h6 class="title"><?php echo $value->soal;?></h6>
                                            </td> 
                                        </tr>
                                        <tr>
                                            <td>
                                            a. <?php echo $value->pilihan_a;?>
                                            </td>
                                            <td>
                                            d. <?php echo $value->pilihan_d;?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                            b. <?php echo $value->pilihan_b;?>
                                            </td>
                                            <td>
                                            e. <?php echo $value->pilihan_e;?>
                                            </td>
                                        </tr>
                                        <tr >
                                            <td>
                                            c. <?php echo $value->pilihan_c;?>
                                            </td>
                                            <td> 
                                            </td>
                                        </tr>
                                </tbody>
                                <?php }
                                }?>	
                            </table>
                        </div>
                    </div>
                </div>            
        </div> 
    </div> 
</div>

 

 
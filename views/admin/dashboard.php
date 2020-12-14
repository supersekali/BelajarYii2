<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
/* @var $this yii\web\View */

$this->title = 'Dashboard';
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<?php if ($model1!=null){
				foreach ($model1 as $key => $value) {?>
					<div class="col-lg-3 col-md-6 col-sm-6">
						<div class="card card-stats">
							<div class="card-header" data-background-color="blue">
								<a href="javascript:;">
									<img class="img" src=<?php echo Yii::getAlias('@bukuImgUrl') . '/' . $value->cover;?> />
								</a>
							</div>
							<table class="table">
							<tr>
							<td>
							<div class="card-content">
								<h4 class="title"><?php echo $value->judul_buku;?></h4>
								<p class="category"><?php echo $value->penulis;?></p>
								<p class="category"><?php echo $value->kategori;  echo '  .  '; echo $value->tahun_terbit;?></p>
							</div>
							<div class="card-footer">
								<div class="stats">
									<i class="text-danger"></i> <a href="<?php echo Url::toRoute(['admin/chapter','id'=>$value->id_buku]); ?>">Lihat Detail Buku...</a>
								</div>
							</div>
							</td>
							</tr>
							</table>
						</div>
					</div>
					<?php }
					}?>	
			</div>
		</div>
	</div>				 
</div>
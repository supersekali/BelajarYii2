<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use yii\dependencies;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
// Register class
if (class_exists('ramosisw\CImaterial\web\MaterialAsset')) {
	ramosisw\CImaterial\web\MaterialAsset::register($this);
}
use app\themes\backend\assets\BackendAsset;
BackendAsset::register($this);
$urlAsset = BackendAsset::register($this);
?>
<?php $this->beginPage();?>
<!DOCTYPE html>
<html lang="">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta charset="" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#317EFB" />
	<?php echo Html::csrfMetaTags() ?>
	<title></title>
	<?php $this->head() ?>
</head>

<body class="loginpage">
	<?php $this->beginBody();?>
	<nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute">
		<div class="container">
			<div class="title">
			<div class="logo" align ="center"> 
			<img src="../themes/backend/images/resource/logo2.png">
			</div>
			</div>
			 
		</div>
	</nav>
	<div class="wrapper wrapper-full-page">
		<div filter-color="black" 
			style="background-image: url('<?php echo $urlAsset->baseUrl;?>/images/resource/login-bg.jpg'); background-size: cover; background-position: top center; min-height: 100vh;">
			<!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-6 col-sm-8 col-lg-offset-4 col-md-offset-3 col-sm-offset-2">
						<?php echo $content ?>
					</div>
				</div>
			</div>
			<footer class="footer">
				<div class="container">
					<div class="copyright">
						©
						<script>
							document.write(new Date().getFullYear())
						</script>, made with by
						<a href="" target="_blank" >putut.nalendro@gmailcom</a> for a better web.
					</div>
				</div>
			</footer>
		</div>
	</div>
	<?php $this->endBody(); ?>
</body>

</html>
<?php $this->endPage(); ?>
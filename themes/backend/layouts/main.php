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
$controller = Yii::$app->controller->id;
$action = Yii::$app->controller->action->id;
$controllerAction = $controller.'/'.$action;
?>
<?php $this->beginPage();?>
<!DOCTYPE html>
<html lang="">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta charset="<?= Yii::$app->charset ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="theme-color" content="#317EFB"/>
	<?php //echo Html::csrfMetaTags() ?>
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
	<?php $this->head() ?>
</head>
<body>
	<?php $this->beginBody();?>
	<div class="wrapper">

	    <div class="sidebar" data-color="blue" data-image="../assets/img/sidebar-1.jpg">
			<!--
		        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"

		        Tip 2: you can also add an image using data-image tag
		    -->

			<div class="logo" align ="center"> 
			<img src="../themes/backend/images/resource/logo.png">
			</div>

	    	<div class="sidebar-wrapper">
	            <ul class="nav">
	                <li class="<?php echo $controllerAction == 'admin/dashboard' ? 'active' : ''?>">
	                    <a href="<?php echo Url::toRoute(['admin/dashboard']); ?>">
	                        <i class="material-icons">dashboard</i>
	                        <p>Dashboard</p>
	                    </a>
	                </li>
	                <li class="<?php echo $controllerAction == 'tbl-buku/index' ? 'active' : ''?>">
	                    <a href="<?php echo Url::toRoute(['tbl-buku/index']); ?>">
	                        <i class="material-icons">book</i>
	                        <p>Upload Books</p>
	                    </a>
	                </li>
					<li class="<?php echo $controllerAction == 'tbl-chapter/index' ? 'active' : ''?>">
	                    <a href="<?php echo Url::toRoute(['tbl-chapter/index']); ?>">
	                        <i class="material-icons">library_books</i>
	                        <p>Upload Chapters</p>
	                    </a>
	                </li>
					
					<li class="<?php echo $controllerAction == 'tbl-kuis/index' ? 'active' : ''?>">
	                    <a href="<?php echo Url::toRoute(['tbl-kuis/index']); ?>">
	                        <i class="material-icons">content_copy</i>
	                        <p>Upload Quizs</p>
	                    </a>
	                </li>
					<li class="<?php echo $controllerAction == 'tbluser/index' ? 'active' : ''?>">
	                    <a href="<?php echo Url::toRoute(['tbluser/index']); ?>">
	                        <i class="material-icons">person</i>
	                        <p>My profile</p>
	                    </a>
	                </li>
	                <li class="<?php echo $controller == 'logout' ? 'active' : ''?>">
	                    <a href="<?php echo Url::toRoute(['admin/logout']); ?>">
	                        <i class="material-icons">logout</i>
	                        <p>Logout</p>
	                    </a>
	                </li>
	            </ul>
	    	</div>
	    </div>

	    <div class="main-panel">
			<nav class="navbar navbar-transparent navbar-absolute">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">Welcome Learning Partner</a>
					</div>
					<div class="collapse navbar-collapse">
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="<?php echo Url::toRoute(['admin/dashboard']); ?>" class="dropdown-toggle" data-toggle="dropdown">
									<i class="material-icons">dashboard</i>
									<p class="hidden-lg hidden-md">Dashboard</p>
								</a>
							</li>
							<!-- <li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="material-icons">notifications</i>
									<span class="notification">5</span>
									<p class="hidden-lg hidden-md">Notifications</p>
								</a>
								<ul class="dropdown-menu">
									<li><a href="#">Mike John responded to your email</a></li>
									<li><a href="#">You have 5 new tasks</a></li>
									<li><a href="#">You're now friend with Andrew</a></li>
									<li><a href="#">Another Notification</a></li>
									<li><a href="#">Another One</a></li>
								</ul>
							</li> -->
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">
									<i class="material-icons">person</i>
	 							   	<p class="hidden-lg hidden-md"><a href>Profile<a></p>
								</a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo Url::toRoute(['tbluser/index']); ?>">Profile</a></li>
									<li><a href="<?php echo Url::toRoute(['admin/logout']); ?>">Logout</a></li>
								</ul>
							</li>
						</ul>

						<form class="navbar-form navbar-right" role="search">
							<div class="form-group  is-empty">
								<input type="text" class="form-control" placeholder="Search">
								<span class="material-input"></span>
							</div>
							<button type="submit" class="btn btn-white btn-round btn-just-icon">
								<i class="material-icons">search</i><div class="ripple-container"></div>
							</button>
						</form>
					</div>
				</div>
			</nav>
			<div class="content">
	            <div class="container-fluid">
					<?= Breadcrumbs::widget([
						'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
					]) ?>
				<?php
    // NavBar::begin([
    //     'brandLabel' => Yii::$app->name,
    //     'brandUrl' => Yii::$app->homeUrl,
    //     'options' => [
    //         'class' => 'navbar-inverse navbar-fixed-top',
    //     ],
    // ]);
    // echo Nav::widget([
    //     'options' => ['class' => 'navbar-nav navbar-right'],
    //     'items' => [
    //         ['label' => 'Home', 'url' => ['/site/index']],
    //         ['label' => 'About', 'url' => ['/site/about']],
    //         ['label' => 'Contact', 'url' => ['/site/contact']],
    //         Yii::$app->user->isGuest ? (
    //             ['label' => 'Login', 'url' => ['/site/login']]
    //         ) : (
    //             '<li>'
    //             . Html::beginForm(['/site/logout'], 'post')
    //             . Html::submitButton(
    //                 'Logout (' . Yii::$app->user->identity->username . ')',
    //                 ['class' => 'btn btn-link logout']
    //             )
    //             . Html::endForm()
    //             . '</li>'
    //         )
    //     ],
    // ]);
    // NavBar::end();
    ?>
					<?php echo $content ?>
				</div>
			</div>

			<!-- <footer class="footer">
				<div class="container-fluid">
					<nav class="pull-left">
						<ul>
							<li>
								<a href="#">
									Home
								</a>
							</li>
							<li>
								<a href="#">
									Company
								</a>
							</li>
							<li>
								<a href="#">
									Portfolio
								</a>
							</li>
							<li>
								<a href="#">
								   Blog
								</a>
							</li>
						</ul>
					</nav>
					<p class="copyright pull-right">
						&copy; <script>document.write(new Date().getFullYear())</script> <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
					</p>
				</div>
			</footer> -->
		</div>
	</div>
	<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
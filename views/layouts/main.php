<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\LanguageSwitcher;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register( $this );
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?= Html::csrfMetaTags() ?>
	<title><?= Html::encode( $this->title ) ?></title>
	<?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
	<div class="wrap">
		<?php

			NavBar::begin( [
				'brandLabel' => 'Truth and Freedom',
				'brandUrl' => Yii::$app->homeUrl,
				'options' => [ 'class' => 'navbar-inverse navbar-fixed-top' ],
			] );

			echo Nav::widget( [
				'options' => [ 'class' => 'navbar-nav navbar-right' ],
				'items' => [
					'<li><span>' . LanguageSwitcher::widget(). '</span></li>',
					[ 'label' => 'Home', 'url' => [ '/site/index' ] ],
					[ 'label' => 'Lessons', 'url' => [ '/lesson/index' ], 'visible' => Yii::$app->user->identity->username == 'admin' ],
					[ 'label' => 'Students', 'url' => [ '/student/index' ], 'visible' => Yii::$app->user->identity->username == 'admin' ],
					[ 'label' => 'Course',
						'visible' => Yii::$app->user->identity->username !== 'admin' && !Yii::$app->user->isGuest,
						'items' => [
							[ 'label' => 'Lessons', 'url' => [ '/student-lesson/index' ] ],
							[ 'label' => 'Introduction', 'url' => [ '/site/intro' ] ]
						]
					],
					[ 'label' => 'About', 'url' => [ '/site/about' ] ],
					[ 'label' => 'Contact', 'url' => [ '/site/contact' ] ],
					Yii::$app->user->isGuest ?
						[ 'label' => 'Login', 'url' => [ '/site/login' ] ] :
						[ 'label' => 'Logout (' . Yii::$app->user->identity->username . ')',
							'url' => [ '/site/logout' ],
							'linkOptions' => [ 'data-method' => 'post' ] ],
					'<li><span><a class="link" target="_blank" href="http://www.vision2020asia.org">Vision 20/20 Asia Site</a></span></li>',
				],
			] );

			NavBar::end();
		?>
		<div class="container">
			<?= Breadcrumbs::widget( [ 'links' => isset( $this->params[ 'breadcrumbs' ] ) ? $this->params[ 'breadcrumbs' ] : [] ] ) ?>
			<?= $content ?>
		</div>
	</div>

	<footer class="footer">
		<div class="container">
			<p class="pull-left">&copy; Truth and Freedom <?= date( 'Y' ) ?></p>
			<p class="pull-right"><?= Yii::powered() ?></p>
		</div>
	</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

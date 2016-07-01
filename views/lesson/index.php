<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Lesson;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LessonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t( 'app', 'Lessons' );
$this->params[ 'breadcrumbs' ][] = $this->title;
?>
<div class="lesson-index">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<p>
		<?= Html::a( Yii::t( 'app', 'Create Lesson' ), [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
	</p>

	<?= GridView::widget( [
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
//			[ 'class' => 'yii\grid\SerialColumn' ],
			'number',
			[
				'attribute' => 'language',
				'format' => 'text',
				'content' => function ( $data ) { return Lesson::getLanguageName(  $data->language ); },
			],
			'title',
//			'text:ntext',
			[ 'class' => 'yii\grid\ActionColumn' ],
		],
	] ); ?>

</div>

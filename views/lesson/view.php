<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;
use app\models\Question;
use app\models\Answer;
use app\models\Lesson;

/* @var $this yii\web\View */
/* @var $model app\models\Lesson */
/* @var $questionDataProvider DataProvider */

$this->title = $model->title;
$this->params[ 'breadcrumbs' ][] = [ 'label' => Yii::t( 'app', 'Lessons' ), 'url' => [ 'index' ] ];
$this->params[ 'breadcrumbs' ][] = $this->title;
?>
<div class="lesson-view">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<p>
		<?= Html::a( Yii::t( 'app', 'Update' ), [ 'update', 'id' => $model->id ], [ 'class' => 'btn btn-primary' ] ) ?>
		<?= Html::a( Yii::t( 'app', 'Delete' ), [ 'delete', 'id' => $model->id ], [
			'class' => 'btn btn-danger',
			'data' => [
				'confirm' => Yii::t( 'app', 'Are you sure you want to delete this item?' ),
				'method' => 'post',
			],
		] ) ?>
	</p>

	<?= DetailView::widget( [
		'model' => $model,
		'attributes' => [
			'id',
			'number',
			[
				'attribute' => 'language',
				'format' => 'text',
				'value' => Lesson::getLanguageName( $model->language ),
			],
			'title',
//			'text:ntext',
			[
				'attribute' => 'text',
				'format' => 'raw',
				'content' => function ( $data ) { return Html.encode( $data->text ); },
			]
		],
	] ) ?>
 
	<?= GridView::widget( [
		'dataProvider' => $questionDataProvider,
		'columns' => [
			'number',
			[
				'attribute' => 'type',
				'format' => 'text',
				'content' => function ( $data ) { return Question::getTypeName(  $data->type ); },
			],
			'text',
			[
				'attribute' => 'answerId',
				'format' => 'text',
				'content' => function ( $data ) { return answerId !== null ? Answer::findOne( [ 'id' => $data->answerId ] )->text : ''; }
			],
			[
				'class' => 'yii\grid\ActionColumn',
				'controller' => 'question',
				'template' => '{update} {delete}',
				'options' => [ 'width' => '50px' ]
			],
		],
	] ) ?>

	<?= Html::a( Yii::t( 'app', 'Add Question' ), [ 'question/create', 'lessonId' => $model->id, 'number' => $questionDataProvider->count + 1 ], [ 'class' => 'btn btn-primary' ] ) ?>

</div>

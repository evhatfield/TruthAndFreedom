<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Question */
/* @var $answerDataProvider DataProvider */

$this->title = $model->id;
$this->params[ 'breadcrumbs' ][] = [ 'label' => Yii::t( 'app', 'Questions' ), 'url' => [ 'index' ] ];
$this->params[ 'breadcrumbs' ][] = $this->title;
?>
<div class="question-view">

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
			'lessonId',
			'number',
			'type',
			'text',
			'answerId',
		],
	]) ?>
 
	<?= GridView::widget( [
		'dataProvider' => $answerDataProvider,
		'columns' => [
			'text',
			[
				'class' => 'yii\grid\ActionColumn',
				'controller' => 'answer'
			],
		],
	] ) ?>

	<?= Html::a( Yii::t( 'app', 'Add Answer' ), [ 'question/create', 'lessonId' => $model->id ], [ 'class' => 'btn btn-primary' ] ) ?>

</div>

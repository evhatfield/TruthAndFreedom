<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentLessonSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t( 'app', 'Student Lessons' );
$this->params[ 'breadcrumbs' ][] = $this->title;
?>
<div class="student-lesson-index">

	<h1><?= Html::encode( $this->title ) ?></h1>
	<?php // echo $this->render( '_search', [ 'model' => $searchModel ] ); ?>

	<p>
		<?= Html::a( Yii::t( 'app', 'Create Student Lesson' ), [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
	</p>

	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			[ 'class' => 'yii\grid\SerialColumn' ],
			'id',
			'studentId',
			'lessonId',
			'status',
			'grade',
			[ 'class' => 'yii\grid\ActionColumn' ],
		],
	] ); ?>

</div>

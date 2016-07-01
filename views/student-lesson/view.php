<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Lesson;

/* @var $this yii\web\View */
/* @var $model app\models\StudentLesson */

$this->title = $model->lesson->title;
$this->params[ 'breadcrumbs' ][] = [ 'label' => Yii::t( 'app', 'Student Lessons' ) /*, 'url' => [ 'index' ] */];
$this->params[ 'breadcrumbs' ][] = $this->title;
?>
<div class="student-lesson-view">
	<h1><?= $this->title ?><h1>
	<?= $model->lesson->text ?>
	<div class="row">
		<?php if ( $model->lesson->number >  1 ) : ?>
			<div class="col-lg-4"><?= Html::a( Yii::t( 'app', 'Previous Lesson' ), [ 'student-lesson/view', 'id' => $model->findPrevious()->id ] ) ?></div>
		<?php else : ?>
			<div class="col-lg-4">&nbsp;</div>
		<?php endif; ?>
		<?php if ( $model->status < 2 ) : ?>
			<div class="col-lg-4"><?= Html::a( Yii::t( 'app', 'Review Questions'), [ 'review', 'id' => $model->id ] ) ?></div>
		<?php else : ?>
			<div class="col-lg-4">&nbsp;</div>
			<?php if ( $model->lesson->number < Lesson::find()->where( [ 'language' => 'en-US' ] )->count() ) : ?>
				<div class="col-lg-4"><?= Html::a( Yii::t( 'app', 'Next Lesson' ), [ 'student-lesson/view', 'id' => $model->findNext()->id ] ) ?></div>
			<?php endif; ?>
		<?php endif; ?>
	</div>
</div>

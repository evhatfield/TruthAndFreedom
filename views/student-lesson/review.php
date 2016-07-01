<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentLesson */


$this->title = Yii::t('app', 'Student Lessons');
$this->params[ 'breadcrumbs' ][] = $this->title;
?>
<div class="student-lesson-form">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<?php
		$questions = $model->lesson->questions;
	?>
	<?php $form = ActiveForm::begin(); ?>
	<?php
		foreach ( $questions as $question )
		{
			echo $this->render( '_question', [ 'model' => $question, 'form' => $form ] );
		}
	?>
	<div class="form-group">
		<?= Html::submitButton( Yii::t( 'app', 'Submit' ), [ 'class' => 'btn btn-primary' ] ) ?>
	</div>
	<?php ActiveForm::end(); ?>

</div>

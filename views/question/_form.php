<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use app\models\Answer;
use app\models\AnswerSearch;

/* @var $this yii\web\View */
/* @var $model app\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="question-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field( $model, 'lessonId', [ 'inputOptions' => [ 'readonly' => 'true' ] ] ) ?>

	<?= $form->field( $model, 'number', [ 'inputOptions' => [ 'readonly' => 'true' ] ] ) ?>

	<?= $form->field( $model, 'type' )->dropDownList( [ 0 => 'True/False', 1 => 'Multiple Choice', 2 => 'Number', 3 => 'Short Answer', 4 => 'Multiple Answers' ], [ 'onchange' => 'this.form.submit()' ] ) ?>

	<?= $form->field( $model, 'text' )->textInput( [ 'maxlength' => true ] ) ?>

	<?php
		if ( $model->isNewRecord )
		{
			echo '';
		}
		else
		{
			switch ( $model->type )
			{
				case 0:
					echo $form->field( $model, 'answerId' )->dropDownList( [ 1 => 'True', 2 => 'False' ], [ 'prompt' => 'Choose Correct Answer' ] );
					break;

				case 1:
				case 2:
				case 3:
				case 4:
					echo $form->field( $model, 'answerId' )
						->dropDownList( ArrayHelper::map(
							Answer::find()->where( [ 'questionId' => $model->id ] )->all(), 'id', 'text' ), [ 'prompt' => 'Choose Correct Answer' ] );
					break;

				default:
					echo '';
					break;
			}
		}
	?>

	<div class="form-group">
		<?= Html::submitButton( $model->isNewRecord ? Yii::t( 'app', 'Create' ) : Yii::t( 'app', 'Update' ), [ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
	</div>

	<?php ActiveForm::end(); ?>

	<?php
		if ( !$model->isNewRecord && $model->type > 0 )
		{
			$searchModel = new AnswerSearch();
			$dataProvider = $searchModel->search( [ 'AnswerSearch' => [ 'questionId' => $model->id ] ] );
			echo GridView::widget( [
				'dataProvider' => $dataProvider,
				'columns' => [
					'text',
					[
						'class' => 'yii\grid\ActionColumn',
						'controller' => 'answer',
						'template' => '{update} {delete}',
						'options' => [ 'width' => '50px' ]
					],
				],
			] );

			if ( $model->type != 2 && $model->type != 3 || $dataProvider->count == 0 )
			{
				echo Html::a( Yii::t( 'app', 'Add Answer' ), [ 'answer/create', 'questionId' => $model->id ], [ 'class' => 'btn btn-primary' ] );
			}
		}
	?>

</div>

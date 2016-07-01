<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Lesson */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lesson-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field( $model, 'number' )->textInput() ?>

	<?= $form->field( $model, 'language' )->dropDownList( Yii::$app->params[ 'languages' ] ) ?>

	<?= $form->field( $model, 'title' )->textInput( [ 'maxlength' => true ] ) ?>

	<?= $form->field( $model, 'text' )->textarea( [ 'rows' => 20 ] ) ?>

	<div class="form-group">
		<?= Html::submitButton( $model->isNewRecord ? Yii::t( 'app', 'Create' ) : Yii::t( 'app', 'Update' ), [ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>

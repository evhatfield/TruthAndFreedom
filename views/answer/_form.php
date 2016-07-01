<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Answer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="answer-form">

	<?php $form = ActiveForm::begin(); ?>

	<?= $form->field( $model, 'questionId', [ 'inputOptions' => [ 'readonly' => 'true' ] ] )->textInput() ?>

	<?= $form->field( $model, 'text', [ 'inputOptions' => [ 'autofocus' => 'autofocus', 'size' => 50 ] ] )->textInput() ?>

	<div class="form-group">
		<?= Html::submitButton( $model->isNewRecord ? Yii::t( 'app', 'Create' ) : Yii::t( 'app', 'Update' ), [ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>
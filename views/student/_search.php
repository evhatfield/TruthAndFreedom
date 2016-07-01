<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\StudentSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-search">

	<?php $form = ActiveForm::begin( [ 'action' => [ 'index' ], 'method' => 'get' ] ); ?>
	<?= $form->field( $model, 'id' ) ?>
	<?= $form->field( $model, 'surname' ) ?>
	<?= $form->field( $model, 'givenName' ) ?>
	<?= $form->field( $model, 'language' ) ?>
	<?= $form->field( $model, 'address1' ) ?>
	<?php // echo $form->field( $model, 'address2' ) ?>
	<?php // echo $form->field( $model, 'city' ) ?>
	<?php // echo $form->field( $model, 'stateOrProvince' ) ?>
	<?php // echo $form->field( $model, 'postalCode' ) ?>
	<?php // echo $form->field( $model, 'country' ) ?>
	<?php // echo $form->field( $model, 'homePhone' ) ?>
	<?php // echo $form->field( $model, 'mobilePhone' ) ?>
	<?php // echo $form->field( $model, 'email' ) ?>
	<?php // echo $form->field( $model, 'username' ) ?>
	<?php // echo $form->field( $model, 'password' ) ?>
	<?php // echo $form->field( $model, 'registeredDate' ) ?>
	<?php // echo $form->field( $model, 'profession' ) ?>
	<?php // echo $form->field( $model, 'dateOfBirth' ) ?>
	<?php // echo $form->field( $model, 'religion' ) ?>
	<?php // echo $form->field( $model, 'education' ) ?>
	<?php // echo $form->field( $model, 'howReferred' ) ?>
	<?php // echo $form->field( $model, 'isSaved' ) ?>

	<div class="form-group">
		<?= Html::submitButton( Yii::t( 'app', 'Search' ), [ 'class' => 'btn btn-primary' ] ) ?>
		<?= Html::resetButton( Yii::t( 'app', 'Reset' ), [ 'class' => 'btn btn-default' ] ) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>

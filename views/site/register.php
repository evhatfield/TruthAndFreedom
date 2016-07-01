<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
//use yii\jui\DatePicker;


/* @var $this yii\web\View */
/* @var $model app\models\Student */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t( 'app', 'Register' );
// $this->params[ 'breadcrumbs' ] [] = [ 'label' => Yii::t( 'app', 'Students' ), 'url' => [ 'index' ] ];
$this->params[ 'breadcrumbs' ] [] = $this->title;
?>

<div class="site-register">
	<h1><?= Html::encode( $this->title ) ?></h1>
	<div class="register-form">
		<?php $form = ActiveForm::begin(); ?>

		<div class="row">
			<div class="col-lg-4">
				<?= $form->field( $model, 'givenName' )->textInput( [ 'maxlength' => true, 'size' => 20 ] ) ?>
			</div>
			<div class="col-lg-4">
				<?= $form->field( $model, 'surname' )->textInput( [ 'maxlength' => true, 'size' => 20 ] ) ?>
			</div>
			<div class="col-lg-4">
				<?= $form->field( $model, 'dateOfBirth' )->textInput( [ 'maxlenth' => true ] ) ?>
				<?php /*DatePicker::widget( [ 'model' => $model, 'attribute' => 'dateOfBirth', 'clientOptions' => [ 'dateFormat' => 'yyyy-mm-dd' ] ] ) */ ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<?= $form->field( $model, 'address1' )->textInput( [ 'maxlength' => true ] ) ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<?= $form->field( $model, 'address2' )->textInput( [ 'maxlength' => true ] ) ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<?= $form->field( $model, 'city' )->textInput( [ 'maxlength' => true ] ) ?>
			</div>
			<div class="col-lg-4">
				<?= $form->field( $model, 'stateOrProvince' )->textInput( [ 'maxlength' => true ] ) ?>
			</div>
			<div class="col-lg-4">
				<?= $form->field( $model, 'postalCode' )->textInput( [ 'maxlength' => true ] ) ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<?= $form->field( $model, 'country' )->textInput( [ 'maxlength' => true ] ) ?>
			</div>
			<div class="col-lg-4">
				<?= $form->field( $model, 'language' )->dropDownList( Yii::$app->params[ 'languages' ] ) ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<?= $form->field( $model, 'homePhone' )->textInput( [ 'maxlength' => true ] ) ?>
			</div>
			<div class="col-lg-4">
				<?= $form->field( $model, 'mobilePhone' )->textInput( [ 'maxlength' => true ] ) ?>
			</div>
			<div class="col-lg-4">
				<?= $form->field( $model, 'email' )->textInput( [ 'maxlength' => true ] ) ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<?= $form->field( $model, 'username' )->textInput( [ 'maxlength' => true ] ) ?>
			</div>
			<div class="col-lg-4">
				<?= $form->field( $model, 'password' )->passwordInput( [ 'maxlength' => true ] ) ?>
			</div>
			<div class="col-lg-4">
				<?= $form->field( $model, 'confirmPassword' )->passwordInput( [ 'maxlength' => true ] ) ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<?= $form->field( $model, 'profession' )->textInput( [ 'maxlength' => true ] ) ?>
			</div>
			<div class="col-lg-4">
				<?= $form->field( $model, 'religion' )->textInput( [ 'maxlength' => true ] ) ?>
			</div>
			<div class="col-lg-4">
				<?= $form->field( $model, 'education' )->textInput( [ 'maxlength' => true ] ) ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<?= $form->field( $model, 'howReferred' )->textInput( [ 'maxlength' => true ] ) ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<?= $form->field( $model, 'isSaved' )->checkbox() ?>
			</div>
		</div>
		<div class="form-group">
		  <?= Html::submitButton( Yii::t( 'app', 'Register' ), [ 'class' => 'btn btn-success' ] ) ?>
		</div>

		<?php ActiveForm::end(); ?>
	</div>
</div>

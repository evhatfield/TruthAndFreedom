<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Student */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="student-form">
	<?php $form = ActiveForm::begin(); ?>
<?= Html::hiddenInput( 'originalPassword', $model->password ) ?>
	<div class="row">
		<div class="col-lg-4">
			<?= $form->field( $model, 'givenName' )->textInput( [ 'maxlength' => true, 'size' => 20 ] ) ?>
		</div>
		<div class="col-lg-4">
			<?= $form->field( $model, 'surname' )->textInput( [ 'maxlength' => true, 'size' => 20 ] ) ?>
		</div>
		<div class="col-lg-4">
			<?= $form->field( $model, 'dateOfBirth' )->textInput( [ 'maxlenth' => true ] ) ?>
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
			<div class="form-group field-student-password required">
				<label class="control-label">Confirm Password</label>
				<?= Html::passwordInput( 'confirmPassword', $model->password, [ 'class' => 'form-control' ] ) ?>
			</div>
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
		<div class="col-lg-4">
			<?= $form->field( $model, 'isSaved' )->checkbox() ?>
		</div>
		<div class="col-lg-4">
			<?= $form->field( $model, 'registeredDate', [ 'inputOptions' => [ 'class' => 'form-control', 'readonly' => 'true' ] ]  )->textInput() ?>
		</div>
	</div>

	<div class="form-group">
		<?= Html::submitButton( $model->isNewRecord ? Yii::t( 'app', 'Create' ) : Yii::t( 'app', 'Update' ), [ 'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary' ] ) ?>
	</div>

	<?php ActiveForm::end(); ?>

</div>

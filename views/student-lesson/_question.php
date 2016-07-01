<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Question */
/* @var $form yii\widgets\ActiveForm */
?>

<?php
	echo '<h3>' . Html::encode( $model->text ) . '</h3>';

	switch ( $model->type )
	{
		case 0:
			echo '<h4>' . Html::radioList( 'question' . $model->id, null, [ 1 => 'True', 2 => 'False' ], [ 'separator' => '<br/>' ] ) . '</h4>';
			break;

		case 1:
			echo '<h4>' . Html::radioList( 'question' . $model->id, null, ArrayHelper::map( $model->answers, 'id', 'text' ), [ 'separator' => '<br/>' ] ) . '</h4>';
			break;

		case 2:
			echo '<h4>' . Html::textInput( 'question' . $model->id ) . '</h4>';
			break;
		
		case 3:
			echo '<h4>' . Html::textInput( 'question' . $model->id ) . '</h4>';
			break;

		case 4:
			$answersCount = $model->getAnswers()->count();

			for ( $i = 0; $i < $answersCount; $i++ )
			{
				echo '<h4>' . Html::textInput( 'question' . $model->id . '_' . $i ) . '</h4>';
			}
			break;

		default:
			echo '<h2>' . Html::encode( 'Error with question.  Please contact site administrator.' ) . '</h2';
			break;
	}
?>

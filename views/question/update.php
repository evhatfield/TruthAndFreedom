<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Question */

$this->title = Yii::t( 'app', 'Update {modelClass}: ', [ 'modelClass' => 'Question' ] ) . ' ' . $model->id;
$this->params[ 'breadcrumbs' ][] = [ 'label' => Yii::t( 'app', 'Lessons' ), 'url' => [ 'lesson/index' ] ];
$this->params[ 'breadcrumbs' ][] = [ 'label' => $model->id, 'url' => [ 'view', 'id' => $model->id ] ];
$this->params[ 'breadcrumbs' ][] = Yii::t( 'app', 'Update' );
?>
<div class="question-update">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<div class="col">
		<?= Html::a( Yii::t( 'app', 'Back to Lesson' ), [ 'lesson/view', 'id' => $model->lessonId ] ) ?>
	</div>
	<br/>
	<?= $this->render( '_form', [ 'model' => $model ] ) ?>

</div>

<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\StudentLesson */

$this->title = Yii::t( 'app', 'Create Student Lesson' );
$this->params[ 'breadcrumbs' ][] = [ 'label' => Yii::t( 'app', 'Student Lessons' ), 'url' => [ 'index' ] ];
$this->params[ 'breadcrumbs' ][] = $this->title;
?>
<div class="student-lesson-create">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<?= $this->render( '_form', [ 'model' => $model ] ) ?>

</div>

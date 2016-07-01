<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t( 'app', 'Students' );
$this->params[ 'breadcrumbs' ][] = $this->title;

$languages = [ 'en-US' => 'English', 'zh-CN' => '中文' ];
?>
<div class="student-index">

	<h1><?= Html::encode( $this->title ) ?></h1>

	<p>
		<?= Html::a( Yii::t( 'app', 'Create Student' ), [ 'create' ], [ 'class' => 'btn btn-success' ] ) ?>
	</p>

	<?= GridView::widget( [
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'columns' => [
			[ 'class' => 'yii\grid\SerialColumn' ],
//			'id',
			'surname',
			'givenName',
			'country',
			'email:email',
			'mobilePhone',
			[
				'label' => 'Course Status',
				'format' => 'text',
				'value' => function ( $model ) {
					$count = $model->getStudentLessons()->count();
					if ( $count < 25 && $count > 0 )
					{
						return 'Started';
					}
					else if ( $count === 25 )
					{
						return 'Completed';
					}
					else if ( $model->username === 'admin' )  
					{
						return 'Not Applicable';
					}
					else
					{
						return 'Not Started';
					}
				},
			],
			// 'address1',
			// 'address2',
			// 'city',
			// 'stateOrProvince',
			// 'postalCode',
			// 'country',
			// 'homePhone',
			// 'mobilePhone',
			// 'email:email',
			// 'username',
			// 'password',
			// 'registeredDate',
			// 'profession',
			// 'dateOfBirth',
			// 'religion',
			// 'education',
			// 'howReferred',
			// 'isSaved',
			[
				'class' => 'yii\grid\ActionColumn',
				'options' => [ 'width' => '75px' ]
			],
		],
	] ); ?>

</div>

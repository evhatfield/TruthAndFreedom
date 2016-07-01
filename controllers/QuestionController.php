<?php

namespace app\controllers;

use Yii;
use app\models\Question;
use app\models\QuestionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller
{
	public function behaviors()
	{
		return [
/*
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'actions' => [ create', 'update', 'delete' ],
//						'users' => [ 'admin' ],
						'roles' => [ '@' ],
					],
				],
			], */
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [ 'delete' => [ 'post' ] ],
			],
		];
	}

	/**
	* Lists all Question models.
	* @return mixed
	*/
/*	public function actionIndex()
	{
		$searchModel = new QuestionSearch();
		$dataProvider = $searchModel->search( Yii::$app->request->queryParams );

		return $this->render( 'index', [ 'searchModel' => $searchModel, 'dataProvider' => $dataProvider ] );
	}*/

	/**
	 * Displays a single Question model.
	 * @param integer $id
	 * @return mixed
	 */
/*	public function actionView( $id )
	{
		$model = $this->findModel( $id );
		$searchModel = new AnswerSearch();
		$dataProvider = $searchModel->search( [ 'AnswerSearch' => [ 'questionId' => $model->id ] ] );

		return $this->render( 'view', [ 'model' => $model, 'answerDataProvider' => $dataProvider ] );
	}*/

	/**
	 * Creates a new Question model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate( $lessonId, $number )
	{
		$model = new Question();
		$model->lessonId = $lessonId;
		$model->number = $number;

		if ( $model->load( Yii::$app->request->post() ) && $model->save() )
		{
			return $this->redirect( [ 'update', 'id' => $model->id ] );
		}
		else
		{
			return $this->render( 'create', [ 'model' => $model ] );
		}
    }
	
	/**
	 * Updates an existing Question model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate( $id )
	{
		$model = $this->findModel( $id );

		if ( $model->load( Yii::$app->request->post() ) && $model->save() )
		{
			return $this->redirect( [ 'update', 'id' => $model->id ] );
		}

		return $this->render( 'update', [ 'model' => $model ] );
	}

	/**
	 * Deletes an existing Question model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete( $id )
	{
		$model = $this->findModel( $id );
		
		$trans = Yii::$app->db->beginTransaction();
		$lessonId = $model->lessonId;
		$number = $model->number;
		$model->delete();

		// we need to reorder the questions
		$number++;
		$model = Question::find()->where( [ 'lessonId' => $lessonId, 'number' => $number ] )->one();
		
		while ( $model !== null )
		{
			$model->number = $number - 1;
			$model->save();
			$number++;
			$model = Question::find()->where( [ 'lessonId' => $lessonId, 'number' => $number ] )->one();		
		}
		
		$trans->commit();

		return $this->redirect( [ 'lesson/view', 'id' => $lessonId ] );
	}

	/**
	 * Finds the Question model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Question the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel( $id )
	{
		if ( ( $model = Question::findOne( $id ) ) !== null )
		{
			return $model;
		}
		else
		{
			throw new NotFoundHttpException( 'The requested page does not exist.' );
		}
	}
}

<?php

namespace app\controllers;

use Yii;
use app\models\Lesson;
use app\models\LessonSearch;
use app\models\QuestionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * LessonController implements the CRUD actions for Lesson model.
 */
class LessonController extends Controller
{
	public function behaviors()
	{
		return [
/*			'access' => [
				'class' => AccessControl::className(),
//				'only' => [ 'logout' ],
				'rules' => [
					[
						'allow' => true,
						'actions' => [ 'create', 'update', 'view', 'delete' ],
						'users' => [ 'admin' ],
//						'roles' => [ '@' ],
					],
				],
			], */
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => [ 'post' ],
				],
			],
		];
	}

	/**
	 * Lists all Lesson models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new LessonSearch();
		$dataProvider = $searchModel->search( Yii::$app->request->queryParams );

		return $this->render( 'index', [ 'searchModel' => $searchModel, 'dataProvider' => $dataProvider ] );
	}

	/**
	 * Displays a single Lesson model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView( $id )
	{
		$model = $this->findModel( $id );
		$searchModel = new QuestionSearch();
		$dataProvider = $searchModel->search( [ 'QuestionSearch' => [ 'lessonId' => $model->id ] ] );

		return $this->render( 'view', [ 'model' => $model,  'questionDataProvider' => $dataProvider ] );
	}

	/**
	 * Creates a new Lesson model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new Lesson();
		
		if ( $model->load( Yii::$app->request->post() ) && $model->save() )
		{
			return $this->redirect( [ 'view', 'id' => $model->id ] );
		}
		else
		{
			return $this->render('create', [ 'model' => $model ] );
		}
	}

	/**
	 * Updates an existing Lesson model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate( $id )
	{
		$model = $this->findModel( $id );
	
		if ( $model->load( Yii::$app->request->post() ) && $model->save() )
		{
			return $this->redirect( [ 'view', 'id' => $model->id ] );
		}
		else
		{
			return $this->render('update', [ 'model' => $model ] );
		}
	}

	/**
	 * Deletes an existing Lesson model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete( $id )
	{
		$this->findModel( $id )->delete();

		return $this->redirect( [ 'index' ] );
	}

	/**
	 * Finds the Lesson model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Lesson the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel( $id )
	{
		if ( ( $model = Lesson::findOne( $id ) ) !== null )
		{
			return $model;
		}
		else
		{
			throw new NotFoundHttpException( 'The requested page does not exist.' );
		}
	}
}
